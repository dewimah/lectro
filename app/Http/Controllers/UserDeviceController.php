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
        /*$data = DB::table('battery_user')
        ->select(
            'battery_user.id',
            //'battery_id',
            'setting_id',
            //'monitorings.*',
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
            'tegangan_max',
            /*'tegangan_tot',
            'tegangan_cell',
            'temp_1',
            'temp_2',
            'temp_3',
            'arus',
            'soc',
            'soh'
        )
        ->join('users','battery_user.user_id', '=', 'users.id')
        ->join('monitorings','battery_user.monitoring_id', '=', 'monitoring.id')
        ->join('batteries','battery_user.battery_id','=','batteries.id')
        ->join('settings','batteries.setting_id', '=', 'settings.id')
        ->join('cells','batteries.cell_id', '=', 'cells.id')
        ->get()->toArray();

        return response()->json([
            'succes' => true,
            'data' => $data
        ]);*/
        $data = DB::table('battery_users')->select(
            'battery_users.is_active',
           /* 'monitorings.tegangan_tot',
            'monitorings.tegangan_cell',
            'monitorings.temp_1',
            'monitorings.temp_2',
            'monitorings.temp_3',
            'monitorings.arus',
            'monitorings.soc',
            'monitorings.soh',*/
            'setting_tegangans.name as namasettingtegangan',
            'setting_suhus.name as namasettingsuhu',
            'setting_aruses.name as namasettingarus',
            'setting_suhus.temp_min',
            'setting_suhus.temp_max',
            'setting_tegangans.tegangan_min',
            'setting_tegangans.tegangan_max',
            'setting_aruses.arus_min',
            'setting_aruses.arus_max',
            'cells.cellbaterai',
            'batteries.tipe',
            'batteries.serial',
            'battery_users.id as bttt',
            'users.id as usss',
            //'monitorings.id as monnn',
            'batteries.name as namabattery',
            'users.name as namauser',
            'battery_users.battery_id',
        );

        $data = $data
       // ->leftJoin('monitorings', 'battery_users.monitoring_id', '=', 'monitorings.id')
        ->join('batteries', 'battery_users.battery_id', '=', 'batteries.id')
        ->join('settings', 'batteries.setting_id', '=', 'settings.id')
        ->join('cells', 'batteries.cell_id', '=', 'cells.id')
        ->join('setting_tegangans','settings.settingtegangans_id', '=', 'setting_tegangans.id')
        ->join('setting_aruses','settings.settingaruses_id', '=', 'setting_aruses.id')
        ->join('setting_suhus','settings.settingsuhus_id', '=', 'setting_suhus.id')
        ->join('users', 'battery_users.user_id', '=', 'users.id')->get();

        return $data;
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

    public function belajar(Request $request){
        $userdevice=BatteryUser::create([
            'user_id' => request()->user_id,
            'battery_id' => request()->battery_id,
            'is_active' => request()->is_active,
        ]);
            return response()->json([
                'succes' => true
            ]);
        }

    public function kabeh($id){
        $data = DB::table('battery_users')->select(
            'battery_users.is_active',
            /*'monitorings.tegangan_tot',
            'monitorings.tegangan_cell',
            'monitorings.temp_1',
            'monitorings.temp_2',
            'monitorings.temp_3',
            'monitorings.arus',
            'monitorings.soc',
            'monitorings.soh',*/
            'batteries.name',
            'batteries.tipe',
            'batteries.serial',
            'users.name',
            'battery_users.id as bttt',
            'users.id as usss',
            'monitorings.id as monnn',
            //'battery_user.battery_id as battery_id'
        )->where('battery_users.id', $id);

        $data = $data
       // ->leftJoin('monitorings', 'battery_users.monitoring_id', '=', 'monitorings.id')
        ->join('batteries', 'battery_users.battery_id', '=', 'batteries.id')
        ->join('users', 'battery_users.user_id', '=', 'users.id')->get();
        return $data;
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

    public function rudi()
    {
        return ResponseFormatter::success(
            'berhasil'
        );
    }
}
