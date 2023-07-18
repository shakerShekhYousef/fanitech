<?php

namespace App\Models\Traits\OfferStatus;

use App\Models\Offer;

trait OfferStatusRelationship
{
    public function offer()
    {
        return $this->hasMany(Offer::class);
    }
}
