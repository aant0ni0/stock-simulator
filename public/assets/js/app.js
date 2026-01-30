import { initFlash } from "./core/flash.js";

initFlash();

const page = document.body.dataset.page;
if (page) {
    import(`./pages/${page}.js`)
        .then(m => m.default())
        .catch(() => {});
}

if (window.lucide) {
    lucide.createIcons();
}

const sidebar = document.querySelector(".sidebar");
const openBtn = document.getElementById("openSidebar");
const backdrop = document.getElementById("sidebarBackdrop");

if (sidebar && openBtn && backdrop) {
    openBtn.addEventListener("click", () => {
        sidebar.classList.add("sidebar--open");
        backdrop.classList.add("active");
    });

    backdrop.addEventListener("click", () => {
        sidebar.classList.remove("sidebar--open");
        backdrop.classList.remove("active");
    });
}
