/*DROP DATABASE IF EXISTS Mantenimiento;
CREATE DATABASE sistema CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;
USE Mantenimiento;*/

CREATE TABLE DatosEquipo(
  iduser INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  nombre VARCHAR(20) NOT NULL,
  apellidoP VARCHAR(20) NOT NULL,
  apellidoM VARCHAR(30) NOT NULL,
  marca VARCHAR(30) NOT NULL,
  modelo VARCHAR(30) NOT NULL,
  numserie INT(5) NOT NULL,
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
  Mac VARCHAR(30) NOT NULL
  );

  /*  DEPARTAMENTO  */

 CREATE TABLE area (
  idarea INT NOT NULL,
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


INSERT INTO area(idarea, area, nivel, idareapadre, pp, pe, pea, pc, ridusuario, abreviatura) VALUES (2, 'Subdirección técnica', 20, 1, 'E010', '1 ', '1 ', '1 ', 84, 'ST');
INSERT INTO area(idarea, area, nivel, idareapadre, pp, pe, pea, pc, ridusuario, abreviatura) VALUES (3, 'Subdirección administrativa', 20, 1, 'E010', '5 ', '5 ', '1 ', 6, 'SSA');
INSERT INTO area(idarea, area, nivel, idareapadre, pp, pe, pea, pc, ridusuario, abreviatura) VALUES (13, 'Recursos materiales y de servicios', 30, 3, 'E010', '5 ', '5 ', '4 ', 157, 'RMS');
INSERT INTO area(idarea, area, nivel, idareapadre, pp, pe, pea, pc, ridusuario, abreviatura) VALUES (11, 'Recursos humanos', 30, 3, 'E010', '5 ', '5 ', '2 ', 129, 'DRH');
INSERT INTO area(idarea, area, nivel, idareapadre, pp, pe, pea, pc, ridusuario, abreviatura) VALUES (12, 'Recursos financieros', 30, 3, 'E010', '5 ', '3 ', '1 ', 134, 'RFN');
INSERT INTO area(idarea, area, nivel, idareapadre, pp, pe, pea, pc, ridusuario, abreviatura) VALUES (7, 'Producción', 30, 2, 'E010', '1 ', '1 ', '1 ', 156, 'PRO');
INSERT INTO area(idarea, area, nivel, idareapadre, pp, pe, pea, pc, ridusuario, abreviatura) VALUES (4, 'Planeación, Programación y Presupuestación', 30, 1, 'E010', '3 ', '3 ', '1 ', 131, 'PLM');
INSERT INTO area(idarea, area, nivel, idareapadre, pp, pe, pea, pc, ridusuario, abreviatura) VALUES (15, 'ninguna', 20, 1, 'E010', '  ', '  ', '  ', NULL, NULL);
INSERT INTO area(idarea, area, nivel, idareapadre, pp, pe, pea, pc, ridusuario, abreviatura) VALUES (14, 'Metrologia', 30, 2, 'E010', '1 ', '1 ', '1 ', 155, 'MET');
INSERT INTO area(idarea, area, nivel, idareapadre, pp, pe, pea, pc, ridusuario, abreviatura) VALUES (9, 'Gestión tecnológica y vinculación', 30, 2, 'E010', '2 ', '2 ', '1 ', 168, 'GTV');
INSERT INTO area(idarea, area, nivel, idareapadre, pp, pe, pea, pc, ridusuario, abreviatura) VALUES (6, 'Diseño y Desarrollo de Equipo', 30, 2, 'E010', '1 ', '1 ', '1 ', 88, 'DDE');
INSERT INTO area(idarea, area, nivel, idareapadre, pp, pe, pea, pc, ridusuario, abreviatura) VALUES (1, 'Dirección', 10, NULL, 'E010', '1 ', '1 ', '1 ', 135, 'DIR');
INSERT INTO area(idarea, area, nivel, idareapadre, pp, pe, pea, pc, ridusuario, abreviatura) VALUES (10, 'Centro de información técnica', 30, 3, 'E010', '5 ', '5 ', '4 ', NULL, NULL);
INSERT INTO area(idarea, area, nivel, idareapadre, pp, pe, pea, pc, ridusuario, abreviatura) VALUES (8, 'Asistencia técnica y mantenimiento', 30, 2, 'E010', '1 ', '1 ', '1 ', 152, 'MAN');
INSERT INTO area(idarea, area, nivel, idareapadre, pp, pe, pea, pc, ridusuario, abreviatura) VALUES (5, 'Administración de la Calidad', 30, 2, 'E010', '4 ', '4 ', '1 ', NULL, 'ADC');
