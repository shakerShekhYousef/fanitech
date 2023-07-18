<?php

namespace App\Http\Requests\api\Offer;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateOfferRequest extends FormRequest
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
            'category_id' => ['nullable', Rule::exists('categories', 'id')],
            'sub_category_id' => ['nullable', Rule::exists('sub_categories', 'id')],
            'offer_status' => ['nullable', 'string'],
            'details_en' => ['nullable', 'string'],
            'details_ar' => ['nullable', 'string'],
            'lat'=>['nullable','numeric'],
            'long'=>['nullable','numeric'],
            'sub_category_description'=>['nullable','string'],
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
