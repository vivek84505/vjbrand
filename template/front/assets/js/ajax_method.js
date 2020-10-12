$('.subscriber').on('click', function () {
    var here = $(this); // alert div for show alert message
    var text = here.html(); // alert div for show alert message
    var form = here.closest('form');
    var email = form.find('#subscr').val();
    if (isValidEmailAddress(email)) {
        //var form = $(this);
        var formdata = false;
        if (window.FormData) {
            formdata = new FormData(form[0]);
        }
        $.ajax({
            url: form.attr('action'), // form action url
            type: 'POST', // form submit method get/post
            dataType: 'html', // request type html/json/xml
            data: formdata ? formdata : form.serialize(), // serialize form data 
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                here.addClass('disabled');
                here.html(working); // change submit button text
            },
            success: function (data) {
                here.fadeIn();
                here.html(text);
                here.removeClass('disabled');
                if (data == 'done') {
                    notify(subscribe_success, 'info', 'bottom', 'right');
                } else if (data == 'already') {
                    notify(subscribe_already, 'warning', 'bottom', 'right');
                } else if (data == 'already_session') {
                    notify(subscribe_sess, 'warning', 'bottom', 'right');
                } else {
                    notify(data, 'warning', 'bottom', 'right');
                }
            },
            error: function (e) {
                console.log(e)
            }
        });
    } else {
        notify(mbe, 'warning', 'bottom', 'right');
    }
});



function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}
;

$("body").on('change', '.required', function () {
    var here = $(this);
    here.css({borderColor: '#931ECD'});
    if (here.attr('type') == 'email') {
        if (isValidEmailAddress(here.val())) {
            here.closest('.input').find('.require_alert').remove();
        }
    } else {
        here.closest('.input').find('.require_alert').remove();
    }
    if (here.is('select')) {
        here.closest('.input').find('.chosen-single').css({borderColor: '#dcdcdc'});
    }
});



    