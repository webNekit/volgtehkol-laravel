<section class="welcome welcome-section" id="welcome-section">
    <div class="welcome-section__wrapper">
        <div class="welcome-section__row welcome-section__row--top">
            <div class="welcome-section__container container">
                <h2 class="welcome-section__title" style="text-transform: uppercase">Учебно-производственный технопарк колледжа</h2>
            </div>
        </div>
{{--        <div class="welcome-section__row welcome-section__row--bottom">--}}
{{--            <div class="welcome-section__container container">--}}
{{--                <div class="welcome-section__workshops workshops">--}}
{{--                    <div class="workshops__slider swiper">--}}
{{--                        <div class="workshops__slider-wrapper swiper-wrapper">--}}
{{--                            @foreach($newsBanner as $news)--}}
{{--                            <div class="workshops__slider-slider swiper-slide">--}}
{{--                                <div class="workshop-card">--}}
{{--                                    <div class="workshop-card__preview">--}}
{{--                                        <img src="{{ Storage::url($news->image)  }}" alt="{{ $news->title }}">--}}
{{--                                    </div>--}}
{{--                                    <div class="workshop-card__alt">--}}
{{--                                        <div class="workshop-card__alt-title">{{ $news->title }}</div>--}}
{{--                                        <div class="workshop-card__alt-text">--}}
{{--                                            <p>{{ $news->description }}</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                        <button aria-label="предыдущий слайд"--}}
{{--                                class="workshops__slider-control workshops__slider-control--prev"--}}
{{--                                data-slider-prev>--}}
{{--                            <i class="ri-arrow-left-line"></i>--}}
{{--                        </button>--}}
{{--                        <button aria-label="сдедующий слайд"--}}
{{--                                class="workshops__slider-control workshops__slider-control--next"--}}
{{--                                data-slide-next>--}}
{{--                            <i class="ri-arrow-right-line"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <video playsinline muted loop autoplay src="{{ asset('statics/video/video_bg.mp4') }}" class="welcome-section__video"></video>
</section>
