<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Battery;

class BatteryController extends Controller
{
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
      }

      //menghapus data
      public function delete($id){
          $battery=Battery::find($id);
          $battery->delete();
          return 204;
      }
}
