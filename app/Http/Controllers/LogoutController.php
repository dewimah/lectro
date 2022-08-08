<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

// use Illuminate\Support\Facades\Cookie;

class LogoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function logout(request $request)
    {
         
        // $user = auth()->user();
        // $request->user()->logout();
        auth()->logout();
        Session::flush();
        return redirect('login');

        // return ResponseFormatter::success(null, 'Token Revoked',200);
    }
    /*$token = request()->user()->currentAccessToken()->delete();

        return ResponseFormatter::success(
            $token,
            'Token Revoked'
        );
}*/
}
