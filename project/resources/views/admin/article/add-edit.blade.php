@extends("admin.layouts.index")
@section("head")
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
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
                                action="{{ isset($record) ? route('admin.article.edit', ['id' => $record->id]) : route('admin.article.add') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="text" class="form-control form-control-solid-bordered m-b-sm
                                {{ $errors->has('title') ? 'border-danger mb-0' : '' }}"
                                       name="title" placeholder="Article Title" required
                                       value="{{ old('title') ?? ($record->title ?? '') }}">
                                @if($errors->has('title'))
                                    <p>{{ $errors->first('title') }}</p>
                                @endif
                                <input type="text" class="form-control form-control-solid-bordered m-b-sm"
                                       name="slug" placeholder="Article Slug"
                                       value="{{ old('slug') ?? ($record->slug ?? '') }}">
                                <div class="m-b-sm">
                                    <textarea class="summernote form-control form-control-solid-bordered m-b-sm"
                                              name="body" rows="3" placeholder="Description"
                                              required>{!! old('body') ?? ($record->body ?? '') !!}</textarea>
                                </div>
                                <div class="m-b-sm">
                                    <input type="file" name="image" id="image"
                                           class="form-control form-control-solid-bordered"
                                           accept="image/png, image/jpeg, image/jpg">
                                    @if(isset($record) && $record->image)
                                        <a href="{{ asset($record->image) }}" target="_blank">
                                            <img src="{{ asset($record->image) }}" alt="{{ $record->title ?? '' }}"
                                                 class="img-fluid m-t-sm" style="max-height: 200px">
                                        </a>
                                    @endif
                                </div>
                                <div class="m-b-sm bg-light">
                                    <select class="form-select" name="category_id" aria-label="Category">
                                        <option value="{{ null }}">Category</option>
                                        @if(!empty($category_list))
                                            @foreach($category_list as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ (old('category_id') && old('category_id') == $item->id) || (isset($record) && $record->category_id == $item->id) ? 'selected' : '' }}
                                                >{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <input type="number" class="form-control form-control-solid-bordered m-b-sm"
                                       name="read_time" placeholder="Article Read Time"
                                       value="{{ old('read_time') ?? ($record->read_time ?? '') }}">
                                <input type="text"
                                       class="form-control form-control-solid-bordered m-b-sm flatpickr2 bg-light"
                                       name="publish_date" placeholder="Publish Date"
                                       value="{{ old('publish_date') ?? ($record->publish_date ?? '') }}">
                                {{--<textarea class="form-control form-control-solid-bordered m-b-sm" name="tags"
                                          rows="2" placeholder="Tags">{{ $record->tags ?? '' }}</textarea>--}}
                                <div class="m-b-sm">
                                    <label for="tags" class="form-label mb-0">Tags</label>
                                    <select
                                        class="form-control js-example-tokenizer" multiple="multiple" name="tags[]"
                                        id="tags" tabindex="-1" style="display: none; width: 100%"
                                        data-allow-clear="true">
                                        @if((!empty($record->tags) && is_array($record->tags)) || (old('tags') && is_array(old('tags'))))
                                            @php
                                                $tag_list = $record->tags ?? old('tags');
                                            @endphp
                                            @foreach($tag_list as $item)
                                                <option value="{{ $item }}" selected>{{ $item }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <textarea class="form-control form-control-solid-bordered m-b-sm" name="seo_keywords"
                                          rows="5"
                                          placeholder="SEO Keywords">{{ old('seo_keywords') ?? ($record->seo_keywords ?? '') }}</textarea>
                                <textarea class="form-control form-control-solid-bordered m-b-sm" name="seo_description"
                                          rows="5"
                                          placeholder="SEO Description">{{ old('seo_description') ?? ($record->seo_description ?? '') }}</textarea>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status"
                                           name="status" {{ old('status') || !empty($record->status) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">Status</label>
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
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/select2.js') }}"></script>
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/datepickers.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/lang/summernote-tr-TR.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/text-editor.js') }}"></script>
@endsection
