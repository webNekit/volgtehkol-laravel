<div class="header__contacts header-contacts">
    <ul aria-label="Контактные данные" class="header-contacts__list">
        @foreach($contacts as $contact)
            <li class="header-contacts__item">
                @if($contact['type'] === 'phone')
                    <a data-tooltip="Позвонить" aria-label="Позвонить" href="tel:{{ $contact['value'] }}"
                       class="header-contacts__link tooltip tooltip--bottom">
                        <i class="ri-phone-line"></i>
                        <span>{{ $contact['value'] }}</span>
                    </a>
                @elseif($contact['type'] === 'email')
                    <a data-tooltip="Написать" aria-label="Написать" href="mailto:{{ $contact['value'] }}"
                       class="header-contacts__link tooltip tooltip--bottom">
                        <i class="ri-mail-line"></i>
                        <span>{{ $contact['value'] }}</span>
                    </a>
                @else
                    <span>{{ $contact['value'] }}</span>
                @endif
            </li>
        @endforeach
    </ul>
</div>
