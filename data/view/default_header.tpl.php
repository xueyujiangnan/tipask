<? if(!defined('IN_TIPASK')) exit('Access Denied'); global $starttime,$querynum;$mtime = explode(' ', microtime());$runtime=number_format($mtime['1'] + $mtime['0'] - $starttime,6); $setting=$this->setting;$user=$this->user;$headernavlist=$this->nav;$regular=$this->regular; ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?=TIPASK_CHARSET?>"/>
        <? if(isset($seo_title)) { ?>        <title><?=$seo_title?></title>
        <? } else { ?>        <title><? if($navtitle) { ?><?=$navtitle?> - <? } ?><?=$setting['site_name']?></title>
        <? } ?>        <? if(isset($seo_description)) { ?>        <meta name="description" content="<?=$seo_description?>" />
        <? } else { ?>        <meta name="description" content="<?=$setting['site_name']?>" />
        <? } ?>        <meta name="keywords" content="<?=$seo_keywords?>" />
        <meta name="generator" content="Tipask <?=TIPASK_VERSION?> <?=TIPASK_RELEASE?>" />
        <meta name="author" content="Tipask Team" />
        <meta name="copyright" content="2011 Tipask.com." />
        <meta name="robots" content="index, follow">
            <meta name="googlebot" content="index, follow" />
            <link href="<?=SITE_URL?>css/default/ask.css" rel="stylesheet" type="text/css" />
            <? $toolbars="'".str_replace(",", "','", $setting['editor_toolbars'])."'"; ?>            <script type="text/javascript">
                g_site_url='<?=SITE_URL?>';g_prefix='<?=$setting['seo_prefix']?>';g_suffix='<?=$setting['seo_suffix']?>';editor_options={toolbars:[[<?=$toolbars?>]],wordCount:<?=$setting['editor_wordcount']?>,elementPathEnabled:<?=$setting['editor_elementpath']?>};messcode='<?=$setting['code_message']?>';</script>
            <script src="<?=SITE_URL?>js/jquery.js" type="text/javascript"></script>
            <script src="<?=SITE_URL?>js/dialog.js" type="text/javascript"></script>
            <script src="<?=SITE_URL?>js/common.js" type="text/javascript"></script>
            <?=$setting['seo_headers']?>
    </head>
    <body >
        <div class="top">
            <div class="topnav" id="toptab">
                <div class="topleft">
                    <a href="javascript:void(0)" onclick="SetHomepage()">设为首页</a>
                    <a href="javascript:void(0)" onclick="addfavorite()">收藏本站</a>
                </div>
            </div>
        </div>
        <div class="header">
            <div class="h_top">
                <div class="logo" >
                    <a href="<?=SITE_URL?>" title="<?=$setting['site_name']?>" target="_top"><img src="<?=SITE_URL?>css/default/logo.png" alt="<?=$setting['site_name']?>" /></a>
                </div>
                <div class="userbar">
                    <? if(0!=$user['uid'] && $user['avatar']) { ?>                    <div class='gdfw'>
                        <img src="<?=$user['avatar']?>" />
                    </div>
                    <? } ?>                    <div class='hyn'>
                        <p>
                            <? if(0!=$user['uid']) { ?>                            您好,<a href="<?=SITE_URL?>?user/default.html"><b><?=$user['username']?></b></a>
                            <? if($user['newmsg']>0) { ?>                            <span class="separe">&nbsp;|&nbsp;</span><a id="TopLink_MessageBox" href="<?=SITE_URL?>?message/new.html" >消息(<span id="MessagesCount" style="color: rgb(255, 0, 0);font-weight:bold ;"><?=$user['newmsg']?></span>)</a>
                            <? } ?>                            <span class="separe">&nbsp;|&nbsp;</span><a href="<?=SITE_URL?>?user/default.html">个人中心</a>
                            <? if($user['groupid']<=3) { ?>                            <span class="separe">&nbsp;|&nbsp;</span><a href="<?=SITE_URL?>index.php?admin_main">系统设置</a>
                            <? } ?> 
                            <span class="separe">&nbsp;|&nbsp;</span><a href="<?=SITE_URL?>?user/logout.html">退出</a> 
                            <? } else { ?>                            您好，欢迎来<?=$setting['site_name']?>！[<a  href="<?=SITE_URL?>?user/login.html">请登录</a>] [<a  href="<?=SITE_URL?>?user/register.html">免费注册</a>]
                            <? } ?></p>
                        <? if(0!=$user['uid']) { ?><p>提问:<?=$user['questions']?> | 回答:<?=$user['answers']?>&nbsp;|&nbsp;用户组:<?=$user['grouptitle']?></p><? } else { if($setting['qqlogin_open'] && $setting['qqlogin_open']) { ?><a href="#" onclick='toQzoneLogin()' title="QQ账号登陆" class="s4"><img src="<?=SITE_URL?>css/default/Connect_logo_3.png"></a><? } } ?>                    </div>

                </div>
                <div class="clr"></div>
            </div>
            <div class="h_mid">
                <div class="h_mid_l"> </div>
                <div id="tdh" class="h_mid_m">
                    <ul>
                        
<? if(is_array($headernavlist)) { foreach($headernavlist as $nav) { ?>
                        <? if($nav['available']) { ?>                        <li <? if(strstr($nav['url'],$regular)) { ?>class="on"<? } ?> >
                            <? if('index/default'==$nav['url']) { ?>                            <a title="<?=$nav['title']?>" href="<?=SITE_URL?>"  <? if($nav['target']) { ?>target="_blank"<? } ?>><?=$nav['name']?></a>
                            <? } elseif('question/doing'==$nav['url']) { ?>                            <a title="<?=$nav['title']?>" href="<?=SITE_URL?>?question/doing.html"  <? if($nav['target']) { ?>target="_blank"<? } ?>><?=$nav['name']?></a>
                            <? } elseif('category/view'==$nav['url']) { ?>                            <a title="<?=$nav['title']?>" href="<?=SITE_URL?>?c-all.html"  <? if($nav['target']) { ?>target="_blank"<? } ?>><?=$nav['name']?></a>
                            <? } elseif('expert/default'==$nav['url']) { ?>                            <a title="<?=$nav['title']?>" href="<?=SITE_URL?>?expert/default.html"  <? if($nav['target']) { ?>target="_blank"<? } ?>><?=$nav['name']?></a>
                            <? } elseif('category/recommend'==$nav['url']) { ?>                            <a title="<?=$nav['title']?>" href="<?=SITE_URL?>?category/recommend.html"  <? if($nav['target']) { ?>target="_blank"<? } ?>><?=$nav['name']?></a>
                            <? } elseif('user/famouslist'==$nav['url']) { ?>                            <a title="<?=$nav['title']?>" href="<?=SITE_URL?>?user/famouslist.html"  <? if($nav['target']) { ?>target="_blank"<? } ?>><?=$nav['name']?></a>
                            <? } elseif('index/taglist'==$nav['url']) { ?>                            <a title="<?=$nav['title']?>" href="<?=SITE_URL?>?index/taglist.html"  <? if($nav['target']) { ?>target="_blank"<? } ?>><?=$nav['name']?></a>
                            <? } elseif('gift/default'==$nav['url']) { ?>                            <a title="<?=$nav['title']?>" href="<?=SITE_URL?>?gift/default.html"  <? if($nav['target']) { ?>target="_blank"<? } ?>><?=$nav['name']?></a>
                            <? } else { ?>                            <a title="<?=$nav['title']?>" href="<?=$nav['url']?>"  <? if($nav['target']) { ?>target="_blank"<? } ?>><?=$nav['name']?></a>
                            <? } ?>                        </li>
                        <? } ?>                        
<? } } ?>
                    </ul>
                </div>
                <div class="h_mid_r"></div>
            </div>
            <div class="clr"></div>
            <div class="h_b">
                <div class="h_b_l"></div>
                <div class="h_b_m">
                    <div class="question_count">
                        <? $statistics=$this->fromcache('statistics'); ?>                        <span class="count">最佳回答采纳率:</span><span class="adopt"><?=$statistics['bestadopt']?>%</span><br/>
                        <span class="count">已解决问题数:</span><span class="countques"><?=$statistics['solves']?></span><br/>
                        <span class="count">待解决问题数:</span><span class="countques"><?=$statistics['nosolves']?></span>
                    </div>
                    <form name="searchform"  action="<?=SITE_URL?>?question/search/3.html" method="post">
                        <div class="h_b_input">                        
                            <input type="hidden" name="q" id="kw_hide" autocomplete="off" />
                            <input type="text" id="kw" onmouseover="this.focus()" autocomplete="off" class="searchinput" style="vertical-align:middle;" name="word" maxlength="100" tabindex="1"  value="<? if(isset($word)) { ?><?=$word?><? } elseif(isset($word)) { ?><?=$tag?><? } ?>" />
                            <button type="button" class="sub" onclick="search_submit();"></button>
                            <button type="button"  class="but" onclick="ask_submit();"></button>
                        </div>
                    </form>
                    <div class="sybz"><a href="<?=SITE_URL?>?index/help.html" title="帮助" target="_blank">使用<br/>帮助</a></div>
                    <div class="tongji">
                        <div id="move">
                            <? $onlineusernum=$this->fromcache('onlineusernum'); ?>                            <span class="count">当前在线:</span><?=$onlineusernum['0']?>人<br/>
                            <? $allusernum=$this->fromcache('allusernum'); ?>                            <span class="count">注册用户:</span><?=$allusernum['0']?>人<br/>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="h_b_r"></div>

            </div>
            <div class="clr"></div>
        </div>