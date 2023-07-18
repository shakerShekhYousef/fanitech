<?php

namespace App\Listeners;

use App\Events\RefreshRatingEvent;
use App\Models\Offer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RefreshRatingListener
{
    public function onCreate(RefreshRatingEvent $event)
    {
        //Get worker id
        $worker_id = Offer::query()->where('id',$event->offer_id)->pluck('worker_id')->first();
        //SAM of rate
        $sam = Order::query()->whereHas('offer',function ($query) use ($worker_id){
            $query->where('worker_id',$worker_id);
        })->avg('rate');
        //Update worker rate
        User::query()->where('id',$worker_id)->update([
            'rate'=>$sam
        ]);
    }

    public function subscribe($events)
    {
        $events->listen(
            RefreshRatingEvent::class,
            'app\Listeners\RefreshRatingListener@onCreate'
        );

    }
}
