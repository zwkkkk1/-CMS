$(window).on('scroll', function () {
    var video=document.getElementById("video");
    if ($(window).scrollTop() > 150) {
        $('header').addClass('float-header');
    } else {
        $('header').removeClass('float-header');
    }

    // 点击视频播放
    $('.glyphicon-play').click(function(){
        $('.play').css({'display':'none'});
        video.play();
    })

    video.onended=function(){
        $('.play').css({'display':'block'});
    }
});

$('.scene-a').on('mouseenter', function () {
    $(this).children('.scene-eye').css("top", "7.8rem");
    $(this).children('.scene-name').css("bottom", "7.8rem");
});

$('.scene-a').on('mouseleave', function () {
    $(this).children('.scene-eye').css("top", "-4rem");
    $(this).children('.scene-name').css("bottom", "-4rem");
});


