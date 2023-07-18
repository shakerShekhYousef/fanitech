<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Repositories\api\PaymentMethodRepository;

class PaymentMethodController extends Controller
{
    public $paymentMethodRepository;

    public function __construct(PaymentMethodRepository $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function index()
    {
        $paymentMethods = PaymentMethod::paginate(10);

        return success_response($paymentMethods);
    }
}
