$(".comment-form .form form").on("submit", function (e) {
    e.preventDefault();
    let $this = $(this);
    showWaitMe($this);
    $.ajax({
        url: $this.attr('action'),
        type: "POST",
        dataType: "JSON",
        headers: {'X-CSRF-TOKEN': $this.find('input[name="_token"]').val()},
        data: $this.serializeArray()
    }).done(function (response) {
        if (response.hasOwnProperty('status')) {
            if (response.hasOwnProperty('message')) {
                Swal.fire({
                    html: response.message,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    icon: response.status ? 'success' : 'error'
                });
            }
            if (response.status) {
                resetForm($this);
            } else {
                if (response.hasOwnProperty('token')) {
                    $this.find('input[name="_token"]').val(response.token)
                }
            }
        }
        hideWaitMe($this);
    });
});
