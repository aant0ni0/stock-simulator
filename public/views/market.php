<h2>Rynek</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>Symbol</th>
        <th>Nazwa</th>
        <th>Cena</th>
        <th>Kup</th>
    </tr>

    <?php foreach ($stocks as $stock): ?>
        <tr>
            <td><?= htmlspecialchars($stock['symbol']) ?></td>
            <td><?= htmlspecialchars($stock['name']) ?></td>
            <td><?= htmlspecialchars($stock['price']) ?></td>
            <td>
                <form method="POST" action="/buy">
                    <input type="hidden" name="stock_id" value="<?= $stock['id'] ?>">
                    <input type="number" name="quantity" min="1" required>
                    <button type="submit">Kup</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
