<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? "Главная страница" }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"/>
    <link rel="stylesheet" href="https://unpkg.com/photoswipe@5/dist/photoswipe.css">
    <link rel="stylesheet" href="{{ asset('statics/styles/libs/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('statics/styles/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('statics/styles/main.css') }}">
    @livewireStyles
</head>
<body class="__application" id="app" style="background-image: url('{{ asset('statics/img/gradient-c.png') }}'); background-size: 100%;">
@include('layout.partials.mobile')
<div aria-hidden="true" class="application__overlay" data-overlay></div>
<div class="application__template">
    @include('layout.partials.header')
    <main class="application__main main @if(\App\Support\Sidebar::showRoutes()) container @endif" id="main">
        @if(\App\Support\Sidebar::showRoutes())
            @include('layout.partials.sidebar')
        @endif
        {{ $slot }}
    </main>
    @include('layout.partials.footer')
</div>
<div class="modals" id="modals">
    <div data-modal="search" class="modal-search">
        <button data-modal-close aria-label="Закрыть" class="modal-search__close">
            <i class="ri-close-line"></i>
        </button>
        <div class="modal-search__wrapper">
            <div class="modal-search__container container">
                <form action="" class="modal-search__form">
                    <input type="search" class="modal-search__input" placeholder="Поиск по сайту">
                    <button type="submit" class="modal-search__button button button--primary">Поиск</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('statics/scripts/vendors/fslightbox.js') }}"></script>
<script src="{{ asset('statics/scripts/vendors/swiper-bundle.min.js') }}"></script>
<script type="module" src="{{ asset('statics/scripts/app.js') }}"></script>
@livewireScripts
</body>
</html>
