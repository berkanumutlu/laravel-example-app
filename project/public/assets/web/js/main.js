function resetForm(form) {
    let $this = form instanceof jQuery ? form : $(form);
    $this.find(':input').val('');
    $this.find(':input').filter('textarea').html('');
    if ($this.find('.reply-comment .comment-item').length > 0) {
        $('.reply-comment').hide(1000);
        $('.reply-comment .comment-item').html('');
    }
}

function showWaitMe(form, text = 'Please wait...') {
    let properties = {
        effect: 'timer',
        text: text,
        bg: 'rgba(255, 255, 255, 0.7)',
        color: '#000',
        maxSize: 40,
        waitTime: -1,
        source: '',
        textPos: 'vertical',
        fontSize: '30px',
        onClose: function (el) {
        }
    };
    if (form instanceof jQuery) {
        form.waitMe(properties);
    } else {
        $(form).waitMe(properties);
    }
}

function hideWaitMe(form) {
    if (form instanceof jQuery) {
        form.waitMe('hide');
    } else {
        $(form).waitMe('hide');
    }
}

jQuery(function ($) {
    $.ajaxSetup({
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
    $.scrollUp({
        scrollName: 'scrollUp', // Element ID
        topDistance: '400', // Distance from top before showing element (px)
        topSpeed: 900, // Speed back to top (ms)
        animation: 'fade', // Fade, slide, none
        animationInSpeed: 200, // Animation in speed (ms)
        animationOutSpeed: 200, // Animation out speed (ms)
        scrollText: '<i class="fa fa-angle-double-up"></i>', // Text for element
        activeOverlay: false // Set CSS color to display scrollUp active point, e.g '#00FFFF'
    });
});

$(document).ready(function () {
    $('.btnUserLogout').on("click", function (e) {
        e.preventDefault();
        let url = $(this).attr("href");
        $.ajax({
            url: url,
            type: "POST",
            dataType: "JSON",
            headers: {'X-CSRF-TOKEN': $(this).prev('input[name="_token"]').val()},
        }).done(function (response) {
            if (response.hasOwnProperty('refreshPage') && response.refreshPage) {
                return window.location.reload(true);
            }
        });
    });
});
