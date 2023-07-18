<?php

namespace App\Repositories\api;

use App\Exceptions\GeneralException;
use App\Models\Device;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class DeviceRepository extends BaseRepository
{
    public function model()
    {
        return Device::class;
    }

    public function saveDeviceToken(array $data)
    {
        return DB::transaction(function () use ($data) {
            //Get auth user id
            $user_id = auth()->id();
            //Check device token
            $user_device = Device::query()
                ->where('user_id', $user_id)
                ->where('fcm_token', $data['fcm_token'])->first();
            //Save device token
            if ($user_device === null) {
                return parent::create([
                    'user_id' => $user_id,
                    'fcm_token' => $data['fcm_token'],
                ]);
            }
        });
        throw new GeneralException('error');
    }

    public function deleteDeviceToken(array $data)
    {
        $fcm = $data['fcm_token'];
        $token_firebase = parent::newQuery()->where('fcm_token', $fcm)
            ->where('user_id', auth()->id())->first();
        if ($token_firebase) {
            $token_firebase->delete();

            return success_response(trans('validation.custom.device.delete_token'));
        } else {
            return error_response(trans('validation.custom.device.token_does_not_exist'));
        }
    }
}
