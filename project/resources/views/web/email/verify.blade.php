@extends("layouts.email")
@section("head")

@endsection
@section("content")
    <div class="text-center">
        <p class="m-0">Hey <strong>{{ $user->name }}</strong>,<br><br>Thank you for
            joining <strong>{{ $site_name }}</strong>! To
            activate your account and start exploring, please click the verification link below:<br><br><br><br>
            <a href="{{ route('auth.verify.token', ['token' => $token]) }}" class="btn btn-black" target="_blank"
               rel="nofollow">Verify now</a>
            <br><br><br><br><br>Best Regards,<br>{{ $site_name }}
        </p>
    </div>
@endsection
