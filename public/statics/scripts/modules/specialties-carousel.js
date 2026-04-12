export function initSpecialtiesCarousel() {
    const swiper = new Swiper('.specialties-collection__slider.swiper', {
        // width: null,
        loop: false,
        // freeMode: false,
        slidesPerView: 1,
        spaceBetween: 24,
        navigation: {
            nextEl: '[data-slide-next]',
            prevEl: '[data-slider-prev]',
        },
        breakpoints: {
            540: {
                slidesPerView: 2,
                spaceBetween: 16
            },
            980: {
                slidesPerView: 3,
                spaceBetween: 24,
            }
        },
    });
}