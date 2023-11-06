<div class="btnChangeStatusSection">
    <a href="javascript:;" data-id="{{ $recordId }}" data-type="{{ $recordType }}"
       data-type-text="{{ $recordTypeText }}"
       class="btnChangeStatus btn btn-outline-success px-2 py-1 me-2 {{ $recordStatus ? '' : 'd-none' }}">Active</a>
    <a href="javascript:;" data-id="{{ $recordId }}" data-type="{{ $recordType }}"
       data-type-text="{{ $recordTypeText }}"
       class="btnChangeStatus btn btn-outline-warning px-2 py-1 me-2 {{ $recordStatus ? 'd-none' : '' }}">Passive</a>
</div>
@section("style")
    <meta name="csrf_token" content="{{ csrf_token() }}"/>
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
                            url: "{{ $ajaxURL }}",
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
        });
    </script>
@endsection
