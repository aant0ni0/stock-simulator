<h2>Historia transakcji</h2>

<?php if (empty($transactions)): ?>
    <p>Brak transakcji.</p>
<?php else: ?>
    <table border="1" cellpadding="5">
        <tr>
            <th>Typ</th>
            <th>Akcja</th>
            <th>Ilość</th>
            <th>Cena</th>
            <th>Data</th>
        </tr>

        <?php foreach ($transactions as $t): ?>
            <tr>
                <td><?= htmlspecialchars($t['type']) ?></td>
                <td><?= htmlspecialchars($t['symbol']) ?></td>
                <td><?= (int)$t['quantity'] ?></td>
                <td><?= number_format((float)$t['price'], 2) ?></td>
                <td><?= htmlspecialchars($t['created_at']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

