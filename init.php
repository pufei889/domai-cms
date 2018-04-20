<?php
/*
 * 初试化:
 * 设置时区，初始化全局变量
 * $domai_db: 全局数据库变量
 * $domai_query: 全局查询函数
 * $post: 当前文章的post对象
 * $posts: 循环操作的posts对象，二维数组
 * $is_amp: 当前在AMP站点上
 * $is_home: 当前页面是否是首页
 * $is_category: 当前页面是否是栏目页
 * $is_ingle: 当前页面是否是内容页
 * $is_search: 当前页面是否是搜索页
 *
 */
date_default_timezone_set('PRC');
$domai_query=NULL;
$domai_db=NULL;
define("ABSPATH",dirname(__FILE__)."/");
require_once(ABSPATH."config.php");
require_once(ABSPATH."include/core.php");
require_once(ABSPATH."include/db.class.php");
require_once(ABSPATH."include/query.class.php");
require_once(ABSPATH."include/post.class.php");
$domai_db=new SWPDB(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
error_reporting(E_ALL);
