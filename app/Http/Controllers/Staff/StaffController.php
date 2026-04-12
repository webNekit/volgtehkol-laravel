<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\CategoryStaff;

class StaffController extends Controller
{
    public function index()
    {
        $categories = CategoryStaff::with([
            'staff' => function ($query) {
                $query->orderBy('order', 'asc');
            }
        ])->get();

        return view('staff::index', [
            'title' => 'Руководство',
            'categories' => $categories,
        ]);
    }
}
