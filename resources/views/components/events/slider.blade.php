<div class="events-slider__slide swiper-slide">
    <div class="events-slider__card">
        <div class="events-slider__body">
            <div class="events-slider__content">
                <a href="#!">
                    <h3 class="events-slider__title text-lg">{{ $event->title }}</h3>
                </a>
                <div class="events-slider__date">
                    @php
                        \Carbon\Carbon::setLocale('ru');
                    @endphp
                    {{ $event->start_date->translatedFormat('d F') }} - {{ $event->end_date->translatedFormat('d F') }}
                </div>
            </div>
        </div>
        <img loading="lazy" src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" class="events-slider__img">
    </div>
</div>
