<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Battery;
use App\Models\Setting;
use App\Models\Monitoring;

class MonitoringController extends Controller
{
    public function all(){
        return Monitoring::all();
    }

    public function show ($id){
        return Monitoring::find($id);
    }

    //menambah data
    public function store(Request $request){
        return Monitoring::create($request->all());
    }

    //mengubah data
    public function update($id, Request $request){
        $user = Monitoring::find($id);
        $user->update($request->all());
    }

    //menghapus data
    public function delete($id){
        $user=Monitoring::find($id);
        $user->delete();
        return 204;
    }
}
