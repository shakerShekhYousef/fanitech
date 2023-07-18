<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\OfferApplication\CreateOfferApplicationRequest;
use App\Http\Requests\api\OfferApplication\UpdateOfferApplicationRequest;
use App\Models\OfferApplication;
use App\Repositories\api\OfferApplicationRepository;

class OfferApplicationController extends Controller
{
    public $offerApplictionRepository;

    public function __construct(OfferApplicationRepository $offerApplicationRepository)
    {
        $this->offerApplictionRepository = $offerApplicationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $applications = OfferApplication::query()
            ->relations()
            ->latest()
            ->paginate(10);

        return success_response($applications);
    }

    public function getOfferApplications()
    {
        if (isset($_GET['offer_id'])) {
            $offer_id = $_GET['offer_id'];
        } else {
            return error_response(trans('validation.custom.application.offer'));
        }
        $applications = OfferApplication::query()
            ->offer($offer_id)
            ->relations()
            ->latest()
            ->paginate();

        return success_response($applications);
    }

    public function getMyApplications()
    {
        //Get auth user id
        $worker_id = auth()->id();
        //Get applications
        $applications = OfferApplication::query()
            ->worker($worker_id)
            ->relations()
            ->latest()
            ->paginate();

        return success_response($applications);
    }

    public function acceptApplication(OfferApplication $offerApplication)
    {
        $message = $this->offerApplictionRepository->acceptApplication($offerApplication);

        return success_response($message);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateOfferApplicationRequest $request)
    {
        $application = $this->offerApplictionRepository->create($request->all());

        return success_response($application);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $application = OfferApplication::query()->whereId($id)
            ->relations()
            ->first();

        return success_response($application);
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
    public function update(UpdateOfferApplicationRequest $request, OfferApplication $offerApplication)
    {
        $application = $this->offerApplictionRepository->updatePrice($request->all(), $offerApplication);

        return success_response($application);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->offerApplictionRepository->deleteById($id);

        return success_response(trans('validation.custom.general.deleted'));
    }
}
