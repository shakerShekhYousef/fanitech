<?php

namespace App\Repositories\api;

use App\Exceptions\GeneralException;
use App\Models\Notification;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class NotificationRepository extends BaseRepository
{
    public function model()
    {
        return Notification::class;
    }

    public function getNotifications($user_id)
    {
        $notifications = parent::newQuery()->where('user_id', $user_id)
            ->relations()->latest()->paginate(10);

        return $notifications;
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $notification = parent::create([
                'title_en' => isset($data['title_en']) ? $data['title_en'] : null,
                'body_en' => isset($data['body_en']) ? $data['body_en'] : null,
                'title_ar' => isset($data['title_ar']) ? $data['title_ar'] : null,
                'body_ar' => isset($data['body_ar']) ? $data['body_ar'] : null,
                'user_id' => $data['user_id'],
                'worker_id' => $data['worker_id'],
                'url' => $data['url'] ?? null,
            ]);

            return $notification;
        });
        throw new GeneralException('error');
    }

    public function update(array $data)
    {
        return DB::transaction(function () use ($data) {
            return parent::whereIn('id', $data['ids'])
                ->update([
                    'is_read' => 1,
                ]);
        });
        throw new GeneralException('error');
    }
}
