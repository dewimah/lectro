<?php

namespace App\Http\Controllers;
use App\Helpers\ResponseFormatter;
use App\Models\UserDevice;
use App\Models\User;
use App\Models\Battery;

use Illuminate\Http\Request;

class UserDeviceController extends Controller
{
    public function all()
    {
        return UserDevice::all();
    }

    public function store(Request $request){
        //return UserDevice::create($request->all());
        $userdevice = UserDevice::create([
            'user_id' => $request->post('user_id'),
            'battery_id' => $request->post('battery_id'),
            'is_active' => $request->post('is_active')
        ]);
        return ResponseFormatter::success($userdevice,'Akun User Berhasil Dibuat');
    }

    public function show($id){
        return UserDevice::find($id);
        $results = UserDevice::with('users')->get();
            foreach ($results as $userrecord) {
            echo $userrecord->id; //access table2 data
            echo $userrecord->users->booktitle; //access table1 data
}
    }

   public function delete(){
        $user=UserDevice::find($id);
        user->delete();
        return 204;
   }

    public function update($id, Request $request){
        $user=UserDevice::find($id);
        $user->delete();
        return 204;
    }
}
