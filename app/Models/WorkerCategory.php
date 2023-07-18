<?php

namespace App\Models;

use App\Models\Traits\WorkerCategory\WorkerCategoryMethod;
use App\Models\Traits\WorkerCategory\WorkerCategoryRelationship;
use App\Models\Traits\WorkerCategory\WorkerCategoryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerCategory extends Model
{
    use HasFactory,WorkerCategoryMethod,WorkerCategoryScope,WorkerCategoryRelationship;

    protected $guarded = [];
}
