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

    {{-- срок обучения на базе 11 классов --}}
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

    {{-- срок обучения на базе 9 классов --}}
    @if($special->level_middle)
        <li class="specialization-card__info-item">
            <span class="specialization-card__info-key">
                Срок обучения
                @if($special->special_category_id != 2)
                    (на базе 9 кл.)
                @endif
            </span>
            <span class="specialization-card__info-value">
                {{ $special->level_middle }}
            </span>
        </li>
    @else
        <li class="specialization-card__info-item">
            <span class="specialization-card__info-key">Квалификация</span>
            <span class="specialization-card__info-value">
                {{ $special->qualification }}
            </span>
        </li>
    @endif

</ul>
