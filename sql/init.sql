-- Script para crear base de datos y tablas necesarias
CREATE DATABASE IF NOT EXISTS prueba_tecnica CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE prueba_tecnica;

CREATE TABLE IF NOT EXISTS trabajadores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  apellido_paterno VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  apellido_materno VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  tipo_documento VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  numero_documento VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  sexo VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  fecha_nacimiento DATE DEFAULT NULL,
  departamento_id VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  provincia_id VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  distrito_id VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  direccion VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  position VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  email VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  salary DECIMAL(10,2) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_general_ci;

INSERT INTO trabajadores 
(nombre, apellido_paterno, apellido_materno, tipo_documento, numero_documento, sexo, fecha_nacimiento, departamento_id, provincia_id, distrito_id, direccion, position, email, salary) 
VALUES
('Juan', 'Pérez', 'García', 'DNI', '12345678', 'masculino', '1990-05-15', '01', '01', '01', 'Av. Principal 123', 'Desarrollador', 'juan@example.com', 2500.00),
('María', 'Gómez', 'López', 'DNI', '87654321', 'femenino', '1992-08-20', '01', '02', '06', 'Jr. Los Rosales 456', 'Diseñadora', 'maria@example.com', 2200.00);