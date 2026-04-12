<section class="section section--employees" id="section-employees">
    <div class="section__container">
        <div class="section__header">
            <h2 class="section__title">{{ $title }}</h2>
        </div>

        <div class="section__body employees-collection">
            @foreach($categories as $category)
                <div class="employees-category">
                    <h3 class="employees-category__title">{{ $category->title }}</h3>
                    <br>
                    <ul class="employees-collection__list">
                        @forelse($category->staff as $item)
                            <li class="employees-collection__item">
                                <article class="employees-collection__card employee-card">
                                    <div class="employee-card__body">
                                        <img loading="lazy"
                                             src="{{ $item->image ? asset('storage/' . $item->image) : 'https://via.placeholder.com/150' }}"
                                             alt="{{ $item->name }}"
                                             class="employee-card__photo">
                                        <div class="employee-card__information">
                                            <h3 class="employee-card__name text-md">{{ $item->name }}</h3>
                                            <div class="employee-card__position">{{ $item->position }}</div>
                                            <ul class="employee-card__contacts">
                                                @if($item->phone)
                                                    <li class="employee-card__contacts-item">
                                                        <div class="employee-card__contacts-key">Телефон</div>
                                                        <div
                                                            class="employee-card__contacts-value">{{ $item->phone }}</div>
                                                    </li>
                                                @endif
                                                @if($item->email)
                                                    <li class="employee-card__contacts-item">
                                                        <div class="employee-card__contacts-key">Почта</div>
                                                        <div
                                                            class="employee-card__contacts-value">{{ $item->email }}</div>
                                                    </li>
                                                @endif
                                                @if(!empty($item->disciplines))
                                                    <li class="employee-card__contacts-item">
                                                        <div class="employee-card__contacts-key">Преподаваемые
                                                            дисциплины
                                                        </div>
                                                        <div class="employee-card__contacts-value">
                                                            {{ implode(', ', (array) json_decode($item->disciplines, true)) }}
                                                        </div>
                                                    </li>
                                                @endif
                                                @if($item->general_works)
                                                    <li class="employee-card__contacts-item">
                                                        <div class="employee-card__contacts-key">Общий стаж работы</div>
                                                        <div
                                                            class="employee-card__contacts-value">{{ $item->general_works }}</div>
                                                    </li>
                                                @endif
                                                @if($item->current_works)
                                                    <li class="employee-card__contacts-item">
                                                        <div class="employee-card__contacts-key">Текущий стаж работы</div>
                                                        <div
                                                            class="employee-card__contacts-value">{{ $item->current_works }}</div>
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
