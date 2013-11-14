<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<!--加载广告--><? $adlist = $this->fromcache("adlist"); ?><div class="content">
    <!--左边分类开始-->
    <div class="left">
        <!--问题分类开始-->
        <div class="wtfl">
            <div class="wtfl_t"></div>
            <div class="wtfl_m">
                <div class="wtfl_m_t">
                    <div class="wt_l">&nbsp;问题分类
                    </div>
                    <div class="clr"></div>
                    <div id="rmc"></div>
                </div>
                <div id="siderbar">
                    <div id="secNav">
                        <ul id="secNavList">
                            <? $categorylist=$this->fromcache('categorylist'); ?>                            
<? if(is_array($categorylist)) { foreach($categorylist as $category1) { ?>
                            <li>
                                <div class="iconBg"><a href="<?=SITE_URL?>?c-<?=$category1['id']?>.html" title="<?=$category1['name']?>"><?=$category1['name']?></a></div>
                                <div class="listcon">
                                    
<? if(is_array($category1['sublist'])) { foreach($category1['sublist'] as $index => $category2) { ?>
                                    <a href="<?=SITE_URL?>?c-<?=$category2['id']?>.html"><?=$category2['name']?></a>
                                    
<? } } ?>
                                </div>
                            </li>
                            
<? } } ?>
                        </ul>
                    </div>
                    <div class="more"><a ttarget="_top" title="查看更多分类" href="<?=SITE_URL?>?c-all.html">查看更多分类&gt;&gt;</a></div>
                </div>          
            </div>
            <div class="wtfl_b"></div>
        </div>
        <!--问题分类结束-->

        <div class="topscore">
            <div class="l_b_t"></div>
            <div class="l_b_m">
                <div class="l_b_m_t">
                    <div class="mc"><div class="ivote"></div>积分排行榜</div>
                    <div class="phb">
                        <ul>
                            <li onclick="showtop('week')" id="weektab" class="on">本周排行</li>
                            <li onclick="showtop('all')" id="alltab" class="">总排行</li>
                        </ul>
                        <div class="clr"></div>
                    </div>
                </div>
                <div class="clr"></div>
                <div class="l_b_m_m">
                    <div id="weektop" class="yshy" style="display: block;">
                        <ul>
                            <? $weekuserlist=$this->fromcache('weekuserlist'); ?>                            
<? if(is_array($weekuserlist)) { foreach($weekuserlist as $index => $weekuser) { ?>
                            <? ++$index; ?>                            <li>
                                <span class="hyname"><img align="absmiddle" src="<?=SITE_URL?>css/default/num<?=$index?>.gif"> <a target="_blank" href="<?=SITE_URL?>?u-<?=$weekuser['uid']?>.html"><?=$weekuser['username']?></a></span>
                                <img align="absmiddle" src="<?=SITE_URL?>css/default/up.gif"><?=$weekuser['credit1']?>
                            </li>
                            
<? } } ?>
                        </ul>
                    </div>
                    <div id="alltop" class="yshy" style="display:none;">
                        <ul>
                            <? $alluserlist=$this->fromcache('alluserlist'); ?>                            
<? if(is_array($alluserlist)) { foreach($alluserlist as $index => $alluser) { ?>
                            <? ++$index; ?>                            <li>
                                <span class="hyname"><img align="absmiddle" src="<?=SITE_URL?>css/default/num<?=$index?>.gif"> <a target="_blank" href="<?=SITE_URL?>?u-<?=$alluser['uid']?>.html"><?=$alluser['username']?></a></span>
                                <img align="absmiddle" src="<?=SITE_URL?>css/default/up.gif"><?=$alluser['credit1']?>
                            </li>
                            
<? } } ?>
                        </ul>
                    </div>
                    <div class="listcon"></div>
                    <div class="more"><a ttarget="_top" title="查看更多排行榜" href="<?=SITE_URL?>?us-1.html">查看更多排行榜&gt;&gt;</a></div>
                    <div class="clr"></div>

                </div>
            </div>
            <div class="l_b_b"></div>
        </div>

        <!--知道小贴士开始-->
        <div class="cjjb">
            <div class="l_b_t"></div>
            <div class="l_b_m">
                <div class="l_b_m_t1">
                    <div class="mc"><div class="irelate"></div>知道小贴士</div>
                </div>
                <div class="clr"></div>
                <div class="l_b_m_m">
                    <div class="xts">
                        <ul>
                            <li><a target="_blank" title="如何提问" href="<?=SITE_URL?>?index/help.html#如何提问">如何提问</a></li>
                            <li><a target="_blank" title="如何回答" href="<?=SITE_URL?>?index/help.html#如何回答">如何回答</a></li>
                            <li><a target="_blank" title="如何获得积分" href="<?=SITE_URL?>?index/help.html#如何获得积分">如何获得积分</a></li>
                            <li><a target="_blank" title="如何处理问题" href="<?=SITE_URL?>?index/help.html#如何处理问题">如何处理问题</a></li>
                        </ul>
                    </div>
                    <div class="tsyjy"> 如要投诉或提出意见，请点击<br><a title="投诉与建议" href="mailto:<?=$setting['admin_email']?>"><input type="button" class="button1" value="建议反馈" /></a></div>
                </div>
            </div>
            <div class="l_b_b"></div>
        </div>
        <!--知道小贴士结束-->
    </div>
    <div class="b_right">
        <div class="middle">
            <? $topiclist=$this->fromcache('topiclist'); ?>            <? if($topiclist) { ?>            <div class="rdtj">
                <div class="rdtj_t"></div>
                <div class="rdtj_m" >
                    <div id="slides">
                        <div class="slides_container">
                            <? $topiclist=$this->fromcache('topiclist'); ?>                            
<? if(is_array($topiclist)) { foreach($topiclist as $topic) { ?>
                            <div>
                                <div class="hdp"><img src="<?=SITE_URL?><?=$topic['image']?>" width="270px" height="222px"/></div>
                                <div class="hdpr">
                                    <strong style="color:#9C9A9A">推荐专题</strong>
                                    <h1><a href="<?=SITE_URL?>?category/recommend.html#<?=$topic['id']?>"><? echo cutstr($topic['title'],14,''); ?></a></h1>
                                    <p><? echo cutstr($topic['describtion'],60,''); ?></p>
                                    <ul>
                                        
<? if(is_array($topic['questionlist'])) { foreach($topic['questionlist'] as $question) { ?>
                                        <li><a class="hotTitscontlia" title="<?=$question['title']?>" target="_blank" href="<?=SITE_URL?>?q-<?=$question['id']?>.html"><? echo cutstr($question['title'],26,''); ?></a> </li>
                                        
<? } } ?>
                                    </ul>
                                </div>
                            </div>
                            
<? } } ?>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="rdtj_b"></div>
            </div>
            <? } ?>            <!--精彩推荐开始-->
            <div class="m_wt">
                <div class="m_wtt">
                    <ul>
                        <li class="a1"></li>
                        <li class="a2">
                            <div class="a2t">精彩推荐的问题</div>
                            <div class="more"><a target="_top" title="更多问题" href="<?=SITE_URL?>?c-all/6.html">更多问题</a> </div>
                        </li>
                        <li class="a3"></li>
                    </ul>
                    <div class="clr"></div>
                </div>
                <div class="m_wtm">
                    <div id="weijieList">
                        <ul>
                            <? $nosolvelist=$this->fromcache('recommendlist'); ?>                            
<? if(is_array($nosolvelist)) { foreach($nosolvelist as $index => $question) { ?>
                            <? ++$index; ?>                            <li><a target="_blank" href="<?=SITE_URL?>?q-<?=$question['id']?>.html" title="<?=$question['title']?>"><? echo cutstr($question['title'],40); ?></a>&nbsp;<span class="lei">[<a target="_blank" href="<?=SITE_URL?>?c-<?=$question['cid']?>.html" title="<?=$question['category_name']?>"><? echo cutstr($question['category_name'],10,''); ?></a>]</span><span class="qanswers"><?=$question['answers']?>回答</span></li>
                            
<? } } ?>
                        </ul>

                    </div>
                </div>
                <div class="m_wtb"></div>
            </div>
            <!--精彩推荐结束-->
            <!--广告位1-->
            <? if((isset($adlist['index']['middle1']) && trim($adlist['index']['middle1']))) { ?>            <div class="m_ad"><?=$adlist['index']['middle1']?></div>
            <? } ?>            <!--待解决问题开始-->
            <div class="m_wt">
                <div class="m_wtt">
                    <ul>
                        <li class="a1"></li>
                        <li class="a2">
                            <div class="a2t">大家都在问什么</div>
                            <div class="more"><a target="_top" title="更多问题" href="<?=SITE_URL?>?c-all/1.html">更多问题</a> </div>
                        </li>
                        <li class="a3"></li>
                    </ul>
                    <div class="clr"></div>
                </div>
                <div class="m_wtm">
                    <div id="weijieList">
                        <ul>
                            <? $nosolvelist=$this->fromcache('nosolvelist'); ?>                            
<? if(is_array($nosolvelist)) { foreach($nosolvelist as $index => $question) { ?>
                            <? ++$index; ?>                            <li><a target="_blank" href="<?=SITE_URL?>?q-<?=$question['id']?>.html" title="<?=$question['title']?>"><? echo cutstr($question['title'],40); ?></a>&nbsp;<span class="lei">[<a target="_blank" href="<?=SITE_URL?>?c-<?=$question['cid']?>.html" title="<?=$question['category_name']?>"><? echo cutstr($question['category_name'],10,''); ?></a>]</span><span class="qanswers"><?=$question['answers']?>回答</span></li>
                            
<? } } ?>
                        </ul>

                    </div>
                </div>
                <div class="m_wtb"></div>
            </div>
            <!--待解决问题结束-->
            <!--广告位2-->
            <? if((isset($adlist['index']['middle2']) && trim($adlist['index']['middle2']))) { ?>            <div class="m_ad"><?=$adlist['index']['middle2']?></div>
            <? } ?>            <!--悬赏问题开始-->
            <div class="m_wt">
                <div class="m_wtt">
                    <ul>
                        <li class="a1"></li>
                        <li class="a2">
                            <div class="a2t">悬赏求答案的问题</div>
                            <div class="more"><a target="_top" target="_blank" title="更多问题" href="<?=SITE_URL?>?c-all/4.html">更多问题</a> </div>
                        </li>
                        <li class="a3"></li>
                    </ul>
                    <div class="clr"></div>
                </div>
                <div class="m_wtm">
                    <div id="weijieList">
                        <ul>
                            <? $nosolvelist=$this->fromcache('rewardlist'); ?>                            
<? if(is_array($nosolvelist)) { foreach($nosolvelist as $index => $question) { ?>
                            <? ++$index; ?>                            <li><span class="qlscore"><img src="<?=SITE_URL?>css/default/TB2.gif" /><?=$question['price']?></span><a target="_blank" href="<?=SITE_URL?>?q-<?=$question['id']?>.html" title="<?=$question['title']?>"><? echo cutstr($question['title'],40); ?></a>&nbsp;<span class="lei">[<a target="_blank" href="<?=SITE_URL?>?c-<?=$question['cid']?>.html" title="<?=$question['category_name']?>"><? echo cutstr($question['category_name'],10,''); ?></a>]</span><span class="qanswers"><?=$question['answers']?>回答</span></li>
                            
<? } } ?>
                        </ul>

                    </div>
                </div>
                <div class="m_wtb"></div>
            </div>
            <!--悬赏问题结束-->
            <!--广告位3-->
            <? if((isset($adlist['index']['middle3']) && trim($adlist['index']['middle3']))) { ?>            <div class="m_ad"><?=$adlist['index']['middle3']?></div>
            <? } ?>            <!--已解决问题开始-->
            <div class="m_wt">
                <div class="m_wtt">
                    <ul>
                        <li class="a1"></li>
                        <li class="a2">
                            <div class="a2t">最新已解决的问题</div>
                            <div class="more"><a target="_top" title="更多问题" href="<?=SITE_URL?>?c-all/2.html">更多问题</a></div>
                        </li>
                        <li class="a3"></li>
                    </ul>
                    <div class="clr"></div>
                </div>
                <div id="jieList" class="m_wtm">
                    <ul>
                        <? $nosolvelist=$this->fromcache('solvelist'); ?>                        
<? if(is_array($nosolvelist)) { foreach($nosolvelist as $index => $question) { ?>
                        <? ++$index; ?>                        <li><a target="_blank" href="<?=SITE_URL?>?q-<?=$question['id']?>.html" title="<?=$question['title']?>"><? echo cutstr($question['title'],30); ?></a>&nbsp;<span class="lei">[<a target="_blank" href="<?=SITE_URL?>?c-<?=$question['cid']?>.html" title="<?=$question['category_name']?>"><? echo cutstr($question['category_name'],10,''); ?></a>]</span><span class="qanswers"><?=$question['answers']?>回答</span></li>
                        
<? } } ?>
                    </ul>

                </div>
                <div class="m_wtb"></div>
            </div>
            <!--已解决问题结束-->
        </div>
        <div class="right">
            <div class="ty">
                <div class="tyt"></div>
                <div class="tym">
                    <div class="tym_t">
                        <div class="mc">
                            <img src="<?=SITE_URL?>css/default/note.gif" class="noteicon"/>
                            站內公告
                        </div>
                    </div>
                    <div class="tym_m">
                        <ul>
                            <? $notelist=$this->fromcache('notelist'); ?>                            
<? if(is_array($notelist)) { foreach($notelist as $note) { ?>
                            <li><a  <? if($note['url']) { ?>href="<?=$note['url']?>"<? } else { ?>href="<?=SITE_URL?>?note/view/<?=$note['id']?>.html"<? } ?>  title="<?=$note['title']?>"><? echo cutstr($note['title'],22); ?></a></li>
                            
<? } } ?>
                        </ul>
                        <div class="more1"><a href="<?=SITE_URL?>?note/list.html" target="_blank" title="查看全部公告">查看全部公告</a></div>
                    </div>
                </div>
                <div class="tyb"></div>
            </div>
            <div class="zjzt">
                <div class="zjztt">
                    <ul>
                        <li class="a1"></li>
                        <li class="a2">热点关键词</li>
                        <li class="a3"></li>
                    </ul>
                </div>
                <div class="zjztm">
                    
<? if(is_array($wordslist)) { foreach($wordslist as $hotword) { ?>
                    <a <? if($hotword['qid']) { ?>href="<?=SITE_URL?>?q-<?=$hotword['qid']?>.html" <? } else { ?>href="<?=SITE_URL?>?question/search/3/<?=$hotword['w']?>.html"<? } ?>><?=$hotword['w']?></a>
                    
<? } } ?>
                    
                </div>
                <div class="zjztb"></div>
            </div>
            <? if((isset($adlist['index']['right1']) && trim($adlist['index']['right1']))) { ?>            <div class="r_ad"><?=$adlist['index']['right1']?></div>
            <? } ?>            <div class="rb_zj">
                <div class="rb_zj_t"></div>
                <div class="rb_zj_m">
                    <div class="rb_zj_mt"><div class="istar"></div>推荐之星</div>
                    <div class="rb_zj_mm">
                        <? $famouslist=$this->fromcache('famouslist'); ?>                        
<? if(is_array($famouslist)) { foreach($famouslist as $indexstat => $famous) { ?>
                        <? if($indexstat) { ?>                        <div class="rb_zj_mmc" style="border-top:1px dashed #DDDDDD;padding-top: 10px;">
                            <? } else { ?>                            <div class="rb_zj_mmc">
                                <? } ?>                                <div class='zjimg'>
                                    <a href="<?=SITE_URL?>?u-<?=$famous['uid']?>.html" target='_blank'><img src="<?=$famous['avatar']?>" width='50px' height='50px' /></a>
                                </div>
                                <div class='jbzl'>
                                    <a href="<?=SITE_URL?>?u-<?=$famous['uid']?>.html" target='_blank'><?=$famous['username']?></a><br/>
                                    回答数:<?=$famous['answers']?><br />
                                    提问数:<?=$famous['questions']?>
                                </div>
                                <div class='clr'></div>
                                <? if($famous['bestanswer']) { ?>                                精选解答:<input type="button" class="button1" value="向TA提问" onclick="javascript:document.location='<?=SITE_URL?>?question/add/<?=$famous['uid']?>.html'"/><ul>
                                    
<? if(is_array($famous['bestanswer'])) { foreach($famous['bestanswer'] as $answer) { ?>
                                    <li><a href="<?=SITE_URL?>?q-<?=$answer['qid']?>.html" target='_blank' title="<?=$answer['title']?>"><? echo cutstr($answer['title'],28,''); ?></a></li>
                                    
<? } } ?>
                                </ul>
                                <? } ?>                            </div>
                            <div class="clr"></div>
                            
<? } } ?>
                            <div class="more2"><a href="<?=SITE_URL?>?user/famouslist.html" target="_blank" title="历届知道之星">历届知道之星>> </a></div>
                        </div>
                    </div>
                    <div class="rb_zj_b"></div>
                </div>
                <div class="rb_zj">
                    <div class="rb_zj_t"></div>
                    <div class="rb_zj_m">
                        <div class="rb_zj_mt1"><img src="<?=SITE_URL?>css/default/user.png" class="noteicon" alt="知道专家" />知道专家</div>
                        <div class="rb_zj_mm">
                            <? $expertlist=$this->fromcache('expertlist'); ?>                            
<? if(is_array($expertlist)) { foreach($expertlist as $indexstat => $expert) { ?>
                            <div class="rb_zj_mmc1">
                                <ul>
                                    <li>
                                        <div class="zjimg1">
                                            <a href="<?=SITE_URL?>?u-<?=$expert['uid']?>.html">
                                                <img src="<?=$expert['avatar']?>"  height="50px" width="50px"/>
                                            </a>
                                        </div>
                                        <div class="jbzl1">
                                            <h3><a href="<?=SITE_URL?>?u-<?=$expert['uid']?>.html" ><?=$expert['name']?></a></h3>
                                            擅长分类：<?=$expert['categoryname']?>
                                            <a href="<?=SITE_URL?>?question/add/<?=$expert['uid']?>.html">
                                                <img src="<?=SITE_URL?>css/default/wytw.gif" height="20px" width="60px"/>
                                            </a>
                                        </div>
                                        <div class="clr"></div>
                                    </li>
                                </ul>
                            </div>
                            
<? } } ?>
                            <div class="more2"><a href="<?=SITE_URL?>?expert/default.html" target="_blank" title="查看更多">查看更多专家</a></div>
                        </div>
                    </div>
                    <div class="rb_zj_b"></div>
                </div>
            </div>
            <div class="clr"></div>
        </div>
    </div>
    <div class="clr"></div>
    <!--友情链接-->
    <div class="jklm">
        <div class="jklmm">
            <h3>友情链接</h3>
            <div class="lm">
                
<? if(is_array($linklist)) { foreach($linklist as $link) { ?>
                <a target="_blank" href="<?=$link['url']?>" title="<?=$link['description']?>">
                    <? if($link['logo']) { ?>                    <img src="<?=$link['logo']?>" alt="<?=$link['name']?>" />
                    <? } else { ?>                    <?=$link['name']?>
                    <? } ?>                </a>
                
<? } } ?>
            </div>
        </div>
    </div>
    <div class="clr"></div>
    <script src="<?=SITE_URL?>js/slides.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('#slides').slides({
                preload: true,
                generateNextPrev: false,
                play: 5000,
                container: 'slides_container'
            
            });
        });
        function showtop(type){
            if(type=='week'){
                $("#weektab").attr('class','on'); 
                $("#alltab").attr('class',''); 
                $("#alltop").hide();
                $("#weektop").show();
            }else{
                $("#alltab").attr('class','on'); 
                $("#weektab").attr('class',''); 
                $("#weektop").hide();
                $("#alltop").show();
            }
        }
    </script>
    
<? include template('footer'); ?>
