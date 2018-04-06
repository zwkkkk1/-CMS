<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/Admin/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/Admin/css/main.css"/>
    <link rel="stylesheet" href="__PUBLIC__/Admin/Font-Awesome-3.2.1/css/font-awesome.min.css">
    <link href="__PUBLIC__/Admin/Datepicker/css/foundation-datepicker.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="__APP__/Admin/Message/lst?cid=1">首页</a></li>
                <li><a href="__ROOT__/index.php" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li style="margin-right:10px;">管理员:<?php echo $_SESSION['outer_username'];?></li>
                <li><a href="__APP__/Admin/Admin/edit/id/<?php echo $_SESSION['outer_id']?>">修改密码</a></li>
                <li><a href="__APP__/Admin/Admin/layout">退出</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                <?php $bigCate = R('Nav/bigCate',array(0),'Widget');?>
                    <a href="#"><i class=" icon-tasks" style="margin-right: 15px;margin-left: 20px"></i>常用操作</a>
                    <ul class="sub-menu">
                    <?php if(is_array($bigCate)): foreach($bigCate as $key=>$vo): ?><li class="sub-menu-li"><a href="__GROUP__/Message/lst?cid=<?php echo ($vo["cid"]); ?>" name="<?php echo ($vo["cid"]); ?>"><?php echo ($vo["name"]); ?></a>
                            <ul class="menu-ul">
                            <?php $smallCate = R('Nav/sonCate',array($vo),'Widget');?>
                                <?php if(is_array($smallCate)): foreach($smallCate as $key=>$vo1): if($vo1["name"] == '现任领导'): ?><li><a href="__GROUP__/Leader/lst" name="现任领导"><?php echo ($vo1["name"]); ?></a></li>
                                    <?php else: ?>
                                        <li><a href="__GROUP__/Message/lst?cid=<?php echo ($vo1["cid"]); ?>" name="<?php echo ($vo1["cid"]); ?>"><?php echo ($vo1["name"]); ?></a></li><?php endif; endforeach; endif; ?>
                            </ul>
                        </li><?php endforeach; endif; ?>
                        <li class="sub-menu-li"><a href="__GROUP__/Category/lst" name="模块管理">模块管理</a>
                    <?php if($_SESSION['outer_id'] == 1): ?><li class="sub-menu-li"><a href="__GROUP__/Admin/lst?cid=50" name="管理员管理">管理员管理</a></li><?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>


    <!--/sidebar-->
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list">
                <i class="icon-home"></i>
                <a href="__GROUP__/Message/lst?cid=1">首页</a>
                <span class="crumb-step">&gt;</span>
                <a href="__URL__/lst?cid=50"><span class="crumb-name">管理员管理</span></a>
                <span class="crumb-step">&gt;</span>
                <span class="crumb-name">新增管理员</span>
            </div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <table class="insert-tab" width="100%">
                    <tbody>
                        <tr>
                            <th><i class="require-red">*</i>管理员账号：</th>
                            <td>
                                <input class="common-text required" id="username" name="username" size="30" type="text" value="">
                            </td>
                        </tr>
                        <tr>
                            <th>密码：</th>
                            <td>
                                <input type="password" id="pwd" name="pwd">
                            </td>
                        </tr>
                        <tr>
                            <th>确认密码：</th>
                            <td>
                                <input type="password" id="repwd" name="repwd">
                            </td>
                        </tr>
                        <!--<tr>-->
                            <!--<th><i class="require-red">*</i>验证码：</th>-->
                            <!--<td>-->
                                <!--<input type="text" id="verify" name="verify" class="input_style" size="15" value=""/>-->
                                <!--<img src="__PUBLIC__/captcha.php" id="verify-img" height="30" width="100" style="cursor:pointer; " onclick="this.src='__PUBLIC__/captcha.php'"/>-->
                            <!--</td>-->
                        <!--</tr>-->
                        <tr>
                            <th></th>
                            <td>
                                <input class="btn btn-primary btn6 mr10 add-admin" value="提交" type="button">
                                <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/main-->
</div>

<script>
var cid = "管理员管理",
    URL = "<?php echo U('add');?>",
    CONTROLLER = "__URL__",
    PUBLIC = "__PUBLIC__";

</script>
<script type="text/javascript" src="__PUBLIC__/Home/js/jq1.8.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/js/modernizr.min.js"></script>
<script>
$('.add-admin').click(function() {
    var username = $('#username').val(),
        pwd = $('#pwd').val(),
        repwd = $('#repwd').val(),
        verify = $('#verify').val();
    var verify_img = $('#verify-img');
    if(username == '')
    {
        alert('用户名不得为空');
        return false;
    }
    if(pwd == '')
    {
        alert('密码不得为空');
        return false;
    }
    if(repwd == '')
    {
        alert('确认密码不得为空');
        return false;
    }
    if(pwd != repwd)
    {
        alert('确认密码错误');
        return false;
    }
//    if(verify == '')
//    {
//        alert('验证码不得为空');
//        return false;
//    }

    $.ajax({
        url: URL,
        data: {username: username, password: pwd, verify: verify},
        dataType: 'json',
        type: 'post',
        success: function(data) {
                    if(data.isok==1)
                    {
                        alert('添加成功');
                        location.href=data.url;
                    } else {
                        alert(data.isok);
                        verify_img.attr('src',PUBLIC+"/captcha.php");
                    }
                }
    })
})
</script>
</body>
</html>