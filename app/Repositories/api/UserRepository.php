<?php

namespace App\Repositories\api;

use App\Exceptions\GeneralException;
use App\Http\Requests\api\User\RateApplicationRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRating;
use App\Repositories\BaseRepository;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserRepository extends BaseRepository
{
    use FileTrait;

    public function model()
    {
        return User::class;
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $role = Role::getRole($data['account_type']);
            $user = parent::create([
                'name' => $data['name'],
                'password' => Hash::make($data['password']),
                'phone_number' => $data['phone_number'],
                'lat' => $data['lat'],
                'long' => $data['long'],
                'region' => $data['region'],
                'id_image' => isset($data['id_image']) ?
                    $this->UploadFile($data['id_image'],
                        ID_IMG_PATH . '/' . '/' . str_replace(' ', '_', $data['name'])) : null,
                'image' => isset($data['image']) ?
                    $this->UploadFile($data['image'],
                        PROFILE_IMG_PATH . '/' . str_replace(' ', '_', $data['name'])) : null,
                'role_id' => $role,
                'plan_id' => $data['plan_id'] ?? null,
            ]);
            if ($data['account_type'] == 'worker') {
                $user->categories()->attach($data['worker_category']);
            }
            if ($user) {
                return $user;
            }
        });
        throw new GeneralException('error');
    }

    public function update(array $data, User $user)
    {
        return DB::transaction(function () use ($data, $user) {
            if ($user->update([
                'name' => $data['name'] ?? $user->name,
                'phone_number' => $data['phone_number'] ?? $user->phone_number,
                'lat' => $data['lat'] ?? $user->lat,
                'long' => $data['long'] ?? $user->long,
                'region' => $data['region'],
                'image' => isset($data['image']) ?
                    $this->Updatefile($data['image'],
                        PROFILE_IMG_PATH . '/' . str_replace(' ', '_', $data['name']),
                        $user->image) : $user->image,
            ])) {
                return $user;
            }
        });
        throw new GeneralException('error');
    }

    public function create_token($user)
    {
        $token = JWTAuth::getFacadeRoot()->fromUser($user);

        return $this->respondWithToken($token);
    }

    public function login(array $data)
    {
        if ($token = Auth::attempt(['phone_number' => $data['phone_number'], 'password' => $data['password']])) {
            $user = User::where('phone_number', $data['phone_number'])->first();
            $user['token'] = $this->respondWithToken($token);
            $user['remember_token'] = $user->remember_token;

            return $user;
        } else {
            throw new GeneralException('Login Failed');
        }
    }

    public function social_login(array $data)
    {
        return DB::transaction(function () use ($data) {
            $role = Role::getRole($data['account_type']);
            $column = '';
            if ($data['type_account'] == 'google') {
                $column = 'google_id';
            }
            if ($data['type_account'] == 'facebook') {
                $column = 'facebook_id';
            }
            if ($data['type_account'] == 'apple') {
                $column = 'apple_id';
            }
            if ($data['type_account'] == 'twitter') {
                $column = 'twitter_id';
            }
            $data_to_insert = [
                'name' => $data['name'],
                'phone_number' => $data['phone_number'],
                'lat' => $data['lat'],
                'long' => $data['long'],
                'region' => $data['region'],
                'id_image' => isset($data['id_image']) ?
                    $this->UploadFile($data['id_image'],
                        ID_IMG_PATH . '/' . str_replace(' ', '_', $data['name'])) : null,
                'image' => isset($data['image']) ?
                    $this->UploadFile($data['image'],
                        PROFILE_IMG_PATH . '/' . str_replace(' ', '_', $data['name'])) : null,
                'role_id' => $role,
                'plan_id' => $data['plan_id'] ?? null,
                'is_social' => true,
                $column => $data['account_id'],
            ];
            $user = User::where($column, $data['account_id'])->first();
            if (!is_null($user)) {
                $token = $this->create_token($user);
            } else {
                $user = parent::create($data_to_insert);
                if ($data['account_type'] == 'worker') {
                    $user->categories()->attach($data['worker_category']);
                }
                $token = $this->create_token($user);
            }
            $user['token'] = $token;

            return $user;
        });
        throw new GeneralException('error');
    }

    public function updatePassword(array $data, User $user)
    {
        return DB::transaction(function () use ($data, $user) {
            if ($user->update([
                'password' => Hash::make($data['password']),
            ])) {
                return 'Your password updated successfully';
            }
        });

        throw new GeneralException('error');
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 3600,
        ]);
    }

    public function rateApplication(array $data)
    {
        return DB::transaction(function () use ($data) {
            return UserRating::updateOrCreate([
                'user_id' => auth()->id(),
            ], [
                'rate' => $data['rate']
            ]);
        });
        throw new GeneralException('error');
    }
}
