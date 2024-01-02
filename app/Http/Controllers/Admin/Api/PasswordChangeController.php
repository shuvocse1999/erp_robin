<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
    public function changePassword(Request $request)
    {
        $token = $request->bearerToken();
        $user = User::where('access_token', $token)->first();
        if (!$user) {
            return response()->json(['message' => 'Invalid or expired token'], 400);
        }
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return response()->json(['message' => 'Current password does not match'], 400);
        }

        $user->password = bcrypt($request->input('new_password'));
        $user->save();

        return response()->json(['message' => 'Password reset successfully']);
    }
}
