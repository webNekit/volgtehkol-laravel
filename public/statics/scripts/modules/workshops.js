export function initWorkshopsCarousel() {
    const swiper = new Swiper('.workshops__slider.swiper', {
        loop: false,
        slidesPerView: 1,
        spaceBetween: 24,
        navigation: {
            nextEl: '[data-slide-next]',
            prevEl: '[data-slider-prev]',
        },
        breakpoints: {
            540: {
                slidesPerView: 1,
                spaceBetween: 16
            },
            980: {
                slidesPerView: 1,
                spaceBetween: 24,
            }
        },
    });
}
