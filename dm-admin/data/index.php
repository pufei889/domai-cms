<?php
header("Content-Type:text/html;charset=utf-8");
require_once("../init.php");
if(file_exists("./lock")){
    die("系统已经安装");
}
$sqls=preg_split("/\#\#.+/i",file_get_contents("./struct.sql"));
foreach($sqls as $sql){
    $swpdb->query($sql);
}
$tmp=$swpdb->get_results("show tables");
if(count($tmp)==6){
    die("安装失败");
}else{
    echo "安装成功";
    file_put_contents("./lock","安装成功!");
}
