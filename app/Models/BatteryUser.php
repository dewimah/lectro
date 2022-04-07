<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class BatteryUser extends Model
{
    use HasFactory,  HasApiTokens;
    protected $table='battery_user';
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'battery_id',
        'is_active',
        'token_device',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
