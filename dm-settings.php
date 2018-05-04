<?php
/**
 * Domai CMS
 * 哆麦内容管理系统 
 * Copyright @2018 Hito
 *
 * 用来初始化Domai的所有的公共变量
 * 加载系统类库
 *
 */

/** 定义系统公共文件位置 */
define('DMINC','dm-includes');


/** 加载Domai初始化需要的文件 */
//插件API
require_once(ABSPATH.DMINC.'/plugin.php');

/** 定义系统默认时区 */
date_default_timezone_set('Asia/Shanghai');

/** 加载数据库类 并初始化*/
require_once(ABSPATH.DMINC.'/class.db.php');
$dmdb=new DM_DB(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
//定义数据库默认时区
$dmdb->query('set global time_zone=\'+8:00\'');
//定义数据库传输编码
$dmdb->query('set names utf8');

/** 定义PHP执行结束需要执行的钩子 */
register_shutdown_function('do_action','shutdown');


/** 加载Domai其他需要的代码*/
require_once(ABSPATH.DMINC.'/formatting.php');
require_once(ABSPATH.DMINC.'/class.query.php');













