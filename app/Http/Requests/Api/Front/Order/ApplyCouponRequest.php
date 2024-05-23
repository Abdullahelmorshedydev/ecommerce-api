<?php

namespace App\Http\Requests\Api\Front\Order;

use App\Models\Coupon;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class ApplyCouponRequest extends FormRequest
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
            'coupon_code' => ['required', function ($attribte, $value, $fail) {
                $coupon = Coupon::where('code', $value)->first();
                if (!isset($coupon)) {
                    $fail('Coupon inValid');
                } else {
                    if ($coupon->max_usage <= $coupon->number_of_usage && $coupon->expire_date <= now()) {
                        $fail('Coupon inValid');
                    }
                }
            }]
        ];
    }

    public function failedValidation($validator)
    {
        return ApiResponseTrait::failedValidation($validator, [], 'Validation Error', 422);
    }
}
