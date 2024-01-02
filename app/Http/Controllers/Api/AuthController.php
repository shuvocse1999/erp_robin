<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                "email" => "required|email|exists:users",
                "password" => "required"
            ];
            $customMessage = [
                "email.required" => "Email is required",
                "email.email" => "Email must be valid",
                "email.exists" => "Email does not exists",
                "password.required" => "Password is required"
            ];
            $validator = validator::make($data, $rules, $customMessage);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                $user = User::where('email', $data['email'])->first();
                $access_token = $user->createToken($data['email'])->accessToken;
                User::where('email', $data['email'])->update(['access_token' => $access_token]);

                if ($user->role_id == 1){
                    $isAdmin = true;
                }
                else{
                    $isAdmin = false;
                }

                $message = "User successfully login";
                return response()->json(['message' => $message, "access_token" => $access_token, 'is_admin'=>$isAdmin, 'userdetails' => $user], 201);
            } else {
                $message = "Invalid email or password";
                return response()->json(['message', $message], 422);
            }
        }
    }
}
