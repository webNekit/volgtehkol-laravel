<x-app :title="$title">
    <div class="main__content">
        <section class="article-section">
            <div class="article-section__container container">

                {{-- HEADER --}}
                <div class="article-section__header">
                    <div class="article-section__information">
                        <div class="article-section__information-date">
                            <i class="ri-time-line"></i>
                            {{ \Carbon\Carbon::createFromTimestamp($post['date'])->format('d.m.Y') }}
                        </div>
                    </div>

                    <h1 class="article-section__title text-xl">
                        {{ Str::limit($post['text'], 120) }}
                    </h1>
                </div>

                {{-- 📸 GALLERY --}}
                @if(!empty($post['photos']))
                    @php
                        $count = count($post['photos']);
                    @endphp
                    <div class="article-gallery article-gallery--count-{{ $count }}">
                        @foreach($post['photos'] as $index => $photo)
                            <div class="article-gallery__item article-gallery__item--{{ $index+1 }}">
                                <a href="{{ $photo }}" data-fslightbox="gallery" target="_blank">
                                    <img loading="lazy" src="{{ $photo }}" alt="Фото новости">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
                {{-- 📝 TEXT --}}
                <div class="article-section__content">
                    {!! nl2br(e($post['text'])) !!}
                </div>

            </div>
        </section>
    </div>
</x-app>
