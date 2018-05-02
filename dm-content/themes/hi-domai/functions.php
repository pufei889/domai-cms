<?php
function list_add_thumb_batch($content){
    preg_match_all("/(<h2>([^>]*)<\/h2>)[\s\r\n]*(<p>[^>]*<\/p>)/",$content,$match);
    if(empty($match[1]) || strpos($content,"<img")!==false || strpos($content,"<h3>")!==false || strpos($content,"<strong>")!==false || strpos($content,"<a href")!==false || strpos($content,"<span>")!==false || strpos($content,"<amp-")!==false){
        return $content;
    }
    $content = "";
    for($i=0;$i<count($match[1]);$i++){
        $title = trim($match[1][$i]."\r\n");
        $no_tag_title =trim($match[2][$i]);
        $desc = $match[3][$i]."\r\n";
        if(is_amp()){
            $img = "<amp-img src=\"".get_the_rand_image($no_tag_title)."\" alt=\"$no_tag_title\" class=\"thumb\" layout=\"responsive\" width=\"200\" height=\"150\"></amp-img>\r\n";
        }else{
            $img = "<img src=\"".get_the_rand_image($no_tag_title)."\" alt=\"$no_tag_title\" class=\"thumb\" width=\"200\" height=\"150\">\r\n";
        }
        $content .= "<li class=\"content-list\">".$img.$title.$desc."</li>";
    }
    return "<ul>".$content."</ul>";
}
function list_add_thumb_crusher($content){
    preg_match_all("/(<h2>([^>]*)<\/h2>)[\s\r\n]*(<p>[^>]*<\/p>)/",$content,$match);
    if(empty($match[1]) || strpos($content,"<img")!==false || strpos($content,"<h3>")!==false || strpos($content,"<strong>")!==false || strpos($content,"<a href")!==false || strpos($content,"<span>")!==false || strpos($content,"<amp-")!==false){
        return $content;
    }
    $content = "";
    for($i=0;$i<count($match[1]);$i++){
        $title = trim($match[1][$i]."\r\n");
        $no_tag_title =trim($match[2][$i]);
        $desc = $match[3][$i]."\r\n";
        if(is_amp()){
            $img = "<amp-img src=\"".get_the_rand_image($no_tag_title,"/uploads/crusher/")."\" alt=\"$no_tag_title\" class=\"thumb\" layout=\"responsive\" width=\"200\" height=\"150\"></amp-img>\r\n";
        }else{
            $img = "<img src=\"".get_the_rand_image($no_tag_title,"/uploads/crusher/")."\" alt=\"$no_tag_title\" class=\"thumb\" width=\"200\" height=\"150\">\r\n";
        }
        $content .= "<li class=\"content-list\">".$img.$title.$desc."</li>";
    }
    return "<ul>".$content."</ul>";
}

if(get_the_category()=="news"||get_the_category()=="News"){
    add_filter("the_content","list_add_thumb_batch");
}else if(get_the_category()=="case"||get_the_category()=="Case"){
    add_filter("the_content","list_add_thumb_crusher");
}
