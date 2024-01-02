<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function dashboard()
    {
        $data['url'] = "Dashboard";
        return view('admin.home', $data);
    }

    public function index(Request $request)
    {
        $query = User::where('role_id', 1)->latest();
        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->where('name', 'like', "%{$key}%")
                    ->orWhere('vorname', 'like', "%{$key}%")
                    ->orWhere('email', 'like', "%{$key}%");
            });
        }
        $data['url'] = "Admins";
        $data['search'] = $request->search;
        $data['admins'] = $query->paginate(10);
        return view('admin.manage-admin.index', $data);
    }

    public function create()
    {
        $data['url'] = "Admin Create";
        return view('admin.manage-admin.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required']
        ]);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = uniqid() . '.' . $avatar->getuserOriginalExtension();
            $avatar->storeAs('public/avatars', $filename);
        } else {
            $filename = null;
        }
        $admin = new User();
        $admin->avatar = $filename;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->role_id = 1;
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect()->route('admin.index')->with('success', 'Admin created successfully.');
    }

    public function edit($id)
    {
        $data['url'] = "Admin Edit";
        $data['admin'] = User::find($id);
        return view('admin.manage-admin.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required']
        ]);

        $admin = User::findOrFail($id);
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->role_id = 1;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->input('password'));
        }

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = uniqid() . '.' . $avatar->getClientOriginalExtension();

            // Move the uploaded file to the "public/avatars" directory
            $avatar->move(public_path('avatars'), $filename);

            if ($admin->avatar) {
                // Delete the old avatar
                if (file_exists(public_path('avatars/' . $admin->avatar))) {
                    unlink(public_path('avatars/' . $admin->avatar));
                }
            }

            $admin->avatar = $filename;
        }

        $admin->save();

        return redirect()->route('admin.index')->with('success', 'Admin updated successfully.');
    }



    public function delete($id)
    {
        $admin = User::findOrFail($id);
        if ($admin->avatar) {
            Storage::delete('storage/app/public/avatars' . $admin->avatar);
        }
        $admin->delete();
        return redirect()->route('admin.index')->with('success', 'Admin deleted successfully.');
    }


    public function profile()
    {
        $data['url'] = "My Profile";
        $data['admin'] = auth()->user();
        return view('admin.profile.index', $data);
    }

    public function profileEdit()
    {
        $data['url'] = "Edit Profile";
        $data['admin'] = auth()->user();
        return view('admin.profile.edit', $data);
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = uniqid() . '.' . $avatar->getClientOriginalExtension();

            // Move the uploaded file to the "public/avatars" directory
            $avatar->move(public_path('avatars'), $filename);

            if ($user->avatar) {
                // Delete the old avatar
                if (file_exists(public_path('avatars/' . $user->avatar))) {
                    unlink(public_path('avatars/' . $user->avatar));
                }
            }

            $user->avatar = $filename;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


    public function profileUpdatePassword(Request $request)
    {
        $user = Auth::user();

        // Validate the form data
        $this->validate($request, [
            'currentpassword' => ['required'],
            'newpassword' => ['required', 'string', 'min:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/'],
        ]);

        // Verify the manage-admin's current password
        if (!Hash::check($request->currentpassword, $user->password)) {
            return back()->withErrors(['currentpassword' => 'The current password is incorrect.']);
        }

        // Verify the new password confirmation
        if ($request->newpassword !== $request->confirmpassword) {
            return back()->withErrors(['newpassword' => 'The new password and confirmation do not match.']);
        }

        // Update the manage-admin's password
        $user->update([
            'password' => Hash::make($request->newpassword),
        ]);

        // Redirect the manage-admin to the login page with a success message
        return redirect()->route('users.login')->with('success', 'Password updated successfully!');
    }
}
