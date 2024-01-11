@extends("web.layouts.index")
@section("style")
    <link href="{{ asset("assets/web/css/pages/login.min.css") }}" rel="stylesheet">
@endsection
@section("content")
    <main class="py-5">
        <div class="container">
            <section class="login-page" data-aos="flip-down">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="login-page-image">
                            <img src="{{ asset('assets/web/images/login.svg') }}" alt="Login Page Image">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="login-form-section">
                            <div class="header">
                                <h1 class="title">Login</h1>
                                <p class="description">Access to the most powerful tool in the entire design and web
                                    industry.</p>
                            </div>
                            <div class="login-form">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="list-group list-unstyled">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('login.index') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-group justify-content-center mb-3">
                                                <span class="input-group-text"><span
                                                        class="material-icons-outlined">email</span></span>
                                                <div class="form-floating">
                                                    <input type="email" name="email" id="email" class="form-control"
                                                           placeholder="Email" required
                                                           value="{{ old('email') ?? '' }}">
                                                    <label for="email">Email</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group justify-content-center mb-3">
                                                <span class="input-group-text"><span
                                                        class="material-icons-outlined">lock</span></span>
                                                <div class="form-floating">
                                                    <input type="password" name="password" id="password"
                                                           class="form-control" placeholder="Password" required>
                                                    <label for="password">Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-5 text-center">
                                                <p class="social-list-description">Or sign in with</p>
                                                <ul class="social-list list-unstyled list-group list-group-horizontal">
                                                    <li>
                                                        <a href="#" class="google">
                                                            <i class="fa-brands fa-google"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="facebook">
                                                            <i class="fa-brands fa-facebook"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="twitter">
                                                            <i class="fa-brands fa-twitter"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="github">
                                                            <i class="fa-brands fa-github"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3 d-flex justify-content-center">
                                                <button type="submit" class="btn btn-login">
                                                    <span class="material-icons-outlined">login</span>Sign In
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
@section("scripts")

@endsection
