<?php

namespace App\Models;

use App\Models\Traits\OfferStatus\OfferStatusMethod;
use App\Models\Traits\OfferStatus\OfferStatusRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferStatus extends Model
{
    use HasFactory,OfferStatusRelationship,OfferStatusMethod;

    protected $guarded = [];
}
