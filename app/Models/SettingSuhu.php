<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Setting;

class SettingSuhu extends Model
{
    use HasFactory;
    protected $table='setting_suhus';
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'temp_min',
        'temp_max',
    ];

    public function setting(){
        return $this->belongsTo(Setting::class);
    }
}
