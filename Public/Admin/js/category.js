$('.cate-outer-ul>li').on('click', function () {
    $(this).siblings().children('.cate-middle-ul').css("display", "none");
    var cate_middle = $(this).children('.cate-middle-ul');

    if (cate_middle.css("display") == 'none') {
        cate_middle.css("display", "block");
    }
    else {
        cate_middle.css("display", "none");
    }
});

$('.cate-middle-ul>li').on('click', function() {
    $(this).siblings().children('.cate-inner-ul').css('display','none');
    var cate_inner = $(this).children('.cate-inner-ul');
    if (cate_inner.css("display") == 'none') {
        cate_inner.css("display", "block");
    }
    else {
        cate_inner.css("display", "none");
    }
    return false;
});

$('ul a').on('click', function(){
    location.href = $(this).attr('href');
    return false;
})