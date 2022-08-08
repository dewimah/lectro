<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //mengambil semua data
    public function all(){
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $battery=Setting::with(['setting_suhus','setting_tegangans','setting_aruses'])->get();
        return ResponseFormatter::success($battery, 'Data Didapatkan');
        //return Battery::with(['cell','setting'])->get();
        //return Setting::all();
    }

    //mengambil data by id
    public function show ($id){
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $setting=Setting::find($id);
        if(!$setting){
            return ResponseFormatter:: error(null, 'Data Tidak Ada', 403);
        }
        return ResponseFormatter::success($setting, 'Data Didapatkan');
        //return Setting::find($id);
    }

    //public function store(Request $request) {
        /*$user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $validateData = $request->validate([
            'name' => 'required',
            'temp_min' => 'required|numeric|gt:20|lt:60',
            'temp_max' => 'required|numeric|gt:20|lt:60',
            'tegangan_min' => 'required|numeric|gt:20|lt:60',
            'tegangan_max' =>'required|numeric|gt:20|lt:60',
            'arus_min' =>'required|numeric|gt:20|lt:60',
            'arus_max' =>'required|numeric|gt:20|lt:60'
        ]);
        return Setting::create($validateData);*/
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
