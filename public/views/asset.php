
<?php
$chartData = array_map(fn($row) => [
        'x' => $row['created_at'],
        'y' => (float)$row['price']
], $history);
?>

<section class="asset-header">
    <div class="asset-navigation">
        <a href="/dashboard" class="back-link">
            <i data-lucide="arrow-left"></i>
            Back to Dashboard
        </a>
    </div>

    <div class="asset-info-group">
        <div class="asset-title">
            <div class="asset-icon">
                <?= strtoupper($asset['symbol'][0]) ?>
            </div>
            <div>
                <h1><?= htmlspecialchars($asset['name']) ?></h1>
                <span class="muted"><?= htmlspecialchars($asset['symbol']) ?></span>
            </div>
        </div>

        <div class="asset-price">
            <strong>$<?= number_format($asset['price'], 2) ?></strong>
            <span class="<?= $change24h >= 0 ? 'up' : 'down' ?>">
            <?= $change24h >= 0 ? '▲' : '▼' ?>
                <?= number_format($change24h, 2) ?>% (24h)
        </span>
        </div>
    </div>


</section>

<div class="asset-grid">

    <section class="card">
        <h2 class="card-title">Price History (30 days)</h2>
        <canvas id="priceChart"></canvas>
    </section>

    <section class="card">
        <h2 class="card-title">Trade <?= htmlspecialchars($asset['symbol']) ?></h2>

        <div class="trade-price">
            <span class="muted">Current Price</span>
            <strong>$<?= number_format($asset['price'], 2) ?></strong>
        </div>

        <form method="POST" action="/trade" class="trade-form">
            <input type="hidden" name="stock_id" value="<?= (int)$asset['id'] ?>">

            <label>
                Quantity
                <input type="number" name="quantity" step="0.01" min="0.01" required>
            </label>

            <button type="submit" name="action" value="buy" class="btn btn-buy">
                Buy
            </button>
            <button type="submit" name="action" value="sell" class="btn btn-sell">
                Sell
            </button>
        </form>
    </section>

</div>

<script>
    window.chartData = <?= json_encode($chartData) ?>;
</script>


