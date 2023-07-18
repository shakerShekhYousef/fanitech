<?php

namespace App\Repositories\api;

use App\Exceptions\GeneralException;
use App\Models\OfferStatus;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class OfferStatusRepository extends BaseRepository
{
    public function model()
    {
        return OfferStatus::class;
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $offerStatus = parent::create([
                'name_en' => isset($data['name_en']) ? $data['name_en'] : null,
                'name_ar' => isset($data['name_ar']) ? $data['name_ar'] : null,
            ]);

            return $offerStatus;
        });
        throw new GeneralException('error');
    }

    public function update(array $data, OfferStatus $offerStatus)
    {
        return DB::transaction(function () use ($data, $offerStatus) {
            if ($offerStatus->update([
                'name_en' => isset($data['name_en']) ? $data['name_en'] : $offerStatus->name_en,
                'name_ar' => isset($data['name_ar']) ? $data['name_ar'] : $offerStatus->name_ar,
            ])) {
                return $offerStatus;
            }
        });

        throw new GeneralException('error');
    }
}
