// 收藏
$('.likeNum').click(function(){
	var style=$(this).find('.glyphicon').attr('class');
	var likeNum = parseInt($('.collect-span').text());
	if(style.indexOf('hearted')>0)
	{
		$(this).find('.glyphicon').attr('class','glyphicon glyphicon-heart heart');
		$('.collect-span').text(likeNum - 1);
		var like = '-1';
	}
	else
	{
		$(this).find('.glyphicon').attr('class','glyphicon glyphicon-heart hearted');
		var like = '1';
        $('.collect-span').text(likeNum + 1);
	}
	$.ajax({
		url: changeCollect,
		data: {like: like, id: id},
		dataType: 'json',
		type: 'post',

	})
});

//点赞

$('.glyphicon-thumbs-up').click(function(){
    var likeNum = parseInt($(this).siblings('.good-num').text());
    if($(this).css('color') == 'rgb(51, 51, 51)')
    {
        $(this).css({'color':'#f11d1d'});
        $(this).siblings('.good-num').text(likeNum + 1);
        var like = '1';
    }
    else
    {
        $(this).css({'color':'rgb(51, 51, 51)'});
        var like = '-1';
        $(this).siblings('.good-num').text(likeNum - 1);
    }
    $.ajax({
        url: changeUp,
        data: {like: like, id: $('#id').val()},
        dataType: 'json',
        type: 'post'

    })
});