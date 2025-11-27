<x-app :title="$title">
    <div class="main__content">
        <h1>{{ $title }}</h1>
        @if(!empty($images))
            @foreach($images as $image)
                @if(!empty($image['file']))
                    <div class="page-image">
                        <img src="{{ Storage::url($image['file']) }}" alt="{{ $image['caption'] ?? '' }}">
                        @if(!empty($image['caption']))
                            <p class="caption">{{ $image['caption'] }}</p>
                        @endif
                    </div>
                @endif
            @endforeach
        @endif
        @if(!empty($content))
            <div class="page-content">
                {!! $content !!}
            </div>
        @endif
        @if(!empty($files))
            <ul class="page-files">
                @foreach($files as $file)
                    @if(!empty($file['file']))
                        <li>
                            <a href="{{ Storage::url($file['file']) }}" target="_blank" style="color: hsl(var(--primary))">
                                {{ $file['caption'] ?? basename($file['file']) }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        @endif
        @if(!empty($links))
            <ul class="page-links">
                @foreach($links as $link)
                    @if(!empty($link['url']))
                        <li>
                            <a href="{{ $link['url'] }}" target="_blank">
                                {{ $link['caption'] ?? $link['url'] }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        @endif
    </div>
</x-app>
