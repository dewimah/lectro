<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Battery;
use App\Helpers\ResponseFormatter;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //mengambil semua data
    public function ambil(){
        return User::all();
    }

    //JUMLAH USER
    public function jumlahUser() {
        $data = User::count();
        return ResponseFormatter::success($data, 'Data Didapatkan');
    }

    public function all()
    {
        /*$user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $user=User::all();
        return ResponseFormatter::success($user, 'Data Didapatkan');*/
        return User::all();
    }

    public function showCurrentUser(){
        $user = request()->user();
        return ResponseFormatter::success($user, 'Data Didapatkan');
    }

    //mengambil data by id
    public function show ($id){
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $user=User::find($id);
        if(!$user){
            return ResponseFormatter:: error(null, 'Data Tidak Ada', 403);
        }
        return ResponseFormatter::success($user, 'Data Didapatkan');
        //return User::find($id);
    }

    //mengubah data
    public function update( Request $request, $id){
        $user = User::find($id);
        $user->update($request->all());
       // return $request->all();
        return ResponseFormatter::success(
            'Success Edit',
            User::find($id),
            200
        );
    }

    //menghapus data
    public function delete($id){
        $user=User::find($id);
        $user->delete();

        return ResponseFormatter::success(
            'Data Berhasil Di Hapus',
            200
        );
    }
}
