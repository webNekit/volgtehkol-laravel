<article class="specialties-collection__slider-card specialization-card" style="--bg-card: url('{{ asset('/statics/img/300x300.png') }}')">
    <a href="{{ route('specials::show', ['id' => $special->id]) }}" class="specialization-card__link">
        <div class="specialization-card__body">

            @if(!empty($special->image) && Storage::disk('public')->exists($special->image))
                <div class="specialization-card__image">
                    <img src="{{ Storage::disk('public')->url($special->image) }}" alt="{{ $special->title }}">
                </div>
            @endif

            <div class="specialization-card__head">
                <h3 class="specialization-card__title text-md">
                    {{ $special->title }}
                </h3>
            </div>

            <div class="specialization-card__content">
                <div class="specialization-card__info">
                    <ul class="specialization-card__info-list">

                        <li class="specialization-card__info-item">
                            <span class="specialization-card__info-key">Форма обучения</span>
                            <span class="specialization-card__info-value" style="text-transform: capitalize;">
                                {{ $special->form }}
                            </span>
                        </li>

                        <li class="specialization-card__info-item">
                            <span class="specialization-card__info-key"></span>
                            <span class="specialization-card__info-value">
                                {{ $special->cost == 0 ? 'бюджет' : 'внебюджет' }}
                            </span>
                        </li>

                        {{-- Срок обучения (11 классов) --}}
                        <li class="specialization-card__info-item">
                            <span class="specialization-card__info-key">
                                Срок обучения
                                @if($special->special_category_id != 2)
                                    (на базе 11 кл.)
                                @endif
                            </span>
                            <span class="specialization-card__info-value">
                                {{ $special->level_max }}
                            </span>
                        </li>

                        {{-- Срок обучения (9 классов) --}}
                        @if($special->level_middle && $special->special_category_id != 2)
                            <li class="specialization-card__info-item">
                                <span class="specialization-card__info-key">
                                    Срок обучения (на базе 9 кл.)
                                </span>
                                <span class="specialization-card__info-value">
                                    {{ $special->level_middle }}
                                </span>
                            </li>
                        @elseif($special->special_category_id != 2)
                            <li class="specialization-card__info-item">
                                <span class="specialization-card__info-key">Квалификация</span>
                                <span class="specialization-card__info-value">
                                    {{ $special->qualification }}
                                </span>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>

        </div>
    </a>
</article>
