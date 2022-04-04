<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseFormatter;
use App\Models\Battery;

class BatteryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

      //mengambil semua data
      public function all()
      {
          return Battery::all();
      }

      //mengambil data by id
      public function show ($id){
          return Battery::find($id);
      }

      //menambah data
      public function store(Request $request){
          return Battery::create($request->all());
      }

      //mengubah data
      public function update($id, Request $request){
          $battery = Battery::find($id);
          $battery->update($request->all());

          return ResponseFormatter::success(
            'Success Edit',
            Battery::find($id),
            200
        );
    }

      //menghapus data
      public function delete($id){
          $battery=Battery::find($id);
          $battery->delete();

          return ResponseFormatter::success(
            'Data Berhasil Di Hapus',
            200
        );
    }
}
