<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(value :[
            [
                'name' => 'admin',
                'email'=> 'admin@test.test',
                'password' => Hash::make (value: 'password'),
            ],
            [
                'name' => 'user',
                'email'=> 'user@test.test',
                'password' => Hash::make (value: 'password'),
            ],
        ])->each(function($users){
                $user = User::create($users);
                if($user->id == 1)
                {
                    $user->assignRole('admin');
                }else{
                    $user->assignRole('user');
                }
        });
    }
}
