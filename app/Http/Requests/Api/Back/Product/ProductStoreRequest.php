<?php

namespace App\Http\Requests\Api\Back\Product;

use App\Enums\DiscountTypeEnum;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:255', 'unique:products,name'],
            'description' => ['required', 'string', 'min:5'],
            'price' => ['required', 'min:0', 'numeric'],
            'quantity' => ['required', 'min:0', 'numeric'],
            'discount' => ['nullable', 'numeric', 'min:0', function ($attribte, $value, $fail) {
                if (request()->input('discount_type') == 'percent') {
                    if ($value <= 0 || $value > 100) {
                        $fail('Discount should be between 0 to 100');
                    }
                } elseif (request()->input('discount_type') == 'fixed') {
                    if ($value > request()->input('price')) {
                        $fail('Discount should not be bigger than price');
                    }
                }
            }],
            'discount_type' => ['nullable', 'integer', Rule::in(DiscountTypeEnum::cases()), function ($attribte, $value, $fail) {
                if (request()->input('discount') == null) {
                    if ($value != null) {
                        $fail('Discount type is required');
                    }
                }
            }],
            'category_id' => ['required', 'exists:categories,id'],
            'colors' => ['required', 'array'],
            'colors.*.*' => ['required', 'string', 'min:3', 'max:255'],
            'colors.*.*' => ['required', 'string', 'min:3', 'max:255'],
            'images' => ['required', 'array'],
            'images.*' => ['required', 'image', 'mimetypes:image/png,image/jpg,image/jpeg', 'mimes:png,jpg,jpeg'],
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
            'description.required' => 'Description is required',
            'description.string' => 'Description should be string',
            'description.min' => 'Description minimum length was 5 character',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price should be number',
            'price.min' => 'Price minimum was 0',
            'quantity.required' => 'quantity is required',
            'quantity.numeric' => 'quantity should be number',
            'quantity.min' => 'quantity minimum was 0',
            'discount.numeric' => 'discount should be number',
            'discount.min' => 'discount minimum was 0',
            'discount_type.integer' => 'discount type should be number',
            'discount_type.min' => 'discount type minimum was 0',
            'category_id.required' => 'Category is required',
            'category_id.exists' => 'Category not in our records',
            'colors.required' => 'Colors is required',
            'colors.array' => 'Colors should be array',
            'colors.*.*.required' => 'Color name is required',
            'colors.*.*.string' => 'Color name should be string',
            'colors.*.*.min' => 'Color name minimum length was 3 character',
            'colors.*.*.max' => 'Color name maximum length was 255 character',
            'colors.*.*.required' => 'Color code is required',
            'colors.*.*.string' => 'Color code should be string',
            'colors.*.*.min' => 'Color code minimum length was 3 character',
            'colors.*.*.max' => 'Color code maximum length was 255 character',
            'images.required' => 'Images is required',
            'images.array' => 'Images should be array',
            'images.*.required' => 'Image is required',
            'images.*.image' => 'Image not valid',
            'images.*.mimetype' => 'Image type not supported',
            'images.*.mimes' => 'Image mime not supported',
        ];
    }

    public function failedValidation($validator)
    {
        return ApiResponseTrait::failedValidation($validator, [], 'Validation Error', 422);
    }
}
