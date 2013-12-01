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
    }

    function ondefault() {
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

    function onlogin() {
    	$username = $this->post['username'];
    	$pwd = $this->post['pwd'];
//     	$username = "1007577820@qq.com";
//     	$pwd = "lengxueyu";
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