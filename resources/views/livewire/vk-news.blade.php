<section class="section section--news" id="news-section" style="background: #fff;">
    <div class="section__container container">
        <div class="section__header">
            <h2 class="section__title">Новости</h2>
            <a href="{{ route('news::index') }}" class="section__link">
                <span>Все новости</span>
                <i class="ri-arrow-right-s-line"></i>
            </a>
        </div>
        <div class="section__body news-collection">
            <div class="news-collection__row">
                @if(!empty($sliderPosts))
                    <div class="news-collection__column news-collection__column--left">
                        <div class="news-collection__slider news-slider swiper">
                            <div class="news-slider__wrapper swiper-wrapper">
                                @foreach($sliderPosts as $post)
                                    <div class="news-slider__slide swiper-slide">
                                        <div class="news-slider__card">
                                            <div class="news-slider__body">
                                                {{-- категории нет --}}
                                                {{-- <a class="news-slider__category">Категория</a> --}}

                                                <div class="news-slider__content">
                                                    <a href="{{ route('news::vk.show', $post['id']) }}">
                                                        <h3 class="news-slider__title text-lg">
                                                            {{ Str::limit($post['text'], 80) }}
                                                        </h3>
                                                    </a>
                                                    <div class="news-slider__date">
                                                        {{ \Carbon\Carbon::createFromTimestamp($post['date'])->format('d.m.Y') }}
                                                    </div>
                                                </div>
                                            </div>

                                            @if(!empty($post['photos'][0]))
                                                <img
                                                    loading="lazy"
                                                    src="{{ $post['photos'][0] }}"
                                                    alt="Новость"
                                                    class="news-slider__img"
                                                >
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="news-slider__controls">
                                <button class="news-slider__control news-slider__control--prev">
                                    <i class="ri-arrow-left-line"></i>
                                </button>
                                <button class="news-slider__control news-slider__control--next">
                                    <i class="ri-arrow-right-line"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- ===== КАРТОЧКИ (следующие 4) ===== --}}
                <div class="news-collection__column news-collection__column--right">
                    <div class="news-collection__grid">
                        @foreach($cardPosts as $post)
                            <div class="news-collection__grid-item">
                                <article class="news-collection__grid-card news-card">
                                    <div class="news-card__wrapper">
                                        <div class="news-card__header">
                                            <div class="news-card__date">
                                                {{ \Carbon\Carbon::createFromTimestamp($post['date'])->format('d.m.Y') }}
                                            </div>

                                            {{-- категория отсутствует --}}
                                            {{-- <a class="news-card__category">Категория</a> --}}
                                        </div>

                                        <div class="news-card__body">
                                            <a href="{{ route('news::vk.show', $post['id']) }}">
                                                <h3 class="news-card__title text-lg">
                                                    {{ Str::limit($post['text'], 60) }}
                                                </h3>
                                            </a>


                                            <div class="news-card__text">
                                                <p>{{ \Illuminate\Support\Str::limit($post['text'], 160) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
