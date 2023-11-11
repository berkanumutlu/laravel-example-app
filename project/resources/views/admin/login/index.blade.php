@extends("layouts.auth")
@section("head")

@endsection
@section("content")
    <div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
        <div class="app-auth-background">

        </div>
        <div class="app-auth-container">
            <div class="logo">
                <a href="javascript:;" rel="nofollow">Login - Admin Panel</a>
            </div>
            <p class="auth-description">Please sign-in to your account and continue to the admin dashboard.</p>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="m-0 p-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.login.index') }}" method="POST">
                @csrf
                <div class="auth-credentials m-b-xxl">
                    <label for="signInEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control m-b-md" id="signInEmail" aria-describedby="signInEmail"
                           placeholder="example@example.com" name="email" value="{{ old('email') }}">
                    <label for="signInPassword" class="form-label">Password</label>
                    <input type="password" class="form-control m-b-md" id="signInPassword" name="password"
                           aria-describedby="signInPassword"
                           placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="signInRememberMe"
                               name="remember_me" {{ old('remember_me') ? 'checked' : '' }}>
                        <label class="form-check-label" for="signInRememberMe">Remember me</label>
                    </div>
                </div>
                <div class="auth-submit">
                    <button type="submit" class="btn btn-primary">Sign In</button>
                </div>
                <div class="divider"></div>
            </form>
        </div>
    </div>
@endsection
@section("scripts")

@endsection
