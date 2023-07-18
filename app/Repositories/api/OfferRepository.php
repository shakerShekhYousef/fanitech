<?php

namespace App\Repositories\api;

use App\Exceptions\GeneralException;
use App\Models\Offer;
use App\Models\OfferStatus;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Traits\FileTrait;
use App\Traits\GetDistanceBetweenTwoPoints;
use Illuminate\Support\Facades\DB;

class OfferRepository extends BaseRepository
{
    use FileTrait, GetDistanceBetweenTwoPoints;

    public function model()
    {
        return Offer::class;
    }

    public function getOfferByStatus($offerStatus)
    {
        return parent::newQuery()
            ->offerStatus($offerStatus)
            ->relations()
            ->latest()
            ->paginate(10);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $offer_status = OfferStatus::getStatus($data['offer_status']);
            $offer = parent::create([
                'user_id' => auth()->id(),
                'category_id' => $data['category_id'],
                'sub_category_id' => $data['sub_category_id'],
                'offer_status_id' => $offer_status,
                'lat' => $data['lat'],
                'long' => $data['long'],
                'sub_category_description' => $data['sub_category_description'] ?? null,
                'offer_number' => $this->createOfferNumber(),
                'details_en' => isset($data['details_en']) ? $data['details_en'] : null,
                'details_ar' => isset($data['details_ar']) ? $data['details_ar'] : null,
                'image' => isset($data['image']) ? $this->UploadFile($data['image'], OFFER_IMG_PATH) : null,
            ]);
            if ($offer) {
                $this->sendNotificationsToWorkers($data['category_id'], $offer->id);

                return $offer;
            }
        });
        throw new GeneralException('error');
    }

    public function update(array $data, Offer $offer)
    {
        return DB::transaction(function () use ($data, $offer) {
            $offer_status = $data['offer_status'] ? OfferStatus::getStatus($data['offer_status']) : $offer->offer_status;
            if ($offer->update([
                'category_id' => $data['category_id'] ?? $offer->category_id,
                'sub_category_id' => $data['sub_category_id'] ?? $offer->sub_category_id,
                'offer_status_id' => $offer_status,
                'lat' => $data['lat'] ?? $offer->lat,
                'long' => $data['long'] ?? $offer->long,
                'sub_category_description' => $data['sub_category_description'] ?? $offer->sub_category_description,
                'details_en' => isset($data['details_en']) ? $data['details_en'] : $offer->details_en,
                'details_ar' => isset($data['details_ar']) ? $data['details_ar'] : $offer->details_ar,
                'image' => isset($data['image']) ?
                    $this->Updatefile($data['image'], OFFER_IMG_PATH, $offer->image)
                    : $offer->image,
            ])) {
                return $offer;
            }
        });

        throw new GeneralException('error');
    }

    public function getWorkersByCategory($category)
    {
        $workers = User::query()
            ->isWorker()
            ->category($category)
            ->get();

        return $workers;
    }

    public function getNearWorkers($workers, $offer_id)
    {
        //Get lat and long of offer
        $offer = parent::getById($offer_id);
        $offer_lat = $offer->lat;
        $offer_long = $offer->long;
        //Get distance trait
        $near_workers = [];
        foreach ($workers as $worker) {
            $distance = $this->getDistance($worker->lat, $worker->long, $offer_lat, $offer_long);
            if ($distance <= 50) {
                $near_workers[] = $worker;
            }
        }

        return $near_workers;
    }

    public function sendNotificationsToWorkers($category_id, $offer_id)
    {
        return DB::transaction(function () use ($category_id, $offer_id) {
            $workers = $this->getWorkersByCategory($category_id);
            $near_workers = $this->getNearWorkers($workers, $offer_id);
            foreach ($near_workers as $worker) {
                $data = [
                    'title_en' => 'New offer',
                    'title_ar' => 'عرض جديد',
                    'body_en' => 'New offer for you.',
                    'body_ar' => 'عرض جديد لك.',
                    'url' => env('APP_URL') . '/api/offers/' . $offer_id,
                    'user_id' => auth()->id(),
                    'worker_id' => $worker['id'],
                ];
                $notificationRepository = new NotificationRepository();
                $notificationRepository->create($data);
                send_message_notification($worker, $data['title_en'], $data['title_ar'], $data['body_en'], $data['body_ar']);
            }
        });
        throw new GeneralException('error');
    }

    public function createOfferNumber()
    {
        $offers = parent::all();
        if ($offers->isEmpty()) {
            // We get here if there is no offer at all
            // If there is no number set it to 0, which will be 1 at the end.
            $number = 0;
        } else {
            $last_offer = parent::orderBy('created_at', 'desc')->first();
            $number = $last_offer->id;
        }

        return '#' . sprintf('%08d', intval($number) + 1);
    }

    public function changeOfferStatus(array $data, Offer $offer)
    {
        return DB::transaction(function () use ($data, $offer) {
            if ($offer->update([
                'offer_status_id' => OfferStatus::getStatus($data['status']),
                'refuse_reason' => $data['status'] == "Canceled" ? $data['refuse_reason'] : null
            ])) {
                return $offer;
            }
        });
        throw new GeneralException('error');
    }
}
