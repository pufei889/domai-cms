create table posts(
    id int unsigned primary key auto_increment,
    title varchar(200),
    linkname varchar(255),
    description varchar(500),
    category char(50),
    post_time datetime DEFAULT now(),
    index(title),
    index(linkname),
    index(category)
)engine=innodb, charset=utf8;
##
create table stat(
    id tinyint primary key,
    stat char(255)
)engine=innodb, charset=utf8;
##
insert into stat (id,stat) values(1,0);
