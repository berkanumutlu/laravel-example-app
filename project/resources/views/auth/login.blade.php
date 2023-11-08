@extends("layouts.auth")
@section("head")

@endsection
@section("content")
    <div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
        <div class="app-auth-background">

        </div>
        <div class="app-auth-container">
            <div class="logo">
                <a href="#">Login</a>
            </div>
            <p class="auth-description">Please sign-in to your account and continue to the dashboard.<br>Don't have an
                account? <a href="#">Sign Up</a></p>
            <form action="">
                <div class="auth-credentials m-b-xxl">
                    <label for="signInEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control m-b-md" id="signInEmail" aria-describedby="signInEmail"
                           placeholder="example@example.com" name="email">
                    <label for="signInPassword" class="form-label">Password</label>
                    <input type="password" class="form-control m-b-md" id="signInPassword" name="password"
                           aria-describedby="signInPassword"
                           placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="signInRememberMe" name="remember_me">
                        <label class="form-check-label" for="signInRememberMe">Remember me</label>
                    </div>
                </div>
                <div class="auth-submit">
                    <button type="submit" class="btn btn-primary">Sign In</button>
                    <a href="#" class="auth-forgot-password float-end">Forgot password?</a>
                </div>
                <div class="divider"></div>
                <div class="auth-alts">
                    <a href="#" class="auth-alts-google"></a>
                    <a href="#" class="auth-alts-facebook"></a>
                    <a href="#" class="auth-alts-twitter"></a>
                </div>
            </form>
        </div>
    </div>
@endsection
@section("scripts")

@endsection
