<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/Admin/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/Admin/css/main.css"/>
    <link rel="stylesheet" href="__PUBLIC__/Admin/Font-Awesome-3.2.1/css/font-awesome.min.css">
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
                <span class="crumb-name">关键字"<strong><?php echo $_GET['keywords'];?></strong>"查询</span>
            </div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="__URL__/research" method="get" class="research-frm">
                    <table class="search-tab">
                        <tr>
                            <th width="120">选择板块:</th>
                            <?php echo R('Index/selectCategory',array(),'Widget');?>
                            <th width="70">关键字:</th>
                            <td><input class="common-text" placeholder="关键字" name="keywords" type="text"></td>
                            <td><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td>
                            <td><button onclick="history.go(-1)">返回</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
                <div class="result-title">
                    <div class="result-list" style="visibility: hidden;">
                        <a href="#"><i class="icon-plus"></i>新增</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th width="4%" >ID</th>
                            <th>标题</th>
                            <th>类型</th>
                            <th>发布者</th>
                            <th>发布时间</th>
                            <th width="20%">操作</th>
                        </tr>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td><?php echo ($vo["id"]); ?></td>
                                <td><a href="__ROOT__/index.php/Index/content?id=<?php echo ($vo["id"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></td>
                                <td><?php echo ($vo["name"]); ?></td>
                                <td><?php echo ($vo["author"]); ?></td>
                                <td><?php echo ($vo["time"]); ?></td>
                                <td>
                                    <a href="__URL__/edit?cid=<?php echo ($info["cid"]); ?>&id=<?php echo ($vo["id"]); ?>">编辑</a>
                                    <a class="file-set" onclick="messageid1=<?php echo ($vo["id"]); ?>;">设置附件</a>
                                    <a href="__URL__/del?cid=<?php echo ($info["cid"]); ?>&id=<?php echo ($vo["id"]); ?>" onclick="return confirm('确定删除该文章')">删除</a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                    <div class="list-page"><?php echo ($page); ?></div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
<div class="mask"></div>
<div class="upload-div">
    <i class="icon-remove icon-2x upload-no"></i>
    <table class="upload-tab">
        <tr><td>已上传文件</td></tr>
        <tr class="file-tr">
            <td>添加附件</td>
            <td>
                <form action="__URL__/upload?cid=<?php echo $_GET['cid'];?>" method="post" enctype="multipart/form-data" class="upload-form">
                    <input type="file" name="file" id="file" class="upload-file">
                    <input type="hidden" name="filetype" id="filetype" value="file">
                    <input type="hidden" name="messageid" id="messageid">
                    <input type="hidden" name="filename" id="filename" class="file-name">
                    <input type="submit" value="上传">
                    <input type="button" value="重置" class="upload-reset">
                </form>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript" src="__PUBLIC__/Home/js/jq1.8.js"></script>
<script>
var SHOWFILE = "<?php echo U('showfile');?>",
    SORTCATE = "<?php echo U('sortcate');?>",
    ROOT = '__ROOT__',
    CONTROLLER = '__URL__';
</script>
<script type="text/javascript" src="__PUBLIC__/Admin/js/modernizr.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/js/upload1.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/js/research.js"></script>
</body>
</html>