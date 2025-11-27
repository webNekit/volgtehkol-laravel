<section class="section section--events" id="events-section">
    <div class="section__container container">
        <div class="section__header">
            <h2 class="section__title">Мероприятия</h2>
{{--            <a href="#!" class="section__link">--}}
{{--                <span>Все мероприятия</span>--}}
{{--                <i class="ri-arrow-right-s-line"></i>--}}
{{--            </a>--}}
        </div>
        @php
            $hasSliderEvents = isset($events_slider) && $events_slider->isNotEmpty();
        @endphp
        <div class="section__body events-collection">
            @if ($hasSliderEvents)
                <div class="events-collection__cols">
                    <div class="events-collection__col events-collection__col--left">
                        <div class="events-collection__slider events-slider swiper">
                            <div class="events-slider__wrapper swiper-wrapper">
                                @foreach($events_slider as $event)
                                    <x-events.slider :event="$event" />
                                @endforeach
                            </div>
                            <div class="events-slider__controls">
                                <button aria-label="предыдущий слайд"
                                        class="events-slider__control events-slider__control--prev"
                                        data-slider-prev>
                                    <i class="ri-arrow-left-line"></i>
                                </button>
                                <button aria-label="сдедующий слайд"
                                        class="events-slider__control events-slider__control--next"
                                        data-slide-next>
                                    <i class="ri-arrow-right-line"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="events-collection__col events-collection__col--right">
                        <div class="events-collection__grid">
                            @foreach($events_default as $event)
                                <div class="events-collection__grid-item">
                                    <x-events.card :event="$event" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="events-collection__cols" style="grid-template-rows: unset;">
                    <div class="events-collection__grid">
                        @foreach($events_default as $event)
                            <div class="events-collection__grid-item">
                                <x-events.card :event="$event" />
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
