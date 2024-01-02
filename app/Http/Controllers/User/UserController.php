<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = User::where('role_id', 2)->latest();
        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->where('vorname', 'like', "%{$key}%")
                    ->orWhere('nachname', 'like', "%{$key}%")
                    ->orWhere('email', 'like', "%{$key}%")
                    ->orWhere('strasse', 'like', "%{$key}%")
                    ->orWhere('hasunr', 'like', "%{$key}%")
                    ->orWhere('plz', 'like', "%{$key}%")
                    ->orWhere('wohnort', 'like', "%{$key}%")
                    ->orWhere('phone', 'like', "%{$key}%");
            });
        }
        $data['url'] = "Kunden";
        $data['search'] = $request->search;
        $data['users'] = $query->paginate(10);
        return view('user.manage-user.index', $data);
    }

    public function create()
    {
        $data['url'] = "Kunde Create";
        return view('user.manage-user.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firmenname' => 'required|string',
            'standort' => 'required|string|max:255',
            'abteilung' => 'required|string|max:255',
            'vorname' => 'required',
            'nachname' => 'required',
            'strasse' => 'required',
            'hasunr' => 'required',
            'plz' => 'required',
//            'berichte' => 'required',
//            'responsible_BG' => 'required',
//            'company_size' => 'required',
            'wohnort' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email',
//            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                toastr()->error($error, 'Validation Error');
            }
            return redirect()->back();
        }

        $user = new User();
        $user->firmenname = $request->firmenname;
        $user->standort = $request->standort;
        $user->abteilung = $request->abteilung;
        $user->vorname = $request->vorname;
        $user->nachname = $request->nachname;
        $user->strasse = $request->strasse;
        $user->hasunr = $request->hasunr;
        $user->plz = $request->plz;
        $user->berichte = $request->berichte;
        $user->responsible_BG = $request->responsible_BG;
        $user->company_size = $request->company_size;
        $user->wohnort = $request->wohnort;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('user.index')->with('success', 'Kunde created successfully.');
    }

    public function edit($id)
    {
        $data['url'] = "Kunde Edit";
        $data['user'] = User::find($id);
        return view('user.manage-user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'firmenname' => 'required|string',
            'standort' => 'required|string|max:255',
            'abteilung' => 'required|string|max:255',
            'vorname' => 'required',
            'nachname' => 'required',
            'strasse' => 'required',
            'hasunr' => 'required',
            'plz' => 'required',
            'wohnort' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
//            'password' => 'nullable|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                toastr()->error($error, 'Validation Error');
            }
            return redirect()->back();
        }

        $user = User::findOrFail($id);
        $user->firmenname = $request->firmenname;
        $user->standort = $request->standort;
        $user->berichte = $request->berichte;
        $user->responsible_BG = $request->responsible_BG;
        $user->company_size = $request->company_size;
        $user->abteilung = $request->abteilung;
        $user->vorname = $request->vorname;
        $user->nachname = $request->nachname;
        $user->strasse = $request->strasse;
        $user->hasunr = $request->hasunr;
        $user->plz = $request->plz;
        $user->wohnort = $request->wohnort;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->role_id = 2;
//        if ($request->password != null) {
//            $user->password = Hash::make($request->password);
//        }
        $user->save();

        return redirect()->route('user.index')->with('success', 'Kunde updated successfully.');
    }


    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Kunde deleted successfully.');
    }


    public function dashboard()
    {
        $data['url'] = "Dashboard";
        return view('user.home', $data);
    }

    public function profile()
    {
        $data['url'] = "My Profile";
        $data['admin'] = auth()->user();
        return view('user.profile.index', $data);
    }

    public function profileEdit()
    {
        $data['url'] = "Edit Profile";
        $data['admin'] = auth()->user();
        return view('user.profile.edit', $data);
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'firmenname' => 'required|string',
            'standort' => 'required|string|max:255',
            'abteilung' => 'required|string|max:255',
            'vorname' => 'required|string|max:255',
            'nachname' => 'required|string|max:255',
            'strasse' => 'required|string|max:255',
            'hasunr' => 'required|string|max:255',
            'plz' => 'required|string|max:255',
            'wohnort' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                toastr()->error($error, 'Validation Error');
            }
            return redirect()->back();
        }


        $user->firmenname = $request->firmenname;
        $user->standort = $request->standort;
        $user->abteilung = $request->abteilung;
        $user->vorname = $request->vorname;
        $user->nachname = $request->nachname;
        $user->strasse = $request->strasse;
        $user->hasunr = $request->hasunr;
        $user->plz = $request->plz;
        $user->wohnort = $request->wohnort;
        $user->email = $request->email;

        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function profileUpdatePassword(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'currentpassword' => ['required'],
            'newpassword' => ['required', 'string', 'min:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/'],
        ]);
        if (!Hash::check($request->currentpassword, $user->password)) {
            return back()->withErrors(['currentpassword' => 'The current password is incorrect.']);
        }
        if ($request->newpassword !== $request->confirmpassword) {
            return back()->withErrors(['newpassword' => 'The new password and confirmation do not match.']);
        }
        $user->update([
            'password' => Hash::make($request->newpassword),
        ]);
        return redirect()->route('login')->with('success', 'Password updated successfully!');
    }
}
