<?php

namespace App\Http\Requests\Api\Front;

use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
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
            'id' => ['required', 'exists:products,id', 'numeric'],
            'color_id' => ['required', 'exists:product_colors,id', 'numeric'],
            'quantity' => ['required', 'numeric', 'min:1'],
        ];
    }

    public function failedValidation($validator)
    {
        return ApiResponseTrait::failedValidation($validator, [], 'Validation Error', 422);
    }
}
