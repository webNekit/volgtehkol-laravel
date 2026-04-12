<x-app :title="__('Новости')">
    <div class="main__content">
        <section class="section" id="news-section">
            <div class="section__container">
                <div class="section__header">
                    <h2 class="section__title">Новости</h2>
                </div>
                <livewire:news.collection />
            </div>
        </section>
    </div>
</x-app>
