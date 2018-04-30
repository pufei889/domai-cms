<?php
/*
 * 认证
 * 2018年3月6日 copyright 杨海涛@camelway
 */
require_once("../init.php");
if(@$_SERVER['PHP_AUTH_USER']!=user || @$_SERVER['PHP_AUTH_PW']!=password){
    header("HTTP/1.1 401 unauthorized");
    header("Content-Type:text/html;charset=utf-8");
    header('WWW-Authenticate:Basic realm="Admin"');
    echo '需要用户名和密码才能继续访问';
    die;
}
