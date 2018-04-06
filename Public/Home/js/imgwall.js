window.onload = function() {
    waterfall();
};

function waterfall() {
    var allBox = $('.main .box');
    var oBoxW = allBox.eq(0).width();
    //计算整个页面显示的列数（页面宽/box的宽）
    var cols = Math.floor($('.main').width() / oBoxW);
     $(".main").css({
         'width:' : oBoxW * cols,
         'margin': '0 auto'
     });
     $('.container').css('width', (oBoxW * cols / 10)+'rem');

    var hArr = [];//存放每一列高度的数组
    allBox.each(function(index, value) {
        var boxH = allBox.eq(index).height();
        if(index < cols) {
            hArr[index] = boxH;//第一行中的cols个块框box 先添加进hArr
        } else {
            var minH = Math.min.apply(null, hArr);//数组中hArr中的最小值
            var minIndex = $.inArray(minH, hArr);
            $(value).css({
                'position': 'absolute',
                'top': minH + 15,
                'left': allBox.eq(minIndex).position().left
            });
            hArr[minIndex] += allBox.eq(index).height() + 15;
        }
    });
}

