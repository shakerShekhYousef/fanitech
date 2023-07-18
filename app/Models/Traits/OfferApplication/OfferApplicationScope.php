<?php

namespace App\Models\Traits\OfferApplication;

trait OfferApplicationScope
{
    public function scopeRelations($query)
    {
        return $query->with(['worker', 'offer']);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeOffer($query, $offer_id)
    {
        return $query->where('offer_id', $offer_id);
    }

    public function scopeWorker($query, $worker_id)
    {
        return $query->where('worker_id', $worker_id);
    }
}
