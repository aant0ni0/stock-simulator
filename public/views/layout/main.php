<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock Simulator</title>
</head>
<body>

    <header>
        <h1>Stock Simulator</h1>
        <nav>
            <a href="/login">Login</a>
            <a href="/dashboard">Dashboard</a>
        </nav>
    </header>
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

    <footer>
        <small>© Stock Simulator</small>
    </footer>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const flashes = document.querySelectorAll(".flash");
            flashes.forEach(flash => {
                setTimeout(() => flash.classList.add("hide"), 3500);
                setTimeout(() => flash.remove(), 4000);
            });
        });
    </script>



</body>


</html>