<?php

namespace App\Http\Controllers;
use App\Helpers\ResponseFormatter;
use App\Models\BatteryUser;
use App\Models\User;
use App\Models\Battery;

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
        //return UserDevice::create($request->all());
        /*$userdevice = UserDevice::create([
            'user_id' => $request->post('user_id'),
            'battery_id' => $request->post('battery_id'),
            'is_active' => $request->post('is_active')
        ]);
        return ResponseFormatter::success($userdevice->load('battery'),'Akun User Berhasil Dibuat');*/

        $userdevice=BatteryUser::create([
            'user_id' => request()->user_id,
            'battery_id' => request()->battery_id,
            'is_active' => request()->is_active
        ]);
        return ResponseFormatter::success($userdevice->load('batteries'),'Akun User Berhasil Dibuat');
    }

    public function show($id){
        return UserDevice::find($id);
        $results = UserDevice::with('users')->get();
            foreach ($results as $userrecord) {
            echo $userrecord->id; //access table2 data
            echo $userrecord->users->booktitle; //access table1 data
            echo $userrecord->load('batteries');
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
