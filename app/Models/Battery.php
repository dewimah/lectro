<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Monitoring;
use App\Models\User;

class Battery extends Model
{
    use HasFactory;

    protected $table='batteries';
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'jml_sel',
    ];

    public function monitoring(){
        return $this->belongsTo(Monitoring::class);
    }

   public function users(){
        return $this->belongsToMany(User::class);
   }
}
