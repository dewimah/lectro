<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Setting;

class SettingArus extends Model
{
    use HasFactory;
    protected $table='setting_aruses';
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'arus_min',
        'arus_max',
    ];

    public function setting(){
        return $this->belongsTo(Setting::class);
    }
}
