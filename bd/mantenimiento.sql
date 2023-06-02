/*DROP DATABASE IF EXISTS Mantenimiento;
CREATE DATABASE mantenimiento CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;
USE Mantenimiento;*/

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

  /*  DEPARTAMENTO  */

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


INSERT INTO DatosEquipo(iduser,nombre,apellidoP,apellidoM,marca,modelo,numserie,numInventario,So,Procesador,DiscoDuro,Ram,TipoMemoria,Observaciones,contraseña,NEquipo,IP,Mac,Departamento) 
VALUES(NULL, 'MARIO','BALTASAR','CARACHEO','LG','SUPER MULTI','DD8D','CORE INTEL','VB5B8',4,'SAS','147DD','4G','5G','MUY RAPIDA','SE ENCONTRO UN PROBLEMA EN LA MAQUINA','ABCD','MAQUINA1','DIR');