<?php

!defined('IN_TIPASK') && exit('Access Denied');

class apicontrol extends base {
    function apicontrol(& $get, & $post) {
        $this->base(& $get, & $post);
        $this->load('user');
        $_ENV['user']->refresh(1, 1, intval(3600));
        $this->load('question');
        $this->load('answer');
        $this->load("favorite");
        $this->load("mail");
    }
    function onnotify(){
    	$answerid = $this->post['answerid'];
    	$answeruser = $this->post['answeruser'];
    	$title = $this->post['title'];
    	$content = $this->post['content'];
    	if(!$answerid || !$answeruser || !$title || !$content){
    		ajax(0,"必要参数不能为空");
    		exit();
    	}
//     	$user = $_ENV['user']->get_by_uid();
//     	notify(tcookie('token'), $title, "消息通知", $content, $receiver);
    }
    /**
     * app客户端提问题
     */
    function onappask(){
      if (isset($this->post['submit'])) {
            //处理提交问题后的操作
      $title = $this->post['title'];
            $description = $this->post['description'];
            $cid1 = $this->post['classlevel1'];
            $cid2 = $this->post['classlevel2'];
            $cid3 = $this->post['classlevel3'];
            $cid = $this->post['cid'];
            $tags = array_filter($this->post['qtags']);
            $hidanswer = intval($this->post['hidanswer']) ? 1 : 0;
            $price = intval($this->post['givescore']);
            $askfromuid = $this->post['askfromuid'];
            //检查魅力值
            //if($this->user['credit3']<$this->user)
            $this->setting['code_ask'] && $this->checkcode(); //检查验证码
            //检查财富值
            (intval($this->user['credit3']) < $this->setting['allow_credit3']) && $this->message("你的魅力太低，禁止提问，如有问题请联系管理员!", 'BACK');
            $offerscore = $price;
            ($hidanswer) && $offerscore+=10;
            (intval($this->user['credit2']) < $offerscore) && $this->message("财富值不够!", 'BACK');
            //检查审核和内容外部URL过滤
            $status = intval(1 != (1 & $this->setting['verify_question']));
            $allow = $this->setting['allow_outer'];
            if (3 != $allow && has_outer($description)) {
                0 == $allow && $this->message("内容包含外部链接，发布失败!", 'BACK');
                1 == $allow && $status = 0;
                2 == $allow && $description = filter_outer($description);
            }
            //检查标题违禁词
            $contentarray = checkwords($title);
            1 == $contentarray[0] && $status = 0;
            2 == $contentarray[0] && $this->message("问题包含非法关键词，发布失败!", 'BACK');
            $title = $contentarray[1];

            //检查问题描述违禁词
            $descarray = checkwords($description);
            1 == $descarray[0] && $status = 0;
            2 == $descarray[0] && $this->message("问题描述包含非法关键词，发布失败!", 'BACK');
            $description = $descarray[1];

            /* 检查提问数是否超过组设置 */
            ($this->user['questionlimits'] && ($_ENV['userlog']->rownum_by_time('ask') >= $this->user['questionlimits'])) &&
                    $this->message("你已超过每小时最大提问数" . $this->user['questionlimits'] . ',请稍后再试！', 'BACK');

            $qid = $_ENV['question']->add($title, $description, $hidanswer, $price, $cid, $cid1, $cid2, $cid3, $status);
            $tags && $_ENV['tag']->multi_add($tags, $qid);

            //增加用户积分，扣除用户悬赏的财富
            if ($this->user['uid']) {
                $this->credit($this->user['uid'], 0, -$offerscore, 0, 'offer');
                $this->credit($this->user['uid'], $this->setting['credit1_ask'], $this->setting['credit2_ask']);
            }
//             $viewurl = urlmap('question/view/' . $qid, 2);
            /* 如果是向别人提问，则需要发个消息给别人 */
            if ($askfromuid) {
                $this->load("message");
                $this->load("user");
                $touser = $_ENV['user']->get_by_uid($askfromuid);
                $_ENV['message']->add($this->user['username'], $this->user['uid'], $touser['uid'], '问题求助:' . $title, $description . '<br /> <a href="' . SITE_URL . $this->setting['seo_prefix'] . $viewurl . $this->setting['seo_suffix'] . '">点击查看问题</a>');
                sendmail($touser, '问题求助:' . $title, $description . '<br /> <a href="' . SITE_URL . $this->setting['seo_prefix'] . $viewurl . $this->setting['seo_suffix'] . '">点击查看问题</a>');
            }
            //如果ucenter开启，则postfeed
            if ($this->setting["ucenter_open"] && $this->setting["ucenter_ask"]) {
                $this->load('ucenter');
                $_ENV['ucenter']->ask_feed($qid, $title, $description);
            }
            $_ENV['userlog']->add('ask');
            
            include template('appaskresult');
//             if (0 == $status) {
//                 $this->message('问题发布成功！为了确保问答的质量，我们会对您的提问内容进行审核。请耐心等待......', 'BACK');
//             } else {
//                 $this->message("问题发布成功!", $viewurl);
//             }
        } else {
        	$questionlist = $_ENV['question']->list_by_uid($this->user['uid'], "all", 0, 6,'status','Asc');
        	$aboutquestionlist = $_ENV['question']->list_by_uid($this->user['uid'], "all", 0, 6,'status','Asc');
            include template('appask');
        }
	}
	/**
	 * 发送邮件接口
	 */
	function  onsendEmail(){
		$mailsubject = "欢迎到丽江旅游！！"; //邮件主题
		//邮件内容
		$mailbody .= "<div style='width:700px; padding:5px; font-family:微软雅黑; font-size:12px; background:#bdd4e2; border-radius:5px;'>";
		$mailbody .= "<div style='background:#fff; padding:20px; border:solid 1px #dedcdc; border-radius:5px;'>";
		$mailbody .= "<div style='font-size:14px; color:#666; padding-top:10px;'>你好，李珊珊同学</div><br/>";
		$mailbody .= "<div style='font-size:14px; color:#197AA7; padding-top:10px;'>您于2013年十一月购买的咖啡即将过期，请尽快寄往以下地址：</div>";
		$mailbody .= "<div style='clear:both;'></div>";
		$mailbody .= "<div style='color: #666; padding-TOP:5px; font-size:14px;'><p style='font-size:14px;'>请点击下面的链接，完成寄送：</p></div>";
		$mailbody .= "<div style='padding-bottom:25px;'><a href='http://www.baidu.com' style=' padding-top:15px; font-size:14px; color:#197aa7; display:block;  word-break:break-all; text-decoration:underline' target='_blank'>http://www.wanchengjisong.com</a></div>";
		$mailbody .= "<div style='color: #666; padding-bottom:15px; font-size:14px;'>如果你不能点击上面链接，还可以将链接复制到浏览器地址栏中访问。</div>";
		$mailbody .= "<div style='padding-top:25px; font-size:14px; color:#888'>这是一封系统邮件，请勿直接回复。如需帮助，请发送邮件至 <a href='mailto:help@tizhimei.com' target='_blank' style='color:#888; text-decoration:none'>help@tizhimei.com</a></div>";
		$mailbody .= "<div style='padding-top:25px; font-size:14px; color:#888'>丽江市咖啡专卖店有限公司版权所有<br>Copyright © TiZhiMei.Com 2012, All Rights Reserved</div>";
		$mailbody .= "</div>";
		$mailbody .= "</div>";
		$_ENV['mail']->sendmail ( "664045262@qq.com", "chenyu@pocketriver.com", $mailsubject, $mailbody);
	}
	/**
	 * 获取用户状态
	 */
    function ongetStatus() {
    	$token = $this->post["token"];
    	$acc_nbr = $this->post['acc_nbr'];
//     	$token = "66062970-0d125db0-9604-4244-a667-fdeb18b3a8a9";
//     	$acc_nbr = "66220097,66220021,66062970";
    	if(!$token){
    		ajax(0,"当前用户token不能为空");
    		exit();
    	}else if(!$acc_nbr){
    		ajax(0,"查询用户不能为空");
    		exit();
    	}
    	$userStatus = isLogin($acc_nbr,$token);
    	if(!$userStatus){
    		ajax(0,"token无效或者查询用户字符串格式不对！");
    	}else{
    		//查询本地用户的状态：   未注册的，默认为不在线
    		$acc_arry = explode(',',$acc_nbr);
    		$status ="";
			foreach ($acc_arry as $key=>$acc){
				//判断是否有这个用户，若是没有就创建，若是有就登陆
				$user = $_ENV['user']->get_by_username($acc);
				if (!$user) {
					$acc_arry[$key] = 0;
				}else{
					$acc_arry[$key] = intval($_ENV['user']->is_login($user["uid"]));
				}	
			}    		
    	}
    	$data["status"] = implode(',', $acc_arry);
    	$data["3q_status"] = $userStatus;
   		ajax(1,"成功",$data);
    }
	/**
	 * 获取用户的最近10条问题记录
	 */
    function onrmyquestion() {
    	$uid = $this->post["uid"];
    	if(!$uid){
    		ajax(0,"必须要uid参数");
    		exit();
    	}
    	$questionlist = $_ENV['question']->list_by_uid($uid, "all", 0, 10);
    	ajax(1,"获取成功",$questionlist);
    }

    /**
     * 初始化用户
     */
    function oninituser() {
    	$token = $this->post['token'];
    	if(!$token){
    		ajax(0,"token不能为空");
    		exit();
    	}
    	$userInfo = inituser($token);
    	if(!$userInfo){
    		ajax(0,"token错误！");
    	}else{
    		//若是手机号码注册，则自动生成一个不可用邮箱，若是用邮箱注册则$email就为改用户名
    		$email = $userInfo["acc_nbr"]."@3q.com";
    		//判断是否有这个用户，若是没有就创建，若是有就登陆
    		$user = $_ENV['user']->get_by_username($userInfo['acc_nbr']);
    		if (!$user) {
    			$uid = $_ENV['user']->add($userInfo["acc_nbr"], "123456", $email);
    			$user = $_ENV['user']->get_by_username($userInfo["acc_nbr"]);
    		}
    		//登陆
    		$_ENV['user']->refresh($user['uid'], 1, intval(3600));
    		$data["user"] =$user;
    		$data["3q_user"] = $userInfo;
    		ajax(1,"登陆成功",$data);//返回登陆用户的3q信息和问答系统账户信息
    	}
    }
	/**
	 * 用户登陆
	 */
    function onlogin() {
    	$username = $this->post['username'];
    	$pwd = $this->post['pwd'];
//     	$username = "1007577820@qq.com";
//     	$username = "chenyu@pocketriver.com";
//     	$pwd = "lengxueyu520";
		if(!$username){
			ajax(0,"用户名不能为空");
			exit();
		}else if(!$pwd){
			ajax(0,"密码不能为空");
			exit();
		}
		$userInfo = login($username, $pwd);
		if(!$userInfo){
			ajax(0,"用户名或者密码错误");
		}else{
			//若是手机号码注册，则自动生成一个不可用邮箱，若是用邮箱注册则$email就为改用户名
			if(preg_match("/^[a-z'0-9]+([._-][a-z'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$/", $username)){
				$email = $username;
			}else{
				$email = $username."@3q.com";
			}
			//判断是否有这个用户，若是没有就创建，若是有就登陆
			$user = $_ENV['user']->get_by_username($userInfo['acc_nbr']);
			if (!$user) {
				$uid = $_ENV['user']->add($userInfo["acc_nbr"], $pwd, $email);
				$user = $_ENV['user']->get_by_username($userInfo["acc_nbr"]);
			}
			//存储3qtoken
			tcookie('token', $userInfo['token'], intval(3600));
// 			ajax(1,"登陆成功success",tcookie('token'));
			//登陆
			$_ENV['user']->refresh($user['uid'], 1, intval(3600));
			$forward = isset($this->post['forward']) ? $this->post['forward'] : SITE_URL; //通行证处理
			$this->setting['passport_open'] && $this->setting['passport_type'] && $_ENV['user']->passport_server($forward);
			$this->credit($this->user['uid'], $this->setting['credit1_login'], $this->setting['credit2_login']); //登录增加积分
			
			$data["user"] =$user;
			$data["3q_user"] = $userInfo;
			ajax(1,"登陆成功success",$data);//返回登陆用户的3q信息和问答系统账户信息
		}
    }


}

?>