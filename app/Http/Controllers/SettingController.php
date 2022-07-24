<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //mengambil semua data
    public function all()
    {
        return Setting::all();
    }

    //mengambil data by id
    public function show ($id){
        return Setting::find($id);
    }

    //menambah data
    /*public function store(Request $request){
        return Setting::create($request->all());
    }*/

    public function store(Request $request) {
         $validateData = $request->validate([
            'temp_min' => 'required|numeric|gt:20|lt:60',
            'temp_max' => 'required|numeric|gt:20|lt:60',
            'tegangan_min' => 'required|numeric|gt:20|lt:60',
            'tegangan_max' =>'required|numeric|gt:20|lt:60',
            'arus_min' =>'required|numeric|gt:20|lt:60',
            'arus_max' =>'required|numeric|gt:20|lt:60'
        ]);

        return Setting::create($validateData);

    }

    //mengubah data
    public function update($id, Request $request){
        $user = Setting::find($id);
        $user->update($request->all());

        return ResponseFormatter::success(
            'Success Edit',
            $user = Setting::find($id),
            200
        );
    }

    //menghapus data
    public function delete($id){
        $user=Setting::find($id);
        $user->delete();

        return ResponseFormatter::success(
            'Data Berhasil Di Hapus',
            200
        );
    }
}
