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
                    <form action="{{ route('admin.log.index') }}" id="formFilter">
                        <div class="row">
                            <div class="col-3 my-2">
                                <input type="text" class="form-control" placeholder="Search" name="search_text"
                                       value="{{ request()->get('search_text') }}">
                            </div>
                            <div class="col-3 my-2">
                                <input type="text"
                                       class="form-control form-control-solid-bordered flatpickr3 bg-light"
                                       name="date" placeholder="Date"
                                       value="{{ request()->get("date") }}">
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
                                @if(!empty($actions))
                                    <select class="form-select" name="action">
                                        <option value="{{ null }}">Select Action</option>
                                        @foreach($actions as $item)
                                            <option {{ request()->get('action') == $item ? "selected" : "" }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="col-3 my-2">
                                @if(!empty($models))
                                    <select class="form-select" name="model">
                                        <option value="{{ null }}">Select Model</option>
                                        @foreach($models as $item)
                                            <option {{ request()->get('model') == $item ? "selected" : "" }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                @endif
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
                                    <td>{{ $item->user?->name }}</td>
                                    <td>{{ $item->action }}</td>
                                    <td>{{ $item->loggable_type }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <x-admin.table-actions
                                        :recordId="$item->id"
                                        :deleteURL="route('admin.log.delete')"
                                        :viewModalContentAJAX="true"
                                        :viewModalAJAXURL="route('admin.log.show.ajax')"
                                    ></x-admin.table-actions>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-admin.table>
                    <x-admin.table-pagination :records="$records"></x-admin.table-pagination>
                </x-slot>
            </x-admin.card>
        </div>
    </div>
    <x-admin.modal
        :modalId="'viewModalAJAX'" :headerTitle="'Log'"
        :modalDialogClass="'modal-xl'"></x-admin.modal>
@endsection
@section("scripts")
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/datepickers.js') }}"></script>
@endsection
