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
 */

/** 加载系统类库 */
require_once(dirname(__FILE__).'/dm-load.php');

/**初始系统查询 */
DM_Query::init();

print_r($dm_db);
/**加载系统模板 */
//require_once(ABSPATH.DMINC.'/template-loader.php');
