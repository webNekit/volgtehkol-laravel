<nav class="header__navbar navbar">
    <menu class="navbar__menu">

        @foreach($submenu as $group)
            <li class="navbar__item dropdown-menu">
                <a href="#!" class="dropdown-menu__trigger navbar__link">
                    {{ $group['title'] }}
                </a>

                <div class="dropdown-menu__content" aria-hidden="true">
                    <ul class="dropdown-menu__list">

                        @foreach($group['items'] as $item)
                            <li class="dropdown-menu__item">
                                <a href="{{ $item['url'] }}" class="dropdown-menu__link">
                                    {{ $item['name'] }}
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </li>
            <li class="navbar__item dropdown-menu">
                <a href="#!" class="dropdown-menu__trigger navbar__link">
                    {{ $group['title'] }}
                </a>

                <div class="dropdown-menu__content" aria-hidden="true">
                    <ul class="dropdown-menu__list">

                        @foreach($group['items'] as $item)
                            <li class="dropdown-menu__item">
                                <a href="{{ $item['url'] }}" class="dropdown-menu__link">
                                    {{ $item['name'] }}
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </li>
            <li class="navbar__item dropdown-menu">
                <a href="#!" class="dropdown-menu__trigger navbar__link">
                    {{ $group['title'] }}
                </a>

                <div class="dropdown-menu__content" aria-hidden="true">
                    <ul class="dropdown-menu__list">

                        @foreach($group['items'] as $item)
                            <li class="dropdown-menu__item">
                                <a href="{{ $item['url'] }}" class="dropdown-menu__link">
                                    {{ $item['name'] }}
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </li>
            <li class="navbar__item dropdown-menu">
                <a href="#!" class="dropdown-menu__trigger navbar__link">
                    {{ $group['title'] }}
                </a>

                <div class="dropdown-menu__content" aria-hidden="true">
                    <ul class="dropdown-menu__list">

                        @foreach($group['items'] as $item)
                            <li class="dropdown-menu__item">
                                <a href="{{ $item['url'] }}" class="dropdown-menu__link">
                                    {{ $item['name'] }}
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </li>
            <li class="navbar__item dropdown-menu">
                <a href="#!" class="dropdown-menu__trigger navbar__link">
                    {{ $group['title'] }}
                </a>

                <div class="dropdown-menu__content" aria-hidden="true">
                    <ul class="dropdown-menu__list">

                        @foreach($group['items'] as $item)
                            <li class="dropdown-menu__item">
                                <a href="{{ $item['url'] }}" class="dropdown-menu__link">
                                    {{ $item['name'] }}
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </li>
            <li class="navbar__item dropdown-menu">
                <a href="#!" class="dropdown-menu__trigger navbar__link">
                    {{ $group['title'] }}
                </a>

                <div class="dropdown-menu__content" aria-hidden="true">
                    <ul class="dropdown-menu__list">

                        @foreach($group['items'] as $item)
                            <li class="dropdown-menu__item">
                                <a href="{{ $item['url'] }}" class="dropdown-menu__link">
                                    {{ $item['name'] }}
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </li>
            <li class="navbar__item dropdown-menu">
                <a href="#!" class="dropdown-menu__trigger navbar__link">
                    {{ $group['title'] }}
                </a>

                <div class="dropdown-menu__content" aria-hidden="true">
                    <ul class="dropdown-menu__list">

                        @foreach($group['items'] as $item)
                            <li class="dropdown-menu__item">
                                <a href="{{ $item['url'] }}" class="dropdown-menu__link">
                                    {{ $item['name'] }}
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </li>
        @endforeach

    </menu>
</nav>
