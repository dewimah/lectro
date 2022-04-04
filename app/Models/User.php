<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BatteryUser;
use App\Models\Battery;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table='users';
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   /* public function hasRole($role)
    {
    // check param $role dengan field usertype
        if ($role == $this->usertype) {
             return true;
    }
         return false;
    }*/

    public function batteries(){
        return $this->belongsToMany(Battery::class,'battery_user','user_id','battery_id');
    }

    public function hasRole($roles)
    {
        $this->have_role = $this->getUserRole();

        if(is_array($roles)){
            foreach($roles as $need_role){
                if($this->cekUserRole($need_role)) {
                    return true;
                }
            }
        } else{
            return $this->cekUserRole($roles);
        }
        return false;
    }
    private function getUserRole()
    {
       return $this->role()->getResults();
    }

    private function cekUserRole($role)
    {
        return (strtolower($role)==strtolower($this->have_role->nama)) ? true : false;
    }
}
