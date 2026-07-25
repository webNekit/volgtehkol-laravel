<div class="section__body education-collection">
    @foreach($specials['default'] as $level)
        <div class="education-collection__group">
            <h3 class="education-collection__group-title text-md">{{ $level['title'] }}</h3>
            <ul class="education-collection__list">
                @foreach($level['specials'] as $special)
                    <li class="education-collection__item">
                        <a href="{{ route('specials::show', ['id' => $special['id']]) }}"
                           class="education-collection__link">
                            <span class="education-collection__body">
                                <span class="education-collection__title text-sm">
                                    {{ $special['code'] }} {{ $special['title'] }}
                                </span>
                                <span class="education-collection__icon">
                                    <i class="ri-arrow-right-up-line"></i>
                                </span>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
