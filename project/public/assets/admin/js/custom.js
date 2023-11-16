function imageCheck(images) {
    let $images = images[0];
    let length = $images.files.length;
    let files = $images.files;
    let mimeType = ['png', 'jpg', 'jpeg'];

    if (length > 0) {
        for (let i = 0; i < length; i++) {
            let type = files[i].type.split("/").pop();
            let size = files[i].size;

            if ($.inArray(type, mimeType) == '-1') {
                Swal.fire({
                    title: "Uyarı",
                    text: "Seçilen " + files[i].name + " 'ine sahip görsel belirtilen formatlarda değildir. .png, .jpeg, .jpg formatlarından birisi olmalıdır",
                    confirmButtonText: 'Tamam',
                    icon: "warning"
                });
                return false;
            } else if (size > 2048000) {
                Swal.fire({
                    title: "Uyarı",
                    text: "Seçilen " + files[i].name + " 'ine sahip görsel en fazla 2mb olmalıdır.",
                    confirmButtonText: 'Tamam',
                    icon: "warning"
                });
                return false;
            }
            return true;

        }
    }
    return true;
}

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
            let hasMessage = response.hasOwnProperty('message') && response.message !== null && response.message !== '';
            let hasRedirect = response.hasOwnProperty('redirect');
            if (hasMessage) {
                let $swalProps = {
                    html: response.message,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false
                };
                if (response.hasOwnProperty('icon')) {
                    $swalProps['icon'] = response.icon;
                }
                if (response.hasOwnProperty('timer')) {
                    $swalProps['timer'] = response.timer;
                }
                if (hasRedirect) {
                    return Swal.fire($swalProps).then((result)=> {
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
});

$(document).ready(function () {
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
                            $this.addClass('d-none').parent('.btnChangeStatusSection').find('.btnChangeStatus').not($this).removeClass('d-none');
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
});
