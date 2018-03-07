<?php
/*
 * 更新并切分sitemap 杨海涛 2018年3月7日
 * 更新文件sitemap.xml
 *
 */
require_once("./init.php");
$total=get_stat();
$mapcount=ceil($total/1000);
$host=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];
$sitemaps=array();
for($i=1;$i<=$mapcount;$i++){
    if(file_exists(ABSPATH."sitemap-full-$i.xml")){
        $urls="sitemap-full-$i.xml";
        array_push($sitemaps,$urls);
        continue;
    }
    $tmp = $mysql->getRows("select id,linkname,category,post_time from posts order by id desc limit ".($i-1)*1000 .",1000");
    ob_start();
    echo '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\r\n";
    foreach($tmp as $t){
        if($t['category']==''){
            $url= $host."/".str_replace("%post_id%",$t['id'],str_replace("%post_name%",$t['linkname'],permanlink));
        }else{
            $url = $host. "/".get_link_name($t['category'])."/".str_replace("%post_id%",$t['id'],str_replace("%post_name%",$t['linkname'],permanlink));
        }
        echo "<url>\r\n<loc>".$url."</loc>\r\n</url>\r\n";
    }
    echo "\r\n</urlset>";
    $xml = ob_get_contents();
    ob_end_clean();
    if(count($tmp)==1000){
        $urls="sitemap-full-$i.xml";
        array_push($sitemaps,$urls);
    }else{
        $urls="sitemap-$i.xml";
        array_push($sitemaps,$urls);
    }
    file_put_contents(ABSPATH.$urls,$xml);
}

ob_start();
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo "\r\n";
echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
foreach($sitemaps as $sitemap){
    echo "<sitemap>\r\n<loc>$host/$sitemap</loc>\r\n</sitemap>";
}
echo "</sitemapindex>";
$xml = ob_get_contents();
ob_end_clean();
file_put_contents(ABSPATH."sitemap.xml",$xml);
