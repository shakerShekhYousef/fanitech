<?php

namespace App\Models\Traits\Notification;

use App\Models\User;

trait NotificationRelationship
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id', 'id');
    }
}
