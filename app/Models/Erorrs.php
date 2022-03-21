<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Monitoring;

class Erorrs extends Model
{
    use HasFactory;
    protected $table='erorrs';
    protected $fillable = [
        'ket_error',
    ];

    public function monitoring(){
        return $this->belongsTo(Monitoring::class);
    }
}
