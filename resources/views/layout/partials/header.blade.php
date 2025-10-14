<header class="application__header header" id="header">
    <div class="header__row header__row--top">
        <div class="header__container container">
            <div class="header__column header__column--left">
                <div class="header__year">Твой путь к успеху</div>
                <livewire:ui.header-contacts />
            </div>
            <div class="header__column header__column--right">
                <div aria-label="Элементы управления" class="header__controls header-controls">
                    <ul class="header-controls__list">
                        <li class="header-controls__item">
                            <button aria-label="Настройки для слабовидящих" class="header-controls__target">
                                <i class="ri-eye-line"></i>
                            </button>
                        </li>
                        <li class="header-controls__item">
                            <button data-modal-open="search" aria-label="Открыть окно поиска" class="header-controls__target">
                                <i class="ri-search-line"></i>
                            </button>
                        </li>
                        <li class="header-controls__item">
                            <button data-mobile-button aria-label="Открыть мобильное меню"
                                    class="header-controls__target header-controls__target--mobile">
                                <i class="ri-menu-3-line"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header__row header__row--middle">
        <div class="header__container container">
            <div class="header__logo logo">
                <a href="{{ route('home::index') }}" class="logo__link">
                    <img src="{{ asset('statics/img/logo.png') }}" alt="Логотип ГБПОУ Волгоградский технический колледж"
                         class="logo__img">
                    <div class="logo__alt">
                        <span>Волгоградский</span>
                        <span>Технический</span>
                        <span>Колледж</span>
                    </div>
                </a>
            </div>
            <livewire:ui.header />
        </div>
    </div>
{{--    <div class="header__row header__row--bottom">--}}
{{--        <div class="header__container container">--}}
{{--            <livewire:ui.submenu />--}}
{{--        </div>--}}
{{--    </div>--}}
</header>
