<?php

namespace App\Http\Controllers;

use App\Models\Kategorien;
use Illuminate\Http\Request;

class RiskassessmentController extends Controller
{
    public function create()
    {
        $data['category'] = Kategorien::get();
        return view('admin.risk-assessment.create', $data);
    }

    public function localData(Request $request){

        $data['localStorageData'] = $request->input('localStorageData');
        return view('admin.risk-assessment.create', $data);
//        return response()->json(['localstorage' => $localStorageData]);
    }
}
