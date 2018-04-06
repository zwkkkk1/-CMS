$('.sidebar-trigger').on('click', function () {
    $('.login-frm').css('display', 'block');
    $('.reg-frm').css('display', 'none');
    $('.sidebar').animate({
        right: '0'
    }, 400);
    $('.mask').fadeIn();
});

$('.mask').on('click', function () {
    $('.sidebar').animate({
        right: -$('.sidebar').width()
    }, 400);
    $('.mask').fadeOut();

});

$('.reg-btn').on('click', function () {
    $('.login-frm').css('display', 'none');
    $('.reg-frm').css('display', 'block');
});

$('.back-btn').on('click', function () {
    $('.login-frm').css('display', 'block');
    $('.reg-frm').css('display', 'none');
});
