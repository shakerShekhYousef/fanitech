<?php

namespace App\Models\Traits\Offer;

trait OfferScope
{
    public function scopeRelations($query)
    {
        return $query->with(['category', 'subCategory', 'user', 'offerStatus']);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeOfferStatus($query, $offerStatus)
    {
        return $query->where('offer_status_id', $offerStatus);
    }

    public function scopeCreator($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }
}
