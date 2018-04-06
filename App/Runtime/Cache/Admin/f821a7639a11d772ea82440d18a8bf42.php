<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
        <?php echo R('Index/topList',array($_GET['cid']),'Widget');?>
        <div class="result-wrap">
            <div class="result-content">
                <form action="" class="addform" method="post" id="myform" name="myform">
                    <table class="insert-tab" width="100%">
                        <tbody>
                            <tr>
                                <th><i class="require-red">*</i>标题：</th>
                                <td>
                                    <input class="common-text required" id="title" name="title" size="30" type="text" value="">
                                </td>
                            </tr>
                            <tr>
                                <th>发布者：</th>
                                <td>
                                    <input class="common-text required" id="author" name="author" size="30" type="text" value="">
                                </td>
                            </tr>
                            <tr>
                                <th>板块：</th>
                                <?php echo R('Index/selectCategory',array($_GET['cid']),'Widget');?>

                            </tr>
                            <tr>
                                <th>时间：</th>
                                <td><input type="text"  value="" id="time" name="time"  style="cursor: pointer"></td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>内容：</th>
                                <td>
                                    <textarea  id="content" name="content" class="content"></textarea>
                                </td>
                            </tr>
                            <!--<tr>-->
                                <!--<th><i class="require-red">*</i>验证码：</th>-->
                                <!--<td>-->
                                    <!--<input type="text" id="verify" name="verify" class="input_style" size="15" value=""/>-->
                                    <!--<img src="__PUBLIC__/captcha.php" id="verify-img" height="30" width="100" style="cursor:pointer; " onclick='this.src="__PUBLIC__/captcha.php?"+Math.random()'/>-->
                                <!--</td>-->
                            <!--</tr>-->
                            <tr>
                                <th></th>
                                <td>
                                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                                    <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
                                </td>
                            </tr>
                        </tbody></table>
                </form>
            </div>
        </div>
    </div>
    <!--/main-->
</div>

<script>
var URL = "<?php echo U('add');?>",
    cid = <?php echo $_GET['cid'];?>,
    admin = "<?php echo $_SESSION['outer_username'];?>",
    CONTROLLER = "__URL__",
    PUBLIC = "__PUBLIC__";
</script>
<script type="text/javascript" src="__PUBLIC__/Home/js/jq1.8.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/ueditor/ueditor.all.js"></script>
<script type="text/javascript">
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue=UE.getEditor('content',{
        initialFrameWidth:700,
        initialFrameHeight:300,
        scaleEnabled:true,
    });

</script>
<script type="text/javascript" src="__PUBLIC__/Admin/js/modernizr.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/js/research.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/js/judge1.js"></script>
<script src="__PUBLIC__/Admin/Datepicker/js/foundation-datepicker.js"></script>
<script src="__PUBLIC__/Admin/Datepicker/js/locales/foundation-datepicker.zh-CN.js"></script>       
<script>
    $('#time').fdatepicker({
        format: 'yyyy-mm-dd',
    });

    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var checkin = $('#dpd1').fdatepicker({
        onRender: function (date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function (ev) {
        if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.update(newDate);
        }
        checkin.hide();
        $('#dpd2')[0].focus();
    }).data('datepicker');
    var checkout = $('#dpd2').fdatepicker({
        onRender: function (date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function (ev) {
        checkout.hide();
    }).data('datepicker');
</script>
</body>
</html>