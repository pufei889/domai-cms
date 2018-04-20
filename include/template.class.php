<?php
/*
 * Domain CMS
 * Copyright @2018 Hito
 *
 * 系统模板类，用来渲染模板
 */

class Domai_Template{

    /*
     * 激活的模板名称
     */
    public $active_template;    

    /*
     * 是否支持手机模板
     */
    public $mobile_support;



    public static function template_init(){
        return new Domai_Template();
    }

    public function __construct(){
    
    
    }












}
