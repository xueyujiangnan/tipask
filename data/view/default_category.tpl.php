<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); $adlist = $this->fromcache("adlist"); ?><div class="content">
    <div class="dh">
        <a href="<?=SITE_URL?>"><?=$setting['site_name']?></a>
        
<? if(is_array($navlist)) { foreach($navlist as $nav) { ?>
        &gt; <a href="<?=SITE_URL?>?c-<?=$nav['id']?>.html"><?=$nav['name']?></a>
        
<? } } ?>
        <? if($cid!='all') { ?>&gt; <?=$category['name']?><? } ?>    </div>
    <div class="cleftbox">
        <div class="tag">
            <div class="tagtitle">
                <ul>
                    <li class="tga1"></li>
                    <li class="tga2">&nbsp;问题分类&nbsp;&nbsp;<span class="rss"><a href="<?=SITE_URL?>?rss/category/<?=$cid?>.html"><img src="<?=SITE_URL?>css/default/rss.gif"  title="您可以在客户端借助于支持RSS的聚合工具软件，在不打开网站内容页面的情况下阅读网站内容。"/></a></span></li>
                    <li class="tga3"></li>
                </ul>
            </div>
            <div class="tagcon">
                <div id="tab_c">
                    <dl>
                        
<? if(is_array($sublist)) { foreach($sublist as $index => $sub) { ?>
                        <? if($sub['id']==$cid) { ?>                        <dt  class="tab_css2"><strong><? echo cutstr($sub['name'],10,''); ?></strong><span class="dlnum">(<?=$sub['questions']?>)</span></dt>
                        <? } else { ?>                        <dt  class="tab_css2"><a href="<?=SITE_URL?>?c-<?=$sub['id']?>.html"><? echo cutstr($sub['name'],10,''); ?></a><span class="dlnum">(<?=$sub['questions']?>)</span></dt>
                        <? } ?>                        
<? } } ?>
                    </dl>
                    <br class="clear">
                </div>
            </div>
            <div class="tagbuttom">
                <ul>
                    <li class="tgba1"></li>
                    <li class="tgba2"></li>
                    <li class="tgba3"></li>
                </ul>
            </div>
        </div>
        <? if((isset($adlist['category']['left1']) && trim($adlist['category']['left1']))) { ?>        <?=$adlist['category']['left1']?>
        <? } ?>        <p class="blank10"></p>
        <div class="title">
            <ul>
                <? if(all==$status) { ?><li class="on">全部问题</li><? } else { ?><li class="current_none"><a href="<?=SITE_URL?>?c-<?=$cid?>/all.html">全部问题</a></li><? } ?>                <? if(6==$status) { ?><li class="on">推荐问题</li><? } else { ?><li class="current_none"><a href="<?=SITE_URL?>?c-<?=$cid?>/6.html">推荐问题</a></li><? } ?>                <? if(4==$status) { ?><li class="on">悬赏问题</li><? } else { ?><li class="current_none"><a href="<?=SITE_URL?>?c-<?=$cid?>/4.html">悬赏问题</a></li><? } ?>                <? if(1==$status) { ?><li class="on"><font color="#ff6600">？</font>待解决</li><? } else { ?><li class="current_none"><a href="<?=SITE_URL?>?c-<?=$cid?>/1.html"><font color="#ff6600">？</font>待解决</a></li><? } ?>                <? if(2==$status) { ?><li class="on"><font color="#1bbf00">√ </font>已解决</li><? } else { ?><li class="current_none"><a href="<?=SITE_URL?>?c-<?=$cid?>/2.html"><font color="#1bbf00">√ </font>已解决</a></li><? } ?>             
            </ul>
            <div class="blank0"> </div>
        </div>

        <div class="clist">
            <ul>
                <li class="li1"><span id="loading"></span>标题(共<?=$rownum?>条)</li>
                <li class="li2">回答/查看</li>
                <li class="li3">状态</li>
                <li class="li4">提问时间</li>
            </ul>
            
<? if(is_array($questionlist)) { foreach($questionlist as $question) { ?>
            <ul>
                <li class="li1">
                    <? if($question['price'] > 0) { ?>                    <img src="<?=SITE_URL?>css/default/TB2.gif" /><span class="qlscore"><?=$question['price']?></span>
                    <? } ?>                    <a href="<?=$question['url']?>" target="_blank" title="<?=$question['title']?>"><? echo cutstr($question['title'],38); ?></a>
                    &nbsp;<span class="lei">[<a target="_blank" href="<?=SITE_URL?>?c-<?=$question['cid']?>.html" title="<?=$question['category_name']?>" class="lei"><? echo cutstr($question['category_name'],10,''); ?></a>]</span>
                </li>
                <li class="li2"><?=$question['answers']?>/<?=$question['views']?></li>
                <li class="li3"><img src="<?=SITE_URL?>css/common/icn_<?=$question['status']?>.gif" /></li>
                <li class="li4"><?=$question['format_time']?></li>
            </ul>
            
<? } } ?>
        </div>
        <div class="blank20"></div>
        <div class="pages"><div class="scott"><?=$departstr?></div></div>

    </div>
    <div class="right1">
        <div class="gg">
            <div class="ggtitle">
                <ul>
                    <li class="gga11"></li>
                    <li class="gga21">
                        <div class="juzhong">
                            <div class="qico" >
                                <img src="<?=SITE_URL?>css/default/user.png" class="noteicon" alt="知道专家" />
                            </div>
                            分类专家
                        </div>
                    </li>
                    <li class="gga31"></li>
                </ul>
            </div>
            <div class="clr"></div>
            <div class="ggcon2">
                <div class="rb_zj_mmc1" >
                    <ul>
                        
<? if(is_array($expertlist)) { foreach($expertlist as $expert) { ?>
                        <li>
                            <div class="zjimg1">
                                <a href="<?=SITE_URL?>?u-<?=$expert['uid']?>.html">
                                    <img height="50px" width="50px" src="<?=$expert['avatar']?>">
                                </a>
                            </div>
                            <div class="jbzl1">
                                <h3><a href="<?=SITE_URL?>?u-<?=$expert['uid']?>.html"><?=$expert['username']?></a><img src="<?=SITE_URL?>css/default/expert.gif" align="absmiddle" title="专家" /></h3>
                                回答数：<?=$expert['answers']?>
                                魅力值：<?=$expert['credit3']?>
                                <a href="<?=SITE_URL?>?question/add/<?=$expert['uid']?>.html">
                                    <img src="<?=SITE_URL?>css/default/wytw.gif" height="20px" width="60px"/>
                                </a>
                            </div>
                            <div class="clr"></div>
                        </li>
                        
<? } } ?>
                    </ul>
                </div>
                <div class="listcon"></div>
                <div class="more"><a href="<?=SITE_URL?>?expert/default.html" target="_blank" title="查看更多">查看更多专家</a></div>
                <div class="clr"></div>
            </div>
            <div class="ggbuttom">
                <ul>
                    <li class="ggba1"></li>
                    <li class="ggba2"></li>
                    <li class="ggba3"></li>
                </ul>
            </div>
            <div class="clr"></div>
        </div>
        <? if((isset($adlist['category']['left1']) && trim($adlist['category']['left1']))) { ?>        <div class="gg"><?=$adlist['category']['right1']?></div>
        <? } ?>    </div>
</div>
<div class="clr"></div>
<? include template('footer'); ?>
