<div class="auth-card">
    <div class="auth-logo">📈</div>

    <h1 class="auth-title">Create account</h1>
    <p class="auth-subtitle">Start your trading journey</p>

    <form method="POST" action="/register" class="auth-form">
        <label>
            Email
            <input type="email" name="email" required>
        </label>

        <label>
            Password
            <input type="password" name="password" required>
        </label>

        <button type="submit" class="btn-primary">Create account</button>
    </form>

    <p class="auth-footer">
        Already have an account?
        <a href="/login">Sign in</a>
    </p>
</div>
