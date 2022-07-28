<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
//use App\Models\PersonalAccessToken;
use App\Models\BatteryUser;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ResponseFormatter;
//use Validator;

class AuthController extends Controller
{
    public function login()
    {
        $validator=Validator::make(request()->all(),[
            'email' => 'required|email',
            'password' => 'min:8|required',
        ]);
        if($validator->fails()){
            return ResponseFormatter::error($validator, $validator->messages(), 400);
        }

        $user = User::where('email', request()->email)->first();
        if($user)
        {
            if(Hash::check(request()->password, $user->password))
            {
                Auth::login($user);
                $token=$user->createToken('auth_token')->plainTextToken;
                $data=[
                    'Token Type' => 'Bearer Token',
                    'Token' => $token,
                    'user' => $user->load('roles'),
                ];
                return ResponseFormatter::success($data,'Login berhasil');
            }
            return ResponseFormatter::error('Password user salah', 400);
        }
        return ResponseFormatter::error('Email user tidak ditemukan', 404);
    }

    public function logout(request $request)
    {
       $token = request()->user()->currentAccessToken()->delete();

        return ResponseFormatter::success(
            $token,
            'Token Revoked'
        );
    }
}
