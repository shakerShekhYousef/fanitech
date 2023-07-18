<?php

namespace App\Models\Traits\Role;

use App\Models\User;

trait RoleRelationship
{
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
