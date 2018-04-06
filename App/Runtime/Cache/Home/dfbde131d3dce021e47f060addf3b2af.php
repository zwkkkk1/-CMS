<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>旅游资讯发布系统</title>
</head>
<link rel="stylesheet" href="__PUBLIC__/Home/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="__PUBLIC__/Home/css/common.css">
<link rel="stylesheet" href="__PUBLIC__/Home/css/index.css">
<link rel="stylesheet" href="__PUBLIC__/Home/css/sidebar.css">
<body onselectstart="return false" ondragstart="return false">
<div class="header-wrapper">
    <div class="white-mask"></div>
    <header>
    <div class="nav-wrapper">
        <nav class="top-nav">
<!--             <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <img src="__PUBLIC__/Home/images/logo.png" style="width: 30%">
                    </a>
                </div>
            </div> -->
            <ul>
                <?php $bigcate = R('Nav/getBigCate',array(1),'Widget');?>
                <?php if($_SESSION['username'] == '') { ?>
                <li><span class="glyphicon glyphicon-user sidebar-trigger" style="color: #fff"></span></li>
                <?php } else {?>
                <li><a href="__APP__/Index/layout"><span class="layout-btn" onclick="return confirm('确定退出');">退出</span></a></li>
                <li>欢迎回来，<?php echo $_SESSION['username'];?>!</li>

                <?php } ?>
                <?php if(is_array($bigcate)): $i = 0; $__LIST__ = $bigcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["cid"] == 1): ?><li><a href="__URL__/imgwall"><?php echo ($vo["name"]); ?></a></li>
                        <?php else: ?>
                        <li><a href="__URL__/item?cid=<?php echo ($vo["cid"]); ?>"><?php echo ($vo["name"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                <li><a href="__URL__/index">首页</a></li>
            </ul>
        </nav>
    </div>
</header>



<script src="__PUBLIC__/Home/js/jq1.8.js"></script>
<script>
    $('.search-a').click(function () {
        $(this).parents('.search-frm').submit();
        return false;
    })

</script>


    <div class="banner">
        <h1>旅游资讯发布系统</h1>
        <p>If you don't walk out, you will think that this is the whole world.</p>
        <p>如果你不出去走走，就会以为眼前的就是全世界。</p>
        <p style="text-align: right;">————《天堂电影院》</p>
    </div>

    <!--<div class="banner">-->
        <!--<img src="__PUBLIC__/Home/images/logo.png" style="width: 80%">-->
        <!--<h2>旅游资讯平台</h2>-->

    <!--</div>-->

</div>

<div class="content">
    <section class="scene-sec" style="padding:2rem 10.05rem;">
        <div class="container">
            <div class="container-bt">
                <h2>古镇宣传</h2>
            </div>
            <div class="shadow">
                <video src="__PUBLIC__/Home/audio/index.mp4" controls="controls" id="video"></video>
                <div class="play"><span class="glyphicon glyphicon-play"></span></div>
            </div>
        </div>
    </section>
    <section class="scene-sec">
        <div class="container">
            <div class="container-bt">
                <h2>美丽古镇</h2>
            </div>
            <ul class="clearfix" style="margin: 0 auto;width: 100%">
                <?php if(is_array($scene)): $i = 0; $__LIST__ = $scene;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                        <img src="<?php echo ($vo["url"]); ?>" alt="">
                        <a href="__URL__/content?id=<?php echo ($vo["id"]); ?>" class="scene-a">
                            <span class="glyphicon glyphicon-eye-open scene-eye"></span>
                            <span class="scene-name"><?php echo ($vo["title"]); ?></span>
                        </a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </section>

    <section class="food-sec">
        <div class="container">
            <div class="container-bt">
                <h2>美食文化</h2>
            </div>
            <?php if(is_array($food)): $i = 0; $__LIST__ = $food;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="__URL__/content?id=<?php echo ($vo["id"]); ?>">
                    <div class="mes-box clearfix">
                        <img src="<?php echo ($vo["url"]); ?>" class="mes-box-img">
                        <div class="mes-box-bt">
                            <?php echo ($vo["title"]); ?>
                        </div>
                        <div class="mes-box-con">
                            <?php echo ($vo["desc"]); ?>
                        </div>
                    </div>
                </a><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </section>
</div>

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
    var cid = "模块管理",
        URL = "<?php echo U('userReg');?>",
        judgeUrl = "<?php echo U('judgeUsername');?>",
        layoutURL = "<?php echo U('layout');?>",
        loginURL = "<?php echo U('userLogin');?>",
        CONTROLLER = "__URL__",
        PUBLIC = "__PUBLIC__";
</script>
<script type="text/javascript" src="__PUBLIC__/Home/REM-unit-polyfill-master/js/rem.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/html5shiv-master/src/html5shiv.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/Respond-master/src/respond.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/js/jquery-1.9.1.min.js"></script>
<script src="__PUBLIC__/Home/bootstrap/js/bootstrap.min.js"></script>
<script src="__PUBLIC__/Home/js/index.js"></script>
<script src="__PUBLIC__/Home/js/sidebar.js"></script>
<script src="__PUBLIC__/Home/js/judge1.js"></script>
</html>