<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\SettingTegangan;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Validator;

class SettingTeganganController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //mengambil semua data
    public function all(){
        return SettingTegangan::all();
    }

    //mengambil data by id
    public function show ($id){
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $settingtegangan=SettingTegangan::find($id);
        if(!$settingtegangan){
            return ResponseFormatter:: error(null, 'Data Tidak Ada', 403);
        }
        return ResponseFormatter::success($settingsuhu, 'Data Didapatkan');
        //return Setting::find($id);
    }

    public function store(Request $request) {
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $settingtegangan = SettingTegangan::create($request->all());
        return ResponseFormatter::success($settingtegangan,'Setting Tegangan Berhasil di Tambahkan',201);
    }

    //mengubah data
    public function update($id, Request $request){
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $settingtegangan = SettingTegangan::find($id);
        $settingtegangan->update($request->all());
        return ResponseFormatter::success(
            'Success Edit',
            SettingTegangan::find($id),
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
        $settingtegangan = SettingTegangan::find($id);
        $settingtegangan->delete();
        return ResponseFormatter::success(
            'Data Berhasil Di Hapus',
            200
        );
    }
}
