<nav class="sidebar__navigation">
    <ul class="sidebar__navigation-list">

        @foreach($menu as $item)
            @php
                if(!empty($item['is_static'])) {
                    $isActive = request()->routeIs($item['route']);
                    $href = $item['route'] !== '#!' ? route($item['route'], $item['params'] ?? []) : '#!';
                } else {
                    $isActive = request()->route('slug') === $item['slug'];
                    $href = $item['url'] ?? '#!';
                }
            @endphp

            <li class="sidebar__navigation-item">
                <a href="{{ $href }}" class="sidebar__navigation-link {{ $isActive ? 'sidebar__navigation-link--active' : '' }}">
                    {{ $item['name'] }}
                </a>
            </li>
        @endforeach

    </ul>
</nav>
