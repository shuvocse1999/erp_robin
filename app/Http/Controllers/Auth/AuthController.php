<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Mail;
use DB;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    protected $maxAttempts = 10;
    protected $decayMinutes = 1;
    protected function redirectTo()
    {
        if (Auth()->user()->role_id == 1) {
            return route('admin.dashboard');
        } elseif (Auth()->user()->role_id == 2) {
            return route('user.dashboard');
        }
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(\Illuminate\Http\Request $request)
    {
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            if ($this->limiter()->attempts($this->throttleKey($request)) >= 10) {
                $this->handleLockoutResetPassword($request);
                return redirect()->back()->with(['error' => 'Account locked. We have sent you a password reset link.']);
            }
            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }
            return $this->sendLoginResponse($request);
        }
        $this->incrementLoginAttempts($request);
        return redirect()->back()->with(['error' => 'Email and Password does not match']);
    }

    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), 10,1
        );
    }
    protected function handleLockoutResetPassword($request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if ($this->limiter()->attempts($this->throttleKey($request)) >= 10) {
            $token = Str::random(64);
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            $user->update([
                'password' => null,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);

            Mail::send('email.forgetPassword', ['token' => $user->token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            });
        }
    }


}
