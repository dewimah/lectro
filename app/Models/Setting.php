<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Monitoring;
use App\Models\SettingSuhu;
use App\Models\SettingTegangan;
use App\Models\SettingArus;

class Setting extends Model
{
    use HasFactory;
    protected $table='settings';
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
       'settingsuhus_id',
        'settingtegangans_id',
         'settingaruses_id',
    ];

    public function settingsuhu(){
        return $this->belongsTo(SettingSuhu::class);
    }

    public function settingtegangan(){
        return $this->belongsTo(SettingTegangan::class);
    }

    public function settingarus(){
        return $this->belongsTo(SettingArus::class);
    }
}
