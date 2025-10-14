<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function show($id)
    {
        $event = Event::query()->findOrFail($id);
        return view('events::show', [
           'event' => $event,
            'title' => $event->title,
        ]);
    }
}
