<x-app :title="$title">
    <div class="main__content">
        <section class="article-section" id="article-section">
            <div class="article-section__container container">
                <div class="article-section__header">
                    <div class="article-section__information">
                        <a href="#!" data-tooltip="Перейти к категории" class="article-section__information-category tooltip tooltip--bottom">{{ $event->format->title }}</a>
                        <div class="article-section__information-date"><i class="ri-time-line"></i> {{ $event->created_at->format('d.m.Y') }}</div>
                    </div>
                    <h1 class="article-section__title text-xl">{{ $event->title }}</h1>
                </div>
                <div class="article-section__body">
                    <img loading="lazy" src="{{ Storage::url($event->image)  }}" alt="" class="article-section__img" style="object-fit: cover;">
                    <div class="article-section__content">
                        {!! $event->content !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app>
