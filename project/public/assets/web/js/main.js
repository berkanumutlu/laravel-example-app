function resetForm(form){
    let $this = form instanceof jQuery ? form: $(form);
    $this.find(':input').val('');
    $this.find(':input').filter('textarea').html('');
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
