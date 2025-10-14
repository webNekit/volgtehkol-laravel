<?php

namespace App\Http\Resources\Addresses;

use App\Models\Address;

class AddressesResource {
    public static function findAll()
    {
        $address = Address::query()
            ->where('is_active', true)
            ->orderByDesc('created_at')
            ->get();

        return $address->groupBy('type')->toArray();
    }
}
