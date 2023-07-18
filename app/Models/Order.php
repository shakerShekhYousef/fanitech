<?php

namespace App\Models;

use App\Models\Traits\Order\OrderRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory,OrderRelationship;

    protected $guarded = [];
}
