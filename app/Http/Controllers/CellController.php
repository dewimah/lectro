<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseFormatter;
use App\Models\cell;

class CellController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

      //mengambil semua data
      public function all()
      {
          return cell::all();

      }

      //mengambil data by id
      public function show ($id){
          return cell::find($id);
      }

      //menambah data
      public function store(Request $request){
          $cell = cell::create($request->all());

          return ResponseFormatter::success($cell,'Jumlah Cell Berhasil di Tambahkan',201);
      }

      //mengubah data
      public function update( Request $request, $id){

          $cell = cell::find($id);
          //$battery->update($request->all());
            return $request->all();
          return ResponseFormatter::success(
            'Success Edit',
            cell::find($id),
            200
        );
    }

      //menghapus data
      public function delete($id){
          $battery=cell::find($id);
          $battery->delete();

          return ResponseFormatter::success(
            'Data Berhasil Di Hapus',
            200
        );
    }
}
