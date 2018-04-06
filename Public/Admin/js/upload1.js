/*
    文件上传部分
 */
    // var add_file = function(currentfile,messageid1) {
    //     currenttr=currentfile.parents('.file-tr');
    //     var tr = '<tr class="file-tr">'+
    //                 '<th></th><td>'+
    //                 '<form action="" enctype="multipart/form-data" class="upload-form">'+
    //                 '<input type="file" name="file" id="file" class="upload-file">'+
    //                 '<input type="hidden" name="filetype" value="file">'+
    //                 '<input type="hidden" name="messageid" id="messageid" value="'+messageid1+'">'+
    //                 '<input type="hidden" name="filename" class="file-name">'+
    //                 '<input type="submit" value="上传">'+
    //                 '<input type="button" value="重置" class="upload-reset">'+
    //             '</form></td></tr>';
    //     currenttr.after(tr);
    //     currentid++;
    // }

    //点击设置附件 给表单设置messageid
    $('body').on('click','.file-set',function() {
        $('.file-tr #messageid').val(messageid1);
    })

    // if($('#file1').val()!='') {
    //     add_file($('#file1'));
    // }
    $('body').on('change','.upload-file',function(){
        var fileName = $(this).val().split("\\").pop();
        //     fileVal = $(this).val(),
        //     flag = 0;
        // $(this).parents('.file-tr').siblings('.file-tr').each(function() {
        //     var thisVal = $(this).find('.upload-file').val();
        //     if(fileVal == thisVal) {
        //         flag = 1;
        //     }
        // })
        // if(flag == 1) {
        //     alert('上传文件不得重复');
        //     $(this).val('');
        // }
        // else {
            $(this).siblings('.file-name').val(fileName);
               // if(currentid<6 && ($(this).parents('.file-tr').next('.file-tr').length == 0))
               //      add_file($(this),messageid1);
        // }
    });

    $('body').on('click','.file-tr .upload-reset',function() {
        $(this).siblings('.upload-file').val('');
        $(this).siblings('.file-name').val('');
    })

    $('body').on('click','.file-set',function() {
        $('.uploadfile-div, .mask').css("display","block");
    })

    $('body').on('click','.uploadfile-div .upload-no, .mask',function() {
        $('.uploadfile-div, .mask').css({"display":"none"});
    })

    $('body').on('click','.file-set',function() {
        $.ajax({
            url:SHOWFILE,
            data:{
                messageid:messageid1,
                type:'file'
            },
            dataType:'json',
            type:'post',
            success:function(fileinfo) {
                $('.uploadfile-div .plus-tr').remove();
                for(var i in fileinfo) {
                    var tr = "<tr class='plus-tr'><td></td>"+
                            "<td><a href='"+ROOT+fileinfo[i]['fileurl']+"'>"+fileinfo[i]['filename']+"</a></td>"+
                            "<td><a class='del-file' href='"+CONTROLLER+"/delfile?id="+fileinfo[i]['id']+"&fileurl="+fileinfo[i]['fileurl']+"&cid="+cid+"&type=file'>删除</a></td>"+
                            "</tr>";
                    $('.uploadfile-div .file-tr').before(tr);
                }
            }
        })
    });

    $('body').on('click','.del-file',function() {
            if(confirm('确定删除该附件'))
                return true;
            else
                return false;
        })

    $('#uploadfile-form').submit(function() {
        if($('#file').val() == '') {
            alert('请选择上传附件');
            return false;
        }
    })

    /*
        图片上传部分
     */
    $('body').on('click','.pic-set',function() {
        $('.uploadpic-div, .mask').css("display","block");
    })

    $('body').on('click','.uploadpic-div .upload-no, .mask',function() {
        $('.uploadpic-div, .mask').css({"display":"none"});
    })

    $('body').on('click','.pic-set',function() {
        $('.pic-tr #messageid').val(messageid1);
    })

    $('body').on('click','.pic-tr .upload-reset',function() {
        $(this).siblings('.upload-pic').val('');
        $(this).siblings('.pic-name').val('');
    })

    $('body').on('change','.upload-pic',function(){
        var picName = $(this).val().split("\\").pop();
        $(this).siblings('.pic-name').val(picName);
    });

    $('body').on('click','.pic-set',function() {
        $.ajax({
            url: SHOWFILE,
            data: {messageid:messageid1,type:'pic'},
            dataType: 'json',
            type: 'post',
            success: function(picinfo) {
                $('.uploadpic-div .plus-tr').remove();
                for(var i in picinfo) {
                    var tr = "<tr class='plus-tr'><td></td>"+
                            "<td><img src="+ROOT+picinfo[i]['fileurl']+" /></td>"+
                            "<td><a class='del-pic' href='"+CONTROLLER+"/delfile?id="+picinfo[i]['id']+"&fileurl="+picinfo[i]['fileurl']+"&cid="+cid+"&type=pic'>删除</a></td>"+
                            "</tr>";
                    $('.uploadpic-div .pic-tr').before(tr);
                }
            }
        })
    })

    $('body').on('click','.del-pic',function() {
        if(confirm('确定删除该图片'))
            return true;
        else
            return false;
    })

    $('#uploadpic-form').submit(function() {
        if($('#pic').val() == '') {
            alert('请选择上传图片');
            return false;
        }
    })

