<?php

namespace App\Http\Controllers;
use App\Helpers\ResponseFormatter;
use App\Models\BatteryUser;
use App\Models\User;
use App\Models\Battery;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UserDeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all()
    {
        /*return BatteryUser::with(['user','battery'])
        ->get();*/
        // return
        $data = DB::table('battery_user')
        ->select(
            'battery_user.id',
            'battery_id',
            'setting_id',
            'cell_id',
            'is_active',
            'users.name as name',
            'batteries.name as namabattery',
            'cellbaterai',
            'email',
            'tipe',
            'serial',
            'settings.name as namasetting',
            'temp_min',
            'temp_max',
            'arus_min',
            'arus_max',
            'tegangan_min',
            'tegangan_max'
        )
        ->join('users','battery_user.user_id', '=', 'users.id')
        ->join('batteries','battery_user.battery_id','=','batteries.id')
        ->join('settings','batteries.setting_id', '=', 'settings.id')
        ->join('cells','batteries.cell_id', '=', 'cells.id')
        ->get()->toArray();

        return response()->json([
            'succes' => true,
            'data' => $data
        ]);
    }

    public function store(Request $request){
    $userdevice=BatteryUser::create([
        'user_id' => request()->user_id,
        'battery_id' => request()->battery_id,
        'is_active' => request()->is_active,
    ]);
        return response()->json([
            'succes' => true
        ]);
    }

    public function show($id){
        /*return BatteryUser::find($id);
        $results = BatteryUser::with('users')->get();
        foreach ($results as $userrecord) {
        echo $userrecord->id; //access table2 data
        echo $userrecord->users->booktitle; //access table1 data
        }*/
        return BatteryUser::with('battery','user','monitoring')->where('id', $id)->get();
    }

    public function delete($id){
        $userdevice=BatteryUser::find($id);
        $userdevice->delete();

        return ResponseFormatter::success(
            'Data Berhasil Di Hapus',
            200
        );
    }

    public function update(Request $request, $id){
        $userdevice = BatteryUser::find($id);
          $userdevice->update($request->all());
         // return $request->all();

        return ResponseFormatter::success(
            'Success Edit',
            BatteryUser::find($id),
            200
        );
    }
}
