<?php

namespace App\Repositories\api;

use App\Exceptions\GeneralException;
use App\Models\Offer;
use App\Models\OfferApplication;
use App\Models\OfferStatus;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class OfferApplicationRepository extends BaseRepository
{
    public function model()
    {
        return OfferApplication::class;
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $application = parent::create([
                'offer_id' => $data['offer_id'],
                'worker_id' => auth()->id(),
                'price' => $data['price'],
            ]);

            return $application;
        });
        throw new GeneralException('error');
    }

    public function updatePrice(array $data, OfferApplication $offerApplication)
    {
        return DB::transaction(function () use ($data, $offerApplication) {
            if ($offerApplication->update([
                'price' => $data['price'],
            ])) {
                return $offerApplication;
            }
        });
        throw new GeneralException('error');
    }

    public function acceptApplication(OfferApplication $offerApplication)
    {
        return DB::transaction(function () use ($offerApplication) {
            //Get offer
            $offer = Offer::query()->where('id', $offerApplication->id)->first();
            if ($offer->update([
                'worker_id' => $offerApplication->worker_id,
                'worker_price' => $offerApplication->price,
                'offer_status_id' => OfferStatus::getStatus('In progress'),
            ])) {
                return trans('validation.custom.application.accept');
            }
        });
        throw new GeneralException('error');
    }
}
