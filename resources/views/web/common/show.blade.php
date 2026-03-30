<x-app :title="$title">
    <div class="main__content">
        <h1>{{ $title }}</h1>

        {{-- Изображения --}}
        @if($images->where('is_visible', true)->isNotEmpty())
            @foreach($images->where('is_visible', true) as $image)
                @if($image->file_path)
                    <div class="page-image">
                        <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $image->caption ?? '' }}">
                        @if($image->caption)
                            <p class="caption">{{ $image->caption }}</p>
                        @endif
                    </div>
                @endif
            @endforeach
        @endif

        {{-- Контент --}}
        @if($content)
            <div class="page-content">
                {!! $content !!}
            </div>
        @endif

        {{-- Файлы --}}
        @if($files->where('is_visible', true)->isNotEmpty())
            <ul class="page-files">
                @foreach($files->where('is_visible', true) as $file)
                    @if($file->file_path)
                        <li>
                            <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" style="color: hsl(var(--primary))">
                                {{ $file->caption ?? basename($file->file_path) }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        @endif

        {{-- Ссылки --}}
        @if($links->where('is_visible', true)->isNotEmpty())
            <ul class="page-links">
                @foreach($links->where('is_visible', true) as $link)
                    @if($link->url)
                        <li>
                            <a href="{{ $link->url }}" target="_blank">
                                {{ $link->caption ?? $link->url }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        @endif
    </div>
</x-app>