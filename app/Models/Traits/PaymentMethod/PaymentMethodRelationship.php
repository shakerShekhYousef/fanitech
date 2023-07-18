<?php

namespace App\Models\Traits\PaymentMethod;

use App\Models\Order;

trait PaymentMethodRelationship
{
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
