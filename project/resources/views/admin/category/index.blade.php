@extends("admin.layouts.index")
@section("head")

@endsection
@section("style")
    <link href="{{ asset('assets/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section("content")
    <div class="row">
        <div class="col-12">
            <x-admin.card>
                <x-slot name="header">
                    <h1 class="card-title">{{ $title }}</h1>
                </x-slot>
                <x-slot name="body">
                    <x-admin.table :class="'table-striped table-hover data-table'" :responsive="true">
                        <x-slot name="columns">
                            @foreach($columns as $item)
                                <th scope="col" class="align-middle"> {{ $item }}</th>
                            @endforeach
                        </x-slot>
                        <x-slot name="rows">
                            @foreach($records as $item)
                                <tr>
                                    <th scope="row">{{ $item->id }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>
                                        @if(!empty($item->image))
                                            <a href="{{ asset($item->image) }}" target="_blank">
                                                <img src="{{ asset($item->image) }}" alt="{{ $item->name }}"
                                                     width="40"></a>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit(strip_tags($item->description), 50) }}</td>
                                    <td>
                                        <x-admin.change-status
                                            :recordId="$item->id" :url="route('admin.category.change_status')"
                                            :recordType="'status'" :recordTypeText="'Status'"
                                            :recordStatus="$item->status">
                                        </x-admin.change-status>
                                    </td>
                                    <td>
                                        <x-admin.change-status
                                            :recordId="$item->id" :url="route('admin.category.change_status')"
                                            :recordType="'feature_status'" :recordTypeText="'Feature Status'"
                                            :recordStatus="$item->feature_status">
                                        </x-admin.change-status>
                                    </td>
                                    <td>{{ $item->order }}</td>
                                    <td>{{ $item->parentCategory?->name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <x-admin.table-actions
                                        :recordId="$item->id"
                                        :editURL="route('admin.category.edit', ['id' => $item->id])"
                                        :deleteURL="route('admin.category.delete')"
                                    ></x-admin.table-actions>
                                </tr>
                            @endforeach
                        </x-slot>
                        <x-slot name="footer">
                            @foreach($columns as $item)
                                <th>{{ in_array($item, ['Title', 'Name', 'Slug', 'Description']) ? $item : '' }}</th>
                            @endforeach
                        </x-slot>
                    </x-admin.table>
                    {{--{{ $records->links() }}--}}
                    {{--{{ $records->links("vendor.pagination.boostrap-5") }}--}}
                    {{--{{ $records->render() }}--}}
                    {{--{{ $records->onEachSide(1)->links() }}--}}
                </x-slot>
            </x-admin.card>
        </div>
    </div>
@endsection
@section("scripts")
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/datatables.js') }}"></script>
@endsection
