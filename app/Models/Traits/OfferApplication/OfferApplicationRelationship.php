<?php

namespace App\Models\Traits\OfferApplication;

use App\Models\Offer;
use App\Models\User;

trait OfferApplicationRelationship
{
    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
