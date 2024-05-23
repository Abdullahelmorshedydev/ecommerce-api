<?php

namespace App\Http\Requests\Api\Front\Order;

use App\Enums\PaymentMethodEnum;
use App\Models\Coupon;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveOrderRequest extends FormRequest
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
            'address' => ['required', 'string', 'min:5'],
            'coupon' => ['nullable', function ($attribte, $value, $fail) {
                $coupon = Coupon::where('code', $value)->first();
                if (!isset($coupon)) {
                    $fail('Coupon inValid');
                } else {
                    if ($coupon->max_usage <= $coupon->number_of_usage && $coupon->expire_date <= now()) {
                        $fail('Coupon inValid');
                    }
                }
            }],
            'payment_method' => ['required', Rule::in(PaymentMethodEnum::cases())],
            'notes' => ['nullable', 'string', 'min:5'],
        ];
    }

    public function failedValidation($validator)
    {
        return ApiResponseTrait::failedValidation($validator, [], 'Validation Error', 422);
    }
}
