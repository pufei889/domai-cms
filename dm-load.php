<?php
/**
 * Domai CMS
 * 哆麦 内容管理系统
 * Copyright @2018 Hito
 *
 * 引导系统进行初始化
 *
 * 如果不存在dm-config.php，则询问用户是否进行系统安装
 *
 */


/** 定义ABSPATH 为当前系统的目录 */
if(!defined('ABSPATH')){
    define('ABSPATH',dirname(__FILE__)."/");
}

error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );


/*
 * 如果dm-config.php文件不存在，则引导用户进行系统安装
 */

if(file_exists(ABSPATH.'dm-config.php')){
    require_once(ABSPATH.'dm-config.php');
}else{
    //引导进行安装
    define('DMINC','dm-includes');
    
    dm_die();
}
