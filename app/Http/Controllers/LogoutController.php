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
        $this->middleware('auth');
        if ($request->user()) {
            $request->user()->tokens()->delete();
            // $request->user()->currentAccessToken()->delete();
            // $user->tokens()->delete();
            // Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        // $user = auth()->user();
        // $request->user()->logout();
        return redirect('/login');

        // return ResponseFormatter::success(null, 'Token Revoked',200);
    }
    /*$token = request()->user()->currentAccessToken()->delete();

        return ResponseFormatter::success(
            $token,
            'Token Revoked'
        );
}*/
}
