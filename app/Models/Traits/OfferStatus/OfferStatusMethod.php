<?php

namespace App\Models\Traits\OfferStatus;

use Illuminate\Support\Facades\DB;

trait OfferStatusMethod
{
    public static function getStatus($name)
    {
        return DB::table('offer_statuses')->where('name_en', $name)->pluck('id')->first();
    }
}
