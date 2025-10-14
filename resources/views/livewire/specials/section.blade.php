<section class="section section--specialties" id="specialties-section">
    @foreach($specials_default as $category)
        <div class="section__container container">
            <div class="section__header">
                <h2 class="section__title">Специальности <span style="text-transform: lowercase">{{ $category->title }}</span></h2>
                <a href="{{ route('specials::index') }}" class="section__link">
                    <span>Все специальности</span>
                    <i class="ri-arrow-right-s-line"></i>
                </a>
            </div>
            <div class="section__body specialties-collection">
                <div class="specialties-collection__slider swiper">
                    <div class="specialties-collection__slider-wrapper swiper-wrapper">
                        @foreach($category->specials as $special)
                            <div class="specialties-collection__slider-slide swiper-slide">
                                <x-specials.card :special="$special" />
                            </div>
                        @endforeach
                    </div>
                    <button aria-label="предыдущий слайд"
                            class="specialties-collection__control specialties-collection__control--prev"
                            data-slider-prev>
                        <i class="ri-arrow-left-line"></i>
                    </button>
                    <button aria-label="сдедующий слайд"
                            class="specialties-collection__control specialties-collection__control--next"
                            data-slide-next>
                        <i class="ri-arrow-right-line"></i>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</section>
