import {initModals} from "./modules/search-modal.js";
import { initMobileMenu } from "./modules/mobile-menu.js";
import { initWorkshopsCarousel } from "./modules/workshops.js";
import { initSpecialtiesCarousel } from "./modules/specialties-carousel.js";
import { initNewsSlider, initEventSlider, initBannerSlider} from "./modules/slider-config.js";


document.addEventListener("DOMContentLoaded", () => {
    initMobileMenu();
    initNewsSlider();
    initEventSlider();
    initBannerSlider();
    initWorkshopsCarousel()
    initSpecialtiesCarousel();
    initModals();
})
