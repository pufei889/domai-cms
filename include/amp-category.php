<?php
require_once("../../init.php");
$page = isset($_GET["page"])?(int)$_GET['page']:1;
$numperpage=pagecount;
if($page<1){
    header("HTTP/1.1 403 forbidden");
    echo "Unauthorized access";
    die;
}
$category = substr($_SERVER["REQUEST_URI"],1); 
$category = substr($category,0,strpos($category,"/"));
$category = str_replace("-"," ",$category);
if(is_404()){
    header("HTTP/1.1 404 Not Found");
    die;
}
$isamp=true;
$iscategory=true;
$category_path=get_link_name($category);
header("Cache-Control: public,max-age=86400");
?>
