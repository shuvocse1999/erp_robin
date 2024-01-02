<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\AnswerSheet;
use App\Models\AnswerSubmission;
use App\Models\AnswerSubmissionBereichAufgaben;
use App\Models\Aufgabe;
use App\Models\Bereich;
use App\Models\Formular;
use App\Models\QuestionAnswerRelation;
use App\Models\User;
use App\Models\UserAnswerSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Exception;
use Illuminate\Support\Facades\Storage;
use PDF;

class FormularController extends Controller
{
    public function berichte(Request $request)
    {
        $bearer_token = $request->bearerToken();
        if ($bearer_token == null) {
            return response()->json(['message' => 'Access token required'], 401);
        }

        $user = User::where('access_token', $bearer_token)->first();
        if ($user == null) {
            return response()->json(['message' => 'User not found'], 401);
        }

        if ($user->role_id == 1) {
            $answerSubmission = AnswerSubmission::with(['formulars', 'userAnswers'])->get();
        } else {
            $answerSubmission = AnswerSubmission::where('user_id', $user->id)->with(['formulars', 'userAnswers'])->get();
        }

        $responseArray = [];
        foreach ($answerSubmission as $submission) {
            $responseArray[] = [
                'id' => @$submission->id,
                'userId' => @$submission->user_id,
                'formularId' => @$submission->formulars->id,
                'formularTitle' => @$submission->formulars->title,
                'userName' => @$submission->userId->vorname . ' ' . @$submission->userId->nachname,
                'email' => @$submission->userId->email,
                'bereichCount' => @$submission->userAnswers->unique('aufgaben_id')->count(),
                'aufgabenCount' => @$submission->userAnswers->unique('bereich_id')->count(),
                'created_at' => @$submission->created_at,
            ];
        }

        return response()->json($responseArray);
    }

    public function kunde(Request $request)
    {
        $query = User::where('role_id', 2)->latest();
        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->where('vorname', 'like', "%{$key}%")
                    ->orWhere('nachname', 'like', "%{$key}%");
            });
        }
        $data['kunden'] = $query->paginate(10);
        return response()->json($data);
    }

    public function assignKunde(Request $request)
    {
        $request->validate([
            'formulare_id' => 'required',
            'user_id' => 'required',
        ]);
        if (isset($request->formulare_id) && isset($request->user_id)) {
            $formular = Formular::find($request->formulare_id);
            if (isset($formular)) {
                if ($formular->user_id === null) {
                    $formular->update(['user_id' => $request->user_id]);
                    return response()->json(['message' => 'Kunde id assigned successfully.']);
                } else {
                    return response()->json(['message' => 'Kunde id already assigned.']);
                }
            } else {
                return response()->json(['message' => 'Not found.', 404]);
            }
        } else {
            return response()->json(['message' => 'Data validation.']);
        }
    }


//    public function singleData(Request $request)
//    {
//        $formular_id = $request->formular_id;
//        if (isset($formular_id)) {
//            $formular = Formular::findOrFail($formular_id);
//            if (isset($formular)) {
//                $aufgabes = Aufgabe::where('formular_id', $formular->id)->get();
//                foreach ($aufgabes as $aufgabe) {
//                    $bereiches = Bereich::where('aufgabe_id', $aufgabe->id)->get();
//                    foreach ($bereiches as $bereich) {
//                        $questions = QuestionAnswerRelation::where('question_id', $bereich->id)->get();
//                        if ($questions) {
//                            foreach ($questions as $question) {
//                                $bereich->answer_sheet_id = $question->answer_sheet_id;
//                                $bereich->answer_sheet_title = @$question->answer_sheet->title;
//                                $bereich->type = @$question->answer_sheet->type;
//
//                                $answer = Answer::where('answer_sheet_id', $question->answer_sheet_id)->get();
//                                foreach ($answer as $ans) {
//                                    $answers[] = $ans;
//                                }
//                            }
//                            $bereich->answer = @$answers;
//                        }
//                        $aufgabe->bereiches = $bereiches;
//                    }
//                }
//                $formular->aufgabes = $aufgabes;
//                return response()->json($formular, 200);
//            } else {
//                return response()->json(["message" => "Not found!", 404]);
//            }
//
//        }
//    }

    public function singleData(Request $request)
    {
        $formular_id = $request->formular_id;
        if (isset($formular_id)) {
            $formular = Formular::findOrFail($formular_id);
            if (isset($formular)) {
                $aufgabes = Aufgabe::where('formular_id', $formular->id)->get();
                foreach ($aufgabes as $aufgabe) {
                    $bereiches = Bereich::where('aufgabe_id', $aufgabe->id)->get();
                    foreach ($bereiches as $bereich) {
                        $questions = QuestionAnswerRelation::where('question_id', $bereich->id)->get();
                        if ($questions->count() > 0) {
                            $answers = [];
                            foreach ($questions as $question) {
                                $bereich->answer_sheet_id = $question->answer_sheet_id;
                                $bereich->answer_sheet_title = @$question->answer_sheet->title;
                                $bereich->type = @$question->answer_sheet->type;

                                // Retrieve answers where answer_sheet_id == $question->answer_sheet_id
                                $answer = Answer::where('answer_sheet_id', $question->answer_sheet_id)->get();
                                foreach ($answer as $ans) {
                                    $answers[] = $ans;
                                }
                            }
                            $bereich->answers = $answers;
                        }
                    }
                    $aufgabe->bereiches = $bereiches;
                }
                $formular->aufgabes = $aufgabes;
                return response()->json($formular, 200);
            } else {
                return response()->json(["message" => "Not found!", 404]);
            }
        }
    }


    public function data(Request $request)
    {
        $bearer = $request->bearerToken();
        $user = User::where('access_token', $bearer)->first();

        if (isset($user)) {
            if ($user->role_id == 2) {
                $query = Formular::where('user_id', $user->id)->orWhere('user_id', null);
            } else {
                $query = Formular::latest();
            }

            $search = $request->input('search');
            if (!empty($search)) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('title', 'LIKE', "%$search%");
                });
            }

            $formulars = $query->simplePaginate(10);
            $formulars->each(function ($formular) {
                $formular->aufgabe_count = $formular->aufgabes()->count();
                $formular->bereich_count = $formular->aufgabes()->with('bereiches')->get()->reduce(function ($carry, $aufgabe) {
                    return $carry + $aufgabe->bereiches->count();
                }, 0);

                $formular->userId = @$formular->users->id;
                $formular->userName = @$formular->users->vorname . ' ' . @$formular->users->nachname;
                $formular->userEmail = @$formular->users->email;
                unset($formular->users);
            });

            return response()->json($formulars, 200);
        } else {
            return response()->json(['message' => "User not found"], 401);
        }
    }


    public function answerSubmission(Request $request)
    {
        $bearer_token = $request->bearerToken();
        if (is_null($bearer_token)) {
            return response()->json(['message' => 'Access token required'], 401);
        }
        $user = User::where('access_token', $bearer_token)->first();
        if (is_null($user)) {
            return response()->json(['message' => 'User not found'], 401);
        }
        $formular_id = $request->formular_id;
        $formularId = Formular::find($formular_id);
        $ansSub = new AnswerSubmission();

        if ($user->role_id == 1) {
            $user_id = @$formularId->user_id ?? $request->user_id;
        } else {
            $user_id = $user->id;
        }
        $ansSub->user_id = $user_id;
        $ansSub->formular_id = $formular_id;
        $ansSub->save();

        if ($request->has('aufgabens') && is_array($request->aufgabens)) {
            foreach ($request->aufgabens as $aufgaben) {
                if (isset($aufgaben['bereiches']) && is_array($aufgaben['bereiches'])) {
                    foreach ($aufgaben['bereiches'] as $bereich) {
                        $photoPaths = [];
                        if (isset($bereich['photo']) && is_array($bereich['photo'])) {
                            foreach ($bereich['photo'] as $base64Image) {
                                if ($base64Image) {
                                    $image_parts = explode(";base64,", $base64Image);
                                    if (count($image_parts) === 2) {
                                        $image_type_aux = explode("image/", $image_parts[0]);
                                        if (count($image_type_aux) === 2) {
                                            $image_type = $image_type_aux[1];
                                            $imageData = base64_decode($image_parts[1]);
                                            $fileName = uniqid() . '.png';
                                            $imagePath = public_path() . '/images/formular/' . $fileName;
                                            file_put_contents($imagePath, $imageData);
                                            $photoPaths[] = $fileName;
                                        }
                                    }
                                }
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
                                        } else {
                                        }
                                    } else {
                                    }
                                } else {
                                }
                            } else {
                            }
                        }

                        $userAnswer = new UserAnswerSubmission();
                        $userAnswer->user_id = @$user_id;
                        $userAnswer->answer_submissions_id = @$ansSub->id;
                        $userAnswer->aufgaben_id = @$aufgaben['id'];
                        $userAnswer->bereich_id = @$bereich['id'];
                        $userAnswer->answer_sheet_id = @$bereich['answer_sheet_id'];
                        $userAnswer->answer_id = @$bereich['answer_id'];
                        $userAnswer->textField = @$bereich['TextField'];
                        $userAnswer->dateTime = @$bereich['dateTime'];
                        $userAnswer->Zahlen = @$bereich['Zahlen'];
                        $userAnswer->Unterschrift = @$photoPath;

                        $userAnswer->photo = json_encode($photoPaths);
                        $userAnswer->comment = @$bereich['comment'];
                        $userAnswer->save();
                    }
                }
            }
            $pdfContent = $this->viewgeneratePdfapi($ansSub, $request);

            return response()->json(['message' => 'Answer submitted successfully'], 200);
        } else {
            return response()->json(['message' => 'No aufgabens provided'], 400);
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


//    public function viewgeneratePdfapi($ansSub, $request)
//    {
//        $data['submission'] = AnswerSubmission::findOrFail($ansSub->id);
//        $data['userAnswers'] = UserAnswerSubmission::where('answer_submissions_id', $ansSub->id)->get();
//        $data['answersheets'] = AnswerSheet::get();
//        $view = view('admin.formular.berichte-pdf', $data);
//        $pdf = PDF::loadHtml($view);
//
//        $pdf->setOptions([
//            'isPhpEnabled' => true,
//            'isHtml5ParserEnabled' => true,
//            'isFontSubsettingEnabled' => true,
//        ]);
//        $pdfContent = $pdf->output();
//        $filename = @$data['submission']->userId->firmenname . '_' . @$data['submission']->formulars->title . '_' . date('Y-m-d_H-i-s') . '.pdf';
//        $pdfPath = public_path('pdfs/' . $filename);
//        file_put_contents($pdfPath, $pdfContent);
//        $headers = [
//            'Content-Type' => 'application/pdf',
//        ];
//        return response()->download($pdfPath, $filename, $headers);
//    }


//    public function viewgeneratePdfapi($formular, $request)
//    {
//        $data['submission'] = AnswerSubmission::findOrFail($formular->id);
//        $data['userAnswers'] = UserAnswerSubmission::where('answer_submissions_id', $formular->id)->get();
//        $data['answersheets'] = AnswerSheet::get();
//        $view = view('admin.formular.berichte-pdf', $data);
//        $pdf = PDF::loadHtml($view);
//
//        $pdf->setOptions([
//            'isPhpEnabled' => true,
//            'isHtml5ParserEnabled' => true,
//            'isFontSubsettingEnabled' => true,
//        ]);
//
//        $pdfContent = $pdf->output();
//        $filename = @$data['submission']->userId->firmenname . '_' . @$data['submission']->formulars->title . '_' . date('Y-m-d_H-i-s') . '.pdf';
//        return $pdf->download($filename);
//    }


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
            return response()->json(['error' => $errors], 422);
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

            return response()->json($formular);
        } catch (\Exception $e) {
            // Handle any unexpected exceptions
            return response()->json(['error' => 'An error occurred while creating the formulare.'], $e->getMessage(), 500);
        }
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
            return response()->json(['error' => $validator->errors()], 400);
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
                        }
                        $existingBereichIds2[] = $bereich->id;
                        $bereich->update(['name' => $bereichData['name']]);
                    }
                    $bereichesToDelete = $bereiches->whereNotIn('id', $existingBereichIds2);
                    $bereichesToDelete->each->delete();
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
            return response()->json(['message' => 'Formulare updated successfully'], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error updating the formulare: ' . $e->getMessage()], 500);
        }
    }

    public function getPdf(Request $request)
    {
        $ansSubId = $request->answer_submission_id;

        try {
            $ansSub = AnswerSubmission::findOrFail($ansSubId);
            $pdfPath = $ansSub->pdf_path;

            return response()->json(['pdf_path' => $pdfPath], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Answer submission not found'], 404);
        }
    }


//    public function unfallermittlungIndex(Request $request)
//    {
//        $query = AnswerSubmission::with(['formulars', 'userId'])
//            ->whereHas('formulars', function ($formularQuery) {
//                $formularQuery->where('title', 'like', "%Unfallermittlung%")
//                    ->orWhere('title', 'like', "%unfallermittlung%");
//            });
//        $ansSubmissions = $query->paginate(10);
//        return response()->json($ansSubmissions);
//    }

    public function unfallermittlungIndex(Request $request)
    {
        $query = AnswerSubmission::with(['formulars', 'userId' => function ($userQuery) {
            $userQuery->select('firmenname', 'standort', 'abteilung');
        }])->whereHas('formulars', function ($formularQuery) {
            $formularQuery->where('title', 'like', "%Unfallermittlung%")
                ->orWhere('title', 'like', "%unfallermittlung%");
        })->get();
        $responseArray = [];
        foreach ($query as $submission) {
            $responseArray[] = [
                'id' => @$submission->id,
                'userId' => @$submission->user_id,
                'firmenname' => @$submission->userId->firmenname,
                'standort' => @$submission->userId->standort,
                'abteilung' => @$submission->userId->abteilung,
                'formularId' => @$submission->formulars->id,
                'formularTitle' => @$submission->formulars->title,
                'bereichCount' => @$submission->userAnswers->unique('aufgaben_id')->count(),
                'aufgabenCount' => @$submission->userAnswers->unique('bereich_id')->count(),
                'created_at' => @$submission->created_at,
            ];
        }
        return response()->json($responseArray);
    }


//    public function submissionUpdate(Request $request)
//    {
////        DB::beginTransaction();
////        try {
//        $requestData = $request->all();
//        foreach ($requestData['aufgaben'] as $index => $aufgabenData) {
//            if (isset($aufgabenData['bereich'])) {
//                foreach ($aufgabenData['bereich'] as $bereichIndex => $bereichData) {
//                    $userAnswer = UserAnswerSubmission::findOrFail($bereichData['user_answer_id']);
//
//                    if (isset($bereichData['textField'])) {
//                        $userAnswer->textField = $bereichData['textField'];
//                    } elseif (isset($bereichData['dateTime'])) {
//                        $userAnswer->dateTime = $bereichData['dateTime'];
//                    } elseif (isset($bereichData['checkbox'])) {
//                        $checkboxValues = is_array($bereichData['checkbox']) ? $bereichData['checkbox'] : [$bereichData['checkbox']];
//                        $userAnswer->answer_id = implode(',', $checkboxValues);
//                    }
//                    $userAnswer->save();
//                }
//            }
//        }
////            DB::commit();
//        return response()->json(['message' => 'Berichte updated successfully'], 200);
////        } catch (\Exception $e) {
////            DB::rollback();
////            return response()->json(['error' => 'Error updating the Berichte: ' . $e->getMessage()], 500);
////        }
//    }

//    public function submissionEdit(Request $request)
//    {
//        try {
//            $id = $request->input('answer_submission_id');
//            $answerSubmission = AnswerSubmission::with('userAnswers', 'userAnswers.answers','userAnswers.answersheet.answers')->findOrFail($id);
//
//            // Accessing the userAnswers relationship (assuming it's a collection)
//            $data = [
//                'id' => $answerSubmission->id,
//                'user_id' => $answerSubmission->user_id,
//                'formular_id' => $answerSubmission->formular_id,
//                'pdf_path' => $answerSubmission->pdf_path,
//                'aufgabes' => $answerSubmission->userAnswers->groupBy('aufgaben_id')->map(function ($groupedItems) {
//                    return [
//                        'id' => $groupedItems->first()['aufgaben_id'],
//                        'name' => $groupedItems->first()['aufgaben_name'],
//                        'bereiches' => $groupedItems->map(function ($item) {
//                            $bereich = [
//                                'id' => $item['bereich_id'],
//                                'name' => $item['bereich_name'],
//                                'answer_sheet_id' => $item['answer_sheet_id'],
//                                'answerdata' => $item['answersheet'],
//                                'answer_id' => $item['answer_id'],
//                                'answer' => $item['answers'],
//                            ];
//
//                            if ($item['answer_sheet_id'] == 10) {
//                                $bereich['Textfield'] = $item['Textfield'];
//                            } elseif ($item['answer_sheet_id'] == 11) {
//                                $bereich['dateTime'] = $item['dateTime'];
//                            }
//
//                            return $bereich;
//                        })->values()->all(),
//                    ];
//                })->values()->all(),
//            ];
//
//            return response()->json(['data' => $data]);
//        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
//            // Handle the case when the record is not found
//            return response()->json(['error' => 'Record not found'], 404);
//        }
//    }

    public function submissionEdit(Request $request)
    {
        try {
            $id = $request->input('answer_submission_id');
            $answerSubmission = AnswerSubmission::with('userAnswers', 'userAnswers.bereiches', 'userAnswers.aufgabens', 'userAnswers.answersheet.answers')->findOrFail($id);

            $basePhotoUrl = "https://vbgenius1.bplaced.net/faisst/public/images/formular/";

            $data = [
                'submissionId' => $answerSubmission->id,
                'userId' => $answerSubmission->user_id,
                'formularId' => $answerSubmission->formular_id,
                'pdfPath' => $answerSubmission->pdf_path,
                'aufgabes' => $answerSubmission->userAnswers->groupBy('aufgaben_id')->map(function ($groupedItems) use ($basePhotoUrl) {
                    return [
                        'id' => $groupedItems->first()['aufgaben_id'],
                        'name' => $groupedItems->first()['aufgabens']['name'] ?? '',
                        'bereiches' => $groupedItems->map(function ($item) use ($basePhotoUrl) {
                            $bereich = [
                                'id' => $item['bereich_id'],
                                'userAnswerSubmissionId' => $item['id'],
                                'name' => $item['bereiches']['name'],
                                'answerSheetId' => $item['answer_sheet_id'],
                                'answerId' => $item['answer_id'],
                                'answer' => $item['answers'],
                                'comment' => $item['comment'],
                            ];

                            if (is_string($item['photo'])) {
                                $item['photo'] = explode(',', $item['photo']);
                            }

                            $photoUrls = array_map(function ($filename) use ($basePhotoUrl) {
                                $fullUrl = asset($basePhotoUrl . trim($filename, '[]\"'));
                                return $fullUrl;
                            }, $item['photo']);

                            if ($item['photo'][0] != "[]") {
                                $bereich['photoUrls'] = $photoUrls;
                            } else {
                                $bereich['photoUrls'] = null;
                            }


                            if ($item['answer_sheet_id'] == 10) {
                                $bereich['Textfield'] = $item['Textfield'];
                            } elseif ($item['answer_sheet_id'] == 11) {
                                $bereich['dateTime'] = $item['dateTime'];
                            } elseif ($item['answer_sheet_id'] == 12) {
                                $bereich['Zahlen'] = $item['Zahlen'];
                            } elseif ($item['answer_sheet_id'] == 13) {
                                if (isset($item['Unterschrift'])) {
                                    $bereich['UnterschriftUrl'] = asset($basePhotoUrl . trim($item['Unterschrift'], '[]\"'));
                                }
                            }
                            return $bereich;
                        })->values()->all(),
                    ];
                })->values()->all(),
            ];

            return response()->json(['data' => $data]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return response()->json(['error' => 'Record not found'], 404);
        }
    }

    public function submissionPhotoDelete(Request $request)
    {
        try {
            $userAnswerSubmissionId = $request->userAnswerSubmissionId;
            if ($request->photoUrl) {
                $photoUrl = last(explode('/', $request->photoUrl));
                $userAns = UserAnswerSubmission::findOrFail($userAnswerSubmissionId);
                if (isset($userAns->photo)) {
                    $photos = json_decode($userAns->photo);
                    if (isset($photos) && is_array($photos)) {

                        $photoPath = public_path('images/formular/' . $photoUrl);
                        if (file_exists($photoPath)) {
                            unlink($photoPath);
                        } else {
                        }

                        $photos = array_diff($photos, [$photoUrl]);
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


    public function submissionUpdate(Request $request)
    {
        $bearer_token = $request->bearerToken();
        if (is_null($bearer_token)) {
            return response()->json(['message' => 'Access token required'], 401);
        }

        $user = User::where('access_token', $bearer_token)->first();
        if (is_null($user)) {
            return response()->json(['message' => 'User not found'], 401);
        }

        $answerSubmissionId = $request->input('answer_submission_id');
        $ansSub = AnswerSubmission::find($answerSubmissionId);

        if (is_null($ansSub)) {
            return response()->json(['message' => 'Answer Submission not found'], 404);
        }
//        $ansSub->userAnswers()->delete();
        if ($request->has('aufgabens') && is_array($request->aufgabens)) {
            foreach ($request->aufgabens as $aufgaben) {
                if (isset($aufgaben['bereiches']) && is_array($aufgaben['bereiches'])) {
                    foreach ($aufgaben['bereiches'] as $bereich) {
                        $photoPaths = [];
                        if (isset($bereich['photo']) && is_array($bereich['photo'])) {
                            foreach ($bereich['photo'] as $base64Image) {
                                if ($base64Image) {
                                    $image_parts = explode(";base64,", $base64Image);
                                    if (count($image_parts) === 2) {
                                        $image_type_aux = explode("image/", $image_parts[0]);
                                        if (count($image_type_aux) === 2) {
                                            $image_type = $image_type_aux[1];
                                            $imageData = base64_decode($image_parts[1]);
                                            $fileName = uniqid() . '.png';
                                            $imagePath = public_path() . '/images/formular/' . $fileName;
                                            file_put_contents($imagePath, $imageData);
                                            $photoPaths[] = $fileName;
                                        }
                                    }
                                }
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
//                            'answer_sheet_id' => @$bereich['answer_sheet_id'],
//                            'answer_submissions_id' => $answerSubmissionId,
//                            'aufgaben_id' => @$aufgaben['id'],
//                            'bereich_id' => @$bereich['id'],
                        ])->first();

                        if ($existingUserAnswer) {
//                            $existingUserAnswer->user_id = @$user_id;
//                            $existingUserAnswer->answer_submissions_id = @$ansSub->id;
//                            $existingUserAnswer->answer_sheet_id = @$bereich['answer_sheet_id'];
                            $existingUserAnswer->answer_id = @$bereich['answer_id'];
                            $existingUserAnswer->textField = @$bereich['Textfield'];
                            $existingUserAnswer->dateTime = @$bereich['dateTime'];
                            $existingUserAnswer->Zahlen = @$bereich['Zahlen'];
//                            $existingUserAnswer->Unterschrift = @$photoPath;

                            $existingPhotoArray = json_decode($existingUserAnswer->photo, true);
                            $existingPhotoArray = array_merge($existingPhotoArray, $photoPaths);
                            $existingUserAnswer->photo = json_encode($existingPhotoArray);
                            $existingUserAnswer->comment = @$bereich['comment'];
                            $existingUserAnswer->save();
                        }
                    }
                }
            }

            // Update the AnswerSubmission fields if needed
            // $ansSub->field = $request->input('field');
            // ...

            // Update the PDF content if needed
            $pdfContent = $this->viewgeneratePdfapi($ansSub, $request);

            return response()->json(['message' => 'Answer submission updated successfully'], 200);
        } else {
            return response()->json(['message' => 'No aufgabens provided'], 400);
        }
    }


}
