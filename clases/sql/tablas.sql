CREATE DATABASE restaurante;

USE restaurante;

CREATE TABLE usuario (
    login VARCHAR(30) NOT NULL PRIMARY KEY,
    clave VARCHAR(40) NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    apellidos VARCHAR(60) NOT NULL,
    email VARCHAR(40) NOT NULL,
    fechaalta DATE NOT NULL,
    isactivo TINYINT(1) NOT NULL default 0,
    isroot TINYINT(1) NOT NULL default 0,
    rol ENUM('administrador','usuario') NOT NULL default 'usuario',
    fechalogin DATETIME
)engine=innodb charset=utf8 collate=utf8_unicode_ci;

CREATE TABLE platos (
    idplato INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    descripcion VARCHAR(500) NOT NULL,
    precio VARCHAR(10) NOT NULL,
    ingredientes VARCHAR(200) NOT NULL
)engine=innodb charset=utf8 collate=utf8_unicode_ci;

CREATE TABLE fotos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idplato INT NOT NULL,
    urlfoto VARCHAR(200) NOT NULL
    FOREIGN KEY (idplato) REFERENCES platos(idplato)
)engine=innodb charset=utf8 collate=utf8_unicode_ci;