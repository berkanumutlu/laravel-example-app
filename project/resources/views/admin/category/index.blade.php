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
            $('.changeStatus').on("click", function () {
                let $this = $(this);
                Swal.fire({
                    text: 'Do you want to change the status?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2269f5',
                    cancelButtonColor: '#ff6673',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let categoryId = $this.data('id');
                        $.ajax({
                            url: "{{ route('admin.category.change_status') }}",
                            type: "POST",
                            dataType: "JSON",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                            data: {'id': categoryId}
                        }).done(function (response) {
                            if (response.hasOwnProperty('status')) {
                                if (response.hasOwnProperty('message')) {
                                    Swal.fire({
                                        html: response.message,
                                        timer: 4000
                                    });
                                }
                                if (response.status) {
                                    $this.addClass('d-none');
                                    $this.parent('.changeStatusSection').find('.changeStatus').not($this).removeClass('d-none');
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
