export default function initDashboard() {
    const buttons = document.querySelectorAll(".trade-btn");

    const stockIdInput= document.getElementById("qt_stock_id");
    const actionInput= document.getElementById("qt_action");
    const nameEl = document.getElementById("qt_name");
    const priceEl = document.getElementById("qt_price");
    const submitBtn = document.getElementById("qt_submit");

    if (!buttons.length) return;

    buttons.forEach(btn => {
        btn.addEventListener("click", () => {
            stockIdInput.value = btn.dataset.stockId;
            actionInput.value = btn.dataset.action;

            nameEl.textContent =
                `${btn.dataset.symbol} – ${btn.dataset.name}`;

            priceEl.textContent = btn.dataset.price;

            submitBtn.disabled = false;
            if (btn.dataset.action === "sell") {
                submitBtn.textContent = "Execute Sell Order";
                submitBtn.style.backgroundColor = "#ef4444";

            }
            else {
                submitBtn.textContent = "Execute Buy Order";
                submitBtn.style.backgroundColor = "#16a34a";
            }
        });
    });
}
