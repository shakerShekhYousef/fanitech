<?php

namespace App\Models\Traits\Offer;

use App\Models\Offer;
use App\Models\OfferApplication;
use App\Models\OfferStatus;
use App\Models\SubCategory;
use App\Models\User;

trait OfferRelationship
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id', 'id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function offerStatus()
    {
        return $this->belongsTo(OfferStatus::class);
    }

    public function category()
    {
        return $this->belongsTo(Offer::class);
    }

    public function applications()
    {
        return $this->hasMany(OfferApplication::class);
    }
}
