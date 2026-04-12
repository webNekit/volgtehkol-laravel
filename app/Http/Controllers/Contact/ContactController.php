<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Resources\Addresses\AddressesResource;
use App\Http\Resources\Contacts\ContactsResource;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contacts::index', [
            'title' => 'Контакты',
            'contacts' => ContactsResource::findAll(),
            'addresses' => AddressesResource::findAll(),
        ]);
    }
}
