<?php

namespace App\Models\Traits\UserRating;

use App\Models\User;

trait UserRatingRelationship
{
    public function user(){
        return $this->belongsTo(User::class);
    }
}
