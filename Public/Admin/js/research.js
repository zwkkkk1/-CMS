var cid1;
    $('.cid').each(function() {
        if($(this).val().length > 0 ) {
            cid1 = $(this).val();
            console.log(cid1);
        }
    })
    $('.cid').on('change',function () {
        cid1 = $(this).val();
        if($('.res-cid').length != 0)
            $('.res-cid').val(cid1);
        if($(this).next().length > 0)
        {
            $(this).nextAll().html("<option value='cid'>请选择</option>");
            var nextCid = $(this).next();
            $.ajax({
                url: SELECTCATE,
                data: {cid: $(this).val()},
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    for(var i in data)
                    {
                        var option = $('<option></option>');
                        option.html(data[i]['name']);
                        option.val(data[i]['cid']);
                        nextCid.append(option);
                    }
                }
            });
        }
    });
