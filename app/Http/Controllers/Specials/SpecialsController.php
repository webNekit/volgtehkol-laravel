<?php

namespace App\Http\Controllers\Specials;

use App\Http\Controllers\Controller;
use App\Http\Resources\Specials\SpecialsResource;
use Illuminate\Http\Request;

class SpecialsController extends Controller
{
    public function index()
    {
        return view('specials::index', [
            'title_page' => 'Образование',
            'specials' => [
                'default' => SpecialsResource::index()->toArray(),
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
