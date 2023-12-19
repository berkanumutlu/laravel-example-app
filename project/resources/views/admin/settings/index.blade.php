@extends("admin.layouts.index")
@section("style")
    <style>
        .settings-form .form-group .input-group-text {
            min-width: 250px;
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
                            <form action="{{ route('admin.settings.index') }}" method="POST" class="settings-form"
                                  enctype="multipart/form-data">
                                @csrf
                                @foreach($settings as $item)
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text">{{ $item->key_name }}</span>
                                            @switch($item->type)
                                                @case('input-text')
                                                    <input type="text" name="settings[{{ $item->id }}]"
                                                           class="form-control" value="{{ $item->key_value ?? '' }}">
                                                    @break
                                                @case('input-checkbox')
                                                    <div
                                                        class="form-check form-switch form-control mb-0 ps-5 pe-3 flex-grow-0">
                                                        <input type="checkbox" name="settings[{{ $item->id }}]"
                                                               class="form-check-input" style="width: 2.5em;"
                                                            {{ $item->key_value == 1 ? 'checked' : '' }}>
                                                    </div>
                                                    @break
                                                @case('input-image')
                                                    <div class="form-control form-control-solid-bordered">
                                                        <input type="file" name="settings[{{ $item->id }}]"
                                                               accept="image/png, image/jpeg, image/jpg">
                                                        @if(!empty($item->key_value))
                                                            <a href="{{ asset($item->key_value) }}" target="_blank">
                                                                <img src="{{ asset($item->key_value) }}"
                                                                     alt="{{ $item->key_name }}"
                                                                     class="img-fluid m-t-sm" style="max-height: 200px">
                                                            </a>
                                                        @endif
                                                    </div>
                                                    @break
                                                @default
                                                    <input type="text" name="settings[{{ $item->id }}]"
                                                           class="form-control" value="{{ $item->key_value ?? '' }}">
                                            @endswitch
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
