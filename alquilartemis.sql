CREATE DATABASE alquilartemis;

USE alquilartemis;

CREATE TABLE empleados(
    Empleados_ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    Nombre VARCHAR(60) COLLATE utf8mb4_spanish_ci NOT NULL,
    Email VARCHAR(60) COLLATE utf8mb4_spanish_ci NOT NULL,
    Usuario VARCHAR(60) COLLATE utf8mb4_spanish_ci NOT NULL,
    password VARCHAR(60) COLLATE utf8mb4_spanish_ci NOT NULL,
    Direccion VARCHAR(60) COLLATE utf8mb4_spanish_ci NOT NULL,
    Telefono BIGINT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

CREATE TABLE clientes(
    Clientes_ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    Nombre_Cliente VARCHAR(60) COLLATE utf8mb4_spanish_ci NOT NULL,
    Direccion_Cliente VARCHAR(60) COLLATE utf8mb4_spanish_ci NOT NULL,
    Telefono_Cliente BIGINT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

CREATE TABLE cotizacion(
    Cotizacion_ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    Empleados_ID INT NOT NULL,
    Clientes_ID INT NOT NULL,
    Fecha DATE NOT NULL,
    Foreign Key (Empleados_ID) REFERENCES empleados(Empleados_ID),
    Foreign Key (Clientes_ID) REFERENCES clientes(Clientes_ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

CREATE TABLE detalleCotizacion(
    Detalle_ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    Cotizacion_ID INT NOT NULL,
    Producto_Alquilado VARCHAR(60) COLLATE utf8mb4_spanish_ci NOT NULL,
    Fecha_Alquiler DATE NOT NULL,
    Hora_Alquiler TIME NOT NULL,
    PrecioxDia VARCHAR(60) COLLATE utf8mb4_spanish_ci NOT NULL,
    TotalCotizacion VARCHAR(60) COLLATE utf8mb4_spanish_ci NOT NULL,
    Foreign Key (Cotizacion_ID) REFERENCES cotizacion(Cotizacion_ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
