<article class="events-collection__grid-card event-card">
    <div class="event-card__wrapper">
        <div class="event-card__header">
            <div class="event-card__date">
                @php
                    \Carbon\Carbon::setLocale('ru');
                @endphp
                {{ $event->start_date->translatedFormat('d F') }} - {{ $event->end_date->translatedFormat('d F') }}
            </div>
            <i class="ri-calendar-2-line"></i>
        </div>
        <div class="event-card__body">
            <div class="event-card__content">
                <a href="{{ route('events::show', $event->id) }}">
                    <h3 class="event-card__title text-lg">{{ $event->title }}</h3>
                </a>
                <div class="event-card__text">
                    <p>{{ Str::limit($event->description, 200, '...') }}</p>
                </div>
            </div>
            <div class="event-card__info">
                <ul class="event-card__info-list">
                    <li class="event-card__info-item">
                        <span class="event-card__info-key">Направление:</span>
                        <span class="event-card__info-value">{{ implode(', ', (array) json_decode($event->direction, true)) }}</span>
                    </li>
                    <li class="event-card__info-item">
                        <span class="event-card__info-key">Формат:</span>
                        <span class="event-card__info-value">{{ $event->format->title }}</span>
                    </li>
                    <li class="event-card__info-item">
                        <span class="event-card__info-key">Организатор:</span>
                        <span class="event-card__info-value">{{ $event->organizer }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</article>
