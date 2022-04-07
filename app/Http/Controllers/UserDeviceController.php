<?php

namespace App\Http\Controllers;
use App\Helpers\ResponseFormatter;
use App\Models\BatteryUser;
use App\Models\User;
use App\Models\Battery;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class UserDeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all()
    {
        return BatteryUser::all();
    }

    public function store(Request $request){
        $userdevice=BatteryUser::create([
            'user_id' => request()->user_id,
            'battery_id' => request()->battery_id,
            'is_active' => request()->is_active,
            'token_device' => Str::random(40),
        ]);

        return ResponseFormatter::success($userdevice->load('batteries'),'Akun User Berhasil Dibuat');
    }

    public function show($id){
        return UserDevice::find($id);
        $results = UserDevice::with('users')->get();
            foreach ($results as $userrecord) {
            echo $userrecord->id; //access table2 data
            echo $userrecord->users->booktitle; //access table1 data

        }
    }

    public function delete($id){
        $userdevice=BatteryUser::find($id);
        $userdevice->delete();

        return ResponseFormatter::success(
            'Data Berhasil Di Hapus',
            200
        );
    }

    public function update($id, Request $request){
        $userdevice=UserDevice::find($id);
        $userdevice->delete();

        return ResponseFormatter::success(
            'Success Edit',
            UserDevice::find($id),
            200
        );
    }
}
