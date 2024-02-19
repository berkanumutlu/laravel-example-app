@extends("admin.layouts.index")
@section("style")
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
                    <form
                        action="{{ isset($page) && $page == 'list' ? route('admin.article.comments.index') : route('admin.article.comments.pending') }}"
                        id="formFilter">
                        <div class="row">
                            <div class="col-3 my-2">
                                @if(!empty($users))
                                    <select class="form-select" name="user_id">
                                        <option value="{{ null }}">Users</option>
                                        <option value="0"
                                            {{ !is_null(request()->get('user_id')) && request()->get('user_id') == 0 ? "selected" : "" }}>
                                            Guests
                                        </option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ request()->get('user_id') == $user->id ? "selected" : "" }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="col-3 my-2">
                                <input type="text"
                                       class="form-control form-control-solid-bordered flatpickr3 bg-light"
                                       name="created_at" placeholder="Created Date"
                                       value="{{ request()->get("created_at") }}">
                            </div>
                            <div class="col-3 my-2">
                                <input type="text" name="comment" class="form-control" placeholder="Comment"
                                       value="{{ request()->get("comment") }}">
                            </div>
                            <div class="col-3 my-2">
                                <input type="text" name="ip_address" class="form-control" placeholder="IP Address"
                                       value="{{ request()->get("ip_address") }}">
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
                                    <td>
                                        <a href="{{ route('article.detail', ['slug' => $item->article?->slug]) }}"
                                           target="_blank">{{ $item->article?->title }}</a>
                                    </td>
                                    <td>{!! $item->user?->name ?? 'Guest<br>('.$item->user_full_name.'<br>'.$item->user_email.')' !!}</td>
                                    @if(!is_null($item->parent?->comment))
                                        <td data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ $item->parent?->comment }}">{{ !is_null($item->parent?->comment) ? Str::limit($item->parent?->comment, 30) : '' }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>{{ Str::limit(strip_tags($item->comment), 40) }}</td>
                                    @if(isset($item->like_count))
                                        <td>{{ $item->like_count }}</td>
                                    @endif
                                    @if(isset($item->dislike_count))
                                        <td>{{ $item->dislike_count }}</td>
                                    @endif
                                    <td>{{ $item->ip_address }}</td>
                                    <td data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ $item->user_agent }}">{{ Str::limit($item->user_agent, 30) }}</td>
                                    @if(isset($item->approve_status))
                                        <td>
                                            <x-admin.change-status
                                                :recordId="$item->id"
                                                :url="route('admin.article.comments.change.status')"
                                                :recordType="'approve_status'" :recordTypeText="'Approve Status'"
                                                :recordStatus="$item->approve_status">
                                            </x-admin.change-status>
                                        </td>
                                    @endif
                                    @if(isset($item->status))
                                        <td>
                                            <x-admin.change-status
                                                :recordId="$item->id"
                                                :url="route('admin.article.comments.change.status')"
                                                :recordType="'status'" :recordTypeText="'Status'"
                                                :recordStatus="$item->status">
                                            </x-admin.change-status>
                                        </td>
                                    @endif
                                    <td>{{ $item->created_at }}</td>
                                    <x-admin.table-actions
                                        :recordId="$item->id"
                                        :viewArticleCommentModalContent="$item->comment"
                                        :userFullName="$item->user?->name ?? 'Guest ('.$item->user_full_name.' - '.$item->user_email.')'"
                                        :creationDate="$item->created_at"
                                        :approveURL="$page == 'pending' ? route('admin.article.comments.approve') : ''"
                                        :deleteURL="route('admin.article.comments.delete')"
                                        :deleteURLClass="is_null($item->deleted_at) ? '' : 'd-none'"
                                        :restoreURL="route('admin.article.comments.restore')"
                                        :restoreURLClass="is_null($item->deleted_at) ? 'd-none' : ''"
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
        :modalId="'viewModal'" :headerTitle="'Article Comment'"
        :modalDialogClass="'modal-xl'"></x-admin.modal>
@endsection
@section("scripts")
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/datepickers.js') }}"></script>
@endsection
