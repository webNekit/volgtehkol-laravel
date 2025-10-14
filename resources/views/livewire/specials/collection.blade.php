<div class="section__body education-collection">
    <ul class="education-collection__list">
        @foreach($specials['default'] as $special)
            <li class="education-collection__item">
                <a href="{{ route('specials::show', ['id' => $special['id']]) }}" class="education-collection__link">
                    <span class="education-collection__body">
                        <h3 class="education-collection__title text-sm">
                            {{ $special['code'] }} {{ $special['title'] }}
                        </h3>
                        <span class="education-collection__icon">
                            <i class="ri-arrow-right-up-line"></i>
                        </span>
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
