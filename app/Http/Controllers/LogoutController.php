<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ResponseFormatter;

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
        }

        return ResponseFormatter::success(null, 'Token Revoked',200);
    }
}
