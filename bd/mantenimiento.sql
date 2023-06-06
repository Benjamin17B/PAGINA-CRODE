/*DROP DATABASE IF EXISTS Mantenimiento;
CREATE DATABASE mantenimiento CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;
USE Mantenimiento;*/


/**********************   CPUS  ***********************/
CREATE TABLE DatosEquipo(
  iduser INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  nombre VARCHAR(20) NOT NULL,
  apellidoP VARCHAR(20) NOT NULL,
  apellidoM VARCHAR(30) NOT NULL,
  marca VARCHAR(30) NOT NULL,
  modelo VARCHAR(30) NOT NULL,
  numserie VARCHAR(15) NOT NULL,
  numInventario INT(5) NOT NULL,
  So VARCHAR(30) NOT NULL,
  Procesador VARCHAR(30) NOT NULL,
  DiscoDuro VARCHAR(30) NOT NULL,
  Ram VARCHAR(30) NOT NULL,
  TipoMemoria VARCHAR(30) NOT NULL,
  Observaciones VARCHAR(30) NOT NULL,
  contraseña VARCHAR(30) NOT NULL,
  NEquipo VARCHAR(30) NOT NULL,
  IP VARCHAR(30) NOT NULL,
  Mac VARCHAR(30) NOT NULL,
  Departamento VARCHAR(100)
  );
/**********************   IMPRESORAS  ***********************/

  CREATE TABLE DatosEquipo(
  iduser INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  nombre VARCHAR(20) NOT NULL,
  apellidoP VARCHAR(20) NOT NULL,
  apellidoM VARCHAR(30) NOT NULL,
  marca VARCHAR(30) NOT NULL,
  modelo VARCHAR(30) NOT NULL,
  numserie VARCHAR(15) NOT NULL,
  numInventario INT(5) NOT NULL,
  So VARCHAR(30) NOT NULL,
  Procesador VARCHAR(30) NOT NULL,
  DiscoDuro VARCHAR(30) NOT NULL,
  Ram VARCHAR(30) NOT NULL,
  TipoMemoria VARCHAR(30) NOT NULL,
  Observaciones VARCHAR(30) NOT NULL,
  contraseña VARCHAR(30) NOT NULL,
  NEquipo VARCHAR(30) NOT NULL,
  IP VARCHAR(30) NOT NULL,
  Mac VARCHAR(30) NOT NULL,
  Departamento VARCHAR(100)
  );

  /*  DEPARTAMENTO(ya no es necesario)  */

 CREATE TABLE area (
  idarea INT AUTO_INCREMENT NOT NULL,
  area VARCHAR(100),
  nivel INT,
  idareapadre INT,
  pp CHAR(4),
  pe CHAR(2),
  pea CHAR(2),
  pc CHAR(2),
  ridusuario INT,
  abreviatura VARCHAR(10),
  PRIMARY KEY (idarea),
  FOREIGN KEY (idareapadre) REFERENCES area (idarea) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (ridusuario) REFERENCES persona (idpersona) ON DELETE NO ACTION ON UPDATE NO ACTION
);


INSERT INTO DatosEquipo (nombre, apellidoP, apellidoM, marca, modelo, numserie, numInventario, So, Procesador, DiscoDuro, Ram, TipoMemoria, Observaciones, contraseña, NEquipo, IP, Mac, Departamento) 
VALUES('JUAN', 'PEREZ', 'GOMEZ', 'Samsung', 'Galaxy S9', 'XYZ123', 10, 'Android', 'Snapdragon 845', '64GB', '4GB', 'DDR4', 'Sin problemas', '123456', 'Equipo2', '192.168.0.10', 'AA:BB:CC:DD:EE:FF', 'DIR'),
('MARIA', 'GONZALEZ', 'LOPEZ', 'Apple', 'MacBook Pro', 'ABC456', 15, 'macOS', 'Intel Core i7', '512GB', '16GB', 'DDR3', 'Sin observaciones', '987654', 'Equipo3', '10.0.0.5', '11:22:33:44:55:66', 'RMS'),
('PEDRO', 'RODRIGUEZ', 'SANCHEZ', 'HP', 'Pavilion', 'PQR789', 20, 'Windows 10', 'AMD Ryzen 5', '1TB', '8GB', 'DDR4', 'Rendimiento lento', 'qwerty', 'Equipo4', '192.168.1.50', 'BB:CC:DD:EE:FF:AA', 'RMS'),
('ANA', 'LÓPEZ', 'MARTÍNEZ', 'Dell', 'Inspiron', 'XYZ789', 25, 'Windows 11', 'Intel Core i5', '256GB', '8GB', 'DDR4', 'Sin problemas', 'password123', 'Equipo5', '192.168.2.100', 'CC:DD:EE:FF:AA:BB', 'PPP'),
('CARLOS', 'SÁNCHEZ', 'RAMOS', 'Lenovo', 'ThinkPad', 'LMN456', 30, 'Windows 10', 'Intel Core i7', '512GB', '16GB', 'DDR4', 'Sin observaciones', 'abcd123', 'Equipo6', '192.168.0.15', 'FF:EE:DD:CC:BB:AA', 'PPP'),
('SOFIA', 'MARTÍNEZ', 'GARCÍA', 'Acer', 'Aspire', 'JKL123', 35, 'Windows 10', 'AMD Ryzen 7', '1TB', '8GB', 'DDR4', 'Sin problemas', 'admin123', 'Equipo7', '192.168.1.70', 'AA:BB:CC:DD:EE:FF', 'RMS'),
('LUCÍA', 'GUTIÉRREZ', 'HERNÁNDEZ', 'Asus', 'VivoBook', 'DEF456', 40, 'Windows 10', 'Intel Core i5', '256GB', '8GB', 'DDR4', 'Sin observaciones', 'qwerty123', 'Equipo8', '192.168.2.150', 'BB:CC:DD:EE:FF:AA', 'DIR'),
('MIGUEL', 'FERNÁNDEZ', 'CRUZ', 'Toshiba', 'Satellite', 'XYZ789', 45, 'Windows 10', 'Intel Core i7', '1TB', '12GB', 'DDR4', 'Rendimiento lento', 'password', 'Equipo9', '192.168.1.100', 'CC:DD:EE:FF:AA:BB', 'PPP'),
('DANIELA', 'RAMÍREZ', 'LOZANO', 'Sony', 'VAIO', 'ABC123', 50, 'Windows 10', 'Intel Core i5', '256GB', '8GB', 'DDR4', 'Sin problemas', 'admin', 'Equipo10', '192.168.2.200', 'AA:BB:CC:DD:EE:FF', 'RMS');

