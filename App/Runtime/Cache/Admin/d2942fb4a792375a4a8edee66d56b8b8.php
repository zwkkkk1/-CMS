<?php if (!defined('THINK_PATH')) exit();?>
<div class="crumb-wrap">
    <div class="crumb-list">
        <i class="icon-home"></i>
        <a href="__GROUP__/Message/lst?cid=1">首页</a>
        <span class="crumb-step">&gt;</span>
        <?php for($i = 0; $i < count($nameArr); $i++) { ?>
            <span class="crumb-name"><?php echo $nameArr[$i];?></span>
        <?php if((count($nameArr) - $i)!=1) { ?>
            <span class="crumb-step">&gt;</span>
        <?php }} ?>
    </div>
</div>