<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Monitoring;

class Setting extends Model
{
    use HasFactory;
    protected $table='settings';
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'temp_min',
        'temp_max',
        'tegangan_min',
        'tegangan_max',
        'arus_min',
        'arus_max',
    ];

    public function monitoring(){
        return $this->belongsTo(Monitoring::class);
    }
}
