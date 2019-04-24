
CREATE DATABASE SIARTEC CHARACTER SET utf8 COLLATE utf8_general_ci;

USE SIARTEC;

/*TABLA DE USUARIOS
*******************
Tabla donde se registrarán todos los usuarios para el acceso al sistema.
*/
CREATE TABLE ADMINISTRADORES (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `usuario` varchar(50) NOT NULL UNIQUE,
    `nombre` varchar(100), /*Nombres y apellidos del administrador*/
    `contrasenia` varchar(60) NOT NULL,
    `urlImagen` varchar(100),
    `estado` int(1) UNSIGNED NOT NULL, /*Estado del registro: 1 (Activo) y 0 (Desactivado)*/
    `usuarioCreacion` varchar(20) NOT NULL , /*Campo auditoria*/
    `horaCreacion` time NOT NULL, /*Campo auditoria*/
    `fechaCreacion` date NOT NULL , /*Campo auditoria*/
    `usuarioModificacion` varchar(20) NOT NULL, /*Campo auditoria*/
    `horaModificacion` time NOT NULL, /*Campo auditoria*/
    `fechaModificacion` date NOT NULL /*Campo auditoria*/
) ENGINE=INNODB DEFAULT CHARSET=utf8; 



/*TIPO DE USUARIOS
******************
Tabla donde se registrarán los tipos de usuarios: Alumno, Administrativo, Docente, etc.
*/
CREATE TABLE TIPO_USUARIO (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `tipo` varchar(50) NOT NULL, /*Alumno, Administrativo, etc.*/
    `estado` int(1) UNSIGNED NOT NULL, /*Estado del registro: 1 (Activo) y 0 (Desactivado)*/
    `usuarioCreacion` varchar(20) NOT NULL , /*Campo auditoria*/
    `horaCreacion` time NOT NULL, /*Campo auditoria*/
    `fechaCreacion` date NOT NULL , /*Campo auditoria*/
    `usuarioModificacion` varchar(20) NOT NULL, /*Campo auditoria*/
    `horaModificacion` time NOT NULL, /*Campo auditoria*/
    `fechaModificacion` date NOT NULL /*Campo auditoria*/
) ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO TIPO_USUARIO VALUES('', 'Alumno', 1, 'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE());
INSERT INTO TIPO_USUARIO VALUES('', 'Docente', 1, 'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE());
INSERT INTO TIPO_USUARIO VALUES('', 'Administrativo', 1, 'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE());



/*ALUMNO
********
Tabla donde se registrarán todos los alumnos de la institución.
*/
CREATE TABLE ALUMNO (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `dni` varchar(8) NOT NULL UNIQUE,
    `nombres` varchar(60) NOT NULL,
    `apellidos` varchar(60) NOT NULL,
    `tipoUsuario` int(11) UNSIGNED NOT NULL, /* FK */
    `estado` int(1) UNSIGNED NOT NULL, /*Estado del registro: 1 (Activo) y 0 (Desactivado)*/
    `usuarioCreacion` varchar(20) NOT NULL , /*Campo auditoria*/
    `horaCreacion` time NOT NULL, /*Campo auditoria*/
    `fechaCreacion` date NOT NULL , /*Campo auditoria*/
    `usuarioModificacion` varchar(20) NOT NULL, /*Campo auditoria*/
    `horaModificacion` time NOT NULL, /*Campo auditoria*/
    `fechaModificacion` date NOT NULL, /*Campo auditoria*/

    FOREIGN KEY (`tipoUsuario`) REFERENCES TIPO_USUARIO(`id`) 
) ENGINE=INNODB DEFAULT CHARSET=utf8;


/*DOCENTE
*********
Tabla donde se registrarán todos los docentes de la institución.
*/
CREATE TABLE DOCENTE (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `dni` varchar(8) NOT NULL UNIQUE,
    `nombres` varchar(60) NOT NULL,
    `apellidos` varchar(60) NOT NULL,
    `tipoUsuario` int(11) UNSIGNED NOT NULL, /* FK */
    `especialidad` varchar(100) NOT NULL, /*Especialidad del docente.*/
    `estado` int(1) UNSIGNED NOT NULL, /*Estado del registro: 1 (Activo) y 0 (Desactivado)*/
    `usuarioCreacion` varchar(20) NOT NULL , /*Campo auditoria*/
    `horaCreacion` time NOT NULL, /*Campo auditoria*/
    `fechaCreacion` date NOT NULL , /*Campo auditoria*/
    `usuarioModificacion` varchar(20) NOT NULL, /*Campo auditoria*/
    `horaModificacion` time NOT NULL, /*Campo auditoria*/
    `fechaModificacion` date NOT NULL, /*Campo auditoria*/
    FOREIGN KEY (`tipoUsuario`) REFERENCES TIPO_USUARIO(`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;


/*ADMINISTRATIVO
****************
Tabla donde se registrarán todos los trabajadores administrativos de la institución.
*/
CREATE TABLE ADMINISTRATIVO (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `dni` varchar(8) NOT NULL UNIQUE,
    `nombres` varchar(60) NOT NULL,
    `apellidos` varchar(60) NOT NULL,
    `tipoUsuario` int(11) UNSIGNED NOT NULL, /* FK */
    `cargo` varchar(100) NOT NULL, /*Cargo del administrativo.*/
    `profesion` varchar(100) NOT NULL, /*Profesión del administrativo.*/
    `estado` int(1) UNSIGNED NOT NULL, /*Estado del registro: 1 (Activo) y 0 (Desactivado)*/
    `usuarioCreacion` varchar(20) NOT NULL, /*Campo auditoria*/
    `horaCreacion` time NOT NULL, /*Campo auditoria*/
    `fechaCreacion` date NOT NULL , /*Campo auditoria*/
    `usuarioModificacion` varchar(20) NOT NULL, /*Campo auditoria*/
    `horaModificacion` time NOT NULL, /*Campo auditoria*/
    `fechaModificacion` date NOT NULL, /*Campo auditoria*/
    FOREIGN KEY (`tipoUsuario`) REFERENCES TIPO_USUARIO(`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;


/*GRADO
*******
Tabla donde se registrarán todos los grado de la institución.
*/
CREATE TABLE GRADO (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `grado` int(11) UNSIGNED NOT NULL,
    `estado` int(1) UNSIGNED NOT NULL, /*Estado del registro: 1 (Activo) y 0 (Desactivado)*/
    `usuarioCreacion` varchar(20) NOT NULL, /*Campo auditoria*/
    `horaCreacion` time NOT NULL, /*Campo auditoria*/
    `fechaCreacion` date NOT NULL, /*Campo auditoria*/
    `usuarioModificacion` varchar(20) NOT NULL, /*Campo auditoria*/
    `horaModificacion` time NOT NULL, /*Campo auditoria*/
    `fechaModificacion` date NOT NULL /*Campo auditoria*/
) ENGINE=INNODB DEFAULT CHARSET=utf8;


 INSERT INTO GRADO VALUES ('', 1,1,'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE()),
                          ('', 2,1,'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE()),
                          ('', 3,1,'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE()),
                          ('', 4,1,'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE()),
                          ('', 5,1,'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE()),
                          ('', 6,1,'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE()),
                          ('', 7,1,'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE()),
                          ('', 8,1,'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE()),
                          ('', 9,1,'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE()),
                          ('', 10,1,'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE());
 



/*SECCION
*********
Tabla donde se registrarán todos los grado de la institución.
*/
CREATE TABLE SECCION (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `seccion` varchar(5) NOT NULL,
    `estado` int(1) UNSIGNED NOT NULL, /*Estado del registro: 1 (Activo) y 0 (Desactivado)*/
    `usuarioCreacion` varchar(20) NOT NULL, /*Campo auditoria*/
    `horaCreacion` time NOT NULL, /*Campo auditoria*/
    `fechaCreacion` date NOT NULL , /*Campo auditoria*/
    `usuarioModificacion` varchar(20) NOT NULL, /*Campo auditoria*/
    `horaModificacion` time NOT NULL, /*Campo auditoria*/
    `fechaModificacion` date NOT NULL /*Campo auditoria*/
) ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO SECCION VALUES ('', 'A', 1, 'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE() ),
                           ('', 'B', 1, 'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE() ),
                           ('', 'C', 1, 'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE() ),
                           ('', 'D', 1, 'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE() ),
                           ('', 'E', 1, 'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE() ),
                           ('', 'F', 1, 'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE() ),
                           ('', 'G', 1, 'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE() ),
                           ('', 'H', 1, 'system', CURRENT_TIME(), CURRENT_DATE(), 'system', CURRENT_TIME(), CURRENT_DATE() );

/*PRESTAMO
**********
Tabla donde se registrarán todos los préstamos de equipos tecnológicos.
*/
CREATE TABLE PRESTAMO(
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `fecha` date NOT NULL, /*Fecha en que se realizó el préstamo.*/
    `hora` time NOT NULL, /*Hora en que se realizó el préstamo.*/
    `dniUsuario` varchar(8) NOT NULL,
    `idTipoUsuario` int(11) UNSIGNED, /* FK */
    `idGrado` int(11) UNSIGNED NOT NULL, /* FK */
    `idSeccion` int(11) UNSIGNED NOT NULL, /* FK */
    `listaEquipos` varchar(500) NOT NULL, /*Lista de equipos que se prestó.*/
    `observacion` varchar(200) NOT NULL, /* Observación del préstamo realizado.*/
    `estadoDevolucion` int(1) UNSIGNED NOT NULL, /* Estado de la devolución: 0 no devolución. 1 Devuelto.*/
    `estado` int(1) UNSIGNED NOT NULL, /*Estado del registro: 1 (Activo) y 0 (Desactivado)*/
    `usuarioCreacion` varchar(20) NOT NULL, /*Campo auditoria*/
    `horaCreacion` time NOT NULL, /*Campo auditoria*/
    `fechaCreacion` date NOT NULL , /*Campo auditoria*/
    `usuarioModificacion` varchar(20) NOT NULL, /*Campo auditoria*/
    `horaModificacion` time NOT NULL, /*Campo auditoria*/
    `fechaModificacion` date NOT NULL, /*Campo auditoria*/

    FOREIGN KEY( `idTipoUsuario`) REFERENCES TIPO_USUARIO(`id`),
    FOREIGN KEY(`idGrado`) REFERENCES GRADO(`id`),
    FOREIGN KEY(`idSeccion`) REFERENCES SECCION(`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;



/*DEVOLUCION
************
Tabla donde se registrarán todos las devoluciones de los préstamos.
*/
CREATE TABLE DEVOLUCION(
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `idPrestamo` bigint(20) UNSIGNED NOT NULL, /* FK */
    `fecha` date NOT NULL, /*Fecha de la Devolución.*/
    `hora` time NOT NULL, /*Hora de la Devolución.*/
    `observacion` varchar(200) NOT NULL, /* Observación de la Devolución.*/
    `estado` int(1) UNSIGNED NOT NULL, /*Estado del registro: 1 (Activo) y 0 (Desactivado)*/
    `usuarioCreacion` varchar(20) NOT NULL, /*Campo auditoria*/
    `horaCreacion` time NOT NULL, /*Campo auditoria*/
    `fechaCreacion` date NOT NULL , /*Campo auditoria*/
    `usuarioModificacion` varchar(20) NOT NULL, /*Campo auditoria*/
    `horaModificacion` time NOT NULL, /*Campo auditoria*/
    `fechaModificacion` date NOT NULL, /*Campo auditoria*/
    
    FOREIGN KEY(`idPrestamo`) REFERENCES PRESTAMO(`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

