<?php

namespace App\Repositories\api;

use App\Exceptions\GeneralException;
use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository
{
    use FileTrait;

    public function model()
    {
        return Category::class;
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $category = parent::create([
                'name_en' => $data['name_en'],
                'name_ar' => $data['name_ar'],
                'image' => isset($data['image']) ?
                    $this->UploadFile($data['image'],
                        CATEGORY_IMG_PATH . '/' . str_replace(' ', '_', $data['name_en']),
                    ) : null,
            ]);

            return $category;
        });
        throw new GeneralException('error');
    }

    public function update(array $data, Category $category)
    {
        return DB::transaction(function () use ($data, $category) {
            if ($category->update([
                'name_en' => $data['name_en'] ?? $category->name_en,
                'name_ar' => $data['name_ar'] ?? $category->name_ar,
                'image' => isset($data['image']) ?
                    $this->Updatefile($data['image'],
                        CATEGORY_IMG_PATH . '/' . str_replace(' ', '_', $data['name_en']),
                        $category->image) : $category->image,
            ])) {
                return $category;
            }
        });

        throw new GeneralException('error');
    }
}
