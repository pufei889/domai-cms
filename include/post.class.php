<?php
/*
 * post对象
 */
final class Domai_Post{
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
   

    public static function get_instance($post_id){
        global $domai_db;
        $post_id=(int) $post_id;
        if(!$post_id) return false;
        $_post = $domai_db->get_row("select posts.*, users.username as post_author from posts left join users on posts.post_author = users.id where posts.ID = $post_id");
        if(!empty($_post)){
            return new Domai_Post($_post);
        }
    }

    public function __construct($post){
        foreach($post as $key=>$value){
            $this->$key=$value;
        }
    }

    public function __get($key){
        if(in_array($key,$this->extra_info)){
            return $this->extra_info[$key];
        }else{
            return NULL;
        }
    }

}
