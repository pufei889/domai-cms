<?php
/*
 * 全局文件
 */

//由内容获取html描述
function get_description($content){
    //去掉html
    $desc=strip_tags($content);
    //去掉特殊字符(...)
    $desc=str_replace(array("..."," - ","\r","\n","\t","  "),array(""," ",""," "," "," "),$desc);
    //截取长度
    $desc=mb_substr($desc,0,500);
    return $desc;
}
//处理多个空格\t\r\n等
function space_replace($t){
    $t = trim($t);
    $t = str_replace("\t"," ",$t);
    $t = str_replace("\r"," ",$t);
    $t = str_replace("\n"," ",$t);
    $t = str_replace("  "," ",$t);
    $t = str_replace("  "," ",$t);
    return $t;
}
//获取链接文件名: 包括目录和文件
//全部小写，不合法词替换
//array("`","~","!","@","#","$","%","^","&","*","(",")","_","+","=","{","[","]","}",";",":","\"","'","<",",",">",".","?","/");
function get_link_name($t){
    $t=strtolower($t);
    $t=str_replace(array("`","~","!","@","#","$","%","^","&","*","(",")","_","-","+","=","{","[","]","}","|","\\",";",":","\"","'","<",",",">",".","?","/","，","。")," ",$t);
    $t=space_replace($t);
    return str_replace(" ","-",$t);
}

//更新栏目统计信息
//统计信息为关联数组
function renew_stat($category){
    global $mysql;
    $tmp = $mysql->getOne("select stat from stat where id =1");
    if(!empty($tmp[0])){
        $stat=unserialize($tmp[0]);
    }else{
        $stat=array();
    }
    if($category=='') $category='top';
    if(!isset($stat[$category])){
        $stat[$category]=1;
    }else{
        $stat[$category]+=1;
    }
    if(!isset($stat["total"])){
        $stat["total"]=1;
    }else{
        $stat["total"]+=1;
    }
    $mysql->query('update stat set stat = "'.addslashes(serialize($stat)).'" where id =1');
}
//获取栏目数量
function get_stat($category=null){
    global $mysql;
    $tmp=$mysql->getOne("select stat from stat where id =1");
    $stat = @unserialize($tmp[0]);
    if(!$stat){
        return 0;
    }
    if($category==null){
        return $stat['total'];
    }else if($category==''){
        return $stat['top'];
    }else if(isset($stat[$category])){
        return $stat[$category];
    }else{
        return 0;
    }
}

function add_filter($point,$callback){
    global $callbackfunctions;
    if(!in_array($point,array("the_content","the_title"))){
        return false;
    }
    $callbackfunctions[$point]=array();
    array_push($callbackfunctions[$point],$callback); 
}

$callbackfunctions=array();
//相关文章全局函数
$relatedposts=array();
$relatedpost=array();
//生成静态文章页面
function save_post_html(){
    global $title;
    global $content;
    global $category;
    global $linkname;
    global $postid;
    global $callbackfunctions;
    //相关文章全局函数
    global $relatedposts;
    global $relatedpost;

    global $category_path;
    $category_path=str_replace(" ","-",$category);
    ob_start();
    if(file_exists(ABSPATH."template/functions.php")){
        require_once(ABSPATH."template/functions.php");
    }
    if(file_exists(ABSPATH."template/".$category_path."-single.php")){
        require(ABSPATH."template/".$category_path."-single.php");
    }else if(file_exists(ABSPATH."template/single.php")){
        require(ABSPATH."template/single.php");
    }else{
        return false;
    }
    $html = ob_get_contents();
    ob_end_clean();
    $filename=ABSPATH.$category_path."/".str_replace("%post_id%",$postid,str_replace("%post_name%",$linkname,permanlink));
    if(compress===true){
        $html=gzencode($html);
        $filename=$filename.".gz";
    }
    if(!file_exists(ABSPATH.$category_path)){
        mkdir(ABSPATH."/".$category_path,"0777");
        if(file_exists(ABSPATH."template/".$category_path."-category.php")){
            $templatecontent=file_get_contents(ABSPATH."include/category.php").file_get_contents(ABSPATH."template/".$category_path."-category.php");
            file_put_contents(ABSPATH.$category_path."/index.php",$templatecontent);
        }else if(file_exists(ABSPATH."template/category.php")){
            $templatecontent=file_get_contents(ABSPATH."/include/category.php").file_get_contents(ABSPATH."template/category.php");
            file_put_contents(ABSPATH.$category_path."/index.php",$templatecontent);
        }else{
            return false;
        }
    }
    @file_put_contents($filename,$html,LOCK_EX);
    if(file_exists($filename) && filesize($filename)>0){
        return true;
    }
    return false;
}

function the_title(){
    global $title,$callbackfunctions;
    if(!empty($callbackfunctions['the_title'])){
        foreach($callbackfunctions['the_title'] as $callback){
            $title = $callback($title);
        }
    } 
    echo $title;
    return $title;
}
function get_the_title(){
    global $title,$callbackfunctions;
    if(!empty($callbackfunctions['the_title'])){
        foreach($callbackfunctions['the_title'] as $callback){
            $title = $callback($title);
        }
    } 
    return $title;
}
function the_content(){
    global $content,$callbackfunctions;
    if(!empty($callbackfunctions['the_content'])){
        foreach($callbackfunctions['the_content'] as $callback){
            $content = $callback($content);
        }
    } 
    echo $content;
    return $content;
}
function get_the_content(){
    global $content,$callbackfunctions;
    if(!empty($callbackfunctions['the_content'])){
        foreach($callbackfunctions['the_content'] as $callback){
            $content = $callback($content);
        }
    } 
    return $content;
}
function the_bread_nav(){
    global $linkname;
    global $category;
    global $category_path;
    echo "<ol class=\"breadcrumb\"><li><a href=\"/\">Home</a> ›</li>\r\n <li><a href=\"/$category_path/\">$category</a></li></ol>";
    return "<ol class=\"breadcrumb\"><li><a href=\"/\">Home</a> ›</li>\r\n <li><a href=\"/$category_path/\">$category</a></li></ol>";
}
function get_the_bread_nav(){
    global $linkname;
    global $category;
    global $category_path;
    return "<ol class=\"breadcrumb\"><li><a href=\"/\">Home</a> ›</li>\r\n <li><a href=\"/$category_path/\">$category</a></li></ol>";
}
function get_the_category(){
    global $category;
    return $category;
}
function the_category(){
    global $category;
    echo $category;
    return $category;
}

//以下为列表页使用函数：只能在列表页使用
function have_posts(){
    global $posts,$post;
    if(!isset($posts) || empty($posts)){
        return false;
    }else{
        $post = array_shift($posts);
        return true;
    }
}
function the_post_description(){
    global $post;
    echo $post['description'];
    return $post['description'];
}
function get_the_post_description(){
    global $post;
    echo $post['description'];
    return $post['description'];
}
function the_post_link(){
    global $post;
    $link ="/".get_link_name($post['category']).'/'.str_replace("%post_id%",$post['id'],str_replace("%post_name%",$post['linkname'],permanlink));
    $link=str_replace("//","/",$link);
    echo $link;
    return $link;
}
function get_the_post_link(){
    global $post,$category;
    $link ="/".get_link_name($post['category']).'/'.str_replace("%post_id%",$post['id'],str_replace("%post_name%",$post['linkname'],permanlink));
    $link=str_replace("//","/",$link);
    return $link;
}
function the_post_id(){
    global $post;
    echo $post['id'];
    return $post['id'];
}
function get_the_post_id(){
    global $post;
    return $post['id'];
}
function the_post_title(){
    global $post;
    echo $post['title'];
    return $post['title'];
}
function get_the_post_title(){
    global $post;
    return $post['title'];
}
function get_the_post_category(){
    global $post;
    return $post['category'];
}
function the_post_category(){
    global $post;
    echo $post['category'];
    return $post['category'];
}
function the_paging_nav(){
    global $page;
    global $category;
    global $numperpage;
    if($numperpage==NULL){
        $numperpage=pagecount;
    }
    $num = get_stat($category);
    $totalpage = ceil($num/$numperpage);
    $nextpage = $totalpage > $page ? "<li><a href=\"./?page=".($page+1)."\">Next Page</a></li>":"";
    $prepage = $page > 1 ? "<li><a href=\"./?page=".($page-1)."\">Previous Page</a></li>":"";
    $startpage = $page-2>0?$page-2:1;
    $endpage= $startpage+5>$totalpage?$totalpage:$startpage+5;
    $numnav="";
    if($startpage>=3){
        $numnav="<li><a href=\"./\">1</a></li><li>...</li>";
    }
    for($startpage;$startpage<=$endpage;$startpage++){
        if($startpage==$page){
            $numnav.="<li>$page</li>";
        }else{
            $numnav .="<li><a href=\"./?page=".$startpage."\">$startpage</a></li>";
        }
    }
    if($endpage+3 <= $totalpage){
        $numnav.="<li>...</li><li><a href=\"./?page=$totalpage\">$totalpage</a></li>";
    }
    echo "<ul>".$prepage.$numnav.$nextpage."</ul>";
    return NUll;
}

//以下为相关文章调用函数，所有页面通用
function related_post($num=null,$category=null){
    global $mysql;
    global $relatedposts;
    $relatedposts=array();
    if($category==null){
        $where= "category <> ''";
    }else{
        $where = "category= \"$category\" ";
    }
    if($num==null){
        $num=5;
    }
    $totalnum = get_stat($category);
    if($totalnum<=$num*4){
        $tmp = $mysql->getRows("select * from posts where $where order by rand() limit 0,$num");
        $relatedposts=$tmp; 
    }else{
        while(count($relatedposts)<$num){
            $id  = rand(1,$totalnum);
            $post = $mysql->getOne("select * from posts where $where and id = $id limit 0,1");
            if(!in_array($post,$relatedposts) && !empty($post)){
                array_push($relatedposts,$post);
            }
        }
    }
    return $relatedposts;
}
function have_related_post(){
    global $relatedposts;
    global $relatedpost;
    if(count($relatedposts)==0){
        return false;
    }else{
        $relatedpost = array_shift($relatedposts);
        return true;
    }
}
function the_related_title(){
    global $relatedpost;
    echo $relatedpost["title"];
}
function get_the_related_title(){
    global $relatedpost;
    return $relatedpost["title"];
}
function get_the_related_time(){
    global $relatedpost;
    return $relatedpost["time"];
}
function the_related_post_time(){
    global $relatedpost;
    echo $relatedpost["time"];
}
function get_the_related_link(){
    global $relatedpost;
    if($relatedpost['category']==''){
        return "/".str_replace("%post_id%",$relatedpost['id'],str_replace("%post_name%",$relatedpost['linkname'],permanlink));
    }else{
        return "/".get_link_name($relatedpost['category'])."/".str_replace("%post_id%",$relatedpost['id'],str_replace("%post_name%",$relatedpost['linkname'],permanlink));
    }
}
function the_related_link(){
    global $relatedpost;
    if($relatedpost['category']==''){
        echo "/".str_replace("%post_id%",$relatedpost['id'],str_replace("%post_name%",$relatedpost['linkname'],permanlink));
        return "/".str_replace("%post_id%",$relatedpost['id'],str_replace("%post_name%",$relatedpost['linkname'],permanlink));
    }else{
        echo "/".get_link_name($relatedpost['category'])."/".str_replace("%post_id%",$relatedpost['id'],str_replace("%post_name%",$relatedpost['linkname'],permanlink));
        return "/".get_link_name($relatedpost['category'])."/".str_replace("%post_id%",$relatedpost['id'],str_replace("%post_name%",$relatedpost['linkname'],permanlink));
    }
}
//以下为获取随机文章的函数，所有页面通用
function get_the_rand_image($seed=NULL,$dir="/uploads/batching/"){
    $imagedir=ABSPATH.$dir;
    $tmp=array();
    if($dd = opendir($imagedir)){
        while(($file=readdir($dd)) !== false){
            if($file == "." || $file == "..") continue;
            array_push($tmp,$file);
        }
    }else{
        return "";
    }
    closedir($dd);
    $offset = sprintf("%u",crc32(substr($seed,0,2).strlen($seed)))%count($tmp);
    return $dir.$tmp[$offset];
}
function the_rand_image($seed=NULL,$dir="/uploads/batching/"){
    $imagedir=ABSPATH.$dir;
    $tmp=array();
    if($dd = opendir($imagedir)){
        while(($file=readdir($dd)) !== false){
            if($file == "." || $file == "..") continue;
            array_push($tmp,$file);
        }
    }else{
        return "";
    }
    closedir($dd);
    $offset = sprintf("%u",crc32(substr($seed,0,2).strlen($seed)))%count($tmp);
    echo $dir.$tmp[$offset];
    return $dir.$tmp[$offset];
}
