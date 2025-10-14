<x-app :title="$title">
    <div class="main__content">
        <section class="section section--contacts" id="contacts-section">
            <div class="section__container">
                <div class="section__header">
                    <h2 class="section__title">{{ $title }}</h2>
                </div>
                <div class="section__body contacts-collection">
                    @if(isset($addresses['juridical']))
                        <div class="contacts-collection__group">
                            <div class="contacts-collection__group-body">
                                <h3 class="contacts-collection__group-title text-md">Юридический адрес</h3>
                                <ul class="contacts-collection__group-list">
                                    @foreach($addresses['juridical'] as $address)
                                        <li class="contacts-collection__group-item">
                                            <a href="{{ $address->url }}" target="_blank" class="contacts-collection__group-link">
                                                {{ $address->address }} - {{ $address->$title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                        @if(isset($addresses['actual']))
                            <div class="contacts-collection__group">
                                <div class="contacts-collection__group-body">
                                    <h3 class="contacts-collection__group-title text-md">Фактический адрес</h3>
                                    <ul class="contacts-collection__group-list">
                                        @foreach($addresses['actual'] as $address)
                                            <li class="contacts-collection__group-item">
                                                <a href="{{ $address['url'] }}" target="_blank" class="contacts-collection__group-link">
                                                    {{ $address['address'] }} - {{ $address['title'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    @if(isset($contacts['phone']))
                        <div class="contacts-collection__group">
                            <div class="contacts-collection__group-body">
                                <h3 class="contacts-collection__group-title text-md">Телефоны</h3>
                                <ul class="contacts-collection__group-list">
                                    @foreach($contacts['phone'] as $phone)
                                        <li class="contacts-collection__group-item">
                                            <a href="tel:{{ preg_replace('/\D+/', '', $phone['value']) }}" class="contacts-collection__group-link">{{ $phone['value'] }}
                                                @if(!empty($phone['title']))
                                                    – {{ $phone['title'] }}
                                                @endif</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if(isset($contacts['email']))
                        <div class="contacts-collection__group">
                            <div class="contacts-collection__group-body">
                                <h3 class="contacts-collection__group-title text-md">E-mail</h3>
                                <ul class="contacts-collection__group-list">
                                    @foreach($contacts['email'] as $email)
                                        <li class="contacts-collection__group-item">
                                            <a href="mailto:{{ $email['value'] }}" class="contacts-collection__group-link">
                                                {{ $email['value'] }}
                                                @if(!empty($email['title']))
                                                    – {{ $email['title'] }}
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
</x-app>
