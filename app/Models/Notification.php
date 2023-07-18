<?php

namespace App\Models;

use App\Models\Traits\Notification\NotificationRelationship;
use App\Models\Traits\Notification\NotificationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory,NotificationRelationship,NotificationScope;

    protected $guarded = [];
}
