<?php
/*
 * Domai CMS
 * Copyright @2018 Hito
 * Core Functions
 */

//检查一个数据是否是序列化数据
function is_serialized( $data, $strict = true ) {
    // if it isn't a string, it isn't serialized.
    if ( ! is_string( $data ) ) {
        return false;
    }
    $data = trim( $data );
    if ( 'N;' == $data ) {
        return true;
    }
    if ( strlen( $data ) < 4 ) {
        return false;
    }
    if ( ':' !== $data[1] ) {
        return false;
    }
    if ( $strict ) {
        $lastc = substr( $data, -1 );
        if ( ';' !== $lastc && '}' !== $lastc ) {
            return false;
        }
    } else {
        $semicolon = strpos( $data, ';' );
        $brace     = strpos( $data, '}' );
        // Either ; or } must exist.
        if ( false === $semicolon && false === $brace )
            return false;
        // But neither must be in the first X characters.
        if ( false !== $semicolon && $semicolon < 3 )
            return false;
        if ( false !== $brace && $brace < 4 )
            return false;
    }
    $token = $data[0];
    switch ( $token ) {
        case 's' :
            if ( $strict ) {
                if ( '"' !== substr( $data, -2, 1 ) ) {
                    return false;
                }
            } elseif ( false === strpos( $data, '"' ) ) {
                return false;
            }
            // or else fall through
        case 'a' :
        case 'O' :
            return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
        case 'b' :
        case 'i' :
        case 'd' :
            $end = $strict ? '$' : '';
            return (bool) preg_match( "/^{$token}:[0-9.E-]+;$end/", $data );
    }
    return false;
}

//下面三个是配置管理函数
function add_option($option_name,$option_value){
    global $swpdb;
    if(is_array($option_value)||is_object($option_value)){
        $option_value=serialize($option_value);
    }
    if(get_option($option_name)==null){
        $swpdb->query("insert into options(option_name,option_value) values('".$option_name."','".$option_value."');");
    }else{
        update_option($option_name,$option_value);
    }
}
function update_option($option_name,$option_value){
    global $swpdb;
    if(is_array($option_value)||is_object($option_value)){
        $option_value=serialize($option_value);
    }
    $swpdb->query("update options set option_value='".$option_value."' where option_name = '".$option_name."'");
}
function get_option($option_name){
    global $swpdb;
    $option_value=$swpdb->get_var("select option_value from options where option_name = \"$option_name\"");
    if(is_serialized($option_value)){
        return unserialize($option_value);
    }else{
        return $option_value;
    }
}

function is_home(){
    global $domai_query;
    return $domai_query->is_home();
}
function is_search(){
    global $domai_query;
    return $domai_query->is_search($search);
}
function is_single($post=NULL){
    global $domai_query;
    return $domai_query->is_single($post);
}
function is_page($page=NULL){
    global $domai_query;
    return $domai_query->is_page($category);
}
function is_category($category=NULL){
    global $domai_query;
    return $domai_query->is_category($category);
}
function is_tag($tag=NULL){
    global $domai_query;
    return $domai_query->is_tag($tag);
}
