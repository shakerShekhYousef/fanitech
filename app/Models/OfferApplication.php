<?php

namespace App\Models;

use App\Models\Traits\OfferApplication\OfferApplicationRelationship;
use App\Models\Traits\OfferApplication\OfferApplicationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferApplication extends Model
{
    use HasFactory,OfferApplicationRelationship,OfferApplicationScope;

    protected $guarded = [];
}
