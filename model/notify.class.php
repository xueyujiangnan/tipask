<?php

!defined('IN_TIPASK') && exit('Access Denied');

class notifymodel {

    var $db;
    var $base;

    function notifymodel(&$base) {
        $this->base = $base;
        $this->db = $base->db;
    }
    /* 添加用户，本函数需要返回uid */

    function add($send, $reciver, $questiontitle, $message) {
    	$this->db->query("INSERT INTO " . DB_TABLEPRE . "notify(sender,reciver,title,msg,time) values ('$send','$reciver','$questiontitle','$message','".date("y/m/d h:i:s",time())."')");
        return $this->db->insert_id();
    }
}

?>