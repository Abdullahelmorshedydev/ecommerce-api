<?php

namespace App\Http\Requests\Api\Front;

use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    use ApiResponseTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'numeric'],
            'subject' => ['required', 'string'],
            'message' => ['required', 'string', 'min:6'],
        ];
    }

    public function failedValidation($validator)
    {
        return ApiResponseTrait::failedValidation($validator, [], 'Validation Error', 422);
    }
}
