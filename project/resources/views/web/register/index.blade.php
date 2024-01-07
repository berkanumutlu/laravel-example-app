@extends("web.layouts.index")
@section("style")
    <link href="{{ asset("assets/web/css/pages/register.min.css") }}" rel="stylesheet">
@endsection
@section("content")
    <main class="py-5">
        <div class="container">
            <section class="register-page" data-aos="flip-down">
                <div class="row">
                    <div class="col-xl-7">
                        <div class="register-page-image">
                            <img src="{{ asset('assets/web/images/register.svg') }}" alt="Register Page Image">
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="register-form-section">
                            <form action="#" method="POST" class="register-form">
                                @csrf
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><span
                                            class="material-icons-outlined">person</span></span>
                                    <div class="form-floating">
                                        <input type="text" name="fullname" id="fullname" class="form-control"
                                               placeholder="Fullname" required>
                                        <label for="fullname">Fullname</label>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><span
                                            class="material-icons-outlined">email</span></span>
                                    <div class="form-floating">
                                        <input type="email" name="email" id="email" class="form-control"
                                               placeholder="Email" required>
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><span
                                            class="material-icons-outlined">alternate_email</span></span>
                                    <div class="form-floating">
                                        <input type="text" name="username" id="username" class="form-control"
                                               placeholder="Username" required>
                                        <label for="username">Username</label>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><span
                                            class="material-icons-outlined">lock</span></span>
                                    <div class="form-floating">
                                        <input type="password" name="password" id="password" class="form-control"
                                               placeholder="Password" required>
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><span
                                            class="material-icons-outlined">sync_lock</span></span>
                                    <div class="form-floating">
                                        <input type="password" name="password_confirm" id="password_confirm"
                                               class="form-control" placeholder="Confirm Password" required>
                                        <label for="password">Confirm Password</label>
                                    </div>
                                </div>
                                <div class="mb-3 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-register"><i class="material-icons-outlined">check</i>Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
@section("scripts")

@endsection
