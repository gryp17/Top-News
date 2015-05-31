create table category(
    ID int AUTO_INCREMENT primary key,
    name varchar(40),
    description varchar(200)
);

create table user(
    ID int AUTO_INCREMENT primary key,
    email varchar(100),
    username varchar(50),
    password varchar(50),
    avatar varchar(100),
    type varchar(30),
    registered datetime,
    active int
);

create table article(
    ID int AUTO_INCREMENT primary key,
    title varchar(200),
    summary varchar(500),
    content MEDIUMTEXT,
    image_path varchar(500),
    views int,
    date datetime,
    authorID int,
    categoryID int,
    constraint fk_author foreign key(authorID) references user (ID),
    constraint fk_category foreign key(categoryID) references category (ID)
);

create table comment(
    ID int AUTO_INCREMENT primary key,
    authorID int,
    articleID int,
    content varchar(500),
    date datetime,
    constraint fk_comment_author foreign key(authorID) references user (ID),
    constraint fk_commect_article foreign key(articleID) references article (ID)
);


insert into category (name, description) values("politics", "none");
insert into category (name, description) values("world", "none");
insert into category (name, description) values("technology", "none");
insert into category (name, description) values("economy", "none");
insert into category (name, description) values("sport", "none");


insert into user (email, username, password, avatar, type, registered, active) values ("skate_mania2abv.bg" ,"admin", "1234", "none", "admin", now(), 1);
