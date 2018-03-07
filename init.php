<?php
/*
 *初始化文件
 * 2018年3月2日 Hito
 */
date_default_timezone_set('PRC');
define("ABSPATH",dirname(__FILE__)."/");
require_once(ABSPATH."config.php");
require_once(ABSPATH."include/functions.php");
require_once(ABSPATH."include/db.class.php");
$mysql=new Mysql(dbhost,dbuser,dbpasswd,dbname);
