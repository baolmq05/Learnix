const openModalBtn = document.getElementById("openModalBtn");
    const cancelBtn = document.getElementById("cancelBtn");
    const modal = document.getElementById("modal-id");

    // Mở modal
    openModalBtn.addEventListener("click", () => {
        modal.classList.remove("hidden");
    });

    // Đóng modal khi nhấn Cancel hoặc click ra ngoài
    cancelBtn.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.classList.add("hidden");
        }
    });