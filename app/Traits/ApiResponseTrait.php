<?php

namespace App\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;

trait ApiResponseTrait
{
    public function apiResponse($data = [], $message = '', $errors = [], $status = 200)
    {
        $response = [
            'data' => $data,
            'message' => $message,
            'errors' => $errors,
            'status' => $status
        ];
        return response()->json($response, $status);
    }

    public static function failedValidation($validator, $data = [], $message = '', $status)
    {
        $errors = $validator->errors()->toArray();
        $response = [
            'data' => $data,
            'message' => $message,
            'errors' => $errors,
            'status' => $status
        ];
        throw new HttpResponseException(response()->json($response, $status));
    }
}
