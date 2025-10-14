<x-app :title="__('Мероприятия')">
    <div class="main__content">
        <section class="section" id="news-section">
            <div class="section__container">
                <div class="section__header">
                    <h2 class="section__title">Мероприятия</h2>
                </div>
                <livewire:news.collection />
            </div>
        </section>
    </div>
</x-app>
