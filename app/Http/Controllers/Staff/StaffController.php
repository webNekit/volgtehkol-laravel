<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\CategoryStaff;

use App\Models\Staff;

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

    public function show($id)
    {
        $item = Staff::findOrFail($id);

        return view('staff::show', [
            'item' => $item,
        ]);
    }
}
