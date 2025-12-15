<h2>Login</h2>

<form method="POST" action="/login">
    <label>
        Email:<br>
        <input type="email" name="email" required>
    </label><br><br>

    <label>
        Hasło:<br>
        <input type="password" name="password" required>
    </label><br><br>

    <button type="submit">Zaloguj</button>
</form>

<?php
echo password_hash('admin123', PASSWORD_DEFAULT);


