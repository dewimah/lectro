<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\SettingSuhu;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Validator;

class SettingSuhuController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //mengambil semua data
    public function all(){
        return SettingSuhu::all();
    }

    //mengambil data by id
    public function show ($id){
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $settingsuhu=SettingSuhu::find($id);
        if(!$settingsuhu){
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
        $settingsuhu = SettingSuhu::create($request->all());
        return ResponseFormatter::success($settingsuhu,'Setting Suhu Berhasil di Tambahkan',201);
    }

    //mengubah data
    public function update($id, Request $request){
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $settingsuhu = SettingSuhu::find($id);
        $settingsuhu->update($request->all());
        return ResponseFormatter::success(
            'Success Edit',
            SettingSuhu::find($id),
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
        $settingsuhu = SettingSuhu::find($id);
        $settingsuhu->delete();
        return ResponseFormatter::success(
            'Data Berhasil Di Hapus',
            200
        );
    }
}
