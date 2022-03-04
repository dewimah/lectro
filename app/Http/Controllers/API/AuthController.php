<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function me(Request $request)
    {
        return $request->user();
    }

    public function login(Request $request)
    {
    $user = User::where('email', $request->email)->first();

    if(!$user || !Hash::check($request->password, $user->password)){
        return response ()->json([
            'message' => 'Password tdk sesuai'
        ],
        401);
    }

    $token = $user->createToken('token-name')->plainTextToken;

    return response()->json([
        'message' => 'success',
        'user' => $user,
        'token' => $token
    ]  ,200);
    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            ]);

        $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            ]);
    }
    public function logout()
    {
        auth()->user();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
