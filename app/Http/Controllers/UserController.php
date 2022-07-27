<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Helpers\ResponseFormatter;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //mengambil semua data
    public function all()
    {
        /*$user->request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter::error(null,'Anda tidak memiliki kewenangan',401);
        }*/
        return $user= User::all();
       //s return ResponseFormatter::success($user,'Data Berhasil didapatkan');
    }

    //mengambil data by id
    public function show ($id){
        return User::find($id);
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
        /*$user = User::where('email', $request->email)->first();
        $user->update(['name' => $request->name]);
        $user->syncRoles($request->input('roles'));*/
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
