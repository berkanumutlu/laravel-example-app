@extends("admin.layouts.index")
@section("head")
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
                                action="{{ isset($record) ? route('admin.category.edit', ['id' => $record->id]) : route('admin.category.add') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="m-b-sm">
                                    <label for="name" class="form-label mb-0">Name</label>
                                    <input type="text"
                                           class="form-control form-control-solid-bordered m-b-sm {{ $errors->has('name') ? 'border-danger mb-0' : '' }}"
                                           name="name" id="name" placeholder="Category Name" required
                                           value="{{ old('name') ?? ($record->name ?? '') }}">
                                    @if($errors->has('name'))
                                        <p>{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="m-b-sm">
                                    <label for="slug" class="form-label mb-0">Slug</label>
                                    <input type="text" class="form-control form-control-solid-bordered m-b-sm"
                                           name="slug" id="slug" placeholder="Category Slug"
                                           value="{{ old('slug') ?? ($record->slug ?? '') }}">
                                </div>
                                <div class="m-b-sm">
                                    <label for="description" class="form-label mb-0">Description</label>
                                    <textarea class="summernote form-control form-control-solid-bordered m-b-sm"
                                              name="description" id="description" rows="3"
                                              placeholder="Description">{!! old('description') ?? ($record->description ?? '') !!}</textarea>
                                </div>
                                <div class="m-b-sm">
                                    <label for="image" class="form-label mb-0">Image</label>
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
                                <div class="m-b-sm">
                                    <label for="order" class="form-label mb-0">Order</label>
                                    <input type="number" class="form-control form-control-solid-bordered m-b-sm"
                                           name="order" id="order" min="0" placeholder="Order"
                                           value="{{ old('order') ?? ($record->order ?? '') }}">
                                </div>
                                <div class="m-b-sm">
                                    <label for="parent_id" class="form-label mb-0">Parent Category</label>
                                    <select class="form-select m-b-sm bg-light" name="parent_id" id="parent_id"
                                            aria-label="Parent Category">
                                        <option value="{{ null }}">Parent Category</option>
                                        @if(!empty($category_list))
                                            @foreach($category_list as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ (old('parent_id') && old('parent_id') == $item->id) || (isset($record) && $record->parent_id == $item->id) ? 'selected' : '' }}
                                                >{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="m-b-sm d-flex align-items-center">
                                    <label for="color" class="form-label mb-0">Category Color</label>
                                    <input type="color" name="color" id="color" class="ms-2"
                                           value="{{ ($record->color ?? '') }}">
                                </div>
                                <div class="m-b-sm">
                                    <label for="seo_keywords" class="form-label mb-0">SEO Keywords</label>
                                    <textarea class="form-control form-control-solid-bordered m-b-sm"
                                              name="seo_keywords" id="seo_keywords" rows="5"
                                              placeholder="SEO Keywords">{{ old('seo_keywords') ?? ($record->seo_keywords ?? '') }}</textarea>
                                </div>
                                <div class="m-b-sm">
                                    <label for="seo_description" class="form-label mb-0">SEO Description</label>
                                    <textarea class="form-control form-control-solid-bordered m-b-sm"
                                              name="seo_description" id="seo_description" rows="5"
                                              placeholder="SEO Description">{{ old('seo_description') ?? ($record->seo_description ?? '') }}</textarea>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status"
                                           name="status" {{ old('status') || !empty($record->status) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">Status</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="feature_status"
                                           name="feature_status" {{ old('feature_status') || !empty($record->feature_status) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="feature_status">Feature Status</label>
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
