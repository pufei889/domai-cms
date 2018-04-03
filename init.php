<?php
/*
 * 初试化:
 * 设置时区，初始化全局变量
 * $swpdb: 全局数据库变量
 * $post: 当前文章的post对象
 * $posts: 循环操作的posts对象，二维数组
 * $is_amp: 当前在AMP站点上
 * $is_home: 当前页面是否是首页
 * $is_category: 当前页面是否是栏目页
 * $is_ingle: 当前页面是否是内容页
 * $is_search: 当前页面是否是搜索页
 *
 * $filter: 过滤函数，在the_content,the_title等调用之前调用 
 */
date_default_timezone_set('PRC');
define("ABSPATH",dirname(__FILE__)."/");
require_once(ABSPATH."config.php");
require_once(ABSPATH."include/swp.db.class.php");
require_once(ABSPATH."include/swp.post.class.php");
require_once(ABSPATH."include/core.php");
$swpdb=new SWPDB(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$post=SWP_Post::get_instance(1);
print_r($post);
