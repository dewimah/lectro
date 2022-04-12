<?php

namespace App\Http\Controllers;

use App\Models\Error;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class ErorrsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     //mengambil semua data
     public function all()
     {
         return Error::all();
     }

     //mengambil data by id
     public function show ($id){
         return Error::find($id);
     }

     //menambah data
     public function store(Request $request){
        $error =  Error::create($request->all());

         return ResponseFormatter::success($error,'Data Battery Berhasil di Tambahkan',201);
     }

     //mengubah data
     public function update($id, Request $request){
         $erorrs = Error::find($id);
         $erorrs->update($request->all());

         return ResponseFormatter::success(
            'Success Edit',
            Error::find($id),
            200
        );
     }

     //menghapus data
     public function delete($id){
         $erorrs= Error::find($id);
         $erorrs->delete();

         return ResponseFormatter::success(
            'Data Berhasil Di Hapus',
            200
        );
     }
}
