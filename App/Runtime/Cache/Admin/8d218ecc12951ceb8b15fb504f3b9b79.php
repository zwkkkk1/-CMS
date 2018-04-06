<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Admin/css/common.css"/>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Admin/css/main.css"/>
<link rel="stylesheet" href="__PUBLIC__/Admin/Font-Awesome-3.2.1/css/font-awesome.min.css">
<link rel="stylesheet" href="__PUBLIC__/Admin/css/category.css">
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


    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list">
                <i class="icon-home"></i>
                <a href="#">首页</a>
                <span class="crumb-step">&gt;</span>
                <span class="crumb-name">模块管理</span>
            </div>
        </div>
        <div class="result-wrap">
            <ul class="cate-outer-ul">
                <?php $bigCateLst = R('Nav/bigCate',array(),'Widget');?>
                <?php if(is_array($bigCateLst)): $i = 0; $__LIST__ = $bigCateLst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><p><?php echo ($vo["name"]); ?>
                        <?php $midCateLst = R('Nav/sonCate',array($vo),'Widget');?>
                        <span>[<a href="add?previd=<?php echo ($vo["cid"]); ?>">添加子模块</a>]
                        [<a href="edit?cid=<?php echo ($vo["cid"]); ?>">修改</a>]</span>
                        <i class="icon-plus"></i></p>
                        <ul class="cate-middle-ul">
                            <?php if(is_array($midCateLst)): $i = 0; $__LIST__ = $midCateLst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><li><p><?php echo ($vo2["name"]); ?>
                                    <span>[<a href="add?previd=<?php echo ($vo2["cid"]); ?>">添加子模块</a>]
                                    [<a href="edit?cid=<?php echo ($vo2["cid"]); ?>">修改</a>]
                                    [<a href="del?cid=<?php echo ($vo2["cid"]); ?>">删除</a>]</span>
                                    <?php $smallCateLst1 = R('Nav/sonCate', array($vo2), 'Widget');?>
                                    <?php if($smallCateLst1 != ''): ?><i class="icon-plus"></i></p>
                                    <ul class="cate-inner-ul">
                                        <?php if(is_array($smallCateLst1)): $i = 0; $__LIST__ = $smallCateLst1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo3): $mod = ($i % 2 );++$i;?><li><?php echo ($vo3["name"]); ?>
                                                <span>[<a href="edit?cid=<?php echo ($vo3["cid"]); ?>">修改</a>]
                                                [<a href="del?cid=<?php echo ($vo3["cid"]); ?>">删除</a>]</span>
                                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul><?php endif; ?>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>

        </div>
    </div>
    <!--/main-->
</div>
<script type="text/javascript" src="__PUBLIC__/Home/js/jq1.8.js"></script>
<script>
    var cid = '模块管理',
        SHOWFILE = "<?php echo U('showfile');?>";
</script>
<script type="text/javascript" src="__PUBLIC__/Admin/js/modernizr.min.js"></script>
<script src="__PUBLIC__/Admin/js/category.js"></script>
</body>
</html>