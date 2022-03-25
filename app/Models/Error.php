<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Monitoring;

class Error extends Model
{
    use HasFactory;
    protected $table='errors';
    protected $fillable = [
        'ket_error',
    ];

    public function monitoring(){
        return $this->belongsTo(Monitoring::class);
    }
}
