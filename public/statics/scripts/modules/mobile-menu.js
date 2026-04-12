export function initMobileMenu() {
    const menu = document.querySelector('[data-mobile-menu]');
    const button = document.querySelector('[data-mobile-button]');
    const overlay = document.querySelector('.application__overlay');
    const body = document.body;

    // --- Переключение сайдбара ---
    const toggleMenu = () => {
        const isOpen = menu.classList.contains('active');
        menu.classList.toggle('active');
        overlay.classList.toggle('active');
        body.classList.toggle('no-scroll', !isOpen);
    };

    button?.addEventListener('click', toggleMenu);
    overlay?.addEventListener('click', toggleMenu);

    // --- Обработка dropdown-меню ---
    const dropdownControls = document.querySelectorAll('.dropdown__control');

    dropdownControls.forEach(dropdownControl => {
        dropdownControl.addEventListener('click', (e) => {
            e.preventDefault();

            const dropdown = dropdownControl.closest('.dropdown');
            const content = dropdown.querySelector('.dropdown__content');
            const isActive = dropdown.classList.contains('active');

            // Закрыть все остальные
            document.querySelectorAll('.dropdown').forEach(el => {
                const ddContent = el.querySelector('.dropdown__content');
                if (ddContent) {
                    ddContent.style.maxHeight = null;
                }
                el.classList.remove('active');
                el.querySelector('.dropdown__control')?.setAttribute('aria-expanded', 'false');
            });

            if (!isActive) {
                dropdown.classList.add('active');
                dropdownControl.setAttribute('aria-expanded', 'true');

                requestAnimationFrame(() => {
                    const scrollHeight = content.scrollHeight;
                    content.style.maxHeight = scrollHeight + 'px';
                });
            }
        });
    });
}
