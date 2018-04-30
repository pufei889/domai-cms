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
    post_excerpt varchar(500),
    post_name varchar(255),
    post_thumbnail varchar(255),
    post_date datetime DEFAULT now(),
    post_category int(4) unsigned not null,
    post_author int unsigned not null,
    post_type char(10) DEFAULT 'post',
    index(post_title),
    index(post_name),
    index(post_category),
    index(post_author),
    index(post_type)
)engine=innodb, charset=utf8;

##系统模型
create table model_table(
    id int unsigned primary key auto_increment,
    model_name varchar(50),
    index(model_name)
)engine=innodb, charset=utf8;

##系统模型字段
create table model_field(
    model_id int unsigned not null,
    field_name varchar(50) not null,
    field_identifier varchar(50) not null,
    field_type char(10) not null,
    field_length int unsigned default 120,
    field_index boolean default false,
    field_unique boolean default false,
    field_form_type varchar(10) not null, 
    filed_default_value varchar(255) default '',
    index(model_id)
)engine=innodb, charset=utf8;
## 系统模型和系统模型字段共同组成一个完成的系统模型表

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
# sitekeywords: 网站关键词
# siteurl: 网站地址
# sitestatic: 网站是否生成静态文件
# compress: 生成文件是否gzip压缩
# permalink: 固定链接格式
# sitemapsize: 每个sitemap的大小
# pagesize: 前台栏目列表大小
# activetemplate: 激活的主题名称
# filetype: 生成的页面后缀
# httpcachetime: http缓存时间，秒

# poststat: 全部文章统计，格式 array("page"=>10,"post"=>array("total"=>100,"category1"=>99,"category2"=>1))
