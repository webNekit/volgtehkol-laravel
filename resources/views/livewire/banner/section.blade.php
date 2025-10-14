<section class="banner" id="banner-section">
    <div class="banner__slider swiper">
        <div class="banner__slider-wrapper swiper-wrapper">
            @foreach($eventsBanner as $event)
                <div class="banner__slider-slide banner-slide swiper-slide">
                    <div class="banner-slide__content">
                        <div class="banner-slide__container container">
                            <div class="banner-slide__alt">
                                <div class="banner-slide__col banner-slide__col--left">
                                    <h2 class="banner-slide__title text-2xl">{{ $event->title }}</h2>
                                </div>
                                <div class="banner-slide__col banner-slide__col--right">
                                    <div class="banner-slide__description">
                                        <p>{{ $event->description }}</p>
                                    </div>
                                    <a href="{{ route('events::show', $event->id) }}" class="banner-slide__more button button--outline">Читать подробнее</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img loading="lazy" src="{{ Storage::url($event->image)  }}" alt="{{ $event->title }}" class="banner-slide__picture">
                </div>
            @endforeach
            @foreach($newsBanner as $news)
                <div class="banner__slider-slide banner-slide swiper-slide">
                    <div class="banner-slide__content">
                        <div class="banner-slide__container container">
                            <div class="banner-slide__alt">
                                <div class="banner-slide__col banner-slide__col--left">
                                    <h2 class="banner-slide__title text-2xl">{{ $news->title }}</h2>
                                </div>
                                <div class="banner-slide__col banner-slide__col--right">
                                    <div class="banner-slide__description">
                                        <p>{{ $news->description }}</p>
                                    </div>
                                    <a href="{{ route('news::show', $news->slug) }}" class="banner-slide__more button button--outline">Читать подробнее</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img loading="lazy" src="{{ Storage::url($news->image)  }}" alt="{{ $news->title }}" class="banner-slide__picture">
                </div>
            @endforeach
        </div>
        <button aria-label="предыдущий слайд" class="banner__slider-control banner__slider-control--prev" data-slider-prev>
            <i class="ri-arrow-left-line"></i>
        </button>
        <button aria-label="следующий слайд" class="banner__slider-control banner__slider-control--next" data-slide-next>
            <i class="ri-arrow-right-line"></i>
        </button>
    </div>
</section>
