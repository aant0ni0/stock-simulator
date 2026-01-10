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


    const input = document.getElementById("assetSearch");
    if (!input) return;

    const rows = document.querySelectorAll(".asset-row");

    input.addEventListener("input", () => {
       const query = input.value.toLowerCase().trim();

       rows.forEach(row =>{
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(query) ? "" : "none";
       })
    });
}
