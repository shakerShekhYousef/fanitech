<?php

namespace App\Models\Traits\Notification;

trait NotificationScope
{
    public function scopeRelations($query)
    {
        return $query->with(['worker', 'user']);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
