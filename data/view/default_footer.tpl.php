<? if(!defined('IN_TIPASK')) exit('Access Denied'); ?>
<!--footer-->
<div class="footer">
                <a href="<?=SITE_URL?>" target="_blank"><?=$setting['site_name']?></a><span style="font-family: Verdana;"> |</span>
            <a href="mailto:<?=$setting['admin_email']?>" target="_blank">联系我们</a> <span style="font-family: Verdana;">|</span>
            <a href="http://www.miibeian.gov.cn" target="_blank"><?=$setting['site_icp']?></a> <span style="font-family: Verdana;"></span>
     <br />
    <span class="bq">Processed in <?=$runtime?> second(s), <?=$querynum?> queries.</span><br />
    <span style="font-family:arial;font-size:12px;">Powered by <a style="color:#303030" href="http://www.tipask.com/" target="_blank" >Tipask</a> <?=TIPASK_VERSION?>&copy;2009-2012.</span>
    <br/>
    <br/>
</div>
<?=$setting['site_statcode']?>
</body>