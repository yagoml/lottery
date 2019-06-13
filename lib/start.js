var base_url = window.location.origin + '/sorte';

$('.close').click(function () {
    $('.responseMsg').fadeOut(500);
});

function onLoadCaptcha() {
    $.ajax({
        url: base_url + '/admin/ggApiKeyJson',
        type: 'GET',
        dataType: 'json',
        cache: false,
        success: function (google) {
            grecaptcha.render('recaptchaFiltro', {
                'sitekey': google.key
            });
        }
    });
}