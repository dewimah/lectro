<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $monitoring = Monitoring::find($id);
        $monitoring->update($request->all());
    }

    //menghapus data
    public function delete($id){
        $monitoring=Monitoring::find($id);
        $monitoring->delete();
        return 204;
    }
}
