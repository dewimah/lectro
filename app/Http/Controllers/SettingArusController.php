<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\SettingArus;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Validator;

class SettingArusController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //mengambil semua data
    public function all(){
        return SettingArus::all();
    }

    //mengambil data by id
    public function show ($id){
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $settingarus=SettingArus::find($id);
        if(!$settingarus){
            return ResponseFormatter:: error(null, 'Data Tidak Ada', 403);
        }
        return ResponseFormatter::success($settingarus, 'Data Didapatkan');
        //return Setting::find($id);
    }

    public function store(Request $request) {
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $settingarus = SettingArus::create($request->all());
        return ResponseFormatter::success($settingarus,'Setting Arus Berhasil di Tambahkan',201);
    }

    //mengubah data
    public function update($id, Request $request){
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $settingarus = SettingArus::find($id);
        $settingarus->update($request->all());
        return ResponseFormatter::success(
            'Success Edit',
            SettingArus::find($id),
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
        $settingarus = SettingArus::find($id);
        $settingarus->delete();
        return ResponseFormatter::success(
            'Data Berhasil Di Hapus',
            200
        );
    }
}
