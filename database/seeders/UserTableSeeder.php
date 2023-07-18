<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin admin',
                'password' => Hash::make('admin'),
                'phone_number' => '099999999',
                'lat' => '24.774265',
                'long' => '46.738586',
                'role_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'worker test',
                'password' => Hash::make('worker'),
                'phone_number' => '099999991',
                'lat' => '24.774265',
                'long' => '46.738586',
                'role_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'user test',
                'password' => Hash::make('user'),
                'phone_number' => '099999992',
                'lat' => '24.774265',
                'long' => '46.738586',
                'role_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], ]
        );
    }
}
