<?php
function list_add_thumb($content){
    preg_match_all("/(<h2>([^>]*)<\/h2>)[\s\r\n]*(<p>[^>]*<\/p>)/",$content,$match);
    if(empty($match[1]) || strpos($content,"<img")!==false || strpos($content,"<h3>")!==false || strpos($content,"<strong>")!==false || strpos($content,"<a href")!==false || strpos($content,"<span>")!==false){
        return $content;
    }
    $content = "";
    for($i=0;$i<count($match[1]);$i++){
        $title = trim($match[1][$i]."\r\n");
        $no_tag_title =trim($match[2][$i]);
        $desc = $match[3][$i]."\r\n";
        $img = "<img src=\"".get_the_rand_image($no_tag_title)."\" alt=\"$no_tag_title\" class=\"thumb\">\r\n";
        $content .= "<li class=\"content-list\">".$img.$title.$desc."</li>";
    }
    return $content;
}
add_filter("the_content","list_add_thumb");
