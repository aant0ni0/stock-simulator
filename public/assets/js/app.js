import { initFlash } from "./core/flash.js";

document.addEventListener("DOMContentLoaded", () => {
    initFlash();

    const page = document.body.dataset.page;
    if (!page) return;

    import(`./pages/${page}.js`)
        .then(m => m.default())
        .catch(() => {});
});
