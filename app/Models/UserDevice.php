<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Battery;

class UserDevice extends Model
{
    use HasFactory;
    protected $table='user_devices';
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'battery_id',
        'is_active'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function battery(){
        return $this->hasMany(Battery::class);
    }
}
