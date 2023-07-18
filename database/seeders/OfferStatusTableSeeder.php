<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('offer_statuses')->insert([
            ['name_en' => 'Done', 'name_ar' => 'مكتمل', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_en' => 'Canceled', 'name_ar' => 'ملغي', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_en' => 'Awaiting order confirmation', 'name_ar' => 'بانتظار تأكيد الطلب', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
