<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\Battery;

class BatteriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('batteries')->insert([
            'name' => Str::random(10),
            'setting_id' => Str::random(10).'@gmail.com',
            'cell_id' => Hash::make('password'),
            'tipe' => Str::random(10),
            'serial' => Str::random(10),
            'token' =>Str::random(10),
        ]);
    }
}
