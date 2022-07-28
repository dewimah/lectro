<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Monitoring;
use App\Models\User;
use App\Models\cell;
use App\Models\Setting;

class Battery extends Model
{
    use HasFactory;

    protected $table='batteries';
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'setting_id',
        'cell_id',
        'tipe',
        'serial'
    ];

   public function users(){
        return $this->belongsToMany(User::class);
   }

   public function setting(){
    return $this->belongsTo(Setting::class);
}

    public function cell(){
   return $this->belongsTo(cell::class);
}
}

