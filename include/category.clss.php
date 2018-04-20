<?php
/*
 * Domain CMS
 * Copyright @2018 Hito
 *
 * 栏目对象，用于栏目页面初始化
 *
 */

class Domai_Category{

    /*
     * 栏目ID
     */
    public $cid;

    /*
     * 栏目名
     */
    public $cname;

    /*
     * 栏目别名: 用于生成链接
     */
    public $slug;

    /*
     * 栏目描述
     */
    public $description;

    /*
     * 栏目关键词
     */
    public $keyword;


    /*
     * 栏目下的文章数量
     */
    private $postcount;

    /*
     * 
     */
    private $currentpos;

    public static function get_instance($cid){
        return new Domain_Category($cid);
    }


    public function __construct($cid){
        global $domain_db;
    
    }

    public 








}
