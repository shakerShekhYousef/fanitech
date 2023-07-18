<?php

namespace App\Repositories\api;

use App\Exceptions\GeneralException;
use App\Models\PaymentMethod;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PaymentMethodRepository extends BaseRepository
{
    public function model()
    {
        return PaymentMethod::class;
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $paymentMethod = parent::create([
                'name_en' => isset($data['name_en']) ? $data['name_en'] : null,
                'name_ar' => isset($data['name_ar']) ? $data['name_ar'] : null,
            ]);

            return $paymentMethod;
        });
        throw new GeneralException('error');
    }

    public function update(array $data, PaymentMethod $paymentMethod)
    {
        return DB::transaction(function () use ($data, $paymentMethod) {
            if ($paymentMethod->update([
                'name_en' => isset($data['name_en']) ? $data['name_en'] : $paymentMethod->name_en,
                'name_ar' => isset($data['name_ar']) ? $data['name_ar'] : $paymentMethod->name_ar,
            ])) {
                return $paymentMethod;
            }
        });

        throw new GeneralException('error');
    }
}
