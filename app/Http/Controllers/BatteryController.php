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
    public function all(){
        /*$user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $battery=Battery::with(['cell','setting'])->get();
        return ResponseFormatter::success($battery, 'Data Didapatkan');
        //return Battery::with(['cell','setting'])->get();*/
        $data = DB::table('batteries')->select(
            'setting_tegangans.id as idsettingtegangan',
            'setting_suhus.id as idsettingsuhu',
            'setting_aruses.id as idsettingarus',
            'setting_tegangans.name as namasettingtegangan',
            'setting_suhus.name as namasettingsuhu',
            'setting_aruses.name as namasettingarus',
            'setting_suhus.temp_min',
            'setting_suhus.temp_max',
            'setting_tegangans.tegangan_min',
            'setting_tegangans.tegangan_max',
            'setting_aruses.arus_min',
            'setting_aruses.arus_max',
            'cells.cellbaterai',
            //'batteries.tipe',
            //'batteries.serial',
            'batteries.*',
            'batteries.name as namabattery',
        );

        $data = $data
        ->join('settings', 'batteries.setting_id', '=', 'settings.id')
        ->join('cells', 'batteries.cell_id', '=', 'cells.id')
        ->join('setting_tegangans','settings.settingtegangans_id', '=', 'setting_tegangans.id')
        ->join('setting_aruses','settings.settingaruses_id', '=', 'setting_aruses.id')
        ->join('setting_suhus','settings.settingsuhus_id', '=', 'setting_suhus.id')->get();

        return $data;
    }

    //JUMLAH BATTERY
    public function jumlahBattery() {
        $data = Battery::count();
        return ResponseFormatter::success($data, 'Data Didapatkan');
    }

    //mengambil data by id
    public function show ($id){
       /* $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $battery=Battery::find($id);
        if(!$battery){
            return ResponseFormatter:: error(null, 'Data Tidak Ada', 403);
        }
        return ResponseFormatter::success($battery, 'Data Didapatkan');
        //return Battery::find($id);*/
        $data = DB::table('batteries')->select(
            'setting_tegangans.id as idsettingtegangan',
            'setting_suhus.id as idsettingsuhu',
            'setting_aruses.id as idsettingarus',
            'setting_tegangans.name as namasettingtegangan',
            'setting_suhus.name as namasettingsuhu',
            'setting_aruses.name as namasettingarus',
            'setting_suhus.temp_min',
            'setting_suhus.temp_max',
            'setting_tegangans.tegangan_min',
            'setting_tegangans.tegangan_max',
            'setting_aruses.arus_min',
            'setting_aruses.arus_max',
            'cells.cellbaterai',
            //'batteries.tipe',
            //'batteries.serial',
            'batteries.*',
            'batteries.name as namabattery',
        )->where('batteries.id', $id);;

        $data = $data
        ->join('settings', 'batteries.setting_id', '=', 'settings.id')
        ->join('cells', 'batteries.cell_id', '=', 'cells.id')
        ->join('setting_tegangans','settings.settingtegangans_id', '=', 'setting_tegangans.id')
        ->join('setting_aruses','settings.settingaruses_id', '=', 'setting_aruses.id')
        ->join('setting_suhus','settings.settingsuhus_id', '=', 'setting_suhus.id')->get();

        return $data;
    }

    //menambah data
    public function store(Request $request){
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $battery = Battery::create($request->all());
        return ResponseFormatter::success($battery,'Data Battery Berhasil di Tambahkan',201);
    }

    //mengubah data
    public function update( Request $request, $id){
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $battery = Battery::find($id);
        $battery->update($request->all());
        //return ResponseFormatter::success($cell,'Jumlah Cell Berhasil di Tambahkan',201);
        /*$cell = cell::find($id);
        $cell->update($request->all());*/
        //return $request->all();
        return ResponseFormatter::success(
            'Success Edit',
            Battery::find($id),
            200
        );
        /*$battery = Battery::find($id);
        $battery->update($request->all());
         //return $request->all();
        return ResponseFormatter::success(
            'Success Edit',
            Battery::find($id),
            200
        );*/
    }

    //menghapus data
    public function delete($id){
        $user=request()->user();
        if(!$user->hasRole('admin'))
        {
            return ResponseFormatter:: error(null, 'Anda Tidak Punya Kewenangan', 403);
        }
        $battery = Battery::find($id);
        $battery->delete();
        /*$battery=cell::find($id);
        $battery->delete();*/
        return ResponseFormatter::success(
            'Data Berhasil Di Hapus',
            200
        );
        /* $battery=Battery::find($id);
        $battery->delete();

        return ResponseFormatter::success(
            'Data Berhasil Di Hapus',
            200
        );*/
    }
}
