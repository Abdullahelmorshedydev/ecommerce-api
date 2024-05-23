<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Front\ContactRequest;
use App\Services\Api\Front\ContactService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use ApiResponseTrait;

    public function store(ContactRequest $request, ContactService $contactService)
    {
        $message = $contactService->store($request->validated()) ? 'Contact sent successfully' : 'something error please try again later';
        $contact = $contactService->store($request->validated()) ? 201 : 406;
        return $this->apiResponse($contactService->store($request->validated()), $message, [], $contact);
    }
}
