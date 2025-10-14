<nav class="sidebar__navigation">
    <ul class="sidebar__navigation-list">
        @foreach($menu['items'] as $item)
            @php
                $isActive = request()->routeIs($item['route']);
            @endphp
            <li class="sidebar__navigation-item">
                <a
                    href="{{ $item['route'] !== '#!' ? route($item['route']) : '#!' }}"
                    class="sidebar__navigation-link {{ $isActive ? 'sidebar__navigation-link--active' : '' }}"
                >
                    {{ $item['name'] }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
