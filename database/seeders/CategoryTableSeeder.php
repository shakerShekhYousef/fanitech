<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name_en' => 'Maintenance', 'name_ar' => 'صيانة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_en' => 'Installing cameras', 'name_ar' => 'تركيب كاميرات', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_en' => 'plumbing', 'name_ar' => 'سباكة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_en' => 'Air conditioner installation', 'name_ar' => 'تركيب مكيفات', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_en' => 'Electricity', 'name_ar' => 'كهرباء', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
