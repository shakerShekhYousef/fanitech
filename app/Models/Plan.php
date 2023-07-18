<?php

namespace App\Models;

use App\Models\Traits\Plan\PlanRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory,PlanRelationship;

    protected $guarded = [];
}
