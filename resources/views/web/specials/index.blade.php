<x-app :title="$title_page">
    <div class="main__content">
        <section class="section section--education" id="section-education">
            <div class="section__container">
                <div class="section__header">
                    <h2 class="section__title">{{ $title_page }}</h2>
                </div>
                <livewire:specials.collection :specials="$specials" />
            </div>
        </section>
    </div>
</x-app>
