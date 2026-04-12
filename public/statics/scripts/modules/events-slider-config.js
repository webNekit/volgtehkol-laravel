export function initEventSlider() {
    const swiper = new Swiper('.events-slider.swiper', {
        width: null,
        loop: false,
        slidesPerView: 1,
        freeMode: false,
        navigation: {
            nextEl: '.events-slider__control--next',
            prevEl: '.events-slider__control--prev',
        },
    });
}