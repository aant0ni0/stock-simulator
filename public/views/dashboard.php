<h2>Dashboard</h2>

<p>Jesteś zalogowany jako:</p>
<pre><?php print_r($_SESSION['user']); ?></pre>

<p>
    Cash Balance:
    <strong>$<?= number_format($cash, 2) ?></strong>
</p>

<a href="/logout">Wyloguj</a>
