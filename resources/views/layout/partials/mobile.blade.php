<div aria-label="Мобильное меню" data-mobile-menu class="application__menu mobile-menu" id="mobile-menu">
    <div class="mobile-menu__wrapper">
        <div class="mobile-menu__header">
            <div class="mobile-menu__logo logo">
                <a href="{{ route('home::index') }}" class="logo__link">
                    <img src="{{ asset('statics/img/logo.png') }}" alt="Логотип ГБПОУ Волгоградский технический колледж" class="logo__img">
                    <div class="logo__alt">
                        <span>Волгоградский</span>
                        <span>Технический</span>
                        <span>Колледж</span>
                    </div>
                </a>
            </div>
        </div>
        <livewire:ui.mobile />
    </div>
</div>
