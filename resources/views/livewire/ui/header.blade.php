<nav aria-label="Навигация" class="header__navigation navigation">
    <menu class="navigation__menu">
        @foreach($menu as $group)
            <li class="navigation__item dropdown-menu">
                <a href="#!" class="dropdown-menu__trigger navigation__link" aria-expanded="false"  aria-haspopup="true">{{ $group['title'] }}</a>
                <div class="dropdown-menu__content" aria-hidden="true">
                    <ul class="dropdown-menu__list">
                        @foreach($group['items'] as $item)
                            <li class="dropdown-menu__item"><a href="{{ $item['route'] !== '#!' ? route($item['route']) : '#!' }}" class="dropdown-menu__link">{{ $item['name'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </li>
        @endforeach
    </menu>
</nav>
