CREATE DATABASE crud_php;

USE crud_php;

CREATE table
    CRUDTable(
        id INT NOT null AUTO_INCREMENT PRIMARY KEY,
        username varchar(40),
        lastName varchar(40),
        email varchar(40),
        pass varchar(255) -- para la contraseña hasheada
    );