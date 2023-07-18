<?php

namespace App\Models;

use App\Models\Traits\Role\RoleMethod;
use App\Models\Traits\Role\RoleRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory,RoleMethod,RoleRelationship;

    protected $guarded = [];
}
