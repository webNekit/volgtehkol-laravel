<section class="section section--news" id="news-section">
    <div class="section__container container">
        <div class="section__header">
            <h2 class="section__title">Новости</h2>
            <a href="{{ route('news::index') }}" class="section__link">
                <span>Все новости</span>
                <i class="ri-arrow-right-s-line"></i>
            </a>
        </div>
        <div class="section__body news-collection">
            <div class="news-collection__row">
                <div class="news-collection__column news-collection__column--left">
                    <x-article.slider :articles="$articles_slider" />
                </div>
                <div class="news-collection__column news-collection__column--right">
                    <div class="news-collection__grid">
                        @foreach($articles as $article)
                            <div class="news-collection__grid-item">
                                <x-article.card :article="$article" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
