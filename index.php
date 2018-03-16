<?php
/*
 * 哆麦
 */
require_once("init.php");
$ishome=true;
if(isset($_GET['amp'])){
    $isamp=true;
    require_once("./template/amp/index.php");
}else{
    require_once("./template/index.php");
}
