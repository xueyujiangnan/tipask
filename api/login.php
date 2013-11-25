<?php
define('TIPASK_ROOT', substr(dirname(__FILE__), 0, -4));
require_once TIPASK_ROOT.'/config.php';
require_once TIPASK_ROOT.'/lib/global.func.php';
// require_once TIPASK_ROOT.'/model/base.class.php';

$username = "1007577820@qq.com";
$pwd = "lengxueyu";


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
	var_dump($_ENV);
	//判断是否有这个用户，若是没有就创建，若是有就登陆
	$user = $_ENV['user']->get_by_username($username);
	var_dump($user);
	if (!$user) {
		$uid = $_ENV['user']->add($userInfo["acc_nbr"], $pwd, $email);
		$user = $_ENV['user']->get_by_username($userInfo["acc_nbr"]);
	}
	var_dump($user);
	//登陆
	$_ENV['user']->refresh($user['uid'], 1, intval(3600));
	
	ajax(1,"登陆成功",$data);//返回登陆用户的3q信息和问答系统账户信息
}

