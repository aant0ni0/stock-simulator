<h2>Dashboard</h2>

<p>
    Cash Balance:
    <strong>$<?= number_format($cash, 2) ?></strong>
</p>

<hr>

<h3>Market</h3>

<?php if (empty($stocks)): ?>
    <p>No assets available.</p>
<?php else: ?>

    <?php foreach ($stocks as $s): ?>
        <div style="margin-bottom:10px;">
            <strong><?= htmlspecialchars($s['symbol']) ?></strong>
            <?= htmlspecialchars($s['name']) ?> –
            $<?= number_format($s['price'], 2) ?>

            <button
                    class="trade-btn"
                    data-action="buy"
                    data-stock-id="<?= (int)$s['id'] ?>"
                    data-symbol="<?= htmlspecialchars($s['symbol']) ?>"
                    data-name="<?= htmlspecialchars($s['name']) ?>"
                    data-price="<?= number_format($s['price'], 2) ?>"
            >
                Buy
            </button>

            <button
                    class="trade-btn"
                    data-action="sell"
                    data-stock-id="<?= (int)$s['id'] ?>"
                    data-symbol="<?= htmlspecialchars($s['symbol']) ?>"
                    data-name="<?= htmlspecialchars($s['name']) ?>"
                    data-price="<?= number_format($s['price'], 2) ?>"
            >
                Sell
            </button>
        </div>
    <?php endforeach; ?>

    <h3>Quick Trade</h3>

    <form method="POST" action="/trade" id="quickTradeForm">
        <input type="hidden" name="stock_id" id="qt_stock_id">
        <input type="hidden" name="action" id="qt_action">

        <p>
            <strong id="qt_name">Select an asset</strong><br>
            Price: $<span id="qt_price">–</span>
        </p>

        <label>
            Quantity:
            <input type="number" name="quantity" step="0.01" min="0.01" required>
        </label>

        <br><br>

        <button type="submit" id="qt_submit" disabled>
            Execute
        </button>
    </form>



<?php endif; ?>


<script>
    document.querySelectorAll('.trade-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const stockId = btn.dataset.stockId;
            const symbol  = btn.dataset.symbol;
            const name    = btn.dataset.name;
            const price   = btn.dataset.price;
            const action  = btn.dataset.action;

            document.getElementById('qt_stock_id').value = stockId;
            document.getElementById('qt_action').value = action;

            document.getElementById('qt_name').innerText =
                `${symbol} – ${name}`;

            document.getElementById('qt_price').innerText = price;

            document.getElementById('qt_submit').disabled = false;
            document.getElementById('qt_submit').innerText =
                `${action.toUpperCase()}`;
        });
    });
</script>
