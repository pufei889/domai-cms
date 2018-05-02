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

/** 定义系统默认时区 */
date_default_timezone_set('Asia/Shanghai');

/**
 * 加载相应类库并
 * 定义系统全局变量
 */

/** 加载插件模块 此模块主要用来实现插件API */
require_once(ABSPATH.DMINC.'/plugin.php');

/** 加载系统查询类*/
require_once(ABSPATH.DMINC.'/query.class.php');
$dm_query=NULL;

/** 加载数据库类 并初始化*/
require_once(ABSPATH.DMINC.'/db.class.php');
$dm_db=new DM_DB(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

/** 定义数据库默认时区*/
$dm_db->query('set global time_zone=\'+8:00\'');

/** 定义数据库传输编码*/
$dm_db->query('set names utf8');

