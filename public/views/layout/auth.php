<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Simulator</title>

    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="icon" href="/assets/images/icon.png" type="image/png">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="auth-body" data-page="<?= $page ?? '' ?>">

<?php if (!empty($_SESSION['flash'])): ?>
    <div class="flash-container">
        <?php foreach (Flash::getAll() as $f): ?>
            <div class="flash <?= htmlspecialchars($f['type']) ?>">
                <?= htmlspecialchars($f['message']) ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<main class="auth-wrapper">
    <?php require $content; ?>
</main>

<script type="module" src="/assets/js/app.js" defer></script>
</body>
</html>
