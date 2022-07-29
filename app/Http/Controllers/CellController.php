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
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $cell=cell::all();
        return ResponseFormatter::success($cell, 'Data Didapatkan');
        //return cell::all();
    }

    //mengambil data by id
    public function show ($id){
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $cell=cell::find($id);
        if(!$cell){
            return ResponseFormatter:: error(null, 'Data Tidak Ada', 403);
        }
        return ResponseFormatter::success($cell, 'Data Didapatkan');
        /*$user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $cell=cell::find($id);
        return ResponseFormatter::success($user, 'Data Didapatkan');
        //return cell::find($id);*/
    }

    //menambah data
    public function store(Request $request){
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $cell = cell::create($request->all());
        return ResponseFormatter::success($cell,'Jumlah Cell Berhasil di Tambahkan',201);
    }

    //mengubah data
    public function update($id, Request $request){
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $cell = cell::find($id);
        $cell->update($request->all());
        //return ResponseFormatter::success($cell,'Jumlah Cell Berhasil di Tambahkan',201);
        /*$cell = cell::find($id);
        $cell->update($request->all());*/
        //return $request->all();
        return ResponseFormatter::success(
            'Success Edit',
            cell::find($id),
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
        $cell = cell::find($id);
        $cell->delete();
        /*$battery=cell::find($id);
        $battery->delete();*/
        return ResponseFormatter::success(
            'Data Berhasil Di Hapus',
            200
        );
    }
}
