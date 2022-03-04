<?php

namespace App\Http\Controllers;

use App\Models\Erorrs;
use Illuminate\Http\Request;

class ErorrsController extends Controller
{
     //mengambil semua data
     public function all()
     {
         return Erorrs::all();
     }

     //mengambil data by id
     public function show ($id){
         return Erorrs::find($id);
     }

     //menambah data
     public function store(Request $request){
         return Erorrs::create($request->all());
     }

     //mengubah data
     public function update($id, Request $request){
         $erorrs = Erorrs::find($id);
         $erorrs->update($request->all());
     }

     //menghapus data
     public function delete($id){
         $erorrs= Erorrs::find($id);
         $erorrs->delete();
         return 204;
     }
}
