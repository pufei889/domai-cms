##栏目信息
create table categories(
    id int unsigned primary key auto_increment,
    parent int unsigned, #父栏目ID
    title varchar(200), #栏目标题
    name varchar(200), #栏目名称
    slug varchar(200), #栏目链接别名
    keywords varchar(255), #栏目关键词
    thumbnail varchar(255), #栏目缩略图
    description varchar(255), #栏目描述
    model int unsigned default 1, #系统模型ID
    index(parent),
    index(name),
    index(slug),
    index(model),
    unique(name),
    unique(slug)
)engine=innodb, charset=utf8;

##主要文章表，只存放文章概要，不存放内容
create table posts(
    ID int unsigned primary key auto_increment,
    post_title varchar(200) not null,
    post_excerpt varchar(500) not null,
    post_name varchar(255) not null,
    post_category char(50) not null,
    post_author int unsigned not null,
    post_date datetime DEFAULT now(),
    index(post_title),
    index(post_name),
    index(post_category),
    index(post_author)
)engine=innodb, charset=utf8;

##系统模型
create table model(
    id int unsigned primary key auto_increment,
    model_name varchar(50),
    model_struct text, #系统模型的结构 序列化数组 array("filed_name"=>,"file_type"=>"varchar|char|text","form-type"=>"text|email|file|checkbox|radio","default"=>"");
                       #附加系统字段结构 post_id int unsigned index, post_thumbnail varchar(255)
    index(model_name)
)engine=innodb, charset=utf8;

##文章Tag/关键词列表，存放文章或者页面的tag
create table tags(
    id int unsigned primary key auto_increment,
    post_id int unsigned not null,
    post_tag varchar(60) not null,
    index(post_id),
    index(post_tag)
)engine=innodb, charset=utf8;

##用户表
create table users(
    ID int unsigned primary key auto_increment,
    username varchar(60) not null,
    userpass varchar(255) not null,
    useremail varchar(100) not null,
    index(username)
)engine=myisam, charset=utf8;

##系统配置表，类似wordpress
create table options(
    option_id int unsigned primary key auto_increment,
    option_name varchar(150) not null,
    option_value text not null,
    index(option_name),
    unique(option_name)
)engine=innodb, charset=utf8;

##系统基础配置项:
# sitename: 网站名称
# sitedescription: 网站描述
# sitekeyword: 网站关键词
# siteurl: 网站地址
# permalink: 固定链接格式
# fulllink: 链接使用绝对地址
# compress: 生成文件是否gzip压缩
# sitemapsize: 每个sitemap的大小
# pagesize: 前台栏目列表大小

# poststat: 全部文章统计，格式 array("page"=>10,"post"=>array("total"=>100,"category1"=>99,"category2"=>1))
# activetemplate: 激活的主题名称
