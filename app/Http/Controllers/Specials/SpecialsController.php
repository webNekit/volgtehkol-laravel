<?php

namespace App\Http\Controllers\Specials;

use App\Http\Controllers\Controller;
use App\Http\Resources\Specials\SpecialsResource;
use Illuminate\Http\Request;

class SpecialsController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->query('category_id');

        $specialsQuery = \App\Http\Resources\Specials\SpecialsResource::index();
        if ($categoryId) {
            $specialsQuery = $specialsQuery->where('special_category_id', $categoryId);
        }
        return view('specials::index', [
            'title_page' => 'Образование',
            'specials' => [
                'default' => $specialsQuery->toArray(),
            ],
        ]);
    }


    public function show($id)
    {
        return view('specials::show', [
            'special' => SpecialsResource::findOrFail($id),
        ]);
    }
}
