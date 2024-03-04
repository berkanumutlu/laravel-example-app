@extends("admin.layouts.index")
@section("style")
    <link href="{{ asset("assets/plugins/fontawesome/css/all.min.css") }}" rel="stylesheet">
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
                                @foreach($records as $item)
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span
                                                class="input-group-text input-group-social-icon">{!! $item->icon !!}</span>
                                            <span
                                                class="input-group-text input-group-social-name">{{ $item->name }}</span>
                                            <input type="text" name="socialMedia[{{ $item->id }}][{{ $item->name }}]"
                                                   class="form-control input-group-social-input"
                                                   value="{{ $item->link ?? '' }}">
                                        </div>
                                        @if(!empty($item->description))
                                            <p class="form-label ms-3 mb-0">{{ $item->description }}</p>
                                        @endif
                                    </div>
                                @endforeach
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

@endsection
