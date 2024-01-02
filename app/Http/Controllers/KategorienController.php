<?php

namespace App\Http\Controllers;

use App\Models\Kategorien;
use App\Models\KategorienOption;
use App\Models\User;
use Illuminate\Http\Request;

class KategorienController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategorien::latest();
        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->where('danger', 'like', "%{$key}%")
                    ->orWhere('kat1', 'like', "%{$key}%")
                    ->orWhere('kat2', 'like', "%{$key}%")
                    ->orWhere('kat3', 'like', "%{$key}%")
                    ->orWhere('kat4', 'like', "%{$key}%")
                    ->orWhere('kat5', 'like', "%{$key}%")
                    ->orWhere('kat6', 'like', "%{$key}%")
                    ->orWhere('kat7', 'like', "%{$key}%")
                    ->orWhere('kat8', 'like', "%{$key}%")
                    ->orWhere('kat9', 'like', "%{$key}%")
                    ->orWhere('kat10', 'like', "%{$key}%");
            });
        }
        $data['url'] = "Kategorien";
        $data['kategorien'] = $query->paginate(10);
        $data['search'] = $request->search;
        return view('admin.kategorien.index', $data);
    }

    public function create()
    {
        $data['url'] = "Kategorien create";
//        $data['kategorien'] = Kategorien::findOrFail($id);
        return view('admin.kategorien.create', $data);
    }

//    public function store(Request $request)
//    {
//        $validatedData = $request->validate([
//            'danger' => 'required|string|max:255',
//            'kat1' => 'required|string|max:255',
//            'kat2' => 'required|string|max:255',
//            'kat3' => 'required|string|max:255',
//            'kat4' => 'required|string|max:255',
//            'kat5' => 'required|string|max:255',
//            'kat6' => 'required|string|max:255',
//            'kat7' => 'required|string|max:255',
//            'kat8' => 'required|string|max:255',
//            'kat9' => 'required|string|max:255',
//            'kat10' => 'required|string|max:255',
//            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);
//        if ($request->hasFile('photo')) {
//            $image = $request->file('photo');
//            $imageName = time() . '.' . $image->extension();
//            $image->move(public_path('/images/uploads'), $imageName);
//            $validatedData['photo'] = '/images/uploads/' . $imageName;
//        }
//
//        $category = new Kategorien($validatedData);
//        $category->save();
//
//        return redirect()->route('kategorien.index')->with('success', 'Kategorien created successfully.');
//    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'danger' => 'required|string|max:255',
            'kat1' => 'required|string|max:255',
            'kat2' => 'required|string|max:255',
            'kat3' => 'required|string|max:255',
            'kat4' => 'required|string|max:255',
            'kat5' => 'required|string|max:255',
            'kat6' => 'required|string|max:255',
            'kat7' => 'required|string|max:255',
            'kat8' => 'required|string|max:255',
            'kat9' => 'required|string|max:255',
            'kat10' => 'required|string|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Kategorien::create([
            'danger' => $validatedData['danger'],
            'photo' => $validatedData['photo'] ?? null,
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('/images/uploads'), $imageName);
            $category->update(['photo' => '/images/uploads/' . $imageName]);
        }

        KategorienOption::create([
            'kategorien_id' => $category->id,
            'kat1' => $validatedData['kat1'],
            'kat2' => $validatedData['kat2'],
            'kat3' => $validatedData['kat3'],
            'kat4' => $validatedData['kat4'],
            'kat5' => $validatedData['kat5'],
            'kat6' => $validatedData['kat6'],
            'kat7' => $validatedData['kat7'],
            'kat8' => $validatedData['kat8'],
            'kat9' => $validatedData['kat9'],
            'kat10' => $validatedData['kat10'],
        ]);

        return redirect()->route('kategorien.index')->with('success', 'Kategorien created successfully.');
    }


    public function edit($id)
    {
        $data['url'] = "Kategorien edit";
        $data['kategorien'] = Kategorien::findOrFail($id);
        return view('admin.kategorien.edit', $data);
    }

//    public function update(Request $request, $id)
//    {
//        $kategorien = Kategorien::find($id);
//
//        if (!$kategorien) {
//            return redirect()->route('kategorien.index')->with('error', 'Kategorien not found.');
//        }
//
//        $validatedData = $request->validate([
//            'danger' => 'required|string|max:255',
//            'kat1' => 'required|string|max:255',
//            'kat2' => 'required|string|max:255',
//            'kat3' => 'required|string|max:255',
//            'kat4' => 'required|string|max:255',
//            'kat5' => 'required|string|max:255',
//            'kat6' => 'required|string|max:255',
//            'kat7' => 'required|string|max:255',
//            'kat8' => 'required|string|max:255',
//            'kat9' => 'required|string|max:255',
//            'kat10' => 'required|string|max:255',
//            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);
//
//        $kategorien->update([
//            'danger' => $validatedData['danger'],
//            'kat1' => $validatedData['kat1'],
//            'kat2' => $validatedData['kat2'],
//            'kat3' => $validatedData['kat3'],
//            'kat4' => $validatedData['kat4'],
//            'kat5' => $validatedData['kat5'],
//            'kat6' => $validatedData['kat6'],
//            'kat7' => $validatedData['kat7'],
//            'kat8' => $validatedData['kat8'],
//            'kat9' => $validatedData['kat9'],
//            'kat10' => $validatedData['kat10'],
//        ]);
//
//        if ($request->hasFile('photo')) {
//            $image = $request->file('photo');
//            $imageName = time() . '.' . $image->extension();
//            $image->move(public_path('/images/uploads'), $imageName);
//
//            // Delete old photo if it exists and is a file
//            if (is_file(public_path($kategorien->photo))) {
//                unlink(public_path($kategorien->photo));
//            }
//
//            $kategorien->photo = '/images/uploads/' . $imageName;
//            $kategorien->save();
//        }
//
//        return redirect()->route('kategorien.index')->with('success', 'Kategorien updated successfully.');
//    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'danger' => 'required|string|max:255',
            'kat1' => 'required|string|max:255',
            'kat2' => 'required|string|max:255',
            'kat3' => 'required|string|max:255',
            'kat4' => 'required|string|max:255',
            'kat5' => 'required|string|max:255',
            'kat6' => 'required|string|max:255',
            'kat7' => 'required|string|max:255',
            'kat8' => 'required|string|max:255',
            'kat9' => 'required|string|max:255',
            'kat10' => 'required|string|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Kategorien::findOrFail($id);

        $category->update([
            'danger' => $validatedData['danger'],
            'photo' => $validatedData['photo'] ?? $category->photo,
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('/images/uploads'), $imageName);
            $category->update(['photo' => '/images/uploads/' . $imageName]);
        }

        $kategorienOption = KategorienOption::where('kategorien_id', $id)->first();

        $kategorienOption->update([
            'kat1' => $validatedData['kat1'],
            'kat2' => $validatedData['kat2'],
            'kat3' => $validatedData['kat3'],
            'kat4' => $validatedData['kat4'],
            'kat5' => $validatedData['kat5'],
            'kat6' => $validatedData['kat6'],
            'kat7' => $validatedData['kat7'],
            'kat8' => $validatedData['kat8'],
            'kat9' => $validatedData['kat9'],
            'kat10' => $validatedData['kat10'],
        ]);

        return redirect()->route('kategorien.index')->with('success', 'Kategorien updated successfully.');
    }


    public function delete($id)
    {
        $category = Kategorien::findOrFail($id);

        // Delete associated options first
        KategorienOption::where('kategorien_id', $id)->delete();

        // Delete the category
        $category->delete();

        return redirect()->route('kategorien.index')->with('success', 'Kategorien deleted successfully.');
    }

}
