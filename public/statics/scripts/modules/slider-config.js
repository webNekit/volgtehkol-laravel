export function initNewsSlider() {
    const swiper = new Swiper('.news-slider.swiper', {
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
