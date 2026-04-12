export function initModals() {
    const overlay = document.querySelector("[data-overlay]");
    const body = document.body;

    function openModal(name) {
        const modal = document.querySelector(`[data-modal="${name}"]`);
        if (!modal) return;

        modal.classList.add("active");
        overlay.classList.add("active");
        body.classList.add("no-scroll");
    }

    function closeModal() {
        const activeModal = document.querySelector(".modal-search.active");
        if (activeModal) activeModal.classList.remove("active");

        overlay.classList.remove("active");
        body.classList.remove("no-scroll");
    }

    // Кнопки открытия
    document.querySelectorAll("[data-modal-open]").forEach(btn => {
        btn.addEventListener("click", () => {
            const target = btn.getAttribute("data-modal-open");
            openModal(target);
        });
    });

    // Кнопки закрытия
    document.querySelectorAll("[data-modal-close]").forEach(btn => {
        btn.addEventListener("click", closeModal);
    });

    // Закрытие по клику на оверлей
    overlay.addEventListener("click", closeModal);

    // Закрытие по Esc
    document.addEventListener("keydown", e => {
        if (e.key === "Escape") closeModal();
    });
}
