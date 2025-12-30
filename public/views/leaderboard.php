<section class="leaderboard-header">
    <h1>Leaderboard</h1>
    <p class="muted">Top traders ranked by portfolio value</p>
</section>

<div class="leaderboard-top">
    <?php foreach (array_slice($leaders, 0, 3) as $i => $user): ?>
        <?php
        $rank = $i + 1;
        $change = (float)$user['change_24h'];
        $isUp = $change >= 0;
        ?>
        <div class="top-card rank-<?= $rank ?>">
            <div class="top-rank">
                <?= $rank === 1 ? '🏆' : ($rank === 2 ? '🥈' : '🥉') ?>
            </div>

            <strong class="top-name">
                <?= htmlspecialchars($user['email']) ?>
            </strong>

            <div class="top-value">
                $<?= number_format($user['total_value'], 2) ?>
            </div>

            <div class="<?= $isUp ? 'up' : 'down' ?>">
                <?= $isUp ? '▲ +' : '▼ ' ?>
                <?= number_format($change, 2) ?>%
            </div>
        </div>
    <?php endforeach; ?>
</div>

<section class="card">
    <h2 class="card-title">All Rankings</h2>

    <table class="leaderboard-table">
        <thead>
        <tr>
            <th>Rank</th>
            <th>User</th>
            <th>Portfolio Value</th>
            <th>24h Change</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($leaders as $index => $user):
            $rank = $index + 1;
            $change = (float)$user['change_24h'];
            $isYou = $user['id'] == $currentUserId;
            ?>
            <tr class="<?= $isYou ? 'you-row' : '' ?>">
                <td>
                    <?= $rank <= 3 ? '🏅' : '#' . $rank ?>
                </td>

                <td>
                    <?= htmlspecialchars($user['email']) ?>
                    <?php if ($isYou): ?>
                        <span class="you-badge">You</span>
                    <?php endif; ?>
                </td>

                <td>
                    $<?= number_format($user['total_value'], 2) ?>
                </td>

                <td class="<?= $change >= 0 ? 'success' : 'danger' ?>">
                    <?= $change >= 0 ? '+' : '' ?>
                    <?= number_format($change, 2) ?>%
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</section>
