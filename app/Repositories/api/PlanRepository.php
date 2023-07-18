<?php

namespace App\Repositories\api;

use App\Exceptions\GeneralException;
use App\Models\Plan;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PlanRepository extends BaseRepository
{
    public function model()
    {
        return Plan::class;
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $plan = parent::create([
                'name_en' => isset($data['name_en']) ? $data['name_en'] : null,
                'name_ar' => isset($data['name_ar']) ? $data['name_ar'] : null,
                'price' => $data['price'],
            ]);

            return $plan;
        });

        throw new GeneralException('error');
    }

    public function update(array $data, Plan $plan)
    {
        return DB::transaction(function () use ($data, $plan) {
            if ($plan->update([
                'name_en' => isset($data['name_en']) ? $data['name_en'] : $plan->name_en,
                'name_ar' => isset($data['name_ar']) ? $data['name_ar'] : $plan->name_ar,
                'price' => $data['price'] ?? $plan->price,
            ])) {
                return $plan;
            }
        });

        throw new GeneralException('error');
    }
}
