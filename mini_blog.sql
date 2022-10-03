DROP DATABASE IF EXISTS blog_database;

CREATE DATABASE blog_database DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_lithuanian_ci;

CREATE TABLE blog_database.posts (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255),
content TEXT NOT NULL,
image VARCHAR(255),
createdAt DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=Innodb;

DROP USER IF EXISTS  'blog_viewer'@'localhost';
    
CREATE USER 'blog_viewer'@'localhost' IDENTIFIED BY 'mysql';

GRANT SELECT ON blog_database.posts TO 'crud_user'@'localhost';
