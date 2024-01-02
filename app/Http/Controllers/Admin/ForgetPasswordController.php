<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Mail;
use Hash;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
        return view('auth.forgetPassword');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);
        DB::table('users')
            ->where('email', $request->email)
            ->update([
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);


        Mail::send('email.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }


    public function createPasswordForm($token, $userId)
    {
        return view('auth.createPasswordLink', ['token' => $token, 'userId' => $userId]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }
        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email' => $request->email])->delete();
        return redirect()->route('users.login')->with('message', 'Your password has been changed!');
    }


    public function submitForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);


        $user = User::where('email', $request->email)->first();
        if (isset($user)) {
            Mail::send('email.forgetPassword', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            });
            return response()->json(['message' => 'We have e-mailed your password reset link!']);
        } else {
            return response()->json(['message' => 'Email not found!']);
        }
    }

    public function showCreatePasswordForm($token)
    {
        $user = User::where('password_reset_token', $token)->first();
        if (!$user) {
            abort(404);
        }
        return view('auth.create-password', compact('user'));
    }

    public function createPassword(Request $request)
    {
        $request->validate([
//            'password' => 'required|confirmed|min:8',
            'password' => 'required|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/',
        ]);
        $user = User::find($request->input('user_id'));
        if ($user) {
            $user->update([
                'password' => bcrypt($request->input('password')),
                'password_reset_token' => null,
            ]);
            return redirect()->route('users.login')->with('success', 'Password created successfully. You can now log in.');
        }
        abort(404);
    }
}
