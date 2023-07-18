<?php

namespace App\Models;

use App\Models\Traits\SubCategory\SubCategoryRelationship;
use App\Models\Traits\SubCategory\SubCategoryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory, SubCategoryRelationship, SubCategoryScope;

    protected $guarded = [];
}
