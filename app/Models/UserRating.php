<?php

namespace App\Models;

use App\Models\Traits\UserRating\UserRatingRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
    use HasFactory, UserRatingRelationship;

    protected $guarded = [];
}
