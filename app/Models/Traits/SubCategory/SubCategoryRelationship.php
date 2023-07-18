<?php

namespace App\Models\Traits\SubCategory;

use App\Models\Category;

trait SubCategoryRelationship
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
