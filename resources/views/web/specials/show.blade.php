<x-app :title="$special->title">
    <div class="main__content">
        <section class="single-education" id="single-education">
            <div class="single-education__banner">
                <div class="single-education__container container">
                    <div class="single-education__alt">
                        <div class="single-education__alt-code">{{ $special->code }}</div>
                        <h1 class="single-education__alt-name xl">{{ $special->title }}</h1>
                    </div>

                    <div class="single-education__program-learning program-learning">
                        <div class="program-learning__wrapper">

                            <div class="program-learning__head">
                                <div class="program-learning__head-title">
                                    <span style="text-transform: capitalize;">
                                        {{ $special->form }}
                                    </span>
                                    форма обучения
                                </div>
                            </div>

                            <div class="program-learning__body">
                                <ul class="program-learning__list">

                                    <li class="program-learning__item">
                                        <div class="program-learning__key">&nbsp;</div>
                                        <div class="program-learning__value">
                                            {{ $special->cost == 0 ? 'Бюджет' : 'Внебюджет' }}
                                        </div>
                                    </li>

                                    <li class="program-learning__item">
                                        <div class="program-learning__key">Квалификация</div>
                                        <div class="program-learning__value">
                                            {{ $special->qualification }}
                                        </div>
                                    </li>

                                    {{-- На базе 9 классов (СКРЫВАЕМ ЦЕЛИКОМ, если категория = 2) --}}
                                    @if($special->level_middle && $special->special_category_id != 2)
                                        <li class="program-learning__item">
                                            <div class="program-learning__key">
                                                На базе 9 классов
                                            </div>
                                            <div class="program-learning__value">
                                                {{ $special->level_middle }}
                                            </div>
                                        </li>
                                    @endif

                                    {{-- На базе 11 классов (СКРЫВАЕМ ТОЛЬКО ТЕКСТ, если категория = 2) --}}
                                    @if($special->level_max)
                                        <li class="program-learning__item">
                                            <div class="program-learning__key">
                                                @if($special->special_category_id != 2)
                                                    На базе 11 классов
                                                @else
                                                    &nbsp;
                                                @endif
                                            </div>
                                            <div class="program-learning__value">
                                                {{ $special->level_max }}
                                            </div>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <br>

            <div class="single-education__body">
                <div class="single-education__container container">
                    <div class="single-education__context">
                        {!! $special->content !!}
                    </div>
                </div>
            </div>

        </section>
    </div>
</x-app>
