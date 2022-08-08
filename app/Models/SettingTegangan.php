<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Setting;

class SettingTegangan extends Model
{
    use HasFactory;
    protected $table='setting_tegangans';
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'tegangan_min',
        'tegangan_max',
    ];
    public function setting(){
        return $this->belongsTo(Setting::class);
    }
}
