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
                                <form action="#" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-group input-group-full-name mb-3">
                                                <span class="input-group-text"><span
                                                        class="material-icons-outlined">person</span></span>
                                                <div class="form-floating form-floating-first-name">
                                                    <input type="text" name="first_name" id="first_name"
                                                           class="form-control" placeholder="First Name" required>
                                                    <label for="first_name">First Name</label>
                                                </div>
                                                <div class="form-floating form-floating-last-name">
                                                    <input type="text" name="last_name" id="last_name"
                                                           class="form-control" placeholder="Last Name" required>
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
                                                           placeholder="Email" required>
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
                                                           class="form-control" placeholder="Username" required>
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
                                                    <input type="password" name="password_confirm" id="password_confirm"
                                                           class="form-control" placeholder="Confirm Password" required>
                                                    <label for="password_confirm">Confirm Password</label>
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
