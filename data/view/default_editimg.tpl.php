<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<script src="<?=SITE_URL?>js/swfobject.js" type="text/javascript"></script>
<script src="<?=SITE_URL?>js/uploadify.js" type="text/javascript"></script><? if(!$imgstr) { ?><script type="text/javascript">
    $(document).ready(function() {
        $('#file_upload').uploadify({
            'uploader'  : '<?=SITE_URL?>css/common/uploadify.swf',
            'script'    : "<?=SITE_URL?>?user/editimg/<?=$user['uid']?>.html",
            'cancelImg' : '<?=SITE_URL?>css/common/cancel.png',
            'auto'      : false,
            'buttonImg'  : '<?=SITE_URL?>css/default/selectimg.gif',
            'fileDataName' : 'userimage',
            'queueSizeLimit' : 2,
            'sizeLimit':1024*1024*2,
            'fileExt'	: '*.jpg;*.jpeg;*.gif;*.png',
            'fileDesc'  : 'User Avatar(.JPG, .GIF, .PNG,.JPEG)',
            'onComplete':function(event, ID, fileObj, response, data) {
                if('ok' == response){
                    alert('头像上传成功，请刷新页面查看更新!');
                }else{
                    alert("上传头像失败，请确认图片类型是否正确!");
                    $('#file_upload').uploadifyCancel(ID);
                    return false;
                }
            }
        });
    });
    function saveimg(){
        $('#file_upload').uploadifyUpload();
    }
</script><? } ?><div class="content">
    <div class="uleft">
        <div class="tximg"><img width="100px" height="100px" src="<?=$user['avatar']?>" alt="<?=$user['username']?>" title="<?=$user['username']?>"></div>
        <div class="txname">
             <?=$user['username']?>
            <? if($user['islogin']) { ?>            <img src="<?=SITE_URL?>css/default/online.gif" align="absmiddle" title="当前在线" alt="当前在线"/>
            <? } else { ?>            <img src="<?=SITE_URL?>css/default/outline.gif" align="absmiddle" title="当前离线" alt="当前离线"/>
            <? } ?>        </div>
        <div class="clr"></div>
        <div class="list">
            <h1 class="on"><a title="我的主页" target="_top" href="<?=SITE_URL?>?user/score.html"><img width="16" height="16" align="absmiddle" src="<?=SITE_URL?>css/default/myhome.gif" /> &nbsp;我的主页</a></h1>
            <h1><a title="我的问答" target="_top" href="<?=SITE_URL?>?user/ask/2.html"><img width="16px" height="15px" align="absmiddle" src="<?=SITE_URL?>css/default/myanswer.gif" /> &nbsp;我的问答</a></h1>            
            <h1 class=""><a title="我的消息" target="_top" href="<?=SITE_URL?>?message/new.html"><img width="16px" height="16px" align="absmiddle" src="<?=SITE_URL?>css/default/mymsg.gif" /> &nbsp;我的消息</a></h1>
            <h1 class=""><a title="我收藏的问题" target="_top" href="<?=SITE_URL?>?user/favorite.html"><img width="14" height="15" align="absmiddle" src="<?=SITE_URL?>css/default/mycollect.gif" /> &nbsp;我的收藏</a></h1>
        </div>
    </div>
    <div class="uright">
        <div class="miaoshu">
            <img width="12px" height="12px" align="texttop" src="<?=SITE_URL?>css/default/tip1.gif">上传头像说明：支持jpg、gif、png、jpeg四种格式图片上传。<br /><font color="red">上传限制：1、图片大小不能超过2M;&nbsp;&nbsp;2、图片长宽大于100*100px时系统将自动压缩</font>
        </div>
        <div class="tab2" id="tab">
            <ul>
                <li>
                    <a href="<?=SITE_URL?>?user/profile.html">个人资料</a>
                </li>
                <li>
                    <a href="<?=SITE_URL?>?user/uppass.html">修改密码</a>
                </li>
                <li  class="on">
                    <a href="<?=SITE_URL?>?user/editimg.html">修改头像</a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>

        <div class="grxx"> 
            <? if(isset($imgstr)) { ?>            <?=$imgstr?>
            <? } else { ?>            <div class="listx">
                <div id="avatar" style=" width:104px;height:104px;float:left;"><img src="<?=$user['avatar']?>" style="border-color: #CDCDCD #CDCDCD #CDCDCD #CDCDCD;border-radius: 5px 5px 5px 5px;border-style: solid;border-width: 1px;height: 100px;padding: 2px;width: 100px;"/></div>
                <div style="float:left;margin-left:20px;margin-top:10px;">
                	<span><input id="file_upload" name="file_upload" type="file"/></span><br />
                	<span><input type="button" onclick="saveimg();" class="button4" value="保&nbsp;存" name="submit" /></span>
                </div>
            </div>
            <div class="clr"></div>
            <div class="shur2">
            </div>
            <? } ?>        </div>
    </div>
</div>
<div class="clr"></div>
<? include template('footer'); ?>
