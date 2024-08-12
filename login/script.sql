create database login;
use login;


CREATE TABLE Usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT not null,
    Usuario VARCHAR(50) UNIQUE,
    Contraseña VARCHAR(255)
);