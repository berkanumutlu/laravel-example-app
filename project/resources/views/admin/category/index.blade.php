@extends("admin.layouts.index")
@section("head")
    <meta name="csrf_token" content="{{ csrf_token() }}"/>
@endsection
@section("content")
    <div class="row">
        <div class="col-12">
            <x-admin.card>
                <x-slot name="header">
                    <h1 class="card-title">{{ $title }}</h1>
                </x-slot>
                <x-slot name="body">
                    <x-admin.table
                        :columns="$columns" :rows="$records"
                        :class="'table-striped table-hover'"
                        :responsive="true"></x-admin.table>
                </x-slot>
            </x-admin.card>
        </div>
    </div>
@endsection
@section("scripts")
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
                    confirmButtonColor: '#2269f5',
                    cancelButtonColor: '#ff6673',
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
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                            data: {'id': recordId, 'type': recordType, 'typeText': recordTypeText}
                        }).done(function (response) {
                            if (response.hasOwnProperty('message')) {
                                let $props = {
                                    html: response.message,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    allowEnterKey: false
                                };
                                if (response.hasOwnProperty('icon')) {
                                    $props['icon'] = response.icon;
                                }
                                if (response.hasOwnProperty('timer')) {
                                    $props['timer'] = response.timer;
                                }
                                Swal.fire($props);
                            }
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
                    confirmButtonColor: '#2269f5',
                    cancelButtonColor: '#ff6673',
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
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                            data: {'id': recordId}
                        }).done(function (response) {
                            if (response.hasOwnProperty('message')) {
                                let $props = {
                                    html: response.message,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    allowEnterKey: false
                                };
                                if (response.hasOwnProperty('icon')) {
                                    $props['icon'] = response.icon;
                                }
                                if (response.hasOwnProperty('timer')) {
                                    $props['timer'] = response.timer;
                                }
                                Swal.fire($props);
                            }
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
