<?php

namespace App\Http\Requests\Api\Auth;

use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'max:255', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:6', 'max:255'],
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
