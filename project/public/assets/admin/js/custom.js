jQuery(function ($) {
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        /*beforeSend: function () {
            // show loading dialog // works
        },*/
        /*complete: function (xhr, stat) {
            // hide dialog // works
        },*/
        success: function (response, status, xhr) {
            let hasMessage = (response.hasOwnProperty('notify') && response.notify.message !== null && response.notify.message !== '') || (response.hasOwnProperty('message') && response.message !== null && response.message !== '');
            let hasRedirect = response.hasOwnProperty('redirect');
            if (hasMessage) {
                let $swalProps = {
                    html: response.notify.message ?? response.message,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false
                };
                if (response.notify.hasOwnProperty('icon')) {
                    $swalProps['icon'] = response.notify.icon;
                }
                if (response.notify.hasOwnProperty('timer')) {
                    $swalProps['timer'] = response.notify.timer;
                }
                if (hasRedirect) {
                    return Swal.fire($swalProps).then((result) => {
                        return window.location.replace(response.redirect);
                    });
                } else {
                    Swal.fire($swalProps);
                }
            }
            if (hasRedirect) {
                return window.location.replace(response.redirect);
            }
        }
    });
    $('form input[type="checkbox"]').each(function () {
        $(this).val($(this).is(':checked') ? 1 : 0);
    });
    $('form input[type="checkbox"]').on("click", function () {
        $(this).val($(this).is(':checked') ? 1 : 0);
    });
});

$(document).ready(function () {
    $('form').submit(function () {
        $(this).find('input[type=checkbox]').each(function (i, el) {
            if (!el.checked) {
                var hidden_el = $(el).clone();
                hidden_el[0].checked = true;
                hidden_el[0].value = '0';
                hidden_el[0].type = 'hidden'
                hidden_el.insertAfter($(el));
            }
        })
    });
    $('#languageDropDown').click(function () {
        $(this).addClass("show");
    });
    $('#btnClearFilter').click(function () {
        let filters1 = $('#formFilter input');
        let filters2 = $('#formFilter select');
        let filters = filters1.toArray().concat(filters2.toArray());
        filters.forEach(function (element, index, arr) {
            element.value = null;
            if (element.nodeName == "SELECT") {
                $(element).val(null).trigger('change');
            }
        })
    });
    $('.btnUserLogout').on("click", function (e) {
        e.preventDefault();
        let url = $(this).attr("href");
        $.ajax({
            url: url,
            type: "POST",
            dataType: "JSON"
        });
    });
    $('.btnChangeStatus').on("click", function (e) {
        e.preventDefault();
        let $this = $(this);
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
                let url = $this.attr('href');
                let recordId = $this.data('id');
                let recordType = $this.data('type');
                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: "JSON",
                    data: {'id': recordId, 'type': recordType, 'typeText': recordTypeText}
                }).done(function (response) {
                    if (response.hasOwnProperty('status')) {
                        if (response.status) {
                            if (response.hasOwnProperty('data')) {
                                if (response.data.hasOwnProperty('recordStatusText')) {
                                    $this.text(response.data.recordStatusText);
                                }
                                if (response.data.hasOwnProperty('recordStatus')) {
                                    if (response.data.recordStatus) {
                                        $this.removeClass('btn-outline-warning').addClass('btn-outline-success');
                                    } else {
                                        $this.removeClass('btn-outline-success').addClass('btn-outline-warning');
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    });
    $('.btnDelete').on("click", function (e) {
        e.preventDefault();
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
                let url = $this.attr('href');
                let recordId = $this.data('id');
                $.ajax({
                    url: url,
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
    $('.btnApprove').on("click", function (e) {
        e.preventDefault();
        let $this = $(this);
        Swal.fire({
            text: 'Do you want to approve this comment?',
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
                let url = $this.attr('href');
                let recordId = $this.data('id');
                $.ajax({
                    url: url,
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
    $('.btnViewModal').on("click", function (e) {
        e.preventDefault();
        let content = $(this).data('content');
        $('#viewModal .modal-body').text(content);
        let recordId = $(this).data('id');
        $('#viewModal .modal-header .modal-title').text('Article Comment #' + recordId);
        let userFullname =$(this).data('user-fullname');
        let creationDate =$(this).data('creation-date');
        $('#viewModal .modal-footer').text('by ' + userFullname + ' - ' + creationDate);
    });
});
