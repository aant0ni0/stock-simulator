<h2>Mój portfel</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>Symbol</th>
        <th>Ilość</th>
        <th>Sprzedaj</th>
    </tr>

    <?php foreach ($portfolio as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['symbol']) ?></td>
            <td><?= (int)$row['quantity'] ?></td>
            <td>
                <form method="POST" action="/sell">
                    <input type="hidden" name="stock_id" value="<?= (int)$row['stock_id'] ?>">
                    <input type="number" name="quantity" min="1" max="<?= (int)$row['quantity'] ?>" required>
                    <button type="submit">Sprzedaj</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

