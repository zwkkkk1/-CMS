<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Good Town</title>
</head>
<link rel="stylesheet" href="__PUBLIC__/Home/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="__PUBLIC__/Home/css/common.css">
<link rel="stylesheet" href="__PUBLIC__/Home/css/content.css">
<link rel="stylesheet" href="__PUBLIC__/Home/css/public.css">
<link rel="stylesheet" href="__PUBLIC__/Home/css/sidebar.css">
<body onselectstart="return false" ondragstart="return false">
<!--<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">-->
    <!--<div class="container-fluid">-->
        <!--<div class="navbar-header">-->
            <!--<a class="navbar-brand" href="#">菜鸟教程</a>-->
        <!--</div>-->
        <!--<div>-->
            <!--<ul class="nav navbar-nav">-->
                <!--<?php $bigcate = R('Nav/getBigCate2',array(1),'Widget');?>-->
                <!--<li class="active"><a href="__URL__/index">首页</a>-->
                <!--</li>-->
                <!--<?php if(is_array($bigcate)): $i = 0; $__LIST__ = $bigcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
                    <!--<?php if($vo["cid"] == 1): ?>-->
                        <!--<li><a href="__URL__/imgwall" class="dropdown-toggle" data-toggle="dropdown"><?php echo ($vo["name"]); ?></a>-->
                            <!--<ul class="dropdown-menu">-->
                                <!--<li><a href="#">jmeter</a></li>-->
                                <!--<li><a href="#">EJB</a></li>-->
                                <!--<li><a href="#">Jasper Report</a></li>-->
                            <!--</ul>-->
                        <!--</li>-->
                        <!--<?php else: ?>-->
                        <!--<li><a href="__URL__/item?cid=<?php echo ($vo["cid"]); ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo ($vo["name"]); ?></a>-->
                            <!--<ul class="dropdown-menu">-->
                                <!--<li><a href="#">jmeter</a></li>-->
                                <!--<li><a href="#">EJB</a></li>-->
                                <!--<li><a href="#">Jasper Report</a></li>-->
                            <!--</ul>-->
                        <!--</li>-->
                    <!--<?php endif; ?>-->
                <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                <!--<form class="navbar-form navbar-left">-->
                    <!--<div class="form-group">-->
                        <!--<input type="text" class="form-control" placeholder="Search">-->
                    <!--</div>-->
                    <!--<button type="submit" class="btn btn-default">Submit</button>-->
                <!--</form>-->
            <!--</ul>-->
            <!--<p class="navbar-text navbar-right">登录\注册</p>-->
        <!--</div>-->
    <!--</div>-->
<!--</nav>-->
<nav class="navbar" role="navigation" style="margin-bottom:0px; position:fixed; top:0; z-index:10; width:100%;">
    <ul class="navbar-nav">
        <?php $bigcate = R('Nav/getBigCate2',array(1),'Widget');?>
        <li class="active"><a href="__URL__/index">首页</a>
        </li>
        <?php if(is_array($bigcate)): $i = 0; $__LIST__ = $bigcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["cid"] == 1): ?><li><a href="__URL__/imgwall"><?php echo ($vo["name"]); ?></a>
                    <?php $smallCate = R('Nav/getSmallCate',array($vo),'Widget');?>
                    <ul class="drop">
                        <?php if(is_array($smallCate)): foreach($smallCate as $key=>$vo1): ?><li><a href="__URL__/item?cid=<?php echo ($vo1["cid"]); ?>"><?php echo ($vo1["name"]); ?></a></li><?php endforeach; endif; ?>
                    </ul>
                </li>
                <?php else: ?>
                <li><a href="__URL__/item?cid=<?php echo ($vo["cid"]); ?>"><?php echo ($vo["name"]); ?></a>
                    <?php $smallCate = R('Nav/getSmallCate',array($vo),'Widget');?>
                    <ul class="drop">
                        <?php if(is_array($smallCate)): foreach($smallCate as $key=>$vo1): ?><li><a href="__URL__/item?cid=<?php echo ($vo1["cid"]); ?>"><?php echo ($vo1["name"]); ?></a></li><?php endforeach; endif; ?>
                    </ul>
                </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <div class="search">
        <form action="__URL__/research" method="get" class="search-frm">
            <input type="text" name="keywords" class="search-box" placeholder="搜索内容">
            <a href="#" class="search-a"><span class="glyphicon glyphicon-search search-btn" style="color:#333;"></span></a>
        </form>

    </div>
    <div class="user">
        <?php if($_SESSION['username'] == '') { ?>
        <span class="sidebar-trigger" style="color: #fff">登录&nbsp/&nbsp注册</span>
        <?php } else {?>
        欢迎回来，<?php echo $_SESSION['username'];?>!
        <a href="__APP__/Index/layout"><span class="layout-btn" onclick="return confirm('确定退出');">退出</span></a>
        <?php }?>
    </div>
</nav>

<script src="__PUBLIC__/Home/js/jq1.8.js"></script>
<script src="__PUBLIC__/Home/js/public.js"></script>
<script>
    $('.search-a').click(function () {
        $(this).parents('.search-frm').submit();
        return false;
    })

    $('.navbar-nav li').hover(function () {
        $(this).find('.drop').css({'display': 'block'});
    }, function () {
        $(this).find('.drop').css({'display': 'none'});
    })

</script>
<div class="headImg">
</div>
<div class="content">
    <div class="title"><?php echo ($mesInfo["name"]); ?></div>
    <div class="small-title"><?php echo ($mesInfo["title"]); ?></div>
    <ul class="likeNum">
        <li><span class="glyphicon glyphicon-heart heart"></li>
        <li>Like</li>
        <li><span class="collect-span"><?php echo ($mesInfo["collect"]); ?></span></li>
    </ul>
    <div class="hid-detail" style="display: none">
        <?php echo ($mesInfo["content"]); ?>
    </div>
    <div class="detail">

    </div>

</div>
<ul class="message">
    <li class="time"><span>编辑时间：</span><?php echo ($mesInfo["time"]); ?></li>
    <li class="author"><span>作者：</span><?php echo ($mesInfo["author"]); ?></li>
    <li class="clickNum"><span>点击量：</span><?php echo ($mesInfo["hit"]); ?></li>
</ul>

<div class="comment fixed">
    <div class="left-comment">
        <span class="glyphicon glyphicon-user user-logo"></span>
    </div>
    <div class="right-comment">
        <input type="hidden" name="uid" id="uid" value="<?php echo $_SESSION['uid'];?>">
        <input type="hidden" name="mid" id="mid" value="<?php echo ($mesInfo["id"]); ?>">
        <textarea rows="5" style="resize:none;" placeholder="扯淡、吐槽、表扬、鼓励......想说啥就说啥!" id="comment"></textarea>
        <button class="submit">发表评论</button>
    </div>
</div>

<ul class="reply">
    <?php if(is_array($comment)): $i = 0; $__LIST__ = $comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
            <span class="glyphicon glyphicon-user user-logo"></span>
            <div class="reply-content">
                <p class="name"><?php echo ($vo["name"]); ?></p>
                <p class="word"><?php echo ($vo["content"]); ?></p>
                <p class="time">时间:<?php echo ($vo["time"]); ?></p>
            </div>
            <div class="good">
                <span class="glyphicon glyphicon-thumbs-up"></span>
                <input type="hidden" value="<?php echo ($vo["id"]); ?>" id="id">
                <div class="good-num"><?php echo ($vo["up"]); ?></div>
            </div>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>

<footer>
    <div class="foot fixed">
        <ul class="left-foot">
            <li>网站首页</li>
            <li>企业合作</li>
            <li>联系我们</li>
            <li>意见反馈</li>
            <li>友情链接</li>
        </ul>
        <ul class="right-foot">
            <li><img src="__PUBLIC__/Home/images/wechat.png"></li>
            <li><img src="__PUBLIC__/Home/images/weibo.png"></li>
            <li><img src="__PUBLIC__/Home/images/qq.png"></li>
        </ul>
    </div>
</footer>
<div class="mask"></div>
<div class="sidebar">
    <form class="login-frm">
        <h3>用户登录</h3>&nbsp/&nbsp<h4><a href="__ROOT__/index.php/Admin" target="_blank">管理员登录</a></h4>
        <div class="form-group">
            用户名
            <input type="username" class="form-control" name="username" placeholder="Username" id="username1">
        </div>
        <div class="form-group">
            密码
            <input type="password" class="form-control" name="password" placeholder="Password" id="password1">
        </div>
        <button class="login-submit btn btn-default">登录</button>
        <a class="reg-btn">注册</a>
    </form>

    <form style="display: none" class="reg-frm">
        <h3>用户注册</h3>
        <div class="form-group">
            用户名<span class="tip-span"></span>
            <input type="username" class="form-control" name="username" placeholder="Username" id="username2">
        </div>
        <div class="form-group">
            密码<span class="tip-span"></span>
            <input type="password" class="form-control" name="password" placeholder="Password" id="password2">
        </div>
        <div class="form-group">
            确认密码<span class="tip-span"></span>
            <input type="password" class="form-control" name="repassword" placeholder="Password" id="repassword">
        </div>
        <button class="reg-submit btn btn-default">注册</button>
        <a class="back-btn">返回</a>
    </form>
</div>


</body>
<script>
    var id = '<?php echo ($mesInfo["id"]); ?>',
        URL = "<?php echo U('userReg');?>",
        changeUp = "<?php echo U('changeUp');?>",
        judgeUrl = "<?php echo U('judgeUsername');?>",
        layoutURL = "<?php echo U('layout');?>",
        loginURL = "<?php echo U('userLogin');?>",
        changeCollect = "<?php echo U('changeCollect');?>",
        CONTROLLER = "__URL__",
        PUBLIC = "__PUBLIC__";
    var imgUrlPrefix = "<?php echo (C("IMG_URL_PREFIX")); ?>";

</script>
<script type="text/javascript" src="__PUBLIC__/Home/js/jquery-1.9.1.min.js"></script>
<script src="__PUBLIC__/Home/bootstrap/js/bootstrap.min.js"></script>
<script src="__PUBLIC__/Home/js/judge1.js"></script>
<script src="__PUBLIC__/Home/js/content.js"></script>
<script src="__PUBLIC__/Home/js/sidebar.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/ueditor/ueditor.all.js"></script>
<script src="__PUBLIC__/Home/js/common.js"></script>
<script>
    window.onload = function () {
        var url = '<?php echo ($mesInfo["url"]); ?>';
        $('.headImg').css('background', 'url("__PUBLIC__/Home/images/img3.jpg")');
        var content = $('.hid-detail').html();
        var string = UE.htmlparser(content, true);
        content = addImgUrlPrefix(string);
        $('.detail').html(content);

    };
    $('.submit').on('click', function () {
        $.ajax({
            url: "<?php echo U('addComment');?>",
            data: {content: $('#comment').val(), uid: $('#uid').val(), mesid: $('#mid').val()},
            dataType: 'json',
            type: 'post',
            success: function (res) {
                if (res.isok == 1) {
                    alert('发布成功');
                    location.reload();
                }
                else {
                    alert(res.isok);
                }
            }
        })
    })

</script>
</html>