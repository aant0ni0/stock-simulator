<h2><?= htmlspecialchars($asset['name']) ?> (<?= htmlspecialchars($asset['symbol']) ?>)</h2>
<p>Current price: $<?= number_format($asset['price'], 2) ?></p>

<canvas id="priceChart" width="700" height="300"></canvas>

<?php
$prices = array_column($history, 'price');
$labels = array_map(
    fn($d) => date('d M', strtotime($d)),
    array_column($history, 'created_at')
);
?>

<script>
    const prices = <?= json_encode($prices) ?>;
    const labels = <?= json_encode($labels) ?>;
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('priceChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                data: prices,
                borderColor: '#2563eb',
                backgroundColor: 'transparent',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: false }
            }
        }
    });
</script>

<h3>Trade <?= htmlspecialchars($asset['symbol']) ?></h3>

<form method="POST" action="/trade">
    <input type="hidden" name="stock_id" value="<?= (int)$asset['id'] ?>">

    <label>
        Quantity:
        <input type="number" name="quantity" step="0.01" min="0.01" required>
    </label>

    <br><br>

    <button type="submit" name="action" value="buy">Buy</button>
    <button type="submit" name="action" value="sell">Sell</button>
</form>

