<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Erorrs;
use App\Models\Battery;
use App\Models\Setting;

class Monitoring extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function setting(){
        return $this->hasOne(Setting::class);
    }

    public function erorrs(){
    return $this->hasMany(Erorrs::class);
    }

    //hasmany
    public function battery(){
        return $this->hasOne(Battery::class)
    }

}
