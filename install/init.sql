##创建系统默认系统模型
#1: 创建系统默认模型
insert into model_table (id,model_name) values (1,'文章与新闻');
#2: 创建模型字段
insert into model_field (model_id,field_name,field_identifier,field_type,field_length,field_form_type) values
                        (1,'content','内容','text','65535','textarea');
#3: 创建数据表
create table data_1 (
    content text
)engine=myisam, charset=utf8;

##创建默认栏目
insert into categories (id, parent,title,name,slug,keywords,thumbnail,description,model) values(1,1,"系统默认栏目","默认栏目","default","哆麦CMS,系统默认栏目,CMS","/uploads/default.png","这里是哆麦CMS的默认栏目，请根据您的情况进行相应更改",1);

##创建网站默认配置
#网站名称
insert into options (option_name,option_value) values ("sitename","又一个Domai CMS制作的网站");
#网站说明
insert into options (option_name,option_value) values ("sitedescription","Domai CMS是由Hito开发完成的网站内容管理系统，系统结合了Wordpress和国内一些常见内容管理系统的特点，具有占用资源小，管理方便，移植简单等特点，快开始使用吧!");
#网站关键词
insert into options (option_name,option_value) values ("sitekeywords","内容管理系统,CMS,网站后台");
#网站url,如果使用"/"则所有网站连接都为相对连接
insert into options (option_name,option_value) values ("siteurl","/");
#网站是否生成静态文件：如果生成则文章自动生成静态文件
insert into options (option_name,option_value) values ("sitestatic",true);
#网站生成静态文件是否gzip压缩：需要服务器支持，能直接50%+硬盘资源
insert into options (option_name,option_value) values ("compress",true);
#网站固定连接，如果为空，则通过动态查询方式运行
insert into options (option_name,option_value) values ("permalink","/%category%/%post_name%");
#网站地图每个sitemap的大小
insert into options (option_name,option_value) values ("sitemapsize","2000");
#网站前台栏目列表大小
insert into options (option_name,option_value) values ("pagesize","20");
#激活的主题
insert into options (option_name,option_value) values ("activetemplate","hi-domai");
#生成的静态文件后缀
insert into options (option_name,option_value) values ("filetype","html");
#HTTP缓存时间单位秒
insert into options (option_name,option_value) values ("httpcachetime","7200");
