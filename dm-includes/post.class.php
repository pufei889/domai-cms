<?php
/*
 * Domai CMS
 * 哆麦 内容管理系统
 * Copyright @2018 Hito
 *
 * 此文章用来实现POST类
 */
final class DM_DB{
    /*
     * 存放在posts表里的基础post信息
     */
    public $ID;
    public $post_author=0;
    public $post_date='0000-00-00 00:00:00';
    public $post_title='';
    public $post_excerpt='';
    public $post_name='';
    public $post_type='post';
    public $post_category='';
    public $post_thumbnail='';

    /*
     *存放在数据系统表的其他信息
     */
    public $extra_info;


    /*
     * 静态函数:用于生成系统post对象
     *
     * @param  文章ID
     * @return 返回post对象
     *         false 
     */
    public static function get_instance($post_id){
        global $domai_db;
        $post_id = (int) $post_id;
        if(!$post_id) return false;
        $_post = $domai_db->get_row( 'select posts.*, users.username as post_author from posts left join users on posts.post_author = users.id where posts.ID = ' . $post_id);
        if(!empty($_post)){
            return new self::($_post);
        }
    }


    /*
     *构造函数
     * @param post关联数组
     * @return NULL
     */
    public function __construct($post){
        foreach($post as $key=>$value){
            $this->$key=$value;
        }
        /*
         * 默认情况下 post_name要么是用户填写，要么是系统自动生成
         * 在某些情况，数据库中的post_name有可能为空
         * 为了增强系统的健壮性，若post_name为空，则调用系统函数重新生成post_name
         * 以保证post_name为空的情况下，也能用get_permalink()获取文章链接
         */
        if($this->post_name==''){
            $this->post_name = sanitize_post_name($this->post_title);
        }
    }

    public function get_the_title(){
        return $this->post_title;
    }
    public function get_the_category(){
        
    }

    public function __get($key){
        if(in_array($key,$this->extra_info)){
            return $this->extra_info[$key];
        }else{
            return NULL;
        }
    }

}
