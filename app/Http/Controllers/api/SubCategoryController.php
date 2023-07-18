<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Repositories\api\SubCategoryRepository;

class SubCategoryController extends Controller
{
    public $subCategoryRepository;

    public function __construct(SubCategoryRepository $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function index()
    {
        $subCategories = SubCategory::query()->relations()->paginate(10);

        return success_response($subCategories);
    }
}
