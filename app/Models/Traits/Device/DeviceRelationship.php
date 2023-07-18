<?php

namespace App\Models\Traits\Device;

use App\Models\User;

trait DeviceRelationship
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
