<?php
/**
 * Domai CMS
 * 哆麦内容管理系统 
 * Copyright @2018 Hito
 *
 * 此文件主要用来实现Domai的Filter API，与WP的实现不同
 * 用单例模式来保证内部变量只存在一份，不能拷贝
 */

class DM_Filter{
    /**
     * 存储系统所有的钩子和函数数据
     * 存放格式为三维数组，键名为Tag,priority,callback
     *  
     *  $filter[$tag][$priority][$function_to_add]=$accepted_args;
     *  
     *
     */
    public $filters=array();

    /**
     * 正在执行动作的标识，用来区别filter
     */
    public $doing_action=false;


    /**
     * 用来存储单例模式中的钩子对象
     */
    private static $_instance=null;


    /**
     * 往指定的filter或action中添加钩子
     * 为保证相关钩子触发方便，对其结构进行特别设计
     *
     * add_filter
     */
    public function add_filter($tag,$function_to_add,$priority,$accepted_args){
        if($tag=='') return;
        if(!function_exists($function_to_add)) return ;
        if(!is_array($this->filters[$tag])) $this->filters[$tag]=array();
        $priority_existed = isset($this->filters[$tag][$priority]);
        $this->filters[$tag][$priority][$function_to_add]=$accepted_args;
    }

    /**
     * 调用在filter上的钩子函数
     *
     *
     * @param mixed $value The value to filter.
     * @param array $args  Arguments to pass to callbacks.
     * @return mixed The filtered value after all hooked functions are applied to it.
     *
     */
    public function apply_filters($value,$args){
        /**找到执行的钩子名称*/
        $tag=$args[0];

        /**找到要函数要调用的参数*/
        $args[0]=$value;

        //如果$value=='',说明调用它的是action
        if($value=='')
            array_shift($args);

        /**遍历所有的filter列表，找到相应的回掉函数，并执行*/
        foreach($this->filters[$tag] as $priority=>$funcs){
            foreach($funcs as $function_to_add=>$accepted_args){
                $arguments=array_slice($args,0,$accepted_args);
                $value = call_user_func_array($function_to_add,$arguments);
            }
        }
        unset($this->filters[$tag]);
        return $value;
    }

    /**
     * 判断系统上是否注册有相应的钩子
     */
    public function has_filter($tag,$function_to_check=false){
        if($tag==''){
            return empty($this->filters);
        }else if(!isset($this->filters[$tag])){
            return false;
        }else if(isset($this->filters[$tag]) && $function_to_check===false){
            return true;
        }else{
            foreach($this->filters[$tag] as $priority=>$funcs){
                if(array_key_exists($function_to_check,$funcs)){
                    return true;
                }
            }
            return false;
        }
    }

    /**
     * 移除系统上注册的钩子
     */
    public function remove_filter($tag, $function_to_remove, $priority){
        if(!$this->has_filter($tag,$function_to_remove)) return false;

        $exists=isset($this->filters[$tag][$priority]);
        if($exists){
            unset($this->filters[$tag][$priority][$function_to_remove]);
        }
    }

    /**
     * 移除所有注册的钩子
     *
     */
    public function remove_all_filters($priority=false){
        if($priority===false){
            unset($this->filters);
        }else{
            foreach($this->filters as $tag=>$v){
                unset($this->filters[$tag][$priority]);
            }    
        }
    }

    /**
     * 指定钩子名为all的回掉函数
     * 这个all钩子的作用是什么还没有找到
     */
    public function do_all_hook(){
        //pass
    }

    /**
     * 调用在action上的钩子函数
     */
    public function do_action($args){
        $this->do_action=true;
        $this->apply_filters('',$args);
    }

    /*
     * 为实现钩子对象的单例模式
     * 重新定义的静态函数，用来创建一个钩子对象
     */
    public static function init(){
        if(self::$_instance==null){
            self::$_instance= new self();
        }
        return self::$_instance;
    }

    /*
     * 用来实现单例模式，保证不能创建多个钩子对象
     */
    private function __construct(){
    }

    /**
     * 防止被克隆
     */
    public function __clone(){
        return self::$_instance;
    }

}
