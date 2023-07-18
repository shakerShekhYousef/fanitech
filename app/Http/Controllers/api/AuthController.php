<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\User\CreateUserRequest;
use App\Http\Requests\api\User\LoginRequest;
use App\Http\Requests\api\User\SocialLoginRequest;
use App\Repositories\api\UserRepository;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(CreateUserRequest $request)
    {
        DB::beginTransaction();
        //create user
        $user = $this->userRepository->create($request->all());
        //create token
        $token = $this->userRepository->create_token($user);
        DB::commit();
        //response
        $user['token'] = $token;

        return success_response($user);
    }

    public function login(LoginRequest $request)
    {
        //Login user
        $user = $this->userRepository->login($request->all());
        //response
        return success_response($user);
    }

    public function social_login(SocialLoginRequest $request)
    {
        $user = $this->userRepository->social_login($request->all());

        return success_response($user);
    }
}
