<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Repositories\api\NotificationRepository;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function getMyNotifications()
    {
        //Get auth user id
        $user_id = auth()->id();
        //Get all notifications
        $notifications = $this->notificationRepository->getNotifications($user_id);
        //Response
        return success_response($notifications);
    }

    public function readNotifications(Request $request)
    {
        $notifications = Notification::whereIn('id', $request['ids'])
            ->update([
                'is_read' => 1,
            ]);

        return success_response('Notifications read');
    }

    public function destroy($id)
    {
        $this->notificationRepository->deleteById($id);

        return success_response(trans('validation.custom.general.deleted'));
    }
}
