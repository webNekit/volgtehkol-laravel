<div class="news-collection__slider news-slider swiper">
    <div class="news-slider__wrapper swiper-wrapper">
        @foreach($articles as $article)
            <div class="news-slider__slide swiper-slide">
                <div class="news-slider__card">
                    <div class="news-slider__body">
                        <a data-tooltip="перейти к категории" href="#!"
                           class="news-slider__category tooltip tooltip--bottom">{{ $article->category->title }}</a>
                        <div class="news-slider__content">
                            <a href="{{ route('news::show', ['slug' => $article->slug]) }}">
                                <h3 class="news-slider__title text-lg">{{ $article->title }}</h3>
                            </a>
                            <div class="news-slider__date">{{ $article->created_at->format('d.m.Y') }}</div>
                        </div>
                    </div>
                    <img loading="lazy" src="{{ Storage::url($article->image)  }}" alt="{{ $article->title }}" class="news-slider__img">
                </div>
            </div>
        @endforeach
    </div>
    <div class="news-slider__controls">
        <button aria-label="предыдущий слайд"
                class="news-slider__control news-slider__control--prev"
                data-slider-prev>
            <i class="ri-arrow-left-line"></i>
        </button>
        <button aria-label="сдедующий слайд"
                class="news-slider__control news-slider__control--next" data-slide-next>
            <i class="ri-arrow-right-line"></i>
        </button>
    </div>
</div>
