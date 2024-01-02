<?php

namespace App\Http\Controllers;

use App\Mail\CreatePasswordMail;
use App\Models\Answer;
use App\Models\AnswerSheet;
use App\Models\AnswerSubmission;
use App\Models\Aufgabe;
use App\Models\Bereich;
use App\Models\Formular;
use App\Models\QuestionAnswerRelation;
use App\Models\User;
use App\Models\UserAnswerSubmission;
use Brian2694\Toastr\Toastr;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FormularController extends Controller
{
    public function submissionPhotoDelete(Request $request)
    {
        try {
            $userAnswerSubmissionId = $request->userAnswerSubmissionId;
            if ($request->photo) {
                $userAns = UserAnswerSubmission::findOrFail($userAnswerSubmissionId);
                if (isset($userAns->photo)) {
                    $photos = json_decode($userAns->photo);
                    if (isset($photos) && is_array($photos)) {
                        $photoPath = public_path('images/formular/' . $request->photo);
                        if (file_exists($photoPath)) {
                            unlink($photoPath);
                        } else {
                        }

                        $photos = array_diff($photos, [$request->photo]);
                        $userAns->photo = json_encode(array_values($photos));
                        $userAns->save();
                        return response()->json(['success' => true, 'message' => 'Photo deleted successfully']);
                    }
                }
            }
            return response()->json(['error' => false, 'message' => 'Photo not found']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function vorlagen(Request $request)
    {
        $query = Formular::where('user_id', auth()->id());
        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->where('title', 'like', "%{$key}%");
            });
        }
        $data['url'] = "Vorlagen";
        $data['search'] = $request->search;
        $data['formulars'] = $query->paginate(10);

        return view('user.vorlagen.index', $data);
    }

    public function index(Request $request)
    {
        $query = Formular::with('users')->latest();
//        if ($request->has('search')) {
//            $key = $request->input('search');
//            $query->where(function ($q) use ($key) {
//                $q->where('title', 'like', "%{$key}%");
//            });
//        }
        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->where('title', 'like', "%{$key}%")
                    ->orWhereHas('users', function ($userQuery) use ($key) {
                        $userQuery->where('firmenname', 'like', "%{$key}%");
                    });
            });
        }

        $data['url'] = "Vorlagen";
        $data['search'] = $request->search;
        $data['formulars'] = $query->paginate(10);

        return view('admin.formular.index', $data);
    }

    public function vorlagenAntwortenIndex(Request $request)
    {
        $query = AnswerSheet::query();
        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->where('title', 'like', "%{$key}%");
            });
        }
        $query->whereType('Dropdown');
        $data['url'] = "Dropdown";
        $data['search'] = $request->search;
        $data['answersheets'] = $query->paginate(10);
        return view('admin.answer.index', $data);
    }

    public function vorlagenAntworten()
    {
        $data['url'] = "Dropdown";
        return view('admin.answer.create', $data);
    }

    public function vorlagenAntwortenStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        if (!$request->title) {
            return redirect()->back()->with(['error' => 'Antwortgruppe field required.']);
        }

        $answerSheet = new AnswerSheet();
        $answerSheet->title = $request->title;
        $answerSheet->type = "Dropdown";
        $answerSheet->save();

        if (!$request->kt_docs_repeater_basic) {
            return redirect()->back()->with(['error' => 'Antwort field required.']);
        }
        foreach ($request->kt_docs_repeater_basic as $answer) {
            $answerCreate = new Answer();
            $answerCreate->answer_sheet_id = $answerSheet->id;
            $answerCreate->answer = $answer['answer'];
            $answerCreate->save();
        }
        return redirect()->route('vorlagen.antworten.index')->with(['success' => 'Vorlagen Antworten created successfully']);
    }

    public function vorlagenAntwortenEdit($id)
    {
        $data['url'] = "Dropdown Edit";
        $data['answersheet'] = AnswerSheet::find($id);
        return view('admin.answer.edit', $data);
    }

    public function vorlagenAntwortenUpdate(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        $answersheet = Answersheet::updateOrCreate(
            ['id' => $request->id],
            ['title' => $request->input('title')]
        );

        $answersheet->answers()->delete();
        foreach ($request->input('kt_docs_repeater_basic') as $answerText) {
            $answer = new Answer(['answer' => $answerText['answer']]);
            $answersheet->answers()->save($answer);
        }
        return redirect()->route('vorlagen.antworten.edit', $request->id)->with(['success' => 'Updated successfully.']);
    }

    public function antwortenDestroy($id)
    {
        DB::beginTransaction();
        try {
            $answersheet = AnswerSheet::find($id);
            if (!$answersheet) {
                return redirect()->route('vorlagen.antworten.index')->with('error', 'Answer group not found.');
            }
            // Delete each related answer individually
            foreach ($answersheet->answers as $answer) {
                $answer->delete();
            }
            $answersheet->delete();
            DB::commit();
            return redirect()->route('vorlagen.antworten.index')->with('success', 'Answer group and related records deleted successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error deleting the Answer group: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $data['url'] = "Create";
        $data['users'] = User::where('role_id', 2)->get();
        $data['answersheets'] = AnswerSheet::get();
        return view('admin.formular.new_create', $data);
    }

    public function store(Request $request)
    {
        $customMessage = [
            'aufgaben.*.name.required' => "Bereich field required.",
            'aufgaben.*.bereich.*.name.required' => 'Aufgaben field required.',
        ];
        // Validate the request
        $validator = Validator::make($request->all(), [
            'titel' => 'required',
            'aufgaben.*.name' => 'required',
            'aufgaben.*.bereich.*.name' => 'required',
        ], $customMessage);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                toastr()->error($error, 'Validation Error');
            }
            return redirect()->back();
        }

        try {
            $formular = new Formular();
            $formular->title = $request->input('titel');
            $formular->user_id = $request->input('kunde');
            $formular->save();

            foreach ($request->input('aufgaben', []) as $aufgabenData) {
                if (!is_null($aufgabenData['name'])) {
                    $aufgaben = new Aufgabe();
                    $aufgaben->formular_id = $formular->id;
                    $aufgaben->name = $aufgabenData['name'];
                    $aufgaben->save();

                    if (isset($aufgabenData['bereich'])) {
                        foreach ($aufgabenData['bereich'] as $bereichData) {
                            if (!is_null($bereichData['name'])) {

                                $bereich = new Bereich();
                                $bereich->name = $bereichData['name'];
                                $bereich->aufgabe_id = $aufgaben->id;
                                $bereich->save();

                                if (isset($bereichData['checkbox'])) {
                                    if (!is_null($bereichData['checkbox'])) {
                                        $questionAns = new QuestionAnswerRelation();
                                        $questionAns->question_id = $bereich->id;
                                        $questionAns->answer_sheet_id = $bereichData['checkbox'];
                                        $questionAns->save();
                                    }
                                }

                            }
                        }
                    }
                }
            }

            return redirect()->route('formular.index')->with('success', 'Formular created successfully.');
        } catch (\Exception $e) {
            // Handle any unexpected exceptions
            return redirect()->back()->with('error', 'An error occurred while creating the formular.');
        }
    }

    public function edit($id)
    {
        $data['url'] = "Edit";
        $data['formular'] = Formular::find($id);
        $data['users'] = User::where('role_id', 2)->get();
        $data['answersheets'] = AnswerSheet::get();
        return view('admin.formular.new_edit', $data);
    }

    public function update(Request $request, $id)
    {
        $customMessage = [
            'aufgaben.*.name.required' => "Bereich field required.",
            'aufgaben.*.bereich.*.name.required' => 'Aufgaben field required.',
        ];
        $validator = Validator::make($request->all(), [
            'titel' => 'required',
            'kunde' => 'nullable',
            'aufgaben' => 'required|array',
            'aufgaben.*.name' => 'required',
            'aufgaben.*.bereich' => 'nullable|array',
            'aufgaben.*.bereich.*.name' => 'required',
            'aufgaben.*.bereich.*.checkbox' => 'nullable',
        ], $customMessage);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                toastr()->error($error, 'Validation Error');
            }
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $formular = Formular::findOrFail($id);
            $formular->user_id = $request->input('kunde');
            $formular->title = $request->input('titel');
            $formular->save();

            $existingBereichIds2 = [];
            $aufgaben = Aufgabe::where('formular_id', $formular->id)->get();
            foreach ($request->aufgaben as $index => $aufgabenData) {
                $aufgabe = $aufgaben->get($index);
                if (!$aufgabe) {
                    $aufgabe = new Aufgabe(['name' => $aufgabenData['name']]);
                    $formular->aufgabes()->save($aufgabe);
                } else {
                    $aufgabe->update(['name' => $aufgabenData['name']]);
                }
//                if (isset($aufgabenData['bereich'])) {
//                    $bereiches = Bereich::where('aufgabe_id', $aufgabe->id)->get();
//                    $existingBereichIds = $bereiches->pluck('id')->toArray();
//
//                    foreach ($aufgabenData['bereich'] as $bereichIndex => $bereichData) {
//                        $bereich = $bereiches->get($bereichIndex);
//                        $isNewBereich = false;
//
//                        if (!$bereich) {
//                            $bereich = new Bereich(['name' => $bereichData['name']]);
//                            $aufgabe->bereiches()->save($bereich);
//                            $isNewBereich = true;
//                        }
//                        if (isset($bereichData['checkbox'])) {
//                            $questionId = $isNewBereich ? $bereich->id : $bereich->id;
//                            QuestionAnswerRelation::updateOrCreate(
//                                ['question_id' => $questionId],
//                                ['answer_sheet_id' => $bereichData['checkbox']]
//                            );
//                        }
//                        $existingBereichIds2[] = $bereich->id;
//
//                        $bereich->update(['name' => $bereichData['name']]);
//                    }
//                    dd($existingBereichIds2);
//                    $bereichesToDelete = $bereiches->whereNotIn('id', $existingBereichIds2);
//                    $bereichesToDelete->each->delete();
//                }
                if (isset($aufgabenData['bereich'])) {
                    $bereiches = Bereich::where('aufgabe_id', $aufgabe->id)->get();
                    $existingBereichIds = $bereiches->pluck('id')->toArray();
                    foreach ($aufgabenData['bereich'] as $bereichIndex => $bereichData) {
                        $bereich = $bereiches->get($bereichIndex);
                        $isNewBereich = false;

                        if (!$bereich) {
                            $bereich = new Bereich(['name' => $bereichData['name']]);
                            $aufgabe->bereiches()->save($bereich);
                            $isNewBereich = true;
                        }
                        if (isset($bereichData['checkbox'])) {
                            $questionId = $isNewBereich ? $bereich->id : $bereich->id;
                            QuestionAnswerRelation::updateOrCreate(
                                ['question_id' => $questionId],
                                ['answer_sheet_id' => $bereichData['checkbox']]
                            );
                        } else {
                            if (isset($bereichData['old_checkbox'])) {
                                $questionId = $isNewBereich ? $bereich->id : $bereich->id;
                                QuestionAnswerRelation::updateOrCreate(
                                    ['question_id' => $questionId],
                                    ['answer_sheet_id' => $bereichData['old_checkbox']]
                                );

                            }
                        }
                        $existingBereichIds2[] = $bereich->id;
                        $bereich->update(['name' => $bereichData['name']]);
                    }
                    $bereichesToDelete = $bereiches->whereNotIn('id', $existingBereichIds2);
                    $bereichesToDelete->each->delete();
                } else {
                    return redirect()->route('formular.index')->with('error', 'You need to complete one aufgabe.');
                }
            }

            $existingAufgabenIndices = $aufgaben->keys()->toArray();
            $requestedAufgabenIndices = array_keys($request->aufgaben);
            $indicesToDelete = array_diff($existingAufgabenIndices, $requestedAufgabenIndices);
            foreach ($indicesToDelete as $indexToDelete) {
                $aufgabeToDelete = $aufgaben->get($indexToDelete);
                $aufgabeToDelete->delete();
            }

            DB::commit();
            return redirect()->route('formular.index')->with('success', 'Formulare updated successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error updating the formulare: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $formular = Formular::find($id);

            if (!$formular) {
                return redirect()->route('formular.index')->with('error', 'Formulare not found.');
            }

            $formular->aufgabes->each(function ($aufgabe) {
                if ($aufgabe->questionAnswerRelation) {
                    $aufgabe->questionAnswerRelation->delete();
                }
                $aufgabe->bereiches()->delete();

                $aufgabe->delete();
            });
            $formular->delete();

            DB::commit();
            return redirect()->route('formular.index')->with('success', 'Formulare and related records deleted successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error deleting the formulare: ' . $e->getMessage());
        }
    }

    public function answerSheet(Request $request)
    {
        $question_id = $request->input('aufgaben');
        $selectedCheckboxes = $request->input('checkboxes');
        return redirect()->route('formular.index');
    }

    public function submission(Request $request)
    {

        $query = AnswerSubmission::with(['formulars', 'userId'])->latest();
        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->whereHas('formulars', function ($formularsQuery) use ($key) {
                    $formularsQuery->where('title', 'like', "%{$key}%");
                })->orWhereHas('userId', function ($userQuery) use ($key) {
                    $userQuery->where('firmenname', 'like', "%{$key}%");
                });
            });
        }
        if (!empty($request->date)) {
            $dateRange = explode(' - ', $request->date);

            if (count($dateRange) == 2) {
                $startDate = \Carbon\Carbon::createFromFormat('m/d/Y', $dateRange[0])->startOfDay();
                $endDate = \Carbon\Carbon::createFromFormat('m/d/Y', $dateRange[1])->endOfDay();

                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
        }
        $data['url'] = "Berichte";
        $data['search'] = $request->search;
        $data['date'] = $request->date;
        $data['ansSubmissions'] = $query->paginate(10);
        return view('admin.formular.submission', $data);
    }

    public function submissionView(Request $request, $id, $user_id)
    {
        $data['url'] = "View";
        $data['userId'] = $request->user_id;
        $data['submission'] = AnswerSubmission::findOrFail($id);
        $data['userAnswers'] = UserAnswerSubmission::where('answer_submissions_id', $id)->get();

        $data['formular'] = Formular::find($id);
        $data['answersheets'] = AnswerSheet::get();

        return view('admin.formular.view', $data);
    }

    public function submissionEdit($id)
    {
        $data['url'] = "Berichte Edit";
        $data['submission'] = AnswerSubmission::findOrFail($id);
        $data['users'] = User::where('role_id', 2)->get();
        $data['answersheets'] = AnswerSheet::get();
        $data['userAnswers'] = UserAnswerSubmission::where('answer_submissions_id', $id)->get()->unique('aufgaben_id');
        return view('admin.formular.submission-edit', $data);
    }

//    public function submissionUpdate(Request $request)
//    {
//        DB::beginTransaction();
//        try {
//            foreach ($request->aufgaben as $index => $aufgabenData) {
//
//                if (isset($aufgabenData['bereich'])) {
//                    foreach ($aufgabenData['bereich'] as $bereichIndex => $bereichData) {
//
//                        $userAnswer = UserAnswerSubmission::findOrFail($bereichData['user_answer_id']);
//                        if (isset($bereichData['textField'])) {
//                            $userAnswer->textField = $bereichData['textField'];
//                        } elseif (isset($bereichData['dateTime'])) {
//                            $userAnswer->dateTime = $bereichData['dateTime'];
//                        } elseif (isset($bereichData['checkbox'])) {
//                            $userAnswer->answer_id = $bereichData['checkbox'];
//                        }
//                        $userAnswer->save();
//                    }
//                }
//            }
//            DB::commit();
//            return redirect()->route('formular.index')->with('success', 'Formulare updated successfully.');
//        } catch (Exception $e) {
//            DB::rollback();
//            return back()->with('error', 'Error updating the formulare: ' . $e->getMessage());
//        }
//    }
//    public function submissionUpdate(Request $request)
//    {
////        dd($request->all());
//        DB::beginTransaction();
//        try {
//            foreach ($request->aufgaben as $index => $aufgabenData) {
//                if (isset($aufgabenData['bereich'])) {
//                    foreach ($aufgabenData['bereich'] as $bereichIndex => $bereichData) {
//                        $userAnswer = UserAnswerSubmission::findOrFail($bereichData['user_answer_id']);
//
//                        if (isset($bereichData['textField'])) {
//                            $userAnswer->textField = $bereichData['textField'];
//                        } elseif (isset($bereichData['dateTime'])) {
//                            $userAnswer->dateTime = $bereichData['dateTime'];
//                        } elseif (isset($bereichData['checkbox'])) {
//                            // Assuming checkbox can have multiple values
//                            $checkboxValues = is_array($bereichData['checkbox']) ? $bereichData['checkbox'] : [$bereichData['checkbox']];
//                            $userAnswer->answer_id = implode(',', $checkboxValues);
//                        }
//
//                        $userAnswer->save();
//                    }
//                }
//            }
//
//            DB::commit();
//
//            return redirect()->route('formular.submission')->with('success', 'Berichte updated successfully.');
//        } catch (Exception $e) {
//            DB::rollback();
//            return back()->with('error', 'Error updating the formulare: ' . $e->getMessage());
//        }
//    }


    public function submissionUpdate(Request $request)
    {

        $answerSubmissionId = $request->input('answer_submission_id');
        $ansSub = AnswerSubmission::find($answerSubmissionId);
        if (is_null($ansSub)) {
            return response()->json(['message' => 'Answer Submission not found'], 404);
        }
        if ($request->has('aufgabens') && is_array($request->aufgabens)) {
            foreach ($request->aufgabens as $aufgaben) {
                if (isset($aufgaben['bereiches']) && is_array($aufgaben['bereiches'])) {
                    foreach ($aufgaben['bereiches'] as $bereich) {
                        $photoPaths = [];
                        if (isset($bereich['photo']) && is_array($bereich['photo'])) {
                            foreach ($bereich['photo'] as $uploadedFile) {
                                // Use Laravel's file upload functionality
                                $name = $uploadedFile->getClientOriginalName();
                                $uploadedFile->move('public/images/formular', $name);
                                $photoPaths[] = $name;
                            }
                        }

                        $photoPath = null;
                        if (isset($bereich['Unterschrift'])) {
                            $image_part = explode(";base64,", $bereich['Unterschrift']);
                            if (count($image_part) === 2) {
                                $image_type_aux = explode("image/", $image_part[0]);
                                if (count($image_type_aux) === 2) {
                                    $image_type = $image_type_aux[1];
                                    $imageData = base64_decode($image_part[1]);
                                    if ($imageData !== false) {
                                        $fileName = uniqid() . '.png';
                                        $imagePath = public_path() . '/images/formular/' . $fileName;

                                        if (file_put_contents($imagePath, $imageData) !== false) {
                                            $photoPath = $fileName;
                                        }
                                    }
                                }
                            }
                        }

                        $existingUserAnswer = UserAnswerSubmission::where([
                            'id' => @$bereich['userAnswerSubmissionId'],
                        ])->first();
                        if ($existingUserAnswer) {
//                            $existingUserAnswer->answer_id = is_array(@$bereich['answer_id']) ? reset($bereich['answer_id']) : null;
                            $existingUserAnswer->answer_id = isset($bereich['answer_id']) && is_array($bereich['answer_id'])
                                ? reset($bereich['answer_id'])
                                : $bereich['answer_id'] ?? null;
                            $existingUserAnswer->textField = @$bereich['TextField'];
                            $existingUserAnswer->dateTime = $bereich['dateTime'] ?? $existingUserAnswer->dateTime;
                            $existingUserAnswer->Zahlen = $bereich['Zahlen'] ?? $existingUserAnswer->Zahlen;
//                            $existingUserAnswer->Unterschrift = @$photoPath;
                            $existingPhotoArray = json_decode($existingUserAnswer->photo, true);
                            $existingPhotoArray = array_merge($existingPhotoArray, $photoPaths);
                            $existingUserAnswer->photo = json_encode($existingPhotoArray);
                            $existingUserAnswer->comment = @$bereich['comment'] ?? $existingUserAnswer->comment;
                            $existingUserAnswer->save();
                        }
                    }
                }
            }
            return redirect()->route('formular.submission')->with('success', 'Berichte updated successfully.');

        } else {
            return back()->with('error', 'Error updating the formulare');
        }
    }

    public function viewgeneratePdfapi($ansSub, $request)
    {
        $data['submission'] = AnswerSubmission::findOrFail($ansSub->id);
        $data['userAnswers'] = UserAnswerSubmission::where('answer_submissions_id', $ansSub->id)->get();
        $data['answersheets'] = AnswerSheet::get();
        $filename = @$data['submission']->userId->firmenname . '_' . @$data['submission']->formulars->title . '_' . date('Y-m-d_H-i-s') . '.pdf';
        $pdfPath = public_path('pdfs/' . $filename);
        $pdfUrl = url('public/pdfs/' . $filename);
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->backgroundColor(243, 151, 57)->generate($pdfUrl);
        $data['base64Svg'] = base64_encode(@$qrCode);
        $view = view('admin.formular.berichte-pdf', $data);

        $pdf = PDF::loadHtml($view);

        $pdf->setOptions([
            'isPhpEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'isFontSubsettingEnabled' => true,
        ]);

        $pdfContent = $pdf->output();

        file_put_contents($pdfPath, $pdfContent);


        // Update the stored PDF path with the full URL
        $data['submission']->pdf_path = $pdfUrl;
        $data['submission']->save();

        $headers = ['Content-Type' => 'application/pdf'];

        return response()->download($pdfPath, $filename, $headers);
    }

    public function submissionDestroy($id)
    {
        $submission = AnswerSubmission::findOrFail($id);
        UserAnswerSubmission::where('answer_submissions_id', $submission->id)->delete();
        $submission->delete();
        return Redirect()->back()->with('success', 'Berichte deleted successfully.');;
    }

    public function generatePdf(Request $request)
    {
        if ($request->input('export_type') === 'pdf') {
            $data['search'] = '';
            $data['url'] = "Formular Submissions";
            $data['ansSubmissions'] = AnswerSubmission::get();
            $pdf = PDF::loadView('admin.formular.submission-pdf', $data);
            $filename = 'submission-pdf_' . date('Y-m-d_His') . '.pdf';
            return $pdf->download($filename);
        }
    }

    public function viewgeneratePdf(Request $request, $id)
    {
        // Fetch the necessary data
        $data['submission'] = AnswerSubmission::findOrFail($id);
        $data['userAnswers'] = UserAnswerSubmission::where('answer_submissions_id', $id)->get();
        $data['answersheets'] = AnswerSheet::get();

        $view = view('admin.formular.berichte-pdf', $data);

        // Create a PDF instance
        $pdf = PDF::loadHtml($view);

        // Optionally set PDF options
        $pdf->setOptions([
            'isPhpEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'isFontSubsettingEnabled' => true,
        ]);

        $pdfContent = $pdf->output();
        $filename = @$data['submission']->userId->firmenname . '_' . @$data['submission']->formulars->title . '_' . date('Y-m-d_H-i-s') . '.pdf';
        return $pdf->download($filename);
    }


    public function updateStatus(Request $request)
    {
        $submissionId = $request->input('submission_id');
        $status = $request->input('status');
        AnswerSubmission::where('id', $submissionId)->update(['status' => $status]);
        // Update the status in the database (adjust this part based on your database schema)
        // Example: Submission::where('id', $submissionId)->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function sendEmail(Request $request)
    {
        $userId = $request->input('userId');
        $status = $request->input('status');
        $user = User::find($userId);

        if ($user) {
            $token = Str::random(60);
            $user->update([
                'status' => $status,
                'password_reset_token' => $token,
            ]);
            if ($status == 1) {
                Mail::to($user->email)->send(new CreatePasswordMail($token, $userId));
            }

        }
        return response()->json(['message' => 'Status updated successfully']);
    }


    public function onlineVerbandsbuch(Request $request)
    {
        $query = AnswerSubmission::with(['formulars', 'userId'])->whereHas('formulars', function ($formularQuery) {
            $formularQuery->whereIn('title', ['verbandbuch', 'Verbandbuch']);
        });

        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->orWhereHas('formulars', function ($formularQuery) use ($key) {
                    $formularQuery->where('title', 'like', "%{$key}%");
                })->orWhereHas('userId', function ($userQuery) use ($key) {
                    $userQuery->where('vorname', 'like', "%{$key}%")->orWhere('nachname', 'like', "%{$key}%");
                });
            });
        }

        $data['url'] = "Online Verbandsbuch";
        $data['search'] = $request->search;
        $data['ansSubmissions'] = $query->paginate(10);

        return view('admin.formular.online_verbandsbuch', $data);
    }

    public function psychischeBelastung(Request $request)
    {
        $query = AnswerSubmission::with(['formulars', 'userId'])
            ->whereHas('formulars', function ($formularQuery) {
                $formularQuery->where('title', 'like', "%Psychische Belastung%")
                    ->orWhere('title', 'like', "%psychische belastung%");
            });
        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->orWhereHas('formulars', function ($formularQuery) use ($key) {
                    $formularQuery->where('title', 'like', "%{$key}%");
                })->orWhereHas('userId', function ($userQuery) use ($key) {
                    $userQuery->where('vorname', 'like', "%{$key}%")->orWhere('nachname', 'like', "%{$key}%");
                });
            });
        }

        $data['url'] = "Psychische Belastung";
        $data['search'] = $request->search;
        $data['ansSubmissions'] = $query->paginate(10);

        return view('admin.formular.psychische_belastung', $data);
    }


    public function unfallermittlungIndex(Request $request)
    {
        $query = AnswerSubmission::with(['formulars', 'userId'])
            ->whereHas('formulars', function ($formularQuery) {
                $formularQuery->where('title', 'like', "%Unfallermittlung%")
                    ->orWhere('title', 'like', "%unfallermittlung%");
            });
        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->orWhereHas('formulars', function ($formularQuery) use ($key) {
                    $formularQuery->where('title', 'like', "%{$key}%");
                })->orWhereHas('userId', function ($userQuery) use ($key) {
                    $userQuery->where('vorname', 'like', "%{$key}%")->orWhere('nachname', 'like', "%{$key}%");
                });
            });
        }

        $data['url'] = "Unfallermittlung";
        $data['search'] = $request->search;
        $data['ansSubmissions'] = $query->paginate(10);

        return view('admin.formular.unfallermittlung', $data);
    }

}
