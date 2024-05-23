<?php

namespace App\Http\Requests\Api\Front\ProductReview;

use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class ProductReviewUpdateRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:255', 'string'],
            'email' => ['required', 'email', 'max:255'],
            'review_title' => ['required', 'string', 'min:3', 'max:255'],
            'review_message' => ['required', 'string', 'min:5'],
            'product_id' => ['required', 'exists:products,id'],
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
            'review_title.required' => 'Review Title is required',
            'review_title.string' => 'Review Title should be string',
            'review_title.min' => 'Review Title minimum length was 3 character',
            'review_title.max' => 'Review Title maximum length was 255 character',
            'review_message.required' => 'Review message is required',
            'review_message.string' => 'Review message should be string',
            'review_message.min' => 'Review message minimum length was 5 character',
            'product_id.required' => 'Product is required',
            'product_id.exists' => 'Product not in our records',
        ];
    }

    public function failedValidation($validator)
    {
        return ApiResponseTrait::failedValidation($validator, [], 'Validation Error', 422);
    }
}
