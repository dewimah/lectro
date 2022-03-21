<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Monitoring;
use App\Models\UserDevice;

class Battery extends Model
{
    use HasFactory;
    protected $table='battery';
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'jml_sel',
    ];

    public function monitoring(){
        return $this->belongsTo(Monitoring::class);
    }

    public function userdevice(){
        return $this->belongsTo(UserDevice::class);
    }
}
