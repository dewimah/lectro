<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {/*
        // reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view posts']);
        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'edit posts']);
        Permission::create(['name' => 'delete posts']);
        Permission::create(['name' => 'publish posts']);
        Permission::create(['name' => 'unpublish posts']);

        //create roles and assign existing permissions
        $user = Role::create(['name' => 'user']);
        //$user->givePermissionTo('view posts');
        //$user->givePermissionTo('create posts');
        //$user->givePermissionTo('edit posts');
        //$user->givePermissionTo('delete posts');

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('view posts');
        $adminRole->givePermissionTo('create posts');
        $adminRole->givePermissionTo('edit posts');
        $adminRole->givePermissionTo('delete posts');
        $adminRole->givePermissionTo('publish posts');
        $adminRole->givePermissionTo('unpublish posts');

        $superadminRole = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule
*/
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
