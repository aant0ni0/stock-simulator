<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Simulator</title>

    <link rel="icon" href="/assets/images/icon.png" type="image/png">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body data-page="<?= $page ?? '' ?>">

<div class="app-layout">

    <aside class="sidebar">
        <div class="sidebar-top">
            <div class="logo">
                <img src="/assets/images/icon.png" alt="Stock Simulator" class="logo-icon">
                <div>
                    <strong>Stock Simulator</strong>
                    <small>Trading Platform</small>
                </div>
            </div>

            <nav class="nav">
                <a href="/dashboard" class="nav-item <?= ($page ?? '') === 'dashboard' ? 'active' : '' ?>">Dashboard</a>
                <a href="/portfolio"  class="nav-item <?= ($page ?? '') === 'portfolio'  ? 'active' : '' ?>">Portfolio</a>
                <a href="/leaderboard"class="nav-item <?= ($page ?? '') === 'leaderboard'? 'active' : '' ?>">Leaderboard</a>
            </nav>

        </div>

        <div class="sidebar-bottom">
            <a href="/logout" class="logout">Logout</a>
        </div>
    </aside>

    <div class="content">

        <?php if (!empty($_SESSION['flash'])): ?>
            <div class="flash-container">
                <?php foreach (Flash::getAll() as $f): ?>
                    <div class="flash <?= htmlspecialchars($f['type']) ?>">
                        <?= htmlspecialchars($f['message']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <main>
            <?php require $content; ?>
        </main>

    </div>

</div>

<script type="module" src="/assets/js/app.js"></script>
</body>
</html>
