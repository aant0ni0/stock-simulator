<h2>Portfolio</h2>
<p>Your investments and performance</p>

<!-- KAFELKI PODSUMOWANIA -->
<div>
    <p><strong>Total Value:</strong> $<?= number_format($totalValue, 2) ?></p>
    <p><strong>Cash Balance:</strong> $<?= number_format($cash, 2) ?></p>
    <p><strong>Holdings Value:</strong> $<?= number_format($holdingsValue, 2) ?></p>
    <p>
        <strong>Total P&amp;L:</strong>
        <?= $totalPnL >= 0 ? '+' : '' ?>$<?= number_format($totalPnL, 2) ?>
    </p>
</div>

<hr>

<h3>Your Holdings</h3>

<?php if (empty($holdings)): ?>
    <p>You do not own any assets yet.</p>
<?php else: ?>

    <table border="1" cellpadding="5">
        <tr>
            <th>Asset</th>
            <th>Quantity</th>
            <th>Avg. Price</th>
            <th>Current Price</th>
            <th>Total Value</th>
            <th>Profit / Loss</th>
            <th>P&amp;L %</th>
            <th>Sell</th>
        </tr>

        <?php foreach ($holdings as $h):
            $total = $h['quantity'] * $h['current_price'];
            $pnl = ($h['current_price'] - $h['avg_price']) * $h['quantity'];
            $pnlPct = ($h['avg_price'] > 0)
                    ? ($pnl / ($h['avg_price'] * $h['quantity'])) * 100
                    : 0;
            ?>
            <tr>
                <td><?= htmlspecialchars($h['symbol']) ?></td>
                <td><?= (float)$h['quantity'] ?></td>
                <td>$<?= number_format($h['avg_price'], 2) ?></td>
                <td>$<?= number_format($h['current_price'], 2) ?></td>
                <td>$<?= number_format($total, 2) ?></td>
                <td>
                    <?= $pnl >= 0 ? '+' : '' ?>$<?= number_format($pnl, 2) ?>
                </td>
                <td>
                    <?= $pnl >= 0 ? '+' : '' ?><?= number_format($pnlPct, 2) ?>%
                </td>
                <td>
                    <form method="POST" action="/sell">
                        <input type="hidden" name="stock_id" value="<?= (int)$h['stock_id'] ?>">
                        <input
                                type="number"
                                name="quantity"
                                min="1"
                                max="<?= (int)$h['quantity'] ?>"
                                required
                        >
                        <button type="submit">Sell</button>
                    </form>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>

<?php endif; ?>
