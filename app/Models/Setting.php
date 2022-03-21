<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Monitoring;

class Setting extends Model
{
    use HasFactory;

    public function monitoring(){
        return $this->belongsTo(Monitoring::class)
    }
}
