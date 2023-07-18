<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repositories\api\PlanRepository;

class PlanController extends Controller
{
    public $planRepository;

    public function __construct(PlanRepository $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    public function index()
    {
        $plans = $this->planRepository->all();

        return success_response($plans);
    }
}
