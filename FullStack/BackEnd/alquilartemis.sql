CREATE DATABASE alquilartemis;

USE alquilartemis;

CREATE TABLE empleados(
    idEmpleados INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    Usuario VARCHAR(60) NOT NULL,
    Password VARCHAR(60) NOT NULL,
    Email VARCHAR(60) NOT NULL
);

CREATE TABLE cotizacion(
    idCotizacion INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    idEmpleados INT NOT NULL,
    Fecha DATE,
    FOREIGN KEY (idEmpleados) REFERENCES empleados(idEmpleados)
);

CREATE TABLE detallecotizacion(
    idDetalle INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    idCotizacion INT NOT NULL,
    ProductoAlquilado VARCHAR(60) NOT NULL,
    FechaAlquiler DATE NOT NULL,
    HoraAlquiler TIME NOT NULL,
    DuracionAlquiler VARCHAR(60) NOT NULL,
    PrecioxDia VARCHAR(60) NOT NULL,
    TotalCotizacion VARCHAR(60) NOT NULL,
    FOREIGN KEY (idCotizacion) REFERENCES cotizacion(idCotizacion)
);