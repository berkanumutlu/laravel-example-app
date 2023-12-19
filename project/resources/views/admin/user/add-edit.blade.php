@extends("admin.layouts.index")
@section("style")
    <link href="{{ asset('assets/plugins/summernote/summernote-lite.min.css') }}" rel="stylesheet">
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
                            <form
                                action="{{ isset($record) ? route('admin.user.edit', ['id' => $record->id]) : route('admin.user.add') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="text"
                                       class="form-control form-control-solid-bordered m-b-sm {{ $errors->has('name') ? 'border-danger mb-0' : '' }}"
                                       name="name" placeholder="Full Name" required
                                       value="{{ old('name') ?? ($record->name ?? '') }}">
                                @if($errors->has('name'))
                                    <p>{{ $errors->first('name') }}</p>
                                @endif
                                <input type="text" class="form-control form-control-solid-bordered m-b-sm"
                                       name="email" placeholder="Email" required
                                       value="{{ old('email') ?? ($record->email ?? '') }}">
                                <input type="text" class="form-control form-control-solid-bordered m-b-sm"
                                       name="username" placeholder="Username"
                                       value="{{ old('username') ?? ($record->username ?? '') }}">
                                <input type="password" class="form-control form-control-solid-bordered m-b-sm"
                                       name="password" placeholder="Password" {{ isset($record) ? '' : 'required' }}>
                                <div class="m-b-sm">
                                    <input type="file" name="image" id="image"
                                           class="form-control form-control-solid-bordered"
                                           accept="image/png, image/jpeg, image/jpg">
                                    @if(isset($record) && $record->image)
                                        <a href="{{ asset($record->image) }}" target="_blank">
                                            <img src="{{ asset($record->image) }}" alt="{{ $record->name ?? '' }}"
                                                 class="img-fluid m-t-sm" style="max-height: 200px">
                                        </a>
                                    @endif
                                </div>
                                <input type="text" class="form-control form-control-solid-bordered m-b-sm"
                                       name="title" placeholder="Title"
                                       value="{{ old('title') ?? ($record->title ?? '') }}">
                                <div class="m-b-sm">
                                    <label for="description" class="form-label mb-0">Description</label>
                                    <textarea class="summernote form-control form-control-solid-bordered m-b-sm"
                                              name="description" rows="3"
                                              placeholder="Description">{!! old('description') ?? ($record->description ?? '') !!}</textarea>
                                </div>
                                <hr>
                                <div class="d-grid gap-2 col-lg-6 mx-auto">
                                    <button class="btn btn-primary"
                                            type="submit">{{ isset($record) ? 'Save' : 'Submit' }}</button>
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
    <script src="{{ asset('assets/plugins/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/lang/summernote-tr-TR.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/text-editor.js') }}"></script>
@endsection
