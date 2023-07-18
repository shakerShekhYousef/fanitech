<?php

namespace App\Http\Requests\api\User;

use App\Rules\WorkerCategoryRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class SocialLoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'phone_number' => ['required'],
            'lat' => ['required', 'numeric'],
            'long' => ['required', 'numeric'],
            'region'=>['required','string'],
            'id_image' => ['nullable', 'file', 'mimes:jpg,png,jpeg,gif,ppt,pptx,doc,docx,pdf,xls,xlsx,txt', 'max:10000'],
            'OID' => ['nullable', 'string'],
            'is_verify' => ['nullable', 'boolean'],
            'account_type' => ['required', Rule::in(['user', 'admin', 'worker'])],
            'plan_id' => ['nullable', Rule::exists('plans', 'id')],
            'account_id' => ['required'],
            'type_account' => ['required', 'in:google,twitter,facebook'],
            'worker_category' => ['nullable', new WorkerCategoryRule(Request::input())],
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
