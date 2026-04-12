export function initNewsSlider() {
    const slider = document.querySelector('.news-slider.swiper');
    if (!slider) return;

    new Swiper(slider, {
        slidesPerView: 1,
        loop: false,
        navigation: {
            nextEl: slider.querySelector('.news-slider__control--next'),
            prevEl: slider.querySelector('.news-slider__control--prev'),
        },
    });
}


export function initEventSlider() {
    const swiper = new Swiper('.events-slider.swiper', {
        width: null,
        loop: false,
        slidesPerView: 1,
        freeMode: false,
        navigation: {
            nextEl: '[data-slide-next]',
            prevEl: '[data-slider-prev]',
        },
    });
}

export function initArticleGallery() {
    const slider = document.querySelector('.article-gallery.swiper');
    if (!slider) return;

    new Swiper(slider, {
        slidesPerView: 1,
        spaceBetween: 16,
        loop: false,
        navigation: {
            nextEl: '[data-article-next]',
            prevEl: '[data-article-prev]',
        },
    });
}

export function initBannerSlider() {
    const swiper = new Swiper('.banner__slider.swiper', {
        width: null,
        loop: false,
        slidesPerView: 1,
        freeMode: false,
        navigation: {
            nextEl: '[data-slide-next]',
            prevEl: '[data-slider-prev]',
        },
    });
}
