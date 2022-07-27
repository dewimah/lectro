<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Monitoring;

class BatteryUser extends Model
{
    use HasFactory,  HasApiTokens;
    protected $table='battery_user';
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'battery_id',
        'is_active',
       // 'token_device',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function monitoring(){
      //return $this->belongsTo(Monitoring::class);
    }
    public function battery(){
        return $this->belongsTo(Battery::class);
     }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
