<?php

namespace App\Models;

use App\Models\Traits\PaymentMethod\PaymentMethodRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory,PaymentMethodRelationship;

    protected $guarded = [];
}
