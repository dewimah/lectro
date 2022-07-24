<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseFormatter;
use App\Models\Battery;
use Yajra\DataTables\DataTables;

class BatteryController extends Controller
{

    //function menampilkan data table
    public function BmsDataTables(){

        if(request()->ajax())
        {
            $query = Battery::query();

            return DataTables::of($query)
                ->addColumn('action', function($item){
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-info dropdown=toggle mr-1 mb-1"
                                        type="button"
                                        data-toggle="dropdown">
                                        Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('edit-bms', $item->id) .'">
                                        Edit
                                    </a>
                                    <button class="btn btn-danger" @click="deleteBms(Battery.id)">
                                    <i class="fa-solid fa-trash"></i> <br>Hapus
                                </button>
                                </div>
                            </div>
                        </div>
                    ';
                })

                ->rawColumns(['action'])
                ->make();
        }
    }

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
          $battery = Battery::create($request->all());

          return ResponseFormatter::success($battery,'Data Battery Berhasil di Tambahkan',201);
      }

      //mengubah data
      public function update( Request $request, $id){

          $battery = Battery::find($id);
          $battery->update($request->all());
            //return $request->all();
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

    /*public function check ($token) {
        $res = false;
        $data = Battery::where('token', $token)->first();

        if $data {
            $res = true;
        }
        return $res;
    }*/
}
