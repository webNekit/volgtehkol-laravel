<div class="contact-form">
    <div class="section__header">
        <h2 class="section__title">Форма обратной связи</h2>
    </div>
    <br>
    @if($success)
        <div class="contact-form__success">
            Спасибо! Сообщение отправлено.
        </div>
    @endif

    <form wire:submit.prevent="submit" class="contact-form__form">

        {{-- honeypot --}}
        <input type="text" wire:model.defer="website" style="display:none">

        <div class="contact-form__field">
            <label>Имя</label>
            <input type="text" wire:model.defer="name" placeholder="Мочалов Никита" required>
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="contact-form__field">
            <label>Email</label>
            <input type="email" wire:model.defer="email" placeholder="user@example.ru">
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="contact-form__field">
            <label>Сообщение</label>
            <textarea rows="5" wire:model.defer="message"></textarea>
            @error('message') <span class="error">{{ $message }}</span> @enderror
        </div>
        <button  type="submit" class="button button--primary contact-form__button" wire:loading.attr="disabled"  wire:target="submit">
            <span wire:loading.remove wire:target="submit">Отправить</span>
            <span wire:loading wire:target="submit">Отправка…</span>
        </button>
    </form>
</div>
