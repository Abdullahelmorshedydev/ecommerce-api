<?php

namespace App\Services\Api\Front;

use App\Models\Contact;

class ContactService
{
    public function Store($data)
    {
        return Contact::create($data) ? true : false;
    }
}
