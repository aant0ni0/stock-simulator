<div class="auth-card">
    <div class="auth-logo">📈</div>

    <h1 class="auth-title">Stock Market Simulator</h1>
    <p class="auth-subtitle">Sign in to your account to continue</p>

    <form method="POST" action="/login" class="auth-form">
        <label>
            Email
            <input type="email" name="email" placeholder="you@example.com" required>
        </label>

        <label>
            Password
            <input type="password" name="password" required>
        </label>

        <button type="submit" class="btn-primary">Sign in</button>
    </form>

    <p class="auth-footer">
        Don’t have an account?
        <a href="/register">Sign up</a>
    </p>
</div>
