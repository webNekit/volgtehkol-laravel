<section class="section">
    <div class="section__container">
        <div class="section__header">
            <h2 class="section__title">{{ $title }}</h2>
        </div>
        <div class="section__body documents">
            @foreach($categories as $category)
                @if($category->documents->count() > 0)
                    <div class="documents__group">
                        <h3 class="documents__title text-md">{{ $category->title }}</h3>
                        <ul class="documents__list">
                            @foreach($category->documents as $document)
                                <li class="documents__item">
                                    <a href="{{ asset('storage/' . $document->file) }}"
                                       download="{{ $document->title }}"
                                       class="documents__link"
                                       target="_blank">
                                        {{ $document->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
