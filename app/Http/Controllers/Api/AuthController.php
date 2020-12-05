<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::whereEmail($request->email)->first();
        if (!is_null($user) && Hash::check($request->password, $user->password) && $user->can('api')) {
            if (isset($user->token)) {
                return;
            } elseif ($user->api_token == null) {
                $user->update([
                    'api_token' => Str::random(50),
                ]);
            }
            return response()->json([
                'message' => 'Welcome, use the token to continue',
                'token' => $user->api_token,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data is invalid',
            ]);
        }
    }
}
