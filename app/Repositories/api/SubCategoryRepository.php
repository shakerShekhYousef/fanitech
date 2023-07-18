<?php

namespace App\Repositories\api;

use App\Exceptions\GeneralException;
use App\Models\SubCategory;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class SubCategoryRepository extends BaseRepository
{
    public function model()
    {
        return SubCategory::class;
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $sub_category = parent::create([
                'name_en' => isset($data['name_en']) ? $data['name_en'] : null,
                'name_ar' => isset($data['name_ar']) ? $data['name_ar'] : null,
                'category_id' => $data['category_id'],
            ]);

            return $sub_category;
        });
        throw new GeneralException('error');
    }

    public function update(array $data, SubCategory $subCategory)
    {
        return DB::transaction(function () use ($data, $subCategory) {
            if ($subCategory->update([
                'name_en' => isset($data['name_en']) ? $data['name_en'] : $subCategory->name_en,
                'name_ar' => isset($data['name_ar']) ? $data['name_ar'] : $subCategory->name_ar,
                'category_id' => $data['category_id'] ?? $subCategory->category_id,
            ])) {
                return $subCategory;
            }
        });
        throw new GeneralException('error');
    }
}
