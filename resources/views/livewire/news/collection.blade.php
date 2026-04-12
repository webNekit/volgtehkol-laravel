<div>
    <div class="section__body news-grid">
        @foreach($posts as $post)
            <div class="news-grid__item">

                <article class="news-collection__grid-card news-card">
                    <div class="news-card__wrapper">
                        <div class="news-card__header">
                            <div class="news-card__date">
                                {{ \Carbon\Carbon::createFromTimestamp($post['date'])->format('d.m.Y') }}
                            </div>

                            {{-- категория отсутствует --}}
                            {{-- <a class="news-card__category">Категория</a> --}}
                        </div>

                        <div class="news-card__body">
                            <a href="{{ route('news::vk.show', $post['id']) }}">
                                <h3 class="news-card__title text-lg">
                                    {{ \Illuminate\Support\Str::limit($post['text'], 60) }}
                                </h3>
                            </a>

                            <div class="news-card__text">
                                <p>{{ \Illuminate\Support\Str::limit($post['text'], 160) }}</p>
                            </div>
                        </div>
                    </div>
                </article>

            </div>
        @endforeach
    </div>

    @if($hasMore)
        <div class="news-grid__more">
            <button
                class="button button--secondary"
                wire:click="loadMore"
                wire:loading.attr="disabled"
                style="width: 100%; margin-block-start: 24px;"
            >
                <span wire:loading.remove>Показать ещё</span>
                <span wire:loading>Загрузка…</span>
            </button>
        </div>
    @endif
</div>
