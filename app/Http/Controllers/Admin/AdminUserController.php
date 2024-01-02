<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;



class AdminUserController extends Controller

{

    public function index(Request $request)

    {

        $query = User::with('role')->where('role_id',1)->latest();
        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->where('vorname', 'like', "%{$key}%")
                    ->orWhere('email', 'like', "%{$key}%")
                    ->orWhereHas('role', function ($formularQuery) use ($key) {
                        $formularQuery->where('name', 'like', "%{$key}%");
                    });
            });

        }

        $data['url'] = "Mitarbeiter";
        $data['search'] = $request->search;
        $data['users'] = $query->paginate(10);
        return view('admin.manage-user.index', $data);

    }





    public function create()

    {

        $data['url'] = "Mitarbeiter Create";

        return view('admin.manage-user.create', $data);

    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firmenname' => 'required',
            'email' => 'required|email|unique:users,email',
//            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/',
            'role' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $filename = null;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = uniqid() . '.' . $avatar->getClientOriginalExtension();
            // Move the uploaded file to the "public/avatars" directory
            $avatar->move(public_path('avatars'), $filename);
        }
        $user = new User();
        $user->avatar = $filename;
        $user->firmenname = $request->firmenname;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('admin.user.index')->with('success', 'User created successfully.');
    }
    public function edit($id)
    {
        $data['url'] = "Mitarbeiter Edit";
        $data['user'] = User::find($id);
        return view('admin.manage-user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'firmenname' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/',
            'role' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::findOrFail($id);
        $user->firmenname = $request->input('firmenname');
        $user->email = $request->input('email');
        $user->role_id = $request->role;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = uniqid() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('avatars'), $filename);
            if ($user->avatar) {
                if (file_exists(public_path('avatars/' . $user->avatar))) {
                    unlink(public_path('avatars/' . $user->avatar));
                }
            }
            $user->avatar = $filename;
        }
        $user->save();
        return redirect()->route('admin.user.index')->with('success', 'User updated successfully.');
    }
    public function delete($id)
    {
        $user = User::findOrFail($id);
            if ($user->avatar) {
                Storage::delete('public/images/admin' . $user->avatar);
            }
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully.');
    }





}

