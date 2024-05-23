<?php

namespace App\Http\Requests\Api\Profie;

use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'password' => ['required', 'string', 'min:6', 'max:255', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:6', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Password is required',
            'password.string' => 'Password should be string',
            'password.min' => 'Password minimum length was 3 character',
            'password.max' => 'Password maximum length was 255 character',
            'password.confirmed' => 'Passwords Does not match',
            'password_confirmation.required' => 'Confirm Password is required',
            'password_confirmation.string' => 'Confirm Password should be string',
            'password_confirmation.min' => 'Confirm Password minimum length was 3 character',
            'password_confirmation.max' => 'Confirm Password maximum length was 255 character',
        ];
    }

    public function failedValidation($validator)
    {
        return ApiResponseTrait::failedValidation($validator, [], 'Validation Error', 422);
    }
}
