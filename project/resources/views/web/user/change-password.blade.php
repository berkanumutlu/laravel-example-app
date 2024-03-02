@extends("web.layouts.index")
@section("style")
    <link href="{{ asset('assets/web/css/pages/change-password.min.css') }}" rel="stylesheet">
@endsection
@section("content")
    <main class="py-5">
        <div class="container">
            <x-web.errors :errors="$errors"></x-web.errors>
            <form action="{{ route('user.change.password.edit', ['user' => $user->id]) }}" method="POST">
                @csrf
                <div class="card user-change-password-card">
                    <div class="card-header">
                        <h1 class="card-title">Change Password</h1>
                        <p class="card-text">Change your profile password.</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="password" name="current_password" id="current_password"
                                           class="form-control" placeholder="Current Password" required>
                                    <label for="current_password">Current Password</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="password" name="new_password" id="new_password"
                                           class="form-control" placeholder="New Password" required>
                                    <label for="new_password">New Password</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="password" name="new_password_confirmation"
                                           id="new_password_confirmation" class="form-control"
                                           placeholder="Confirm New Password" required>
                                    <label for="new_password_confirmation">Confirm New Password</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('user.change.password') }}" class="btn btn-link">Cancel</a>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
@section("scripts")

@endsection
