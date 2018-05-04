<?php
/**
 * Domai CMS
 * 哆麦 内容管理系统
 * Copyright @2018 Hito
 *
 *
 */

/**开始加载主题*/
do_action('template_redirect');



/**开始处理一些不需要加载主题的请求*/
/*
if(is_robots()){
    do_action('do_robots');
    return;
}else if(is_sitemap){
    do_action('do_sitemap');
    return;
}else if(is_feed()){
    do_action('do_feed');
    return;
}
*/

/**获取主题文件*/
$template = false;
