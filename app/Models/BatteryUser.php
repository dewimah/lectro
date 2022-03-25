<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatteryUser extends Model
{
    use HasFactory;
    protected $table='battery_user';
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'battery_id'
    ];

}
