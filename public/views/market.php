
<h2>Rynek</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>Symbol</th>
        <th>Nazwa</th>
        <th>Cena</th>
    </tr>

    <?php foreach ($stocks as $stock): ?>
        <tr>
            <td><?= htmlspecialchars($stock['symbol']) ?></td>
            <td><?= htmlspecialchars($stock['name']) ?></td>
            <td><?= htmlspecialchars($stock['price']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

