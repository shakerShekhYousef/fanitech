<?php

namespace App\Http\Requests\api\Notification;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CreateNotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title_en' => ['nullable', 'string'],
            'body_en' => ['nullable', 'string'],
            'title_ar' => ['nullable', 'string'],
            'body_ar' => ['nullable', 'string'],
            'user_id' => ['required', Rule::exists('users', 'id')],
            'worker_id' => ['required', Rule::exists('users', 'id')],
            'url' => ['nullable', 'string'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response = response()->json([
            'message' => 'Invalid data send',
            'details' => $errors->messages(),
        ], 422);
        throw new HttpResponseException($response);
    }
}
