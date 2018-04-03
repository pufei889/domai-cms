<?php
/*
 * SWPL CMS
 * Simple Wordpress Like Content Management System
 * Copyright @Hito(2018 https://www.hitoy.org/
 * License: Non-commercial Use
 * Version: 1.0.0
 * Update: 2018-03-30
 */

//数据库配置地址
define("DB_NAME","dba");
define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASSWORD","");
//是否开启debug模式
define('DEBUG', true);
if(!defined('ABSPATH'))
	define('ABSPATH', dirname(__FILE__).'/');
