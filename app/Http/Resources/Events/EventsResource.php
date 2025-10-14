<?php

namespace App\Http\Resources\Events;

use App\Models\Event;

class EventsResource {
    public static function eventsCollection()
    {
        return Event::query()->where('is_active', true)->where('is_slider', false)->where('is_banner', false)
//            ->whereDate('end_date', '>=', now())
            ->orderBy('start_date')
            ->with('format')
            ->limit(4)
            ->get();
    }

    public static function eventsSliderCollection()
    {
        return Event::query()->where('is_active', true)->where('is_slider', true)
            ->whereDate('end_date', '>=', now())
            ->orderBy('start_date')
            ->with('format')
            ->get();
    }

    public static function eventsBannerCollection()
    {
        return Event::query()->where('is_active', true)->where('is_banner', true)
//            ->whereDate('end_date', '>=', now())
            ->orderBy('start_date')
            ->with('format')
            ->get();
    }
}
