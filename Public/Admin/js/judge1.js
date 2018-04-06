$('.addform').submit(function () {
    var content = ue.getContent();
    var title = $('#title').val(),
        author = $('#author').val();
    var reg = /icon_\w*.gif$/;
    if (content == '' && title == '') {
        alert('内容不得为空');
    } else {
        var verify_img = $('#verify-img');
        var root1 = UE.htmlparser(content, true);

        //读取所有图片放于页面最后
        var imgs = root1.getNodesByTagName('img');
        if (imgs.length == 0) {
            var pic_url = '';
        } else {

            for (var i in imgs) {
                if (reg.exec(imgs[i].getAttr('src'))) {
                    var parentNode = UE.dom.domUtils.findParent(imgs[i]);
                    parentNode.removeChild(imgs[i]);
                }

                var src = changeImgUrl(imgs[i].getAttr('src'));
                imgs[i].setAttr('src', src);

            }
        }

        var pic_url = imgs[0].getAttr('src');
        if (title == '') {
            //读取第一行作为标题
            var mes = root1.children[0];
            UE.dom.domUtils.remove(root1.children[0], false);
            var title = mes.innerText();
        }
        else
            var title = $('#title').val();

        if (author == '') {
            author = admin;
        }
        var str = root1.toHtml();
        str = str.replace(/&nbsp;/g, "");
        $.ajax({
            url: URL,
            data: {
                title: title,
                cid: cid1,
                pic_url: pic_url,
                content: str,
                author: author,
                // verify: $('#verify').val(),
                time: $('#time').val()
            },
            dataType: 'json',
            type: 'post',
            success: function (data) {
                if (data.isok == 1) {
                    alert('添加成功');
                    location.href = data.url;
                } else {
                    alert(data.isok);
                    verify_img.attr('src', PUBLIC + "/captcha.php");
                }
            }
        });
    }
    return false;
});

$('.editform').submit(function () {
    var verify_img = $('#verify-img');
    var str = ue.getContent();
    $.ajax({
        url: URL,
        data: {
            title: $('#title').val(),
            id: $('#id').val(),
            cid: cid1,
            content: str,
            author: $('#author').val(),
            // verify:$('#verify').val(),
            time: $('#time').val()
        },
        dataType: 'json',
        type: 'post',
        success: function (data) {
            if (data.isok == 1) {
                alert('修改成功')
                location.href = data.url;
            } else {
                alert(data.isok);
                verify_img.attr('src', PUBLIC + "/captcha.php");
            }
        }
    });
    return false;
});

$('.edit-adminfrm').submit(function () {
    var new_pwd = $('#new_pwd').val(),
        renew_pwd = $('#renew_pwd').val();
    if (new_pwd == renew_pwd) {
        $.ajax({
            url: URL,
            data: {
                id: $('#id').val(),
                password: $('#password').val(),
                new_pwd: new_pwd
            },
            dataType: 'json',
            type: 'post',
            success: function (isok) {
                alert(isok);
                location.reload();
            }
        })

    } else {
        alert('确认密码错误');
    }
    return false;
});

function changeImgUrl(string) {
    var index=string.indexOf('ueditor');
    var result="/"+string.substring(index,string.length);
    return result;
}