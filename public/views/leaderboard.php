<h2>Leaderboard</h2>
<p>Top traders ranked by portfolio value</p>

<table border="1" cellpadding="5">
    <tr>
        <th>Rank</th>
        <th>Username</th>
        <th>Portfolio Value</th>
        <th>24 Change</th>
    </tr>

    <?php foreach ($leaders as $index => $user): ?>
        <tr <?php if ($user['id'] == $currentUserId) echo 'style="background:#eef"'; ?>>
            <td><?= $index + 1 ?></td>
            <td>
                <?= htmlspecialchars($user['email']) ?>
                <?php if ($user['id'] == $currentUserId): ?>
                    <strong>(You)</strong>
                <?php endif; ?>
            </td>
            <td>$<?= number_format($user['total_value'], 2) ?></td>
            <td>
                <?php
                $change = $user['change_24h'];
                $sign = $change >= 0 ? '+' : '';
                ?>
                <span style="color: <?= $change >= 0 ? 'green' : 'red' ?>">
                    <?= $sign . number_format($change, 2) ?>%
                </span>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


