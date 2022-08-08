<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //mengambil semua data
    public function all(){
       /* $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        //$setting=Setting::with(['setting_suhus','setting_tegangans','setting_aruses'])->get();
        //return ResponseFormatter::success($setting, 'Data Didapatkan');
        //return Battery::with(['cell','setting'])->get();
        return Setting::all();*/
        $data = DB::table('settings')->select(
            'setting_tegangans.name as namasettingtegangan',
            'setting_suhus.name as namasettingsuhu',
            'setting_aruses.name as namasettingarus',
            'setting_suhus.temp_min',
            'setting_suhus.temp_max',
            'setting_tegangans.tegangan_min',
            'setting_tegangans.tegangan_max',
            'setting_aruses.arus_min',
            'setting_aruses.arus_max',
        );

        $data = $data
        ->join('setting_tegangans','settings.settingtegangans_id', '=', 'setting_tegangans.id')
        ->join('setting_aruses','settings.settingaruses_id', '=', 'setting_aruses.id')
        ->join('setting_suhus','settings.settingsuhus_id', '=', 'setting_suhus.id')->get();

        return $data;
    }

    //mengambil data by id
    public function show ($id){
       /* $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $setting=Setting::find($id);
        if(!$setting){
            return ResponseFormatter:: error(null, 'Data Tidak Ada', 403);
        }
        return ResponseFormatter::success($setting, 'Data Didapatkan');
        //return Setting::find($id);*/
        $data = DB::table('settings')->select(
            'setting_tegangans.name as namasettingtegangan',
            'setting_suhus.name as namasettingsuhu',
            'setting_aruses.name as namasettingarus',
            'setting_suhus.temp_min',
            'setting_suhus.temp_max',
            'setting_tegangans.tegangan_min',
            'setting_tegangans.tegangan_max',
            'setting_aruses.arus_min',
            'setting_aruses.arus_max',
        )->where('settings.id', $id);

        $data = $data
        ->join('setting_tegangans','settings.settingtegangans_id', '=', 'setting_tegangans.id')
        ->join('setting_aruses','settings.settingaruses_id', '=', 'setting_aruses.id')
        ->join('setting_suhus','settings.settingsuhus_id', '=', 'setting_suhus.id')->get();

        return $data;
    }

    public function store(Request $request){
            $setting=Setting::create([
                'name' => request()->name,
                'settingsuhus_id' => request()->settingsuhus_id,
                'settingaruses_id' => request()->settingaruses_id,
                'settingtegangans_id' => request()->settingtegangans_id,
            ]);
                return response()->json([
                    'succes' => true
                ]);
    }

    //mengubah data
    public function update($id, Request $request){
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $setting = Setting::find($id);
        $setting->update($request->all());
        return ResponseFormatter::success(
            'Success Edit',
            Setting::find($id),
            200
        );
    }

    //menghapus data
    public function delete($id){
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $setting = Setting::find($id);
        $setting->delete();
        return ResponseFormatter::success(
            'Data Berhasil Di Hapus',
            200
        );
    }
}
