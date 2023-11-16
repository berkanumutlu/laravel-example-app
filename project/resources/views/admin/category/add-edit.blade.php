@extends("admin.layouts.index")
@section("head")

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
                                method="POST">
                                @csrf
                                <input type="text" class="form-control form-control-solid-bordered m-b-sm
                                {{ $errors->has('name') ? 'border-danger mb-0' : '' }}"
                                       name="name" placeholder="Category Name" required
                                       value="{{ old('name') ?? ($record->name ?? '') }}">
                                @if($errors->has('name'))
                                    <p>{{ $errors->first('name') }}</p>
                                @endif
                                <input type="text" class="form-control form-control-solid-bordered m-b-sm"
                                       name="slug" placeholder="Category Slug"
                                       value="{{ old('slug') ?? ($record->slug ?? '') }}">
                                <textarea class="form-control form-control-solid-bordered m-b-sm" name="description"
                                          rows="5"
                                          placeholder="Description">{{ old('description') ?? ($record->description ?? '') }}</textarea>
                                <input type="number" class="form-control form-control-solid-bordered m-b-sm"
                                       name="order" min="0" placeholder="Order"
                                       value="{{ old('order') ?? ($record->order ?? '') }}">
                                <select class="form-select m-b-sm bg-light" name="parent_id"
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
                                <textarea class="form-control form-control-solid-bordered m-b-sm" name="seo_keywords"
                                          rows="5"
                                          placeholder="SEO Keywords">{{ old('seo_keywords') ?? ($record->seo_keywords ?? '') }}</textarea>
                                <textarea class="form-control form-control-solid-bordered m-b-sm" name="seo_description"
                                          rows="5"
                                          placeholder="SEO Description">{{ old('seo_description') ?? ($record->seo_description ?? '') }}</textarea>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status"
                                           name="status" {{ old('status') || (isset($record) && $record->status) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">Status</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="feature_status"
                                           name="feature_status" {{ old('feature_status') || (isset($record) && $record->feature_status) ? 'checked' : '' }}>
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

@endsection
