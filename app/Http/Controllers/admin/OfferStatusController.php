<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\OfferStatus\CreateOfferStatusRequest;
use App\Http\Requests\admin\OfferStatus\UpdateOfferStatusRequest;
use App\Models\OfferStatus;
use App\Repositories\api\OfferStatusRepository;

class OfferStatusController extends Controller
{
    public $offerStatusRepository;

    public function __construct(OfferStatusRepository $offerStatusRepository)
    {
        $this->offerStatusRepository = $offerStatusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $offerStatuses = $this->offerStatusRepository->all();

        return success_response($offerStatuses);
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
    public function store(CreateOfferStatusRequest $request)
    {
        $offerStatus = $this->offerStatusRepository->create($request->all());

        return success_response($offerStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $offerStatus = $this->offerStatusRepository->getById($id);

        return success_response($offerStatus);
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
    public function update(UpdateOfferStatusRequest $request, OfferStatus $offerStatus)
    {
        $offerStatus = $this->offerStatusRepository->update($request->all(), $offerStatus);

        return success_response($offerStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->offerStatusRepository->deleteById($id);

        return success_response(trans('validation.custom.general.deleted'));
    }
}
