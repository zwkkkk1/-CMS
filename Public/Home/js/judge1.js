$('.reg-submit').on('click', function () {
    if (regJudge()) {
        $.ajax({
            url: URL,
            data: {username: $('#username2').val(), password: $('#password2').val()},
            type: 'post',
            dataType: 'json',
            success: function (res) {
                console.log(res);
                if (res.isok == 1) {
                    alert('注册成功');
                    location.reload();
                }
                else {
                    alert(res.isok);
                    $('.sidebar').css('right', '0');
                    $('.login-frm').css('display', 'block');
                    $('.reg-frm').css('display', 'none');
                }
            }
        })
    }
    return false;
});

$('.login-submit').on('click', function () {

    $.ajax({
        url: loginURL,
        data: {username: $('#username1').val(), password: $('#password1').val()},
        type: 'post',
        dataType: 'json',
        success: function (res) {
            if(res == 1) {
                alert('登陆成功');
                location.reload();
            }
            else {
                alert(res);
                $('.sidebar').css('right', '0');
                $('.login-frm').css('display', 'block');
                $('.reg-frm').css('display', 'none');
            }
        }
    });
    return false;
});

function regJudge() {
    if ($('#username2').val() == '') {
        alert('用户名不得为空');
        return false;
    }
    if (($('#username2').val()).length < 3 || ($('#username2').val()).length > 16) {
        alert('用户名长度为3到16个字');
        return false;
    }
    if ($('#password2').val() == '') {
        alert('密码不得为空');
        return false;
    }
    if ($('#repassword').val() != $('#password2').val()) {
        alert('确认密码错误');
        return false;
    }
    return true;
}

$('#username2').on('blur', function () {
    if ($(this).val() == '') {
        $(this).siblings('.tip-span').text('用户名不得为空');
    }else {
        $(this).siblings('.tip-span').text('');
    }
    $.ajax({
        url: judgeUrl,
        data: {username: $('#username2').val()},
        type: 'post',
        dataType: 'json',
        success: function (res) {
            if (!res) {
                $(this).siblings('.tip-span').text('用户名已存在');
            }
        }
    })
});

