<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\Offer\ChangeStatusRequest;
use App\Http\Requests\api\Offer\CreateOfferRequest;
use App\Http\Requests\api\Offer\UpdateOfferRequest;
use App\Models\Offer;
use App\Models\OfferStatus;
use App\Repositories\api\OfferRepository;

class OfferController extends Controller
{
    public $offerRepository;

    public function __construct(OfferRepository $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $offers = Offer::relations()->latest()->paginate(10);

        return success_response($offers);
    }

    public function getOffersByStatus()
    {
        if (isset($_GET['offer_status'])) {
            $offer_status = OfferStatus::getStatus($_GET['offer_status']);
        } else {
            return error_response('Please insert offer first.');
        }
        $offers = $this->offerRepository->getOfferByStatus($offer_status);

        return success_response($offers);
    }

    public function getMyOffers()
    {
        $user_id = auth()->id();
        if (isset($_GET['offer_status'])) {
            $offer_status = OfferStatus::getStatus($_GET['offer_status']);
        } else {
            return error_response('Please insert offer first.');
        }
        $offers = Offer::query()
            ->creator($user_id)
            ->offerStatus($offer_status)
            ->latest()
            ->paginate(10);

        return success_response($offers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateOfferRequest $request)
    {
        $offer = $this->offerRepository->create($request->all());

        return success_response($offer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $offer = Offer::query()->relations()->whereId($id)->first();

        return success_response($offer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        $offer = $this->offerRepository->update($request->all(), $offer);

        return success_response($offer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->offerRepository->deleteById($id);

        return success_response(trans('validation.custom.general.deleted'));
    }

    public function changeStatus(ChangeStatusRequest $request,Offer $offer){
        $status = $this->offerRepository->changeOfferStatus($request->all(), $offer);
        return success_response($status);
    }
}
