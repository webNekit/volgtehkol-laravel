<x-app :title="$item->name">
    <div class="main__content">
        <section class="staff-detail" id="staff-detail">
            <div class="container">
                <div class="staff-detail__header">
                    <a href="{{ route('staff::index') }}" class="back-link" style="display: inline-flex; align-items: center; margin-bottom: 20px; text-decoration: none; color: hsl(var(--muted-foreground)); font-size: 0.9rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                        Назад к списку
                    </a>
                    <h1 class="xl" style="margin-bottom: 5px;">{{ $item->name }}</h1>
                    <p style="color: hsl(var(--muted-foreground));">{{ $item->position }}</p>
                </div>

                <div class="staff-detail__grid">
                    <div class="staff-detail__left">
                        <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://via.placeholder.com/300x400' }}"
                             alt="{{ $item->name }}"
                             class="staff-detail__photo">

                        <div class="staff-detail__contacts-card">
                            @if($item->phone)
                                <div class="staff-detail__contact-item">
                                    <span class="staff-detail__contact-label">Телефон</span>
                                    <span class="staff-detail__contact-value">{{ $item->phone }}</span>
                                </div>
                            @endif
                            @if($item->email)
                                <div class="staff-detail__contact-item">
                                    <span class="staff-detail__contact-label">Email</span>
                                    <span class="staff-detail__contact-value"><a href="mailto:{{ $item->email }}" style="color: inherit;">{{ $item->email }}</a></span>
                                </div>
                            @endif
                            @if($item->general_works)
                                <div class="staff-detail__contact-item">
                                    <span class="staff-detail__contact-label">Общий стаж</span>
                                    <span class="staff-detail__contact-value">{{ $item->general_works }}</span>
                                </div>
                            @endif
                            @if($item->current_works)
                                <div class="staff-detail__contact-item">
                                    <span class="staff-detail__contact-label">Стаж по спец.</span>
                                    <span class="staff-detail__contact-value">{{ $item->current_works }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="staff-detail__right">
                        @if(!empty($item->disciplines))
                            <div class="staff-detail__info-block">
                                <h2 class="staff-detail__info-title">Дисциплины</h2>
                                <div class="staff-detail__badge-list">
                                    @foreach((array) $item->disciplines as $discipline)
                                        <span class="staff-detail__badge">{{ $discipline }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if(!empty($item->education))
                            <div class="staff-detail__info-block">
                                <h2 class="staff-detail__info-title">Образование</h2>
                                <ul class="staff-detail__list">
                                    @foreach($item->education as $edu)
                                        <li class="staff-detail__list-item">{{ is_array($edu) ? ($edu['value'] ?? '') : $edu }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(!empty($item->work_experience))
                            <div class="staff-detail__info-block">
                                <h2 class="staff-detail__info-title">Опыт работы</h2>
                                <ul class="staff-detail__list">
                                    @foreach($item->work_experience as $exp)
                                        <li class="staff-detail__list-item">{{ is_array($exp) ? ($exp['value'] ?? '') : $exp }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(!empty($item->professional_development))
                            <div class="staff-detail__info-block">
                                <h2 class="staff-detail__info-title">Повышение квалификации</h2>
                                <ul class="staff-detail__list">
                                    @foreach($item->professional_development as $pd)
                                        <li class="staff-detail__list-item">{{ is_array($pd) ? ($pd['value'] ?? '') : $pd }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(!empty($item->honors))
                            <div class="staff-detail__info-block">
                                <h2 class="staff-detail__info-title">Достижения</h2>
                                <ul class="staff-detail__list">
                                    @foreach($item->honors as $honor)
                                        <li class="staff-detail__list-item">{{ is_array($honor) ? ($honor['value'] ?? '') : $honor }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app>
