<?php

namespace App\Models\Traits\User;

use App\Models\Role;

trait UserScope
{
    public function scopeRelations($query)
    {
        return $query->with(['categories', 'plan', 'role']);
    }

    public function scopeIsWorker($query)
    {
        $role = Role::getRole('worker');

        return $query->where('role_id', $role);
    }

    public function scopeCategory($query, $category)
    {
        $query->whereHas('categories', function ($q) use ($category) {
            $q->where('category_id', $category);
        });
    }
}
