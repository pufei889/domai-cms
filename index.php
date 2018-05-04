<?php
/**
 * Domai CMS
 * 哆麦 内容管理系统
 * Copyright @2018 Hito
 *
 * 首页文件
 * 用来：
 * 初始化系统相关类库
 * 加载系统模板并初始化
 *
 * 请不要改动此文件!
 *
 */

/** 加载系统类库 */
//对请求数据进行处理，初始化所有数据
require_once(dirname(__FILE__).'/dm-load.php');

/**加载系统模板类*/
//加载模板并把数据渲染成HTML
require_once(ABSPATH.DMINC.'/template-loader.php');
