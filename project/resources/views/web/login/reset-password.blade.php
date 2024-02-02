@extends("web.layouts.index")
@section("style")
    <link href="{{ asset("assets/web/css/pages/reset-password.min.css") }}" rel="stylesheet">
@endsection
@section("content")
    <main class="py-5">
        <div class="container">
            <section class="reset-password-page" data-aos="flip-down">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="reset-password-page-image">
                            <img src="{{ asset('assets/web/images/reset-password.svg') }}"
                                 alt="Reset Password Page Image">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="reset-password-form-section">
                            <div class="header mb-3">
                                <h1 class="title">Reset Password</h1>
                                <p class="description">Access to the most powerful tool in the entire design and web
                                    industry.</p>
                            </div>
                            <div class="reset-password-form">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="list-group list-unstyled">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('reset.password') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-group justify-content-center mb-4">
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
                                            <div class="mb-3 d-flex justify-content-center">
                                                <button type="submit" class="btn btn-reset-password">
                                                    <span class="material-icons-outlined">lock_reset</span>Reset
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
