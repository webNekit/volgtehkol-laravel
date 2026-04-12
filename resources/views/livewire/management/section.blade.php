<section class="section section--management" id="section-management">
    <div class="section__container">
        <div class="section__header">
            <h2 class="section__title">{{ $title }}</h2>
        </div>

        <div class="section__body management-collection">
            @foreach($categories as $category)
                <div class="management-category">
                    <h3 class="management-category__title">{{ $category->title }}</h3>
                    <br>
                    <ul class="management-collection__list">
                        @forelse($category->management as $item)
                            <li class="management-collection__item">
                                <article class="management-collection__card management-card">
                                    <div class="management-card__body">
                                        <img loading="lazy"
                                             src="{{ $item->image ? asset('storage/' . $item->image) : 'https://via.placeholder.com/150' }}"
                                             alt="{{ $item->name }}"
                                             class="management-card__photo">
                                        <div class="management-card__information">
                                            <h3 class="management-card__name text-md">{{ $item->name }}</h3>
                                            <div class="management-card__position">{{ $item->position }}</div>
                                            <ul class="management-card__contacts">
                                                @if($item->phone)
                                                    <li class="management-card__contacts-item">
                                                        <div class="management-card__contacts-key">Телефон</div>
                                                        <div
                                                            class="management-card__contacts-value">{{ $item->phone }}</div>
                                                    </li>
                                                @endif
                                                @if($item->email)
                                                    <li class="management-card__contacts-item">
                                                        <div class="management-card__contacts-key">Почта</div>
                                                        <div
                                                            class="management-card__contacts-value">{{ $item->email }}</div>
                                                    </li>
                                                @endif
                                                @if(!empty($item->disciplines))
                                                    <li class="management-card__contacts-item">
                                                        <div class="management-card__contacts-key">Преподаваемые
                                                            дисциплины
                                                        </div>
                                                        <div class="management-card__contacts-value">
                                                            {{ implode(', ', (array) json_decode($item->disciplines, true)) }}
                                                        </div>
                                                    </li>
                                                @endif
                                                @if($item->general_works)
                                                    <li class="management-card__contacts-item">
                                                        <div class="management-card__contacts-key">Общий стаж работы</div>
                                                        <div
                                                            class="management-card__contacts-value">{{ $item->general_works }}</div>
                                                    </li>
                                                @endif
                                                @if($item->current_works)
                                                    <li class="management-card__contacts-item">
                                                        <div class="management-card__contacts-key">Текущий стаж работы</div>
                                                        <div
                                                            class="management-card__contacts-value">{{ $item->current_works }}</div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </article>
                            </li>
                        @empty
                            <p>Нет сотрудников в этой категории.</p>
                        @endforelse
                    </ul>
                    <br>
                </div>
            @endforeach
        </div>
    </div>
</section>
