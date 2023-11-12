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
                                    <td>{{ Str::limit($item->description, 50) }}</td>
                                    <td>
                                        <x-admin.change-status
                                            :recordId="$item->id" :recordType="'status'"
                                            :recordTypeText="'Status'" :recordStatus="$item->status">
                                        </x-admin.change-status>
                                    </td>
                                    <td>
                                        <x-admin.change-status
                                            :recordId="$item->id" :recordType="'feature_status'"
                                            :recordTypeText="'Feature Status'"
                                            :recordStatus="$item->feature_status">
                                        </x-admin.change-status>
                                    </td>
                                    <td>{{ $item->order }}</td>
                                    <td>{{ $item->parentCategory?->name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <x-admin.table-actions
                                        :recordId="$item->id"
                                        :editURL="route('admin.category.edit', ['id' => $item->id])"
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
    <script>
        $(document).ready(function () {
            $('.btnChangeStatus').on("click", function () {
                let $this = $(this);
                let recordType = $this.data('type');
                let recordTypeText = $this.data('type-text');
                Swal.fire({
                    text: 'Do you want to change the ' + recordTypeText + '?',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#ff6673',
                    confirmButtonColor: '#2269f5',
                    confirmButtonText: 'Yes',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        let recordId = $this.data('id');
                        $.ajax({
                            url: "{{ route('admin.category.change_status') }}",
                            type: "POST",
                            dataType: "JSON",
                            data: {'id': recordId, 'type': recordType, 'typeText': recordTypeText}
                        }).done(function (response) {
                            if (response.hasOwnProperty('status')) {
                                if (response.status) {
                                    $this.addClass('d-none').parent('.btnChangeStatusSection').find('.btnChangeStatus').not($this).removeClass('d-none');
                                }
                            }
                        });
                    }
                });
            });
            $('.btnDelete').on("click", function () {
                let $this = $(this);
                Swal.fire({
                    text: 'Do you want to delete this record?',
                    icon: 'error',
                    showCancelButton: true,
                    cancelButtonColor: '#ff6673',
                    confirmButtonColor: '#2269f5',
                    confirmButtonText: 'Yes',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        let recordId = $this.data('id');
                        $.ajax({
                            url: "{{ route('admin.category.delete') }}",
                            type: "POST",
                            dataType: "JSON",
                            data: {'id': recordId}
                        }).done(function (response) {
                            if (response.hasOwnProperty('status')) {
                                if (response.status) {
                                    $this.parents('tr').remove();
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
