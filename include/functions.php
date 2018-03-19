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

//相关文章全局函数
$callbackfunctions=array();
$posts=array();
$post=array();
$isamp=false;
$issingle=false;
$ishome=false;
$iscategory=false;
//生成静态文章页面
function save_post_html(){
    //全局变量
    global $posts;
    global $posts;
    global $callbackfunctions;
    global $isamp;
    global $issingle;
    //文章变量，从发布接口获取
    global $title;
    global $content;
    global $category;
    global $linkname;
    global $postid;

    $category_path=get_link_name($category);

    //引入模板functions
    if(file_exists(ABSPATH."template/functions.php")){
        require_once(ABSPATH."template/functions.php");
    }
    //HTML Single
    $issingle=true;
    ob_start();
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
    //AMP Single
    ob_start();
    $content=amp_filter($content);
    $isamp=true;
    if(file_exists(ABSPATH."template/amp/".$category_path."-single.php")){
        require(ABSPATH."template/amp/".$category_path."-single.php");
    }else if(file_exists(ABSPATH."template/amp/single.php")){
        require(ABSPATH."template/amp/single.php");
    }
    $amphtml=ob_get_contents();
    $isamp=false;
    $issingle=false;
    ob_end_clean();
    $ampfilename=ABSPATH.$category_path."/amp/".str_replace("%post_id%",$postid,str_replace("%post_name%",$linkname,permanlink));
    //category directory init
    if(!file_exists(ABSPATH.$category_path)){
        mkdir(ABSPATH."/".$category_path,0777);
        //html category
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
    //AMP Category INIT
    if(!file_exists(ABSPATH."/".$category_path."/amp/")){
        mkdir(ABSPATH."/".$category_path."/amp/",0777);
        //amp category
        if(file_exists(ABSPATH."template/amp/".$category_path."-category.php")){
            $templatecontent=file_get_contents(ABSPATH."include/amp-category.php").file_get_contents(ABSPATH."template/amp/".$category_path."-category.php");
            file_put_contents(ABSPATH.$category_path."/amp/index.php",$templatecontent);
        }else if(file_exists(ABSPATH."template/amp/category.php")){
            $templatecontent=file_get_contents(ABSPATH."/include/amp-category.php").file_get_contents(ABSPATH."template/amp/category.php");
            file_put_contents(ABSPATH.$category_path."/amp/index.php",$templatecontent);
        }
    }
    //gz encode and write
    if(compress===true){
        $html=gzencode($html);
        $filename=$filename.".gz";
        $amphtml=gzencode($amphtml);
        $ampfilename=$ampfilename.".gz";
    }
    @file_put_contents($filename,$html,LOCK_EX);
    if(strlen($amphtml)>=10){
        @file_put_contents($ampfilename,$amphtml,LOCK_EX);
    }
    if(file_exists($filename) && filesize($filename)>0){
        return true;
    }
    return false;
}

//把不符合AMP规范的标签替换
//https://www.ampproject.org/zh_cn/docs/fundamentals/spec
function amp_filter($content){
    $patterns=array("/<img([^>]*)>/i","/<video([^>]*)>/i","/<\/video>/i","/<audio([^>]*)>/i","/<\/audio>/i","/<iframe([^>]*)>/i","/<\/iframe>/i");
    $replacements=array('<amp-img${1} layout="responsive"></amp-img>','<amp-video${1}>',"</amp-video>",'<amp-audio${1}>',"</amp-audio>",'<amp-iframe${1}>',"</amp-iframe>");
    $content = preg_replace($patterns,$replacements,$content);
    return $content; 
}
//判断是否为amp页面
function is_amp(){
    global $isamp;
    if($isamp==true){
        return true;
    }else{
        return false;
    }
}
//是否为首页
function is_home(){
    global $ishome;
    if($ishome==true){
        return true;
    }else{
        return false;
    }
}
//是否为内容页面
function is_single(){
    global $issingle;
    if($issingle==true){
        return true;
    }else{
        return false;
    }
}
//是否为分类页
function is_category(){
    global $iscategory;
    if($iscategory==true){
        return true;
    }else{
        return false;
    }
}
//分类是否为404页面
function is_404(){
    global $category,$mysql;
    $tmp = $mysql->getOne("select id from posts where category=\"$category\"");
    if(empty($tmp)){
        return true;
    }else{
        return false;
    }
}

//把css文件导入到html中，主要在amp中使用
function importcss($css){
    $bug=debug_backtrace();
    $path=dirname($bug[0]['file']);
    $path=realpath($path."/".$css);
    $style=file_get_contents($path);
    $style=str_replace(array("\r","\n","\t",";}"),array("",""," ","}"),$style);
    echo $style;
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
function the_title(){
    echo get_the_title();
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
function the_content(){
    echo get_the_content(); 
}
function get_the_bread_nav(){
    global $linkname;
    global $category;
    global $category_path;
    return "<ol class=\"breadcrumb\"><li><a href=\"/\">Home</a> ›</li>\r\n <li><a href=\"/$category_path/\">$category</a></li></ol>";
}
function the_bread_nav(){
    echo get_the_bread_nav();
}
function get_the_amp_bread_nav(){
    global $linkname;
    global $category;
    global $category_path;
    return "<ol class=\"breadcrumb\"><li><a href=\"/?amp\">Home</a> ›</li>\r\n <li><a href=\"/$category_path/amp/\">$category</a></li></ol>";
}
function the_amp_bread_nav(){
    echo get_the_amp_bread_nav();
}
function get_the_category(){
    global $category;
    return $category;
}
function the_category(){
    echo get_the_category();
}

function have_posts(){
    global $posts,$post;
    if(!isset($posts) || empty($posts)){
        return false;
    }else{
        $post = array_shift($posts);
        return true;
    }
}

function get_the_post_description($len=500){
    global $post;
    return mb_substr($post['description'],0,$len);
}
function the_post_description($len=500){
    echo get_the_post_description($len);
}

function get_the_post_link(){
    global $post,$category;
    $link ="/".get_link_name($post['category']).'/'.str_replace("%post_id%",$post['id'],str_replace("%post_name%",$post['linkname'],permanlink));
    $link=str_replace("//","/",$link);
    return $link;
}
function the_post_link(){
    echo  get_the_post_link();
}
function get_the_amp_post_link(){
    global $post,$category;
    $link ="/".get_link_name($post['category']).'/amp/'.str_replace("%post_id%",$post['id'],str_replace("%post_name%",$post['linkname'],permanlink));
    $link=str_replace("//","/",$link);
    return $link;
}
function the_amp_post_link(){
    echo get_the_amp_post_link();
}

function get_the_post_time(){
    global $post;
    return $post["post_time"];
}
function the_post_time(){
    echo get_the_post_time();
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

//以下为文章调用函数，所有页面通用
function latest_post($num,$category=null){
    global $mysql,$posts;
    if($category==null){
        $where= "category <> ''";
    }else{
        $where = "category= \"$category\" ";
    }
    if($num==null){
        $num=5;
    }
    $posts=$mysql->getRows("select * from posts where $where order by id desc limit 0,$num");
}
function rand_post($num=null,$category=null){
    global $mysql,$posts;
    if($category==null){
        $where= "category <> ''";
    }else{
        $where = "category= \"$category\" ";
    }
    if($num==null){
        $num=5;
    }
    $posts=$mysql->getRows("select * from posts where $where order by rand() limit 0,$num");
}
//显示当前栏目下的文章
function init_post(){
    global $posts,$page,$category,$numperpage,$mysql;
    $posts = $mysql->getRows("select * from posts where category = \"$category\" order by id desc limit ".($page-1)*$numperpage.", $numperpage");    
}
/*
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
    return $relatedpost["post_time"];
}
function the_related_post_time(){
    global $relatedpost;
    echo $relatedpost["post_time"];
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
    echo get_the_related_link();
}
function get_the_amp_related_link(){
    global $relatedpost;
    if($relatedpost['category']==''){
        return "/amp/".str_replace("%post_id%",$relatedpost['id'],str_replace("%post_name%",$relatedpost['linkname'],permanlink));
    }else{
        return "/".get_link_name($relatedpost['category'])."/amp/".str_replace("%post_id%",$relatedpost['id'],str_replace("%post_name%",$relatedpost['linkname'],permanlink));
    }
}
function the_amp_related_link(){
    echo get_the_amp_related_link();
}
 */
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

function get_header(){
    if(!is_amp()){
        require_once(ABSPATH."template/header.php");
    }else{
        require_once(ABSPATH."template/amp/header.php");
    }
}
function get_footer(){
    if(!is_amp()){
        require_once(ABSPATH."template/footer.php");
    }else{
        require_once(ABSPATH."template/amp/footer.php");
    }
}
function get_sidebar(){
    if(!is_amp()){
        require_once(ABSPATH."template/aside.php");
    }else{
        require_once(ABSPATH."template/amp/aside.php");
    }
}
function comment_form(){
    if(!is_amp()){
        require_once(ABSPATH."template/comments.php");
    }else{
        require_once(ABSPATH."template/amp/comments.php");
    }
}
function the_amp_html(){
    if(is_home()){
        echo "<link rel=\"amphtml\" href=\"/?amp\">\r\n";
    }else if(is_category()){
        global $category_path;
        echo "<link rel=\"amphtml\" href=\"/".$category_path."/amp/\">\r\n";
    }else if(is_single()){
        echo "<link rel=\"amphtml\" href=\"".get_the_amp_post_link()."\">\r\n";
    }
}
function the_amp_canonical(){
    if(is_home()){
        echo "<link rel=\"canonical\" href=\"/\">\r\n";
    }else if(is_category()){
        global $category_path;
        echo "<link rel=\"canonical\" href=\"/".$category_path."\">\r\n";
    }else if(is_single()){
        echo "<link rel=\"canonical\" href=\"".get_the_post_link()."\">\r\n";
    }
}
