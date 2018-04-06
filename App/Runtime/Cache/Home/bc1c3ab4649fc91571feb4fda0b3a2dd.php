<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta>
    <title>Good Town</title>
</head>
<link rel="stylesheet" href="__PUBLIC__/Home/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="__PUBLIC__/Home/css/common.css">
<link rel="stylesheet" href="__PUBLIC__/Home/css/item.css">
<link rel="stylesheet" href="__PUBLIC__/Home/css/public.css">
<link rel="stylesheet" href="__PUBLIC__/Home/css/sidebar.css">
<body onselectstart="return false" ondragstart="return false" style="padding-top:72px;">
<!-- 导航栏 -->
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

<!-- 轮播图 -->
<div id="myCarousel" class="carousel slide">
    <!-- 轮播（Carousel）指标 -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <!-- 轮播（Carousel）项目 -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="__PUBLIC__/Home/images/img1.jpg" alt="First slide">
        </div>
        <div class="item">
            <img src="__PUBLIC__/Home/images/img2.jpg" alt="Second slide">
        </div>
        <div class="item">
            <img src="__PUBLIC__/Home/images/img3.jpg" alt="Third slide">
        </div>
    </div>
    <!-- 轮播（Carousel）导航 -->
    <a class="carousel-control left" href="#myCarousel"
       data-slide="prev">&lsaquo;
    </a>
    <a class="carousel-control right" href="#myCarousel"
       data-slide="next">&rsaquo;
    </a>
</div>

<div class="content">

    <section class="food-sec">
        <div class="container">
            <div class="container-bt">
                <h2>关键字<span style="color: #286090;">"<?php echo $_GET['keywords'];?>"</span>搜索</h2>
            </div>
            <?php if(is_array($data["list"])): $i = 0; $__LIST__ = $data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="__URL__/content?id=<?php echo ($vo["id"]); ?>">
                    <?php if($vo["url"] != ''): ?><div class="mes-box clearfix">
                            <img src="<?php echo ($vo["url"]); ?>" class="mes-box-img">
                            <div class="mes-box-bt">
                                <?php echo ($vo["title"]); ?>
                            </div>
                            <div class="mes-box-con">
                                同里状元蹄是江苏苏州同里一道特色传统名菜。相传宋淳佑四年，同里人魏汝贤高中状元。魏状元特别喜欢吃红烧蹄，到了清光绪年间，退思园主人任兰生因仰慕魏状元，特聘名厨烧制
                            </div>
                        </div><?php endif; ?>
                </a><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="list-page">
            <?php echo ($data["show"]); ?>
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
        loginURL = "<?php echo U('userLogin');?>",
        CONTROLLER = "__URL__",
        PUBLIC = "__PUBLIC__";
</script>
<script type="text/javascript" src="__PUBLIC__/Home/js/jquery-1.9.1.min.js"></script>
<script src="__PUBLIC__/Home/bootstrap/js/bootstrap.min.js"></script>
<script src="__PUBLIC__/Home/js/judge1.js"></script>
<script src="__PUBLIC__/Home/js/sidebar.js"></script>
</html>