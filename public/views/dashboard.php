<section class="dashboard-header">
    <div>
        <h1>Market Dashboard</h1>
        <p class="muted">Live asset prices and trading</p>
    </div>

    <div class="cash-card">
        <span class="muted">Cash Balance</span>
        <strong class="cash-value">
            $<?= number_format($cash, 2) ?>
        </strong>
    </div>
</section>

<div class="dashboard-grid">

    <section class="card">
        <h2 class="card-title">Available Assets</h2>

        <div class="asset-search">
            <i data-lucide="search" class="search-icon"></i>
            <input
                    type="text"
                    id="assetSearch"
                    placeholder="Search asset (e.g. AAPL, Tesla…)">
        </div>

        <div class="assets-scroll">

        <?php foreach ($stocks as $s): ?>
            <?php
            $c = $s['change_24h'];
            $isUp = $c >= 0;
            ?>
            <div class="asset-row">
                <a href="/asset?id=<?= $s['id'] ?>" class="asset-row-link">
                <div class="asset-info">
                    <div class="asset-icon">
                        <?= strtoupper($s['symbol'][0]) ?>
                    </div>
                    <div>
                        <strong><?= htmlspecialchars($s['symbol']) ?></strong>
                        <div class="muted"><?= htmlspecialchars($s['name']) ?></div>
                    </div>
                </div>
                </a>

                <div class="asset-price">
                    <strong>$<?= number_format($s['price'], 2) ?></strong>
                    <span class="<?= $isUp ? 'up' : 'down' ?>">
                        <?= $isUp ? '▲' : '▼' ?>
                        <?= number_format($c, 2) ?>%
                    </span>
                </div>

                <div class="asset-actions">
                    <button
                            class="btn btn-buy trade-btn"
                            data-action="buy"
                            data-stock-id="<?= $s['id'] ?>"
                            data-symbol="<?= htmlspecialchars($s['symbol']) ?>"
                            data-name="<?= htmlspecialchars($s['name']) ?>"
                            data-price="<?= number_format($s['price'], 2) ?>"
                    >
                        Buy
                    </button>

                    <button
                            class="btn btn-outline trade-btn"
                            data-action="sell"
                            data-stock-id="<?= $s['id'] ?>"
                            data-symbol="<?= htmlspecialchars($s['symbol']) ?>"
                            data-name="<?= htmlspecialchars($s['name']) ?>"
                            data-price="<?= number_format($s['price'], 2) ?>"
                    >
                        Sell
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </section>

    <section class="card qt-card">
        <h2 class="card-title">Quick Trade</h2>

        <div class="qt-asset">
            <div class="qt-asset-main">
                <span class="qt-symbol" id="qt_name">Select asset</span>
                <span class="qt-price">
                $<span id="qt_price">–</span>
            </span>
            </div>
            <span class="qt-hint">Click any asset on the left</span>
        </div>

        <form method="POST" action="/trade" id="quickTradeForm" class="qt-form">
            <input type="hidden" name="stock_id" id="qt_stock_id">
            <input type="hidden" name="action" id="qt_action">

            <div class="qt-field">
                <label>Quantity</label>
                <input type="number" name="quantity" step="1" min="1" placeholder="Enter amount" required>
            </div>

            <div class="qt-actions">
                <button type="submit" id="qt_submit" class="btn qt-btn" disabled>
                    Execute Trade
                </button>
            </div>
        </form>
    </section>


</div>

<script type="module" src="/assets/js/dashboard.js"></script>

