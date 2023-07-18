<?php

namespace App\Models;

use App\Models\Traits\Category\CategoryRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory,CategoryRelationship;

    protected $guarded = [];
}
