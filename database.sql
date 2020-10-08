CREATE DATABASE IF NOT EXISTS  api_pcs;
USE api_pcs;

CREATE TABLE roles(
id              int(255) auto_increment NOT NULL,
role       		varchar(255) NOT NULL,
created_at      datetime DEFAULT NULL,
updated_at      datetime DEFAULT NULL,
CONSTRAINT pk_roles PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE users(
id                 int(255) auto_increment NOT NULL, 
role_id            int(255) NOT NULL,
name               varchar(50) NOT NULL,
surname            varchar(100),
email              varchar(255) NOT NULL,
password           varchar(255) NOT NULL,
description        text,
image              varchar(255),
created_at         datetime DEFAULT NULL ,
updated_ad         datetime DEFAULT NULL,
CONSTRAINT pk_users PRIMARY KEY(id),
CONSTRAINT fk_user_role FOREIGN KEY (role_id) REFERENCES roles(id)
)ENGINE=InnoDb;


