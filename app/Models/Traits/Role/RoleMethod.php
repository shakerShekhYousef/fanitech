<?php

namespace App\Models\Traits\Role;

use Illuminate\Support\Facades\DB;

trait RoleMethod
{
    public static function getRole($name)
    {
        return DB::table('roles')->where('name', $name)->pluck('id')->first();
    }
}
