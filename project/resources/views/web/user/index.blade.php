@extends("web.layouts.index")
@section("style")
    <link href="{{ asset('assets/web/css/pages/user-profile.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/summernote/summernote-lite.min.css') }}" rel="stylesheet">
@endsection
@section("content")
    <main class="py-5">
        <div class="container">
            <x-web.errors :errors="$errors"></x-web.errors>
            <form action="{{ route('user.profile.edit', ['user' => $user->id]) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="card user-profile-card mb-3">
                    <div class="card-header">
                        <h1 class="card-title">Profile</h1>
                        <p class="card-text">Settings for your personal profile</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if(!empty($user->oauth_type))
                                <div class="col-12">
                                    <div class="user-oauth-section mb-3">
                                        <div class="icon">
                                            <i class="fa-brands fa-{{ $user->oauth_type }}"></i>
                                        </div>
                                        <div class="text">
                                            This account is connected to
                                            your {{ \Illuminate\Support\Str::title($user->oauth_type) }} Account. These
                                            changes will only affect your account on this website.
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <x-web.section-author
                                    :authorImage="$user->image"
                                    :authorName="$user->name"
                                    :authorTitle="$user->title"
                                    :authorDescription="$user->description"
                                ></x-web.section-author>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="name" id="name" class="form-control"
                                                   placeholder="Full Name"
                                                   value="{{ old('name') ?? ($user->name ?? '') }}" required>
                                            <label for="name">Full Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="email" name="email" id="email" class="form-control"
                                                   placeholder="Email"
                                                   value="{{ old('email') ?? ($user->email ?? '') }}" required>
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="username" id="username" class="form-control"
                                                   placeholder="Username"
                                                   value="{{ old('username') ?? ($user->username ?? '') }}" required>
                                            <label for="username">Username</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="title" id="title" class="form-control"
                                                   placeholder="Title"
                                                   value="{{ old('title') ?? ($user->title ?? '') }}">
                                            <label for="title">Title</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <textarea name="description" id="description"
                                                      class="form-control summernote"
                                                      placeholder="Description">{!! old('description') ?? ($user->description ?? '') !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('user.profile') }}" class="btn btn-link">Cancel</a>
                        <button class="btn btn-primary" type="submit">Save changes</button>
                    </div>
                </div>
            </form>
            <form action="{{ route('user.social.edit', ['user' => $user->id]) }}" method="POST">
                @csrf
                <div class="card user-social-card">
                    <div class="card-header">
                        <h1 class="card-title">Socials</h1>
                        <p class="card-text">Social medias for your personal profile</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="input-group mb-3 website">
                                    <span class="input-group-text"><i class="fa-solid fa-globe"></i></span>
                                    <input type="text" name="website" class="form-control"
                                           value="{{ old('website') ?? ($user->website ?? '') }}"
                                           placeholder="Website">
                                </div>
                            </div>
                            @if(!empty($user->socialsActive))
                                @foreach($user->socialsActive as $item)
                                    @php
                                        $item_social_name = $item->social?->name;
                                        $item_social_name_lowercase = \Illuminate\Support\Str::lower($item_social_name);
                                    @endphp
                                    <div class="col-md-6 col-lg-3">
                                        <div class="input-group mb-3 {{ $item_social_name_lowercase }}">
                                            <span class="input-group-text">
                                                <i class="fa-brands fa-{{ $item_social_name_lowercase }}"></i>
                                            </span>
                                            <input type="hidden" name="socials[{{ $item->id }}][social_id]"
                                                   value="{{ $item->social_id }}">
                                            <input type="hidden" name="socials[{{ $item->id }}][name]"
                                                   value="{{ $item_social_name_lowercase }}">
                                            <input type="text" name="socials[{{ $item->id }}][link]"
                                                   class="form-control" placeholder="{{ $item_social_name }}"
                                                   value="{{ old('socials.'.$item->id.'.link') ?? ($item->link ?? '') }}">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('user.profile') }}" class="btn btn-link">Cancel</a>
                        <button class="btn btn-primary" type="submit">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
@section("scripts")
    <script src="{{ asset('assets/plugins/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/lang/summernote-tr-TR.js') }}"></script>
    <script>
        function change_input_value_live(value, input, method = 'text') {
            if (method == 'text') {
                input.text(value);
            } else if (method == 'val') {
                input.val(value);
            } else if (method == 'html') {
                input.html(value);
            }
        }

        $(document).ready(function () {
            $('.summernote').summernote({
                lang: 'tr-TR',
                toolbar: [
                    ['font', ['bold', 'underline', 'clear']]
                ],
                height: 160,
                /*callbacks: {
                    onChange: function () {
                        var value = $(this).val();
                        var input = $('.author .author-content .description');
                        change_input_value_live(value, input, 'html');
                    }
                }*/
            });
            $('#name').on('input', function () {
                var value = $(this).val();
                var input = $('.author .author-content .name');
                change_input_value_live(value, input);
            });
            $('#title').on('input', function () {
                var value = $(this).val();
                var input = $('.author .author-content .designation');
                change_input_value_live(value, input);
            });
            $("#description").on("summernote.change", function (e) {
                var value = $(this).val();
                var input = $('.author .author-content .description');
                change_input_value_live(value, input, 'html');
            });
        });
    </script>
@endsection
