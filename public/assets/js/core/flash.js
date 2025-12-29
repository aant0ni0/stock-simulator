export function initFlash() {
    const flashes = document.querySelectorAll(".flash");
    flashes.forEach(flash => {
        setTimeout(() => flash.classList.add("hide"), 3500);
        setTimeout(() => flash.remove(), 4000);
    });
}
