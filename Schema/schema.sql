create database mp;

use mp;

create table users_role(
    role_id int not null auto_increment,
    role_name varchar(30),
    constraint PK_roles primary key (role_id)
);


insert into users_role (role_name) values ("admin");

insert into users_role (role_name) values ("client");

create table users(
    user_id int not null auto_increment,
    user_role int not null,
    user_name varchar(30),
    user_last_name varchar(30),
    email varchar(30),
    user_password varchar(30),
    birth_date date,
    constraint PK_users primary key (user_id),
    constraint FK_user_role foreign key (user_role) references users_role (role_id) on delete restrict
);


insert into users (user_role, user_name,user_last_name, email, user_password, birth_date) VALUES (1, "admin", "admin", "admin@admin.com", "admin", "1999-07-19");

insert into users (user_role, user_name,user_last_name, email, user_password, birth_date) VALUES (2, "client", "client", "client@client.com", "client", "1999-07-19");


create table genres(
    genre_id int not null,
    genre_name varchar(20) not null,
    constraint PK_genres primary key (genre_id)
);


insert into genres (genre_id, genre_name) values
    (28, "Acción"), (12, "Aventura"), (16, "Animación"), (35, "Comedia"), (80, "Crimen"), (99, "Documental"), (18, "Drama"), (10751, "Familia"),
    (14, "Fantasía"), (36, "Historia"), (27, "Terror"), (10402, "Música"), (9648, "Misterio"), (10749, "Romance"), (878, "Ciencia Ficción"), (10770, "Peliculas de TV"), (53, "Suspense"), (10752, "Bélica"), (37, "Western");


create table theaters(
    theater_id int not null auto_increment,
    theater_name varchar(30) unique,
    address varchar(30),
    opening_time time,
    closing_time time,
    constraint PK_theaters primary key (theater_id)
);


create table rooms(
    room_id int not null auto_increment,
    theater_id int not null,
    room_name varchar(30),
    capacity int,
    ticket_value float,
    constraint PK_rooms primary key (room_id),
    constraint FK_theaters foreign key (theater_id) references theaters (theater_id) on delete cascade
);


create table projections(
    projection_id int not null auto_increment,
    room_id int not null,
    movie_id int not null,
    projection_date date,
    beginning_time time,
    ending_time time,
    available_seats int,
    sold_seats int,
    constraint PK_projections primary key (projection_id),
    constraint FK_rooms foreign key (room_id) references rooms (room_id) on delete cascade
);


create table purchases(
    purchase_id int not null auto_increment,
    ticket_amount int not null,
    total float not null,
    purchase_date date not null,
    user_id int not null,
    projection_id int not null,
    constraint PK_purchase primary key (purchase_id),
    constraint FK_user_purchase foreign key (user_id) references users (user_id),
    constraint FK_projection_purchase foreign key (projection_id) references projections (projection_id) on delete cascade
);


create table tickets(
    ticket_id int not null auto_increment,
    purchase_id int not null,
    constraint PK_ticket primary key (ticket_id),
    constraint FK_purchase_ticket foreign key (purchase_id) references purchases (purchase_id) on delete cascade
);
