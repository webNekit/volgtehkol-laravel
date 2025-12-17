<x-app :title="__('Главная страница')">
    <div class="main__content">
        <livewire:video.section />
{{--        <livewire:banner.section />--}}
        <livewire:specials.section :specials="$specials" />
{{--        <livewire:news.section />--}}
        <livewire:vk-news />
        <livewire:events.section :events="$events" />
    </div>
</x-app>
