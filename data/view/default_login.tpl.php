<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<div class="content">
    <div class="dh">用户登录</div>
    <div class="loginleft">
        <div class="zhuce">
            <div class="zhucet"></div>
            <div class="zhucec">
                <h1><a href="<?=SITE_URL?>?user/register.html">还没有帐号？立即注册</a>！</h1> 
                <h1>更多登录方式：</h1>
                <ul>
                <? if($setting['qqlogin_open'] && $setting['qqlogin_open']) { ?>                    <li><a href="#" onclick='toQzoneLogin()' title="QQ账号登陆" class="s4"><img src="<?=SITE_URL?>css/default/Connect_logo_1.png">QQ账号登陆</a></a></li>
                    <? } ?>                </ul>
            </div>
            <div class="zhuceb"></div>
        </div>
    </div>
    <div class="loginright">
        <div class="lgbdright">
            <ul>
                <li class="a1"></li>
                <li class="a2"></li>
                <li class="a3"></li>
            </ul>
        </div>
        <div class="clr"></div>
        <div class="lgrightc">
            <div class="dl">
                <form name="loginform"  action="<?=SITE_URL?>?user/login.html" method="post">
                    <div class="dlc">
                        <div class="shur">
                            <h2>用户名：</h2> <input type="text" name="username" id="username" class="input3">
                        </div>
                        <div class="clr"></div>
                        <div class="shur">
                            <h2>密&nbsp;&nbsp;码：</h2> <input type="password"  name="password" id="password" class="input3" />
                        </div>
                        <? if($setting['code_login']) { ?>                        <div class="clr"></div>
                        <div class="shur">
                            <h2>验证码：</h2> <input type="text"  name="code" id="password" class="input4" />&nbsp;<img align="absmiddle" id="verifycode" onclick="javascript:updatecode();" src="<?=SITE_URL?>?user/code.html"/><a href="javascript:updatecode();">&nbsp;换一个</a>
                        </div>
                        <? } ?>                        <div class="clr"></div>
                        <div class="shur1">
                            <input border="1" type="checkbox"  value="2592000" name="cookietime" id="cookietime" />下次自动登录
                        </div>
                        <div class="shur1">
                            <input type="submit" name="submit" class="button4"  value="登&nbsp;录"/>&nbsp;忘记密码了？请点击 “<a class="red" href="<?=SITE_URL?>?user/getpass.html">找回密码</a>” 。</div>
                    </div>
                </form>
                <div class="clr"></div>
            </div>
        </div>
        <div class="lgbdright2">
            <ul>
                <li class="a1"></li>
                <li class="a2"></li>
                <li class="a3"></li>
            </ul>
        </div>
    </div>
</div>
<div class="clr"></div>
<? include template('footer'); ?>
