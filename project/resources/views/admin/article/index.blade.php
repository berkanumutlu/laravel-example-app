@extends("admin.layouts.index")
@section("head")
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
@endsection
@section("content")
    <div class="row">
        <div class="col-12">
            <x-admin.card>
                <x-slot name="header">
                    <h1 class="card-title">{{ $title }}</h1>
                </x-slot>
                <x-slot name="body">
                    <form action="{{ route('admin.article.index') }}" id="formFilter">
                        <div class="row">
                            <div class="col-3 my-2">
                                <input type="text" class="form-control" placeholder="Title" name="title"
                                       value="{{ request()->get('title') }}">
                            </div>
                            <div class="col-3 my-2">
                                <input type="text" class="form-control" placeholder="Slug" name="slug"
                                       value="{{ request()->get('slug') }}">
                            </div>
                            <div class="col-3 my-2">
                                <input type="text" class="form-control" placeholder="Body" name="body"
                                       value="{{ request()->get('body') }}">
                            </div>
                            <div class="col-3 my-2">
                                <select class="form-select" name="status" aria-label="Status">
                                    <option value="{{ null }}">Status</option>
                                    <option
                                        value="0" {{ request()->filled('status') && request()->get('status') == 0 ? "selected" : "" }}>
                                        Passive
                                    </option>
                                    <option
                                        value="1" {{ request()->filled('status') && request()->get('status') == 1 ? "selected" : "" }}>
                                        Active
                                    </option>
                                </select>
                            </div>
                            <div class="col-3 my-2">
                                @if(!empty($categories))
                                    <select class="form-select" name="category_id">
                                        <option value="{{ null }}">Select Category</option>
                                        @foreach($categories as $item)
                                            <option
                                                value="{{ $item->id }}" {{ request()->get('category_id') == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="col-3 my-2">
                                @if(!empty($users))
                                    <select class="form-select" name="user_id">
                                        <option value="{{ null }}">Users</option>
                                        @foreach($users as $user)
                                            <option
                                                value="{{ $user->id }}" {{ request()->get('user_id') == $user->id ? "selected" : "" }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="col-3 my-2">
                                <input type="text"
                                       class="form-control form-control-solid-bordered flatpickr2 bg-light"
                                       name="publish_date" placeholder="Publish Date"
                                       value="{{ request()->get("publish_date") }}">
                            </div>
                            <div class="col-3 my-2">
                            </div>
                            <div class="col-3 my-2">
                                <input type="number" class="form-control" placeholder="Min View Count"
                                       name="min_view_count" value="{{ request()->get("min_view_count") }}">
                            </div>
                            <div class="col-3 my-2">
                                <input type="number" class="form-control" placeholder="Max View Count"
                                       name="max_view_count" value="{{ request()->get("max_view_count") }}">
                            </div>
                            <div class="col-3 my-2">
                                <input type="number" class="form-control" placeholder="Min Like Count"
                                       name="min_like_count" value="{{ request()->get("min_like_count") }}">
                            </div>
                            <div class="col-3 my-2">
                                <input type="number" class="form-control" placeholder="Max Like Count"
                                       name="max_like_count" value="{{ request()->get("max_like_count") }}">
                            </div>
                            <hr>
                            <div class="col-6 mb-2 d-flex">
                                <button class="btn btn-primary w-50 me-4" type="submit">Search</button>
                                <button class="btn btn-warning w-50" type="button" id="btnClearFilter">Reset</button>
                            </div>
                            <hr>
                        </div>
                    </form>
                    <x-admin.table :class="'table-striped table-hover'" :responsive="true">
                        <x-slot name="columns">
                            @foreach($columns as $item)
                                <th scope="col" class="align-middle"> {{ $item }}</th>
                            @endforeach
                        </x-slot>
                        <x-slot name="rows">
                            @foreach($records as $item)
                                <tr>
                                    <th scope="row">{{ $item->id }}</th>
                                    <td>{{ Str::limit($item->title, 20) }}</td>
                                    <td>{{ Str::limit($item->slug, 20) }}</td>
                                    <td>{{ Str::limit(strip_tags($item->body), 40) }}</td>
                                    <td>
                                        @if(!empty($item->image))
                                            <a href="{{ asset($item->image) }}" target="_blank">
                                                <img src="{{ asset($item->image) }}" alt="{{ $item->title }}"
                                                     width="40" height="40"></a>
                                        @endif
                                    </td>
                                    <td>
                                        <x-admin.change-status
                                            :recordId="$item->id" :url="route('admin.article.change_status')"
                                            :recordType="'status'" :recordTypeText="'Status'"
                                            :recordStatus="$item->status">
                                        </x-admin.change-status>
                                    </td>
                                    <td>{{ $item->read_time }}</td>
                                    <td>{{ $item->view_count }}</td>
                                    <td>{{ $item->like_count }}</td>
                                    <td>{{ $item->publish_date }}</td>
                                    <td>{{ $item->category?->name }}</td>
                                    <td>{{ $item->user?->name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <x-admin.table-actions
                                        :recordId="$item->id"
                                        :editURL="route('admin.article.edit', ['id' => $item->id])"
                                        :deleteURL="route('admin.article.delete')"
                                    ></x-admin.table-actions>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-admin.table>
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        @if(isset($records))
                            Showing {{ $records->currentPage() == 1 ? $records->currentPage() : $records->currentPage() * $records->perPage() - $records->perPage() + 1 }}
                            to {{ $records->currentPage() * $records->perPage() > $records->total() ? $records->total() : $records->currentPage() * $records->perPage() }}
                            of {{ $records->total() }} entries
                        @endif
                        {{ $records->onEachSide(1)->links() }}
                    </div>
                </x-slot>
            </x-admin.card>
        </div>
    </div>
@endsection
@section("scripts")
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/datepickers.js') }}"></script>
@endsection
