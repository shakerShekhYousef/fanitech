<?php

namespace App\Http\Requests\admin\Plan;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class UpdatePlanRequest extends FormRequest
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
            'name_ar' => ['nullable', 'string'],
            'name_en' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric'],
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
