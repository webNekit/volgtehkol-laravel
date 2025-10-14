<?php

namespace App\Http\Resources\Staff;

use App\Models\CategoryStaff;
use App\Models\Staff;

class StaffResource {
    public static function collection()
    {
        return Staff::query()
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
