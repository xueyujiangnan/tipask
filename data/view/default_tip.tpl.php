<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<div class="content">
    <div class="dh" id="pos"><a href="<?=SITE_URL?>"><?=$setting['site_name']?></a>&gt; 消息提示</div>
    <div class="tips">
        <div class="tipmgs"><?=$message?></div>
        <div class="redirect">            
            <? if($redirect == 'BACK') { ?>            <a class="question" href="javascript:history.go(-1);">返回原处</a>&nbsp;&nbsp;
            <a class="question" href="<?=SITE_URL?>?user/ask.html">我的提问</a>&nbsp;&nbsp;
            <a class="question" href="<?=SITE_URL?>">回到首页</a>  
            <? } elseif($redirect!='STOP') { ?>            页面将在3秒后自动跳转到下一页，你也可以直接点 <a href="<?=$redirect?>" >立即跳转</a>。
            <script type="text/javascript">
                function redirect(url, time) {
                    setTimeout("window.location='" + url + "'", time * 1000);
                }
                redirect('<?=$redirect?>', 3);
            </script>
            <? } ?>        </div>
    </div>
</div>
<div class="clr"></div>
<? include template('footer'); ?>
