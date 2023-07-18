<?php

namespace App\Models;

use App\Models\Traits\Offer\OfferRelationship;
use App\Models\Traits\Offer\OfferScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory,OfferRelationship,OfferScope;

    protected $guarded = [];
}
