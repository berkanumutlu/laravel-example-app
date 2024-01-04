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
            }
            if (response.hasOwnProperty('token')) {
                $this.find('input[name="_token"]').val(response.token)
            }
        }
        hideWaitMe($this);
    });
});
$(".btn-reply-comment").on("click", function (e) {
    e.preventDefault();
    let commentId = $(this).data('id');
    let commentSection = $(".comment-form");
    let commentForm = commentSection.find('.form form');
    commentForm.find('input[name="comment_id"]').val(commentId);
    $('html, body').animate({
        scrollTop: commentSection.offset().top,
        duration: 800
    });
    commentForm.find('.reply-comment .comment-item').html($(this).parents('.comment-item').html());
    commentForm.find('.reply-comment .comment-item .btn-actions').html('');
    commentForm.find('.reply-comment').show(1000);
});
$(".btn-remove-reply-comment").on("click", function (e) {
    e.preventDefault();
    let commentForm = $(".comment-form .form form");
    commentForm.find('.reply-comment').hide(1000);
    commentForm.find('.reply-comment .comment-item').html('');
});
