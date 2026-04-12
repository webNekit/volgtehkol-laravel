<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\CategoryManagement;

class ManagementController extends Controller
{
    public function index()
    {
        $categories = CategoryManagement::with([
            'management' => function ($query) {
                $query->orderBy('order', 'asc');
            }
        ])->get();

        return view('management::index', [
            'title' => 'Педагогический состав',
            'categories' => $categories,
        ]);
    }
}
