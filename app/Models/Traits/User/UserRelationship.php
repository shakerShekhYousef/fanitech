<?php

namespace App\Models\Traits\User;

use App\Models\Category;
use App\Models\Plan;
use App\Models\Role;
use App\Models\UserRating;

trait UserRelationship
{
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,
            'worker_categories',
            'user_id',
            'category_id');
    }

    public function ratings(){
        return $this->hasMany(UserRating::class);
    }
}
