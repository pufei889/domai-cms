<?php
/*
 * 字符串处理函数
 */

/*
 * 把非ASIIC字符转化为ASIIC
 */
function remove_accents( $string ) {
    if ( !preg_match('/[\x80-\xff]/', $string) )
        return $string;

    $chars = array(
        // Decompositions for Latin-1 Supplement
        'ª' => 'a', 'º' => 'o',
        'À' => 'A', 'Á' => 'A',
        'Â' => 'A', 'Ã' => 'A',
        'Ä' => 'A', 'Å' => 'A',
        'Æ' => 'AE','Ç' => 'C',
        'È' => 'E', 'É' => 'E',
        'Ê' => 'E', 'Ë' => 'E',
        'Ì' => 'I', 'Í' => 'I',
        'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N',
        'Ò' => 'O', 'Ó' => 'O',
        'Ô' => 'O', 'Õ' => 'O',
        'Ö' => 'O', 'Ù' => 'U',
        'Ú' => 'U', 'Û' => 'U',
        'Ü' => 'U', 'Ý' => 'Y',
        'Þ' => 'TH','ß' => 's',
        'à' => 'a', 'á' => 'a',
        'â' => 'a', 'ã' => 'a',
        'ä' => 'a', 'å' => 'a',
        'æ' => 'ae','ç' => 'c',
        'è' => 'e', 'é' => 'e',
        'ê' => 'e', 'ë' => 'e',
        'ì' => 'i', 'í' => 'i',
        'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n',
        'ò' => 'o', 'ó' => 'o',
        'ô' => 'o', 'õ' => 'o',
        'ö' => 'o', 'ø' => 'o',
        'ù' => 'u', 'ú' => 'u',
        'û' => 'u', 'ü' => 'u',
        'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y', 'Ø' => 'O',
        // Decompositions for Latin Extended-A
        'Ā' => 'A', 'ā' => 'a',
        'Ă' => 'A', 'ă' => 'a',
        'Ą' => 'A', 'ą' => 'a',
        'Ć' => 'C', 'ć' => 'c',
        'Ĉ' => 'C', 'ĉ' => 'c',
        'Ċ' => 'C', 'ċ' => 'c',
        'Č' => 'C', 'č' => 'c',
        'Ď' => 'D', 'ď' => 'd',
        'Đ' => 'D', 'đ' => 'd',
        'Ē' => 'E', 'ē' => 'e',
        'Ĕ' => 'E', 'ĕ' => 'e',
        'Ė' => 'E', 'ė' => 'e',
        'Ę' => 'E', 'ę' => 'e',
        'Ě' => 'E', 'ě' => 'e',
        'Ĝ' => 'G', 'ĝ' => 'g',
        'Ğ' => 'G', 'ğ' => 'g',
        'Ġ' => 'G', 'ġ' => 'g',
        'Ģ' => 'G', 'ģ' => 'g',
        'Ĥ' => 'H', 'ĥ' => 'h',
        'Ħ' => 'H', 'ħ' => 'h',
        'Ĩ' => 'I', 'ĩ' => 'i',
        'Ī' => 'I', 'ī' => 'i',
        'Ĭ' => 'I', 'ĭ' => 'i',
        'Į' => 'I', 'į' => 'i',
        'İ' => 'I', 'ı' => 'i',
        'Ĳ' => 'IJ','ĳ' => 'ij',
        'Ĵ' => 'J', 'ĵ' => 'j',
        'Ķ' => 'K', 'ķ' => 'k',
        'ĸ' => 'k', 'Ĺ' => 'L',
        'ĺ' => 'l', 'Ļ' => 'L',
        'ļ' => 'l', 'Ľ' => 'L',
        'ľ' => 'l', 'Ŀ' => 'L',
        'ŀ' => 'l', 'Ł' => 'L',
        'ł' => 'l', 'Ń' => 'N',
        'ń' => 'n', 'Ņ' => 'N',
        'ņ' => 'n', 'Ň' => 'N',
        'ň' => 'n', 'ŉ' => 'n',
        'Ŋ' => 'N', 'ŋ' => 'n',
        'Ō' => 'O', 'ō' => 'o',
        'Ŏ' => 'O', 'ŏ' => 'o',
        'Ő' => 'O', 'ő' => 'o',
        'Œ' => 'OE','œ' => 'oe',
        'Ŕ' => 'R','ŕ' => 'r',
        'Ŗ' => 'R','ŗ' => 'r',
        'Ř' => 'R','ř' => 'r',
        'Ś' => 'S','ś' => 's',
        'Ŝ' => 'S','ŝ' => 's',
        'Ş' => 'S','ş' => 's',
        'Š' => 'S', 'š' => 's',
        'Ţ' => 'T', 'ţ' => 't',
        'Ť' => 'T', 'ť' => 't',
        'Ŧ' => 'T', 'ŧ' => 't',
        'Ũ' => 'U', 'ũ' => 'u',
        'Ū' => 'U', 'ū' => 'u',
        'Ŭ' => 'U', 'ŭ' => 'u',
        'Ů' => 'U', 'ů' => 'u',
        'Ű' => 'U', 'ű' => 'u',
        'Ų' => 'U', 'ų' => 'u',
        'Ŵ' => 'W', 'ŵ' => 'w',
        'Ŷ' => 'Y', 'ŷ' => 'y',
        'Ÿ' => 'Y', 'Ź' => 'Z',
        'ź' => 'z', 'Ż' => 'Z',
        'ż' => 'z', 'Ž' => 'Z',
        'ž' => 'z', 'ſ' => 's',
        // Decompositions for Latin Extended-B
        'Ș' => 'S', 'ș' => 's',
        'Ț' => 'T', 'ț' => 't',
        // Euro Sign
        '€' => 'E',
        // GBP (Pound) Sign
        '£' => '',
        // Vowels with diacritic (Vietnamese)
        // unmarked
        'Ơ' => 'O', 'ơ' => 'o',
        'Ư' => 'U', 'ư' => 'u',
        // grave accent
        'Ầ' => 'A', 'ầ' => 'a',
        'Ằ' => 'A', 'ằ' => 'a',
        'Ề' => 'E', 'ề' => 'e',
        'Ồ' => 'O', 'ồ' => 'o',
        'Ờ' => 'O', 'ờ' => 'o',
        'Ừ' => 'U', 'ừ' => 'u',
        'Ỳ' => 'Y', 'ỳ' => 'y',
        // hook
        'Ả' => 'A', 'ả' => 'a',
        'Ẩ' => 'A', 'ẩ' => 'a',
        'Ẳ' => 'A', 'ẳ' => 'a',
        'Ẻ' => 'E', 'ẻ' => 'e',
        'Ể' => 'E', 'ể' => 'e',
        'Ỉ' => 'I', 'ỉ' => 'i',
        'Ỏ' => 'O', 'ỏ' => 'o',
        'Ổ' => 'O', 'ổ' => 'o',
        'Ở' => 'O', 'ở' => 'o',
        'Ủ' => 'U', 'ủ' => 'u',
        'Ử' => 'U', 'ử' => 'u',
        'Ỷ' => 'Y', 'ỷ' => 'y',
        // tilde
        'Ẫ' => 'A', 'ẫ' => 'a',
        'Ẵ' => 'A', 'ẵ' => 'a',
        'Ẽ' => 'E', 'ẽ' => 'e',
        'Ễ' => 'E', 'ễ' => 'e',
        'Ỗ' => 'O', 'ỗ' => 'o',
        'Ỡ' => 'O', 'ỡ' => 'o',
        'Ữ' => 'U', 'ữ' => 'u',
        'Ỹ' => 'Y', 'ỹ' => 'y',
        // acute accent
        'Ấ' => 'A', 'ấ' => 'a',
        'Ắ' => 'A', 'ắ' => 'a',
        'Ế' => 'E', 'ế' => 'e',
        'Ố' => 'O', 'ố' => 'o',
        'Ớ' => 'O', 'ớ' => 'o',
        'Ứ' => 'U', 'ứ' => 'u',
        // dot below
        'Ạ' => 'A', 'ạ' => 'a',
        'Ậ' => 'A', 'ậ' => 'a',
        'Ặ' => 'A', 'ặ' => 'a',
        'Ẹ' => 'E', 'ẹ' => 'e',
        'Ệ' => 'E', 'ệ' => 'e',
        'Ị' => 'I', 'ị' => 'i',
        'Ọ' => 'O', 'ọ' => 'o',
        'Ộ' => 'O', 'ộ' => 'o',
        'Ợ' => 'O', 'ợ' => 'o',
        'Ụ' => 'U', 'ụ' => 'u',
        'Ự' => 'U', 'ự' => 'u',
        'Ỵ' => 'Y', 'ỵ' => 'y',
        // Vowels with diacritic (Chinese, Hanyu Pinyin)
        'ɑ' => 'a',
        // macron
        'Ǖ' => 'U', 'ǖ' => 'u',
        // acute accent
        'Ǘ' => 'U', 'ǘ' => 'u',
        // caron
        'Ǎ' => 'A', 'ǎ' => 'a',
        'Ǐ' => 'I', 'ǐ' => 'i',
        'Ǒ' => 'O', 'ǒ' => 'o',
        'Ǔ' => 'U', 'ǔ' => 'u',
        'Ǚ' => 'U', 'ǚ' => 'u',
        // grave accent
        'Ǜ' => 'U', 'ǜ' => 'u',
    );
    $string = strtr($string, $chars);
    return $string;
}

/*
 * 去除单个标签的后闭合标签
 */
function strip_single_tag_slash($string){
    return preg_replace("/<([^>]+)\/>/i","<\${1}>",$string);
}

/*
 * 去除所有HTML标签
 */
function strip_all_tags($string,$remove_break=false){
    $string = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $string );
    $string = strip_tags($string);

    if ( $remove_breaks )
        $string = preg_replace('/[\r\n\t ]+/', ' ', $string);
    return trim( $string );
}

/*
 * 去除指定的HTML标签
 */
function strip_specified_tags($string,$tags='style,script,frame,frameset,object,param,applet',$remove_comments=true,$remove_breaks=false){
    $tagsarr=explode(",",$tags);
    foreach($tagsarr as $tag){
        $reg_double = "<\s*".trim($tag)."[^>]*>[\s\S]*<\/".trim($tag).">";
        $reg_single = "<\s*".trim($tag)."[^>]*>";
        $string=preg_replace("/$reg_double/iU","",$string);
        $string=preg_replace("/$reg_single/iU","",$string);
    }
    if($remove_comments==true){
        $string = preg_replace("/<!--[\s\S]*-->/iU","",$string);
    }
    if($remove_breaks){
        $string = preg_replace('/[\r\n\t ]+/', ' ', $string);
    }
    return trim($string);
}

/*
 * 去除所有标签属性
 */
function strip_attrs($string,$remove='style,onclick,onload,onabort,onblur,onchange,ondbclick,onerror,onfocus,onkeydown,onkeypress,onkeyup,onmousedown,onmousemove,onmouseout,onmouseover,onmouseup,onreset,onresize,onselect,onsubmit,onunload'){
    preg_match_all("/(.*)(?=\s*)*/i",$string,$m);
    print_r($m);
}


function strip_attr_reserved($string,$exclude=array("href","alt","title","class","id","width","height")){

}
header("content-type:text/html;charset=utf-8");
//echo remove_accents("ǚ Бетоносмесительная установка  Trạm trộn bê tông");
$alt = "Charlie 's Angels \"test\" cool! ";
$str = '<a href="test.html?val=1" title="' . $alt . '"> afaf</a> <script type="fdsa">alert(1);</script><img src="fdsaf" alt=""> <input class = " fds "  autofous>';
echo strip_attrs($str);
