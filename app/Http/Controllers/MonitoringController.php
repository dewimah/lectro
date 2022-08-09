<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monitoring;
use App\Helpers\ResponseFormatter;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{
    public function getwaktu($dari, $ke){
       $monitoring= Monitoring::whereBetween('created_at', [$dari, $ke])->get();



       /* $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::now();

        $monitoring = Monitoring::select('*')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    -> $transactions = Transaction::whereBetween('created_at',
                    [$data_inicio, $data_fim])->where('user_id',Auth::id())->get();
                    ->get();*/

        return $monitoring;
    }

    public function all(){
        //return Monitoring::with(['battery'])->get();

        return DB::table('monitorings')
        
        ->join('batteries AS a','a.id','=','monitorings.battery_id')
        ->join('settings AS b','b.id', '=', 'a.setting_id')
        ->join('setting_tegangans AS c','c.id', '=', 'b.settingtegangans_id')
        ->join('setting_aruses AS d','d.id', '=', 'b.settingaruses_id')
        ->join('setting_suhus AS e','e.id', '=', 'b.settingsuhus_id')
        ->join('cells AS f','f.id', '=', 'a.cell_id')
        ->join('battery_users AS g','g.battery_id', '=', 'a.id' )
        ->select(
            'monitorings.*',
            'g.battery_id',
            'a.setting_id',
            'a.name as namabattery',
            'f.cellbaterai',
            'b.name as namasetting',
            'c.name as namasettingtegangan',
            'e.name as namasettingsuhu',
            'd.name as namasettingarus',
            'e.temp_min',
            'e.temp_max',
            'd.arus_min',
            'd.arus_max',
            'c.tegangan_min',
            'c.tegangan_max',
            'temp_1',
            'temp_2',
            'temp_3',
            'arus',
            'tegangan_tot',
            'g.user_id as id')
            ->get();

    }

    // public function rekapData (Request $request)
    // {
    //     $tgl_sekarang = Carbon::now()->format('Y-m-d');
    //     $data_temp1 = Monitoring::where('hari', $tgl_sekarang)->max('temp_1');
    //     $data_temp2 = Monitoring::where(date('Y-m-d', strtotime('created_at')), $tgl_sekarang)->max('temp_2')->first();
    //     $data_temp3 = Monitoring::where(date('Y-m-d', strtotime('created_at')), $tgl_sekarang)->max('temp_3')->first();
    //     $arus = Monitoring::where(date('Y-m-d', strtotime('created_at')), $tgl_sekarang)->max('arus')->first();
    //     $tot = Monitoring::where(date('Y-m-d', strtotime('created_at')), $tgl_sekarang)->max('tegangan_tot')->first();

    //     return response()->json(
    //         [$data_temp1, $data_temp2, $data_temp3, $arus, $tot]
    //     );
    // }

    public function show ($id){
        return Monitoring::with('battery')->where('id', $id)->get();

    }

    public function lala($id){
        //return Monitoring::with('battery')->where('battery_id',$id)->get();

         $data = DB::table('monitorings')->select(
            //'battery_id as batteryid',
            'setting_id as settingid',
            'cell_id as cellid',
            'monitorings.*',
            'setting_tegangans.name as namasettingtegangan',
            'setting_suhus.name as namasettingsuhu',
            'setting_aruses.name as namasettingarus',
            'setting_suhus.temp_min',
            'setting_suhus.temp_max',
            'setting_tegangans.tegangan_min',
            'setting_tegangans.tegangan_max',
            'setting_aruses.arus_min',
            'setting_aruses.arus_max',
            'batteries.name',
            'batteries.tipe',
            'batteries.serial',
            'monitorings.id as monnn'
        )->where('battery_id', $id);

        $data = $data
        ->join('batteries', 'monitorings.battery_id', '=', 'batteries.id')
        ->join('settings', 'batteries.setting_id', '=', 'settings.id')
        ->join('setting_tegangans','settings.settingtegangans_id', '=', 'setting_tegangans.id')
        ->join('setting_aruses','settings.settingaruses_id', '=', 'setting_aruses.id')
        ->join('setting_suhus','settings.settingsuhus_id', '=', 'setting_suhus.id');

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
        $tgl_sekarang = Carbon::now()->format('Y-m-d');

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
        //$data -> hari = $tgl_sekarang;


        $data -> save();
        return 200;
        //return ResponseFormatter::success('Data Masuk');
    }
    public function rudi(){
        return response()->json([
            'berhasil'
        ]);
        //echo 'berhasil';
        //return ;
    }
}
