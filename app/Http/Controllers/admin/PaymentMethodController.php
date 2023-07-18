<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\PaymentMethod\CreatePaymentMethodRequest;
use App\Http\Requests\admin\PaymentMethod\UpdatePaymentMethodRequest;
use App\Models\PaymentMethod;
use App\Repositories\api\PaymentMethodRepository;

class PaymentMethodController extends Controller
{
    public $paymentMethodRepository;

    public function __construct(PaymentMethodRepository $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::paginate(10);

        return success_response($paymentMethods);
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
    public function store(CreatePaymentMethodRequest $request)
    {
        $paymentMethod = $this->paymentMethodRepository->create($request->all());

        return success_response($paymentMethod);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(PaymentMethod $paymentMethod)
    {
        return success_response($paymentMethod);
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
    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        $paymentMethod = $this->paymentMethodRepository->update($request->all(), $paymentMethod);

        return success_response($paymentMethod);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->paymentMethodRepository->deleteById($id);

        return success_response(trans('validation.custom.general.deleted'));
    }
}
