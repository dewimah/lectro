<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Error;
use App\Models\Battery;
use App\Models\BatteryUser;

class Monitoring extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
       'battery_id',
       //'error_id',
        //'control_relay',
        'tegangan_tot',
        'tegangan_cell',
        'temp_1',
        'temp_2',
        'temp_3',
        'arus',
        'soc',
        'soh',
    ];

    /*public function setting(){
        return $this->hasOne(Setting::class);
    }*/

    public function erorrs(){
    return $this->hasMany(Erorrs::class);
    }

    //hasmany
    public function battery(){
        return $this->hasOne(Battery::class);
    }

    public function batteryuser(){
        return $this->hasOne(BatteryUser::class);
    }
}

