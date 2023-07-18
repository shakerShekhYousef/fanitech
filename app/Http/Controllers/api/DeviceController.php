<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\Device\CreateDeviceRequest;
use App\Http\Requests\api\Device\DeleteDeviceRequest;
use App\Repositories\api\DeviceRepository;

class DeviceController extends Controller
{
    public $deviceRepository;

    public function __construct(DeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    public function saveDeviceToken(CreateDeviceRequest $request)
    {
        $device = $this->deviceRepository->saveDeviceToken($request->all());

        return success_response($device);
    }

    public function deleteDeviceToken(DeleteDeviceRequest $request)
    {
        $message = $this->deviceRepository->deleteDeviceToken($request->all());

        return $message;
    }
}
