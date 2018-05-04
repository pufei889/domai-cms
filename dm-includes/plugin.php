<?php
/**
 * Domai CMS
 * 哆麦内容管理系统 
 * Copyright @2018 Hito
 *
 * 此文件主要用来实现插件API，和WP的接口类似但实现方法不一样
 *
 * 系统中有两种插件函数，一种为filters,另一种为actions
 * filters用于内容的更改
 * actions用于动作(函数的执行)
 *
 * 此文件要实现所有WP的插件API
 *
 *
 * 没有实现的插件函数有:
 * _wp_call_all_hook
 * _wp_filter_build_unique_id
 * current_filter
 * current_action
 * doing_filter
 * did_action
 * apply_filters_deprecated
 * do_action_deprecated
 *
 * plugin_basename
 * wp_register_plugin_realpath
 * plugin_dir_path
 * plugin_dir_url
 * register_activation_hook
 * register_deactivation_hook
 * register_uninstall_hook
 */

/** 加载钩子库*/
require_once(dirname(__FILE__).'/class.filter.php');

/**
 * 向指定的action或者filter中添加钩子函数
 * 调用方法和WP一样
 * 但实现方式有很大出入
 */
function add_filter($tag,$function_to_add,$priority=10,$accepted_args = 1){
    $dm_filter = DM_Filter::init();
    return $dm_filter->add_filter($tag,$function_to_add,$priority,$accepted_args);
}

/**
 * 判断系统是否已经存在相应的钩子函数
 */

function has_filter($tag,$function_to_check=false){
    $dm_filter= DM_Filter::init();
    if(!isset($dm_filter->filters[$tag])){
        return false;
    }
    return $dm_filter->has_filter($tag,$function_to_check);
}

/**
 * 调用添加到action或者filter中的钩子函数
 * $value等后面多个为add_filter添加的hook函数的参数
 */
function apply_filters($tag,$value){
    $dm_filter = DM_Filter::init();
    $args = func_get_args();
    return $dm_filter->apply_filters($value,$args);
}

/*
 * 调用添加到action或者filter中的钩子函数
 * 参数通过数组传递
 * $args:array()
 * $args等后面多个为add_filter添加的hook函数的参数
 */
function apply_filters_ref_array($tag,$args){
    $dm_filter = DM_Filter::init();
    return $dm_filter->apply_filters($args[0],$args);
}

/**
 * 删除系统中已经存在的钩子函数
 */
function remove_filter($tag, $function_to_remove, $priority = 10){
    $dm_filter= DM_Filter::init();
    $dm_filter->remove_filter($tag,$function_to_remove,$priority);
}

/**
 * 删除系统指定的钩子函数
 */
function remove_all_filters($tag,$priority=10){
    $dm_filter= DM_Filter::init();
    if(isset($dm_filter->filters[$tag])){
        unset($dm_filter->filters[$tag][$priority]);
    }
    return true;
}

/**
 * 向指定的钩子添加回调函数
 */
function add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1){
    return add_filter($tag, $function_to_add, $priority, $accepted_args);
}

/**
 * 触发指定钩子的函数
 */
function do_action($tag,$args = ''){
    $dm_filter= DM_Filter::init();
    $args=func_get_args();
    $dm_filter->do_action($args);
}

/**
 * 触发定制钩子的函数
 * 回掉函数的参数为数组
 */
function do_action_ref_array($tag,$args){
    $dm_filter= DM_Filter::init();
    array_unshift($args,$tag);
    var_dump($args);
    $dm_filter->do_action($args);
}

/**
 * 是否含有指定的action
 */
function has_action($tag, $function_to_check = false) {
    return has_filter($tag, $function_to_check);
}


/**
 * 删除指定的action
 */
function remove_action( $tag, $function_to_remove, $priority = 10 ) {
    return remove_filter( $tag, $function_to_remove, $priority );
}

/**
 * 删除全部action
 */
function remove_all_actions($tag, $priority = false) {
    return remove_all_filters($tag, $priority);
}
