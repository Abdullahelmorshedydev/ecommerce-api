<?php

namespace App\Http\Requests\Api\Back\Category;

use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:255', 'unique:categories,name'],
            'image' => ['required', 'image', 'mimetypes:image/png,image/jpg,image/jpeg', 'mimes:png,jpg,jpeg'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name should be string',
            'name.unique' => 'Name in use',
            'name.min' => 'Name minimum length was 3 character',
            'name.max' => 'Name maximum length was 255 character',
            'image.required' => 'Image is required',
            'image.image' => 'Image not valid',
            'image.mimetype' => 'Image type not supported',
            'image.mimes' => 'Image mime not supported',
        ];
    }

    public function failedValidation($validator)
    {
        return ApiResponseTrait::failedValidation($validator, [], 'Validation Error', 422);
    }
}
