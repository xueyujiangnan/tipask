<?php

!defined('IN_TIPASK') && exit('Access Denied');

class giftcontrol extends base {

    function giftcontrol(& $get,& $post) {
        $this->base( & $get,& $post);
        $this->load('gift');
        $this->load('user');
        $this->load('mail');
    }

    function ondefault() {
    	$navtitle = "礼品商店";
        @$page = max(1, intval($this->get[2]));
        $pagesize=$this->setting['list_default'];
        $startindex = ($page - 1) * $pagesize;
        $giftlist = $_ENV['gift']->get_list($startindex,$pagesize);
        $giftnum=$this->db->fetch_total('gift');
        $departstr=page($giftnum, $pagesize, $page,"gift/default");
        $ranglist = unserialize($this->setting['gift_range']);
        include template('giftlist');
    }
    
    function onsearch() {
        $from = intval($this->get[2]);
        $to = intval($this->get[3]);
        @$page = max(1, intval($this->get[4]));
        $pagesize = $this->setting['list_default'];
        $startindex = ($page - 1) * $pagesize;
        $giftlist = $_ENV['gift']->get_by_range($from,$to,$startindex,$pagesize);
        $rownum=$this->db->fetch_total('gift'," `credit`>=$from AND `credit`<=$to");
        $departstr=page($rownum, $pagesize, $page,"gift/search/$from/$to");
        $ranglist = unserialize($this->setting['gift_range']);
        include template('giftlist');
    }

    function onadd() {
        if(isset($this->post['realname'])) {
            $realname = $this->post['realname'];
            $email = $this->post['email'];
            $phone = $this->post['phone'];
            $addr = $this->post['addr'];
            $postcode = $this->post['postcode'];
            $qq = $this->post['qq'];
            $notes = $this->post['notes'];
            $gid = $this->post['gid'];
            $param = array();
            if(''==$realname || ''==$email || ''==$phone||''==$addr||''==$postcode) {
                $this->message("为了准确联系到您，真实姓名、邮箱、联系地址（邮编）、电话不能为空！",'gift/default');
            }

            if (!preg_match("/^[a-z'0-9]+([._-][a-z'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$/",$email)) {
                $this->message("邮件地址不合法!",'gift/default');
            }

            if(($this->user['email'] != $email) && $this->db->fetch_total('user'," email='$email' ")) {
                $this->message("此邮件地址已经注册!",'gift/default');
            }

            $gift = $_ENV['gift']->get($gid);
            if($this->user['credit2']<$gift['credit']) {
                $this->message("抱歉！您的财富值不足不能兑换该礼品!",'gift/default');
            }
           
            $_ENV['user']->update_gift($this->user['uid'],$realname,$email,$phone,$qq);
            $_ENV['gift']->addlog($this->user['uid'],$gid,$this->user['username'],$realname,$this->user['email'],$phone,$addr,$postcode,$gift['title'],$qq,$notes,$gift['credit']);
            $this->credit($this->user['uid'],0,-$gift['credit']);//扣除财富值
            //向管理员发送邮件提醒
            $mailsubject = "礼品兑换提示邮件(请勿回复)"; //邮件主题
            //邮件内容
            $mailbody .= "<div style='width:700px; padding:5px; font-family:微软雅黑; font-size:12px; background:#bdd4e2; border-radius:5px;'>";
            $mailbody .= "<div style='background:#fff; padding:20px; border:solid 1px #dedcdc; border-radius:5px;'>";
            $mailbody .= "<div style='font-size:14px; color:#666; padding-top:10px;'>3Q-ID"."ssss"."于".date("Y年m月d日h时i分",time())."在3Q系统中兑换了XX元的点卡</div><br/>";
            $mailbody .= "<div style='padding-top:25px; font-size:14px; color:#888'>这是一封系统邮件，请勿直接回复。如需帮助，请发送邮件至 <a href='mailto:help@tizhimei.com' target='_blank' style='color:#888; text-decoration:none'>help@tizhimei.com</a></div>";
            $mailbody .= "</div>";
            $mailbody .= "</div>";
            $_ENV['mail']->sendmail ("1007577820@qq.com", "chenyu@pocketriver.com", $mailsubject, $mailbody);
            $this->message("礼品兑换申请已经送出等待管理员审核！","gift/default");
        }
    }

}
?>