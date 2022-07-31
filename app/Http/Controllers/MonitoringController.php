<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monitoring;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function all(){
        //return Monitoring::with(['battery'])->get();
        return DB::table('monitorings')
        ->join('batteries','monitorings.battery_id','=','batteries.id')
        ->join('settings','batteries.setting_id', '=', 'settings.id')
        ->join('cells','batteries.cell_id', '=', 'cells.id')
        ->select(
            'monitorings.*',
            'battery_id',
            'setting_id',
            'batteries.name as namabattery',
            'cellbaterai',
            'settings.name as namasetting',
            'temp_min',
            'temp_max',
            'arus_min',
            'arus_max',
            'tegangan_min',
            'tegangan_max',
            'temp_1',
            'temp_2',
            'temp_3',
            'arus',
            'tegangan_tot'
        )
        ->get();
    }

    public function show ($id){
        return Monitoring::with('battery')->where('id', $id)->get();

        //return Monitoring::find($id)->with('settings','cells');
    }

    public function lala($id){
        //return Monitoring::with('battery')->where('battery_id',$id)->get();

         $data = DB::table('monitorings')->select(
            //'battery_id as batteryid',
            'setting_id as settingid',
            'cell_id as cellid',
            'monitorings.*',
            'settings.tegangan_min',
            'settings.tegangan_max',
            'settings.temp_min',
            'settings.temp_max',
            'settings.arus_min',
            'settings.arus_max',
            'batteries.name',
            'batteries.tipe',
            'batteries.serial',
            'monitorings.id as monnn'
        )->where('battery_id', $id);

        $data = $data
        ->join('batteries', 'monitorings.battery_id', '=', 'batteries.id')
        ->join('settings', 'batteries.setting_id', '=', 'settings.id');

        $data = $data->orderBy('id', 'desc')->first();
	return $data;
    }

    //menambah data
    public function store(Request $request){
        return Monitoring::create($request->all());
    }

    //mengubah data
    public function update($id, Request $request){
        $monitoring = Monitoring::find($id);
        $monitoring->update($request->all());
    }

    //menghapus data
    public function delete($id){
        $monitoring=Monitoring::find($id);
        $monitoring->delete();
        return 204;
    }

    public function datamasuk(Request $request){
        $data = new Monitoring;
        //$data -> error_id = $request -> error_id;
        //$data -> control_relay = $request -> control_relay;
        $data -> battery_id = $request -> battery_id;
        $data -> tegangan_tot = $request -> tegangan_tot;
        $data -> tegangan_cell = $request -> tegangan_cell;
        $data -> temp_1 = $request -> temp_1;
        $data -> temp_2 = $request -> temp_2;
        $data -> temp_3 = $request -> temp_3;
        $data -> arus = $request -> arus;
        $data -> soc = $request -> soc;
        $data -> soh = $request -> soh;

        $data -> save();
        return 200;
        //return ResponseFormatter::success('Data Masuk');
    }
}
