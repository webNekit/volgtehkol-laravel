<div class="footer__cols">
    @foreach($menu as $group)
        <div class="footer__col">
            <div class="footer__navigation footer-navigation">
                <div class="footer-navigation__head">
                    <div class="footer-navigation__label">{{ $group['title'] }}</div>
                </div>
                <div class="footer-navigation__body">
                    <ul class="footer-navigation__list">
                        @foreach($group['items'] as $item)
                            <li class="footer-navigation__item">
                                <a href="{{ $item['route'] !== '#!' ? route($item['route']) : '#!' }}" class="footer-navigation__link">
                                    {{ $item['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
