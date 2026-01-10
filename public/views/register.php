<div class="auth-card">
    <div class="auth-logo">
        <img src="/assets/images/icon.png" alt="Stock Simulator" class="login-logo-icon">
    </div>

    <h1 class="auth-title">Create account</h1>
    <p class="auth-subtitle">Start your trading journey</p>

    <form method="POST" action="/register" class="auth-form" novalidate>
        <label>
            Email
            <input type="email" name="email" placeholder="you@example.com">
        </label>

        <label>
            Password
            <input type="password" name="password1" placeholder="Min. 6 characters">
        </label>

        <label>
            Repeat password
            <input type="password" name="password2">
        </label>

        <label>
            First name
            <input type="text" name="firstname">
        </label>

        <label>
            Last name
            <input type="text" name="lastname">
        </label>

        <button type="submit" class="btn-primary">Create account</button>
    </form>


    <p class="auth-footer">
        Already have an account?
        <a href="/login">Sign in</a>
    </p>
</div>



