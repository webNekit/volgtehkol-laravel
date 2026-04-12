<div class="mobile-menu__body">
    <nav class="mobile-menu__navigation">
        <menu class="mobile-menu__navigation-items">
            @foreach($menu as $group)
                <li class="mobile-menu__navigation-item dropdown">
                    <a aria-expanded="false" href="#!" class="mobile-menu__navigation-link dropdown__control">
                        <span>{{ $group['title'] }}</span>
                    </a>
                    <div class="dropdown__content">
                        <ul class="dropdown__items">
                            @foreach($group['items'] as $item)
                                <li class="dropdown__item">
                                    <a href="{{ $item['route'] !== '#!' ? route($item['route']) : '#!' }}" class="dropdown__link">{{ $item['name'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
                @foreach($submenu as $group)
                    <li class="mobile-menu__navigation-item dropdown">
                        <a aria-expanded="false" href="#!" class="mobile-menu__navigation-link dropdown__control">
                            <span>{{ $group['title'] }}</span>
                        </a>
                        <div class="dropdown__content">
                            <ul class="dropdown__items">
                                @foreach($group['items'] as $item)
                                    <li class="dropdown__item">
                                        <a
                                            href="{{ isset($item['route'])
                                ? route($item['route'], $item['params'] ?? [])
                                : '#!' }}"
                                            class="dropdown__link"
                                        >
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
    <div class="mobile-menu__contacts">
        <ul class="mobile-menu__contacts-list">
            @foreach($contacts as $contact)
                <li class="mobile-menu__contacts-item">
                    @if($contact['type'] === 'phone')
                        <a aria-label="позвонить" href="tel:{{ $contact['value'] }}" class="mobile-menu__contacts-link">
                            <i class="ri-phone-line"></i>
                            <span>{{ $contact['value'] }}</span>
                        </a>
                    @elseif($contact['type'] === 'email')
                        <a aria-label="написать" href="mailto:{{ $contact['value'] }}" class="mobile-menu__contacts-link">
                            <i class="ri-mail-line"></i>
                            <span>{{ $contact['value'] }}</span>
                        </a>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
