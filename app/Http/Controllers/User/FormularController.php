<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AnswerSubmission;
use App\Models\Formular;
use Illuminate\Http\Request;

class FormularController extends Controller
{
//    public function index()
//    {
//        $data['search'] = '';
//        $data['url'] = "Formulare";
//        $data['formulars'] = Formular::paginate(10);
//        return view('user.formulare.index', $data);
//    }

    public function index()
    {
        $data['search'] = '';
        $data['url'] = "Berichte";
        $data['ansSubmissions'] = AnswerSubmission::where('user_id',auth()->id())->paginate(10);
        return view('user.berichte.index', $data);
    }
}
