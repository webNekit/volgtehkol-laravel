<article class="news-collection__grid-card news-card">
    <div class="news-card__wrapper">
        <div class="news-card__header">
            <div class="news-card__date">{{ $article->created_at->format('d.m.Y') }}</div>
            <a data-tooltip="Перейти к категории" href="#!" class="news-card__category tooltip tooltip--top">{{ $article->category->title }}</a>
        </div>
        <div class="news-card__body">
            <a href="{{ route('news::show', ['slug' => $article->slug]) }}">
                <h3 class="news-card__title text-lg">{{ $article->title }}</h3>
            </a>
            <div class="news-card__text">
                <p>{{ Str::limit($article->description, $limit, '...') }}</p>
            </div>
        </div>
    </div>
</article>
