<section class="portfolio-header">
    <h1>Portfolio</h1>
    <p class="muted">Your investments and performance</p>
</section>

<div class="portfolio-summary">

    <div class="summary-card">
        <div class="summary-icon blue">
            <i data-lucide="wallet"></i>
        </div>
        <div>
            <span class="muted">Total Value</span>
            <strong>$<?= number_format($totalValue, 2) ?></strong>
        </div>
    </div>

    <div class="summary-card">
        <div class="summary-icon green">
            <i data-lucide="dollar-sign"></i>
        </div>
        <div>
            <span class="muted">Cash Balance</span>
            <strong class="success">$<?= number_format($cash, 2) ?></strong>
        </div>
    </div>

    <div class="summary-card">
        <div class="summary-icon purple">
            <i data-lucide="pie-chart"></i>
        </div>
        <div>
            <span class="muted">Holdings Value</span>
            <strong>$<?= number_format($holdingsValue, 2) ?></strong>
        </div>
    </div>

    <div class="summary-card">
        <div class="summary-icon <?= $totalPnL >= 0 ? 'green' : 'red' ?>">
            <i data-lucide="<?= $totalPnL >= 0 ? 'trending-up' : 'trending-down' ?>"></i>
        </div>
        <div>
            <span class="muted">Total P&amp;L</span>
            <strong class="<?= $totalPnL >= 0 ? 'success' : 'danger' ?>">
                <?= $totalPnL >= 0 ? '+' : '' ?>$<?= number_format($totalPnL, 2) ?>
            </strong>
        </div>
    </div>

</div>

<section class="card">
    <h2 class="card-title">Your Holdings</h2>

    <?php if (empty($holdings)): ?>
        <p class="muted">You do not own any assets yet.</p>
    <?php else: ?>

        <table class="portfolio-table">
            <thead>
            <tr>
                <th>Asset</th>
                <th>Quantity</th>
                <th>Avg. Price</th>
                <th>Current Price</th>
                <th>Total Value</th>
                <th>Profit / Loss</th>
                <th>P&amp;L %</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($holdings as $h):
                $quantity = (float)$h['quantity'];
                $avg = (float)$h['avg_price'];
                $current = (float)$h['current_price'];

                $total = $quantity * $current;
                $pnl = ($current - $avg) * $quantity;
                $pnlPct = $avg > 0 ? ($pnl / ($avg * $quantity)) * 100 : 0;
                $isUp = $pnl >= 0;
                ?>

                <tr class="asset-info-row">

                    <td data-label="Asset"><a href="/asset?id=<?= (int)$h['stock_id'] ?>" class="cell-link"><strong><?= htmlspecialchars($h['symbol']) ?></strong></a></td>
                    <td data-label="Quantity"><?= $quantity ?></td>
                    <td data-label="Avg. Price">$<?= number_format($avg, 2) ?></td>
                    <td data-label="Current Price">$<?= number_format($current, 2) ?></td>
                    <td data-label="Total Value">$<?= number_format($total, 2) ?></td>
                    <td data-label="Profit / Loss" class="<?= $isUp ? 'success' : 'danger' ?>">
                        <?= $isUp ? '+' : '' ?>$<?= number_format($pnl, 2) ?>
                    </td>
                    <td data-label="P&L %">
        <span class="pnl-badge <?= $isUp ? 'up' : 'down' ?>">
            <?= $isUp ? '+' : '' ?><?= number_format($pnlPct, 2) ?>%
        </span>
                    </td>
                    <td data-label="Action">
                        <form method="POST" action="/sell" class="sell-form">
                            <input type="hidden" name="stock_id" value="<?= (int)$h['stock_id'] ?>">
                            <input type="number" name="quantity" step="1" min="1" max="<?= $quantity ?>" required>
                            <button type="submit" class="btn btn-sell">Sell</button>
                        </form>
                    </td>

                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>
</section>
