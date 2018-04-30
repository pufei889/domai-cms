<?php
/*
 * Domai CMS
 * 哆麦 内容管理系统
 * Copyright @2018 Hito
 *
 * 此文件用来存放所有的系统级别的字符串处理函数
 */

/*
 * 将所有和ASCII有对应关系的字符转换为ASCII字符
 * 参考了wordpress的字符对应表
 * 包括:
 * 各类有对应关系的读音
 * 俄语字符
 *
 * 系统还不完善，正在参加中
 * 参考资料:
 * https://codex.wordpress.org/Function_Reference/remove_accents
 * http://www.russianlessons.net/lessons/lesson1_alphabet.php
 */
function to_ascii($string){
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
        // russia char
        'а' => 'A', 'а' => 'a',
        'Б' => 'B', 'б' => 'b',
        'В' => 'V', 'в' => 'v',
        'Г' => 'G', 'г' => 'g',
        'Д' => 'D', 'д' => 'd',
        'Е' => 'YE', 'е' => 'ye',
        'Ё' => 'YO', 'ё' => 'yo',
        'Ж' => 'Zh', 'ж' => 'zh',
        'З' => 'Z', 'з' => 'z',
        'И' => 'EE', 'и' => 'ee',
        'Й' => 'Y', 'й' => 'y',
        'К' => 'K', 'к' => 'k',
        'Л' => 'L', 'л' => 'l',
        'М' => 'M', 'м' => 'm',
        'Н' => 'H', 'н' => 'h',
        //注意:这两个分重度和轻度，下面是重读转换
        'О' => 'O', 'о' => 'o',
        'П' => 'P', 'п' => 'p',
        'Р' => 'R', 'р' => 'r',
        'С' => 'S', 'с' => 's',
        'Т' => 'T', 'т' => 't',
        'У' => 'U', 'у' => 'u',
        'Ф' => 'F', 'ф' => 'f',
        //注意:这两个由两种意思
        'Х' => 'H', 'х' => 'h',
        'Ц' => 'TS', 'ц' => 'ts',
        'Ч' => 'CH', 'ч' => 'ch',
        //以下是添加了重读和轻读的几个词，由双字符组成
        'ЪШ' => 'SH', 'Ъш' => 'sh',
        'ъШ' => 'SH', 'ъш' => 'sh',
        'ЬЩ' => 'SH', 'Ьщ' => 'sh',
        'ьЩ' => 'SH', 'ьщ' => 'sh',
        //完毕
        //重度       轻读
        'Ш' => 'SH', 'ш' => 'sh',
        //重度       轻读
        'Щ' => 'SH', 'щ' => 'sh',
        'Ы' => 'I', 'ы' => 'i',
        'Э' => 'E', 'э' => 'e',
        'Ю' => 'YU', 'ю' => 'yu',
        'Я' => 'YA', 'я' => 'ya',
        //4个重度和轻读字符，无实际意义
        'Ъ' => '', 'ъ' => '',
        'Ь' => '', 'ь'=>'',
    );
    $string = strtr($string, $chars);
    return $string;
}

/*
 * 移除多余的空格
 * 把多个空格替换成一个
 */
function remove_extra_space($string){
    return preg_replace('/\s{2,}/i','',$string);
}

/*
 * 移除\t
 * 把\t替换成空格
 */
function remove_tab($string){
    return preg_replace('/\t+/i',' ',$string);
}

/*
 * 移除单个HTML标签的斜杠
 */
function remove_single_tag_slash($string){
    return preg_replace("/<([^>]+)\/>/i","<\${1}>",$string);
}

/*
 * 移除指定HTML标签
 */
function remove_tags($string,$tags='style,script,frame,frameset,object,param,applet',$remove_comments=true,$remove_breaks=false){
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
 * 移除HTML标签的指定属性
 * 注意: 由于HTML属性的可能出现各种不规范的写法
 *       这里最容易出现各种bug，需要进一步进行测试
 */
function remove_attrs($string,$remove='style,onclick,onload,onabort,onblur,onchange,ondbclick,onerror,onfocus,onkeydown,onkeypress,onkeyup,onmousedown,onmousemove,onmouseout,onmouseover,onmouseup,onreset,onresize,onselect,onsubmit,onunload'){
        
}



/*
 * 下面的函数为使用系统其他函数的
 * 符合函数
 */

/*
 * 净化输入的文章标题
 */
function sanitize_post_title($title){
    $title = remove_tab($title);
    $title = remove_extra_space($title);
    return $title;
}

/*
 * 根据文章标题获取post_name
 */
function sanitize_post_name($title){
    $postname = to_asccii($title);
    $postname = remove_tab($postname);
    $postname = remove_extra_space($postname);
    return $postname;
}
