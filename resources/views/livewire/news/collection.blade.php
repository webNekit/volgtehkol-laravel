<div class="section__body news-grid">
    @foreach($articles as $article)
        <div class="news-grid__item">
            <x-article.card :article="$article" />
        </div>
    @endforeach
</div>
