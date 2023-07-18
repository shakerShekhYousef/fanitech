<?php

namespace App\Models\Traits\SubCategory;

trait SubCategoryScope
{
    public function scopeRelations($query)
    {
        return $query->with(['category']);
    }
}
