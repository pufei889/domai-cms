<?php
function list_add_thumb($content){
    preg_match_all("/(<h2>([^>]*)<\/h2>)[\s\r\n]*(<p>[^>]*<\/p>)/",$content,$match);
    if(empty($match[1])) return $content;
    $content = "";
    for($i=0;$i<count($match[1]);$i++){
        $title = $match[1][$i]."\r\n";
        $no_tag_title =$match[2][$i];
        $desc = $match[3][$i]."\r\n";
        $img = "<img src=\"".get_the_rand_image($title)."\" alt=\"$no_tag_title\" class=\"thumb_list\">\r\n";
        $content .= "<li class=\"zhaoyx\">".$img.$title.$desc."<a href=\" javascript:openZoosUrl();\">Chat Now</a><a href=\"#quality_promise \" >Send Inquiry</a>";
    }
    return $content;
}
add_filter("the_content","list_add_thumb");
