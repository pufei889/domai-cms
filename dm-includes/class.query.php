<?php
/*
 * Domain CMS
 * Copyright @2018 Hito
 *
 * 系统前端主查询类，同时只能存在一个
 * 当请求分发时，初始化这个类的init静态函数
 * 请为动态请求，各个请求的含义
 * 空:  请求首页
 * p: 请求单页或内容页， 值为文章ID
 * c: 请求栏目页，值为栏目ID
 * t: 请求tag页，值为Tag值
 * s: 请求搜索页，值为搜索词
 *
 * 附加请求值
 * mobile: 表示用移动版的模板渲染
 */

class DM_Query{
    /*
     * 查询类型: 单个文章或者多个文章
     * 单个是指只需要调用单个文章的页面，如文章页
     * 多个只是需要调用多个文章的页面，如栏目页
     */
    public $type;
    /*
     * 是否是移动的页面
     */
    public $is_mobile=false;

    /*
     * 是否是首页
     */
    public $is_home=false;

    /*
     * 是否是栏目页
     */
    public $is_category=false;

    /*
     * 是否是内容页面
     */
    public $is_single=false;

    /*
     * 是否是单页
     */
    public $is_page=false;

    /*
     * 是否是tag页
     */
    public $is_tag=false;

    /*
     * 是否为404页面
     */
    public $is_404=false;

    /*
     * 是否为搜索页面
     */
    public $is_search=false;

    /*
     * 是否为robots.txt页面
     */
    public $is_robots=false;

    /*
     * 是否为sitemap.xml页面
     */
    public $is_sitemap=false;

    /*
     * 是否为feed页面
     */
    public $is_feed=false;

    /*
     * 查询值
     */
    public $query;

    /*
     * 是否是非法查询
     */

    public static function init(){
        global $dm_query;
        if($dm_query==NULL){
            $dm_query = new self();
            $dm_query->run();
        }
    }

    public function __construct(){
        global $dm_query;
        if($dm_query!=NULL){
            return $dm_query;
        }
        if(isset($_GET['mobile'])) $this->is_mobile=true;
        if(isset($_GET['p'])){
            $this->type='';
            $this->query=(int) $_GET['p'];
            $this->is_single=true;
        }else if(isset($_GET['c'])){
            $this->type='c';
            $this->query=(int) $_GET['c'];
            $this->is_category=true;
        }else if(isset($_GET['t'])){
            $this->type='t';
            $this->query=$_GET['t'];
            $this->is_tag=true;
        }else if(isset($_GET['s'])){
            $this->type='s';
            $this->query=$_GET['s'];
            $this->is_search=true;
        }else{
            $this->type='index';
            $this->is_home=true;
        }
    }

    public function run(){
        if($this->is_single || $this->is_page ){
            $post = DM_Post::get_instance($this->query);
        }else if($this->is_category){
            $category= DM::get_instance($this->query);
        }else if($this->is_tag){
            $tag= DM_Tag::get_instance($this->query);
        }else if($this->is_search){
            $search= DM_Search::get_instance($this->query);
        }
    }

    /*
     * 判断当前页面是否是首页
     */
    public function is_home(){
        return $this->is_home;
    }

     /*
     * 判断当前页面是否是搜索页
     */
    public function is_search(){
        return $this->is_search;   
    }
    /*
     * 判断是否是文章页
     * 参数可为ID,标题,postname
     */
    public function is_single($post){
        //当传递的参数为空时，表示判断当前主查询是否为内容页
        if($post==NULL) return $this->is_single;
        //传递有参数时，用数据库进行查询
        global $dm_db;
        $postid=(is_int($post))?$post:0;
        $tmp = $dm_db->get_var("select ID from posts where (ID = $postid or post_title = \"$post\" or post_name = \"$post\") and post_type=\"post\" limit 0,1");
        if($tmp) return true;
        return false;
    }

    /*
     * 判断是否是单页
     * 参数可为ID,标题,postname
     */
    public function is_page($post){
        //当传递的参数为空时，表示判断当前主查询是否为内容页
        if($post==NULL) return $this->is_page;
        //传递有参数时，用数据库进行查询
        global $dm_db;
        $postid=(is_int($post))?$post:0;
        $tmp = $dm_db->get_var("select ID from posts where (ID = $postid or post_title = \"$post\" or post_name = \"$post\") and post_type=\"page\" limit 0,1");
        if($tmp) return true;
        return false;
    }

    /*
     * 判断是否是栏目页
     * 参数可为栏目ID，栏目名称，slug
     */
    public function is_category($category){
        //当传递的参数为空时，表示判断当前主查询是否为栏目页 
        if($category==NULL) return $this->is_category;
        //传递有参数时，用数据库进行查询
        global $dm_db;
        $cid=(is_int($category))?$category:0;
        $tmp=$dm_db->get_var("select id from categories where id = $cid or title = \"$category\" or slug = \"$category\" limit 0,1");
        if($tmp) return true;
        return false;
    }

    /*
     * 判断是否是Tag
     * 参数可为ID, Tag名
     */
    public function is_tag($tag){
        //当传递的参数为空时，表示判断当前主查询是否为栏目页 
        if($tag==NULL) return $this->is_tag;
        global $dm_db;
        $tid=(is_int($tag))?$tag:0;
        $tmp = $dm_db->get_var("select id from tags where id = $tid or post_tag = \"$tag\" limit 0,1");
        if($tmp) return true;
        return false;
    }
}
