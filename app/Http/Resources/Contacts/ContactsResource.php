<?php

namespace App\Http\Resources\Contacts;

use App\Models\Contact;
use App\Models\ContactDepartament;
use Illuminate\Support\Collection;

class ContactsResource
{

    public static function findAll()
    {
        $contacts = Contact::query()
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return $contacts->groupBy('type')->toArray();
    }

}
