@extends("web.layouts.index")
@section("style")
    <link href="{{ asset("assets/web/css/pages/register.min.css") }}" rel="stylesheet">
@endsection
@section("content")
    <main class="py-5">
        <div class="container">
            <section class="register-page" data-aos="flip-down">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="register-page-image">
                            <img src="{{ asset('assets/web/images/register.svg') }}" alt="Register Page Image">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="register-form-section">
                            <div class="header">
                                <h1 class="title">Register</h1>
                                <p class="description">Access to the most powerfull tool in the entire design and web
                                    industry.</p>
                            </div>
                            <div class="register-form">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="list-group list-unstyled">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-group input-group-full-name mb-3">
                                                <span class="input-group-text"><span
                                                        class="material-icons-outlined">person</span></span>
                                                <div class="form-floating form-floating-first-name">
                                                    <input type="text" name="first_name" id="first_name"
                                                           class="form-control" placeholder="First Name" required
                                                           value="{{ old('first_name') ?? '' }}">
                                                    <label for="first_name">First Name</label>
                                                </div>
                                                <div class="form-floating form-floating-last-name">
                                                    <input type="text" name="last_name" id="last_name"
                                                           class="form-control" placeholder="Last Name" required
                                                           value="{{ old('last_name') ?? '' }}">
                                                    <label for="last_name">Last Name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="input-group mb-3">
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
                                        <div class="col-xl-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><span
                                                        class="material-icons-outlined">alternate_email</span></span>
                                                <div class="form-floating">
                                                    <input type="text" name="username" id="username"
                                                           class="form-control" placeholder="Username" required
                                                           value="{{ old('username') ?? '' }}">
                                                    <label for="username">Username</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><span
                                                        class="material-icons-outlined">lock</span></span>
                                                <div class="form-floating">
                                                    <input type="password" name="password" id="password"
                                                           class="form-control" placeholder="Password" required>
                                                    <label for="password">Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="input-group mb-4">
                                                <span class="input-group-text"><span
                                                        class="material-icons-outlined">sync_lock</span></span>
                                                <div class="form-floating">
                                                    <input type="password" name="password_confirmation"
                                                           id="password_confirmation"
                                                           class="form-control" placeholder="Confirm Password" required>
                                                    <label for="password_confirmation">Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3 d-flex justify-content-center">
                                                <button type="submit" class="btn btn-register">
                                                    <i class="material-icons-outlined">check</i>Sign In
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
