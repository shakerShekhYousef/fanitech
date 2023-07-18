<?php

namespace App\Models\Traits\Order;

use App\Models\Offer;
use App\Models\PaymentMethod;

trait OrderRelationship
{
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
