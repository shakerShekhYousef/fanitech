<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\SubCategory\CreateSubCategoryRequest;
use App\Http\Requests\admin\SubCategory\UpdateSubCategoryRequest;
use App\Models\SubCategory;
use App\Repositories\api\SubCategoryRepository;

class SubCategoryController extends Controller
{
    public $subCategoryRepository;

    public function __construct(SubCategoryRepository $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $subCategories = SubCategory::query()->relations()->paginate(10);

        return success_response($subCategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateSubCategoryRequest $request)
    {
        $subCategory = $this->subCategoryRepository->create($request->all());

        return success_response($subCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $subCategory = SubCategory::query()->where('id', $id)->relations()->first();

        return success_response($subCategory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        $subCategory = $this->subCategoryRepository->update($request->all(), $subCategory);

        return success_response($subCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->subCategoryRepository->deleteById($id);

        return success_response(trans('validation.custom.general.deleted'));
    }
}
