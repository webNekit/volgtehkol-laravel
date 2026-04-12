<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\Events\EventsResource;
use App\Http\Resources\Specials\SpecialsResource;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        return view('home::index', [
            'events' => [
                'default' => EventsResource::eventsCollection(),
                'slider' => EventsResource::eventsSliderCollection(),
                'banner' => EventsResource::eventsBannerCollection(),
            ],
            'specials' => [ 'default' => SpecialsResource::collection() ],
        ]);
    }
}
