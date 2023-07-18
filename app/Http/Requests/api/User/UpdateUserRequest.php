<?php

namespace App\Http\Requests\api\User;

use App\Rules\DublicateEmailRule;
use App\Rules\DublicatePhoneNumberRule;
use App\Rules\WorkerCategoryRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => ['nullable', 'string'],
            'phone_number' => ['nullable', new DublicatePhoneNumberRule()],
            'lat' => ['nullable', 'numeric'],
            'long' => ['nullable', 'numeric'],
            'region'=>['required','string'],
            'image' => ['nullable', 'file', 'mimes:jpg,png,jpeg', 'max:10000'],
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
