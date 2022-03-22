<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDeviceController extends Controller
{
    public function all()
    {
        return UserDevice::all();
    }
}
