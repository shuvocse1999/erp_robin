<?php

namespace App\Http\Controllers;

use App\Imports\MessungenImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        try {
            $user = $request->user_id;

            if (request()->hasFile('file')) {
                $filePath = request()->file('file')->store('csv', 'public');
                Excel::import(new MessungenImport($user), $filePath, 'public');
            }

            return redirect()->back()->with('success', 'File imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'The Excel or CSV file format does not match.');
        }
    }

}
