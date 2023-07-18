<?php

namespace App\Repositories\api;

use App\Events\RefreshRatingEvent;
use App\Exceptions\GeneralException;
use App\Models\Order;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository
{
    public function model()
    {
        return Order::class;
    }

    public function rateOrder(array $data, Order $order)
    {
        return DB::transaction(function () use ($data, $order) {
            if ($order->update([
                'rate' => $data['rate']
            ])) {
                event(new RefreshRatingEvent($order->offer_id, $data['rate']));
                return $order;
            }
        });
        throw new GeneralException('error');
    }
}
