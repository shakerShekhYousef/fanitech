<?php

namespace App\Http\Controllers\api;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\Profile\UpdatePasswordRequest;
use App\Http\Requests\api\User\RateApplicationRequest;
use App\Http\Requests\api\User\UpdateUserRequest;
use App\Models\User;
use App\Repositories\api\UserRepository;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function profile()
    {
        $auth_id = auth()->id();
        $user = User::query()->where('id', $auth_id)->relations()->first();

        return success_response($user);
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        $user = auth()->user();
        $user = $this->userRepository->update($request->all(), $user);

        return success_response($user);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = auth()->user();
        $message = $this->userRepository->updatePassword($request->all(), $user);

        return success_response($message);
    }

    public function rateApplication(RateApplicationRequest $request){
        $rate = $this->userRepository->rateApplication($request->all());
        return success_response($rate);
    }
}
