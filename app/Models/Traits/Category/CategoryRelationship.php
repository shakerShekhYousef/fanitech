<?php

namespace App\Models\Traits\Category;

use App\Models\Offer;
use App\Models\SubCategory;

trait CategoryRelationship
{
    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,
            'worker_categories',
            'category_id',
            'user_id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
