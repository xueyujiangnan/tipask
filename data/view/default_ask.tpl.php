<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<script src="<?=SITE_URL?>js/ueditor/editor_config.js" type="text/javascript"></script>
<script src="<?=SITE_URL?>js/ueditor/editor_all.js" type="text/javascript"></script>
<script src="<?=SITE_URL?>js/ueditor/third-party/SyntaxHighlighter/shCore.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?=SITE_URL?>js/ueditor/themes/default/ueditor.css"/>
<link rel="stylesheet" href="<?=SITE_URL?>js/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css"/>
<div class="content">
    <div class="dh" id="pos"><a href="<?=SITE_URL?>"><?=$setting['site_name']?></a>&gt; 提问问题</div>
    <div class="left1">
        <div class="leftt">
            <ul>
                <li class="a1"></li>
                <li class="a2"><div class="juzhong">提问问题</div></li>
                <li class="a3"></li>
            </ul>
        </div>
        <div class="clr"></div>
        <div class="leftc">

            <div class="tw_t"><? if(isset($touser)) { ?>您正在向<a href="<?=SITE_URL?>?u-<?=$touser['uid']?>.html"><?=$touser['username']?></a>提问<? } else { ?>请将您的问题告诉我们<? } ?>:</div>
            <div class="askfgx"></div>
            <form name="askform" onsubmit="return check_askform(this);" action="<?=SITE_URL?>?question/add.html" method="post" >
                <div class="tiwen">
                    <div class="shur1">
                        <h2>您的问题:</h2> <input type="text"  maxlength="100" size="65" name="title" value="<?=$word?>" id="mytitle"  class="input1"  />
                    </div>
                    <div class="clr"></div>

                    <div class="shur4">
                        <div style="margin-left: 75px;">更多问题描述(选填)</div>                      
                        <script type="text/plain" id="mydescription" name="description" style="width:550px;margin-left:75px;"></script>
                    </div>
                    <div class="clr"></div>

                    <div class="shur1">
                        <h2>标签(TAG):</h2>  
                        <input type="text"  maxlength="8" name="qtags[]" class="input4" value="" />
                        <input type="text"  maxlength="8" name="qtags[]" class="input4" value="" />                   
                        <input type="text"  maxlength="8" name="qtags[]" class="input4" value="" />                  
                        <input type="text"  maxlength="8" name="qtags[]" class="input4" value="" />                   
                        <input type="text"  maxlength="8" name="qtags[]" class="input4" value="" />                   
                    </div>
                    <div class="clr"></div>
                    <div class="shur shur3">
                        <h2>问题分类</h2>
                        <div id="classnav" name="classnav">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr valign="top">
                                    <td width="15%">

                                        <select  id="ClassLevel1" class="catselect2" size="8" name="classlevel1" >
                                            <option selected></option>
                                        </select>

                                    </td>
                                    <td align="center" valign="middle" width="7%">
                                        <div><b>→</b></div>
                                    </td>
                                    <td width="15%">                                        
                                        <select  id="ClassLevel2"  class="catselect2" size="8" name="classlevel2">
                                            <option selected></option>
                                        </select>                                        
                                    </td>
                                    <td align="center" valign="middle" width="7%">
                                        <div style="display: none;" id="jiantou"><b>→</b></div>
                                    </td>
                                    <td width="15%">
                                        <select id="ClassLevel3"  class="catselect2" size="8" onchange="getCidValue();"  name="classlevel3">
                                            <option selected></option>
                                        </select>
                                    </td>
                                    <td width="32%"></td>
                                </tr>
                                <tr valign="top">
                                    <td class="tiw_biaozhu" colspan="6" align="left" valign="middle">请您选择正确的分类，以使您的问题尽快得到解答。</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="clr"></div>

                    <div class="shur shur2">
                        <h2>问题设置</h2>
                        <div class="shezhi">
                            <h3>悬赏分:</h3>                           
                            <select name="scorelist" id="scorelist" class="select1" onchange="otherscore();">
                                <option selected="selected" value="0">0</option>
                                <option value="1">1</option>
                                <option value="3">3</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="80">80</option>
                                <option value="100">100</option>
                                <option value="other">其他</option>
                            </select>&nbsp;<span class="zhusi" style="display:none;" id="showscore"><input type="text"  maxlength="8" name="givescore"  id="givescore"  class="input4"  value="0"/></span>&nbsp;分 &nbsp;<span class="zhusi">您目前的财富值:<? if($user['credit2']) { ?><?=$user['credit2']?><? } else { ?>0<? } ?> 悬赏分越高，您的问题会越受关注。</span>
                            <div class="clr"></div> 
                            <? if($user['uid']) { ?>                            <h3>匿名设定:</h3><input type="checkbox" name="hidanswer" value="1" class="checkbox1" />&nbsp;<span class="zhusi">您需要付出财富值10分</span>
                            <div class="clr"></div>
                            <? } ?>                            <? if($setting['code_ask']) { ?>                            <h3>验证码:</h3><input type="text"  maxlength="8" name="code"    class="input4"  />&nbsp;<img  id="verifycode" align="absmiddle"   src="<?=SITE_URL?>?user/code.html" />&nbsp;<a href="javascript:updatecode();">换一张</a>
                            <div class="clr"></div> 
                            <? } ?>                            <input type="hidden" value="0" name="cid" />
                            <input type="hidden" value="<?=$askfromuid?>" name="askfromuid" />                            
                        </div>
                    </div>
                    <div id="searchresult"></div>
                    <div class="asksubmit"><button name="submit" type="submit" class="btn_addques" ></button></div>
                    <div class="clr"></div>
                </div>

            </form>
        </div>
        <div class="clr"></div>
        <div class="leftb"></div>
    </div>
    <div class="right1">
        <div class="gg">
            <div class="ggtitle">
                <ul>
                    <li class="gga1"></li>
                    <li class="gga2">
                        <div class="juzhong">
                            <div class="qico" ><div class="irelate"></div></div>
                            别人都在问什么
                        </div>
                    </li>
                    <li class="gga3"></li>
                </ul>
            </div>
            <div class="clr"></div>
            <div class="ggcon">
                <ul>
                    <? $nosolvelist=$this->fromcache('nosolvelist'); ?>                    
<? if(is_array($nosolvelist)) { foreach($nosolvelist as $index => $nosolve) { ?>
                    <li> <a title="<?=$nosolve['title']?>" target="_blank" href="<?=SITE_URL?>?q-<?=$nosolve['id']?>.html"><? echo cutstr($nosolve['title'],24); ?></a></li>
                    
<? } } ?>
                </ul>
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

        <div class="gg">
            <div class="ggtitle">
                <ul>
                    <li class="gga11"></li>
                    <li class="gga21">
                        <div class="juzhong">&nbsp;知道小贴士</div>
                    </li>
                    <li class="gga31"></li>
                </ul>
            </div>
            <div class="clr"></div>
            <div class="ggcon">
                <ul>
                    <li><a target="_blank" title="如何提问" href="<?=SITE_URL?>?index/help.html#如何提问">如何提问</a></li>
                    <li><a target="_blank" title="如何回答" href="<?=SITE_URL?>?index/help.html#如何回答">如何回答</a></li>
                    <li><a target="_blank" title="如何获得积分" href="<?=SITE_URL?>?index/help.html#如何获得积分">如何获得积分</a></li>
                    <li><a target="_blank" title="如何处理问题" href="<?=SITE_URL?>?index/help.html#如何处理问题">如何处理问题</a></li>
                </ul>
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
    </div>
</div>
<div class="clr"></div>
<script type="text/javascript">
    $(document).ready(function () {
        var mycontent = new baidu.editor.ui.Editor(editor_options);
        mycontent.render("mydescription");
        $("#mytitle").bind("blur", function(){
            searchurl="<?=SITE_URL?>?question/ajaxsearch/"+encodeURI($("#mytitle").val());
            $("#searchresult").load(searchurl);
        });
    });
    var showtagdesc = true;
    var sortobj=eval('(<?=$category_js?>)');
    var g_ClassLevel1;
    var g_ClassLevel2;
    var g_ClassLevel3;
    var class_level_1=sortobj.category1;
    var class_level_2=sortobj.category2;
    var class_level_3=sortobj.category3;
    var button_noselect="不选择";

    function getCidValue()
    {
        var _cl1 = document.askform.ClassLevel1;
        var _cl2 = document.askform.ClassLevel2;
        var _cl3 = document.askform.ClassLevel3;
        var _cid = document.askform.cid;
        if(_cl1.value!=0) _cid.value = _cl1.value;
        if(_cl2.value!=0) _cid.value = _cl2.value;
        if(_cl3.value!=0) _cid.value = _cl3.value;
    }
    function FillClassLevel1(ClassLevel1)
    {
        ClassLevel1.options[0] = new Option("aa", "0");
        for(i=0; i<class_level_1.length; i++)
        {
            ClassLevel1.options[i] = new Option(class_level_1[i][1], class_level_1[i][0]);
        }
        // ClassLevel1.options[0].selected = true;
        ClassLevel1.length = i;
    }
    function FillClassLevel2(ClassLevel2, class_level_1_id)
    {
        ClassLevel2.options[0] = new Option(button_noselect, "");
        count = 1;
        for(i=0; i<class_level_2.length; i++){
            if(class_level_2[i][0].toString() == class_level_1_id) {
                ClassLevel2.options[count] = new Option(class_level_2[i][2], class_level_2[i][1]);
                count = count+1;}
        }
        ClassLevel2.options[0].selected = true;
        ClassLevel2.length = count;
    }
    function FillClassLevel3(ClassLevel3, class_level_2_id)
    {
        ClassLevel3.options[0] = new Option(button_noselect, "");
        count = 1;
        for(i=0; i<class_level_3.length; i++) {
            if(class_level_3[i][0].toString() == class_level_2_id) {
                ClassLevel3.options[count] = new Option(class_level_3[i][2], class_level_3[i][1]);
                count = count+1;}
        }
        ClassLevel3.options[0].selected = true;
        ClassLevel3.length = count;
    }
    function ClassLevel2_onchange()
    {
        getCidValue();
        FillClassLevel3(g_ClassLevel3, g_ClassLevel2.value);
        if (g_ClassLevel3.length <= 1) {
            g_ClassLevel3.style.display = "none";
            document.getElementById("jiantou").style.display = "none";
        }
        else {
            g_ClassLevel3.style.display = "";
            document.getElementById("jiantou").style.display = "";
        }
    }
 
    function ClassLevel1_onchange()
    {
        getCidValue();
        FillClassLevel2(g_ClassLevel2, g_ClassLevel1.value);
        ClassLevel2_onchange();

    }
    function InitClassLevelList(ClassLevel1, ClassLevel2, ClassLevel3)
    {
        g_ClassLevel1=ClassLevel1;
        g_ClassLevel2=ClassLevel2;
        g_ClassLevel3=ClassLevel3;
        g_ClassLevel1.onchange = Function("ClassLevel1_onchange();");
        g_ClassLevel2.onchange = Function("ClassLevel2_onchange();");
        FillClassLevel1(g_ClassLevel1);
        ClassLevel1_onchange();
    }
    InitClassLevelList(document.askform.ClassLevel1, document.askform.ClassLevel2, document.askform.ClassLevel3);

    var selected_id_list="0"
    var blank_pos = selected_id_list.indexOf(" ");
    var find_blank = true;
    if (blank_pos == -1) {
        find_blank = false;
        blank_pos = selected_id_list.length;
    }
    var id_str = selected_id_list.substr(0, blank_pos);
    g_ClassLevel1.value = id_str;
    ClassLevel1_onchange();

    if (find_blank == true) {
        selected_id_list = selected_id_list.substr(blank_pos + 1,   selected_id_list.length - blank_pos - 1);
        blank_pos = selected_id_list.indexOf(" ");
        if (blank_pos == -1) {
            find_blank = false;
            blank_pos = selected_id_list.length;
        }
        id_str = selected_id_list.substr(0, blank_pos);
        g_ClassLevel2.value = id_str;
        ClassLevel2_onchange();

        if (find_blank == true) {
            selected_id_list = selected_id_list.substr(blank_pos + 1,  selected_id_list.length - blank_pos - 1);
            blank_pos = selected_id_list.indexOf(" ");
            if (blank_pos == -1) {
                find_blank = false;
                blank_pos = selected_id_list.length;
            }
            id_str = selected_id_list.substr(0, blank_pos);
            g_ClassLevel3.value = id_str;
        }
    }

    /*检查*/
    function check_askform(obj){
        if (bytes($.trim(obj.title.value)) < 8 ||  bytes($.trim(obj.title.value))>120) {
            alert("问题标题长度不得少于4个字，不能超过30字！");
            obj.title.focus();
            return false;
        }
        if(obj.classlevel1.selectedIndex==-1){
            alert("没有选择分类!");
            return false;
        }
        <? if($user['uid']) { ?>        //检查财富值是否够用
        var offerscore=0;
        var selectsocre = $("#scorelist").val();
        if(selectsocre != 'other')
            $("#givescore").val(selectsocre);
        if(obj.hidanswer.checked)offerscore+=10;
        offerscore+=parseInt(obj.givescore.value);
        if(offerscore><?=$user['credit2']?>){
            alert("你的财富值不够!");
            return false;
        }
        <? } ?>        if(showtagdesc)
            $("#qtags").val("");
    }
    function otherscore(){
        if($("#scorelist").val() == 'other'){
            $("#showscore").show();
        }else{
            $("#showscore").hide();
        }f  
         
    }
    /*隐藏标签描述*/
    function hidetagdesc(){       
        if(showtagdesc){
            $("#qtags").val('');
            showtagdesc = false;
        }           
    }    
</script>
<? include template('footer'); ?>
