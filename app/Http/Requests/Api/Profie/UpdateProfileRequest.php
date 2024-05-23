<?php

namespace App\Http\Requests\Api\Profie;

use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.auth()->user()->id],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name should be string',
            'name.min' => 'Name minimum length was 3 character',
            'name.max' => 'Name maximum length was 255 character',
            'email.required' => 'Email is required',
            'email.email' => 'Email should be type email',
            'email.max' => 'Email maximum length was 255 character',
            'email.unique' => 'Email in use',
        ];
    }

    public function failedValidation($validator)
    {
        return ApiResponseTrait::failedValidation($validator, [], 'Validation Error', 422);
    }
}
