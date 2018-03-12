<?php
/*
 * 更新并切分sitemap 杨海涛 2018年3月7日
 * 更新文件sitemap.xml
 *
 */
require_once("./init.php");
if(!isset($_GET['pw']) || $_GET['pw']!=submitpasswd) die("Password Error, Updated Sitemap Error!");
$total=get_stat();
$host=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];
$sitemaps=array();
$i=1;
while(1){
    $tmp = $mysql->getRows("select id,linkname,category,post_time from posts order by id asc limit ".($i-1)*1000 .",1000");
    if(empty($tmp)) break;
    $sitemap = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<urlset xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\" xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\r\n";
    foreach($tmp as $t){
        if($t['category']==''){
            $url= $host."/".str_replace("%post_id%",$t['id'],urlencode(str_replace("%post_name%",$t['linkname'],permanlink)));
        }else{
            $url = $host. "/".get_link_name($t['category'])."/".urlencode(str_replace("%post_id%",$t['id'],str_replace("%post_name%",$t['linkname'],permanlink)));
        }
        $sitemap .= "<url>\r\n<loc>".$url."</loc>\r\n</url>\r\n";
    }
    file_put_contents(ABSPATH."sitemap-$i.xml",$sitemap."</urlset>");
    if(count($tmp)==1000){
        $i++;
    }else{
        break;
    }
}

$sitemap='<?xml version="1.0" encoding="UTF-8"?>'."\r\n".'<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\r\n";
while($i>0){
    $sitemap.="<sitemap>\r\n<loc>$host/sitemap-$i.xml</loc>\r\n</sitemap>";
    $i--;
}
$sitemap.="</sitemapindex>";
file_put_contents(ABSPATH."sitemap.xml",$sitemap);
