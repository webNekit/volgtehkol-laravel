<div class="footer__contacts footer-contacts">
    <ul class="footer-contacts__list">
        @foreach($groups as $group)
            <li class="footer-contacts__item">
                <span class="footer-contacts__item-label">{{ $group['title'] }}</span>
                @foreach($group['items'] as $item)
                    @if($item['type'] === 'phone')
                        <a href="tel:{{ $item['value'] }}" class="footer-contacts__item-phone">{{ $item['label'] }}</a>
                    @elseif($item['type'] === 'email')
                        <a href="mailto:{{ $item['value'] }}" class="footer-contacts__item-email">{{ $item['label'] }}</a>
                    @else
                        <span>{{ $item['label'] }}</span>
                    @endif
                @endforeach
            </li>
        @endforeach
    </ul>
</div>
