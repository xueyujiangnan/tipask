<?php
define('TIPASK_ROOT', substr(dirname(__FILE__), 0, -4));
require_once TIPASK_ROOT.'/config.php';
require_once TIPASK_ROOT.'/lib/global.func.php';

$username = $_get[];
$password = $_get[];

//调用3q接口验证合法性,并获取用户信息
//判断用户是否存在于当前系统中，若不存在，自行创建
