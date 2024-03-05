@extends("admin.layouts.index")
@section("style")
    <link href="{{ asset("assets/plugins/fontawesome/css/all.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/plugins/jquery-ui/jquery-ui.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/admin/css/sortable-list.min.css") }}" rel="stylesheet">
    <style>
        .social-media-form .form-group .input-group .input-group-social-icon {
            flex: 1;
            justify-content: center;
            font-size: 20px;
        }

        .social-media-form .form-group .input-group .input-group-social-name {
            flex: 3;
        }

        .social-media-form .form-group .input-group .input-group-social-input {
            flex: 20;
        }
    </style>
@endsection
@section("content")
    <div class="row">
        <div class="col-12">
            <x-admin.card>
                <x-slot name="header">
                    <h1 class="card-title">{{ $title }}</h1>
                </x-slot>
                <x-slot name="body">
                    <p class="card-description">We offer some different custom styles for input fields to make your
                        forms more beautiful.</p>
                    <div class="example-container">
                        <div class="example-content">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="m-0 p-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('admin.social.media.index') }}" method="POST"
                                  class="social-media-form">
                                @csrf
                                <div class="sortable-list">
                                    @foreach($records as $item)
                                        <div class="form-group mb-3 sortable-item">
                                            <div class="input-group">
                                                <span class="input-group-text input-group-sort">
                                                    <i class="fa-solid fa-sort"></i></span>
                                                <span
                                                    class="input-group-text input-group-social-icon">{!! $item->icon !!}</span>
                                                <span
                                                    class="input-group-text input-group-social-name">{{ $item->name }}</span>
                                                <input type="hidden" name="socialMedia[{{ $item->id }}][name]"
                                                       value="{{ $item->name }}">
                                                <input type="text" name="socialMedia[{{ $item->id }}][link]"
                                                       class="form-control input-group-social-input"
                                                       value="{{ $item->link ?? '' }}">
                                                <div class="input-group-text">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="status"
                                                               name="socialMedia[{{ $item->id }}][status]" {{ !empty($item->status) ? 'checked' : '' }}>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="socialMedia[{{ $item->id }}][sort]"
                                                       class="sort" value="{{ $item->sort }}">
                                            </div>
                                            @if(!empty($item->description))
                                                <p class="form-label ms-3 mb-0">{{ $item->description }}</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <div class="d-grid gap-2 col-lg-4 mx-auto">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </x-slot>
            </x-admin.card>
        </div>
    </div>
@endsection
@section("scripts")
    <script src="{{ asset("assets/plugins/jquery-ui/jquery-ui.min.js") }}"></script>
    <script src="{{ asset('assets/admin/js/sortable-list.js') }}"></script>
@endsection
