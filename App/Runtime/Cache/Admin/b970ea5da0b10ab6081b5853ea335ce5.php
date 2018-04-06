<?php if (!defined('THINK_PATH')) exit();?><td>
    <?php if($type == 1): ?><select class="cid">
                <option value="">请选择</option>
                <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cid"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            <select class="cid">
                <option value="">请选择</option>
            </select>
    <?php else: ?>
        <?php $__FOR_START_27881__=0;$__FOR_END_27881__=$step;for($i=$__FOR_START_27881__;$i < $__FOR_END_27881__;$i+=1){ if($cates[$i] != ''): ?><select class="cid">
                    <option value="<?php echo ($cates[$i]['cid']); ?>"><?php echo ($cates[$i]['name']); ?></option>
                    <?php $cateInfo1 = R('Index/getVolistCate',array($cates[$i]['cid']),'Widget');?>}
                    <?php if(is_array($cateInfo1)): $j = 0; $__LIST__ = $cateInfo1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($j % 2 );++$j;?><option value="<?php echo ($vo["cid"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <?php else: ?>
                <select class="cid">
                    <?php if($info[$i]['name'] != '') {?>
                        <option value="{$info[$i]['cid']}"><?php echo ($info[$i]['name']); ?></option>
                    <?php } ?>
                    <?php if(!empty($cates[$i - 1])) { ?>
                        <?php $cateInfo2 = R('Index/getSonCates',array($cates[$i-1]['cid']),'Widget');?>
                        <?php if(is_array($cateInfo2)): $j = 0; $__LIST__ = $cateInfo2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($j % 2 );++$j;?><option value="<?php echo ($vo["cid"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php } else {?>
                    <option value="">请选择</option>
                    <?php } ?>
                </select><?php endif; } endif; ?>
</td>
<script>
    var SELECTCATE = "<?php echo U('sortCate');?>";
</script>