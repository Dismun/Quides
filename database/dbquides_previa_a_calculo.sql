-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 11-01-2018 a las 15:21:01
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbquides`
--
CREATE DATABASE IF NOT EXISTS `dbquides` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `dbquides`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bosquejo`
--

CREATE TABLE `bosquejo` (
  `id` int(11) NOT NULL COMMENT 'Identificador de registro',
  `fecha` date NOT NULL COMMENT 'Día en cuestión',
  `idpersona` int(11) NOT NULL COMMENT 'Identificador de trabajador',
  `idturno` int(11) NOT NULL COMMENT 'Identificador de Turno',
  `idpunto` int(11) NOT NULL COMMENT 'Identificador de punto o ubicación',
  `bloqueado` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Este campo puesto a "true" quiere decir que ese registro ya está pasado y no se debe modificar '
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario_laboral`
--

CREATE TABLE `calendario_laboral` (
  `id` int(11) NOT NULL COMMENT 'Identificador de registro',
  `fecha` date NOT NULL COMMENT 'Fecha de la festividad',
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripcion de la fiesta',
  `tipo_fiesta` enum('Nacional','Regional','Local','Patronal','Otra') COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tipo de fiesta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `calendario_laboral`
--

INSERT INTO `calendario_laboral` (`id`, `fecha`, `descripcion`, `tipo_fiesta`) VALUES
(2, '2018-01-01', 'Año nuevo', 'Nacional'),
(3, '2017-12-06', 'Día de la Constitución', 'Nacional'),
(4, '2017-12-23', 'Día de la Región de Murcia', 'Regional'),
(5, '2018-01-06', 'Día de Reyes', 'Nacional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_externos`
--

CREATE TABLE `categorias_externos` (
  `id` int(11) NOT NULL COMMENT 'Identificador de registro',
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Descripcion de la categoría',
  `activa` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Campo para filtrar y poder dejar categorias en desuso.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias_externos`
--

INSERT INTO `categorias_externos` (`id`, `descripcion`, `activa`) VALUES
(1, 'Contrato de Guardias', 1),
(2, 'Protocolo Abiertos', 1),
(3, 'Altas/Bajas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centros`
--

CREATE TABLE `centros` (
  `id` int(11) NOT NULL COMMENT 'Identificador de Reginstro',
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del centro',
  `codigo` varchar(5) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código qeu identifique al centro de forma abreviada.',
  `color` varchar(7) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Color RGB que identifique al centro.',
  `direccion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefonos` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `poblacion` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `centros`
--

INSERT INTO `centros` (`id`, `descripcion`, `codigo`, `color`, `direccion`, `telefonos`, `poblacion`, `imagen`) VALUES
(1, 'Santa Lucia', 'STL', '#66ff00', 'Autovía de Murcia S/N', '999887111', 'Cartagena', 'centros/stl.jpg'),
(2, 'Rossel', 'RO', '#ff00ff', 'Paseo Alfonso XIII', '999887222', 'Cartagena', 'centros/ro.jpg'),
(3, 'rgfsdfgsdf', 'Pe', '#00f200', 'sdf', '619230465', 'sdf', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chamanes`
--

CREATE TABLE `chamanes` (
  `id` int(11) NOT NULL COMMENT 'Identificador de registro',
  `idpersona` int(11) NOT NULL COMMENT 'Identificador de persona',
  `desde` date NOT NULL COMMENT 'Desde fecha desde la cual la persona es chaman (consideración de liberación de clave)',
  `hasta` date DEFAULT NULL COMMENT 'Fecha hasta que deja de ser chaman',
  `idpunto` int(11) NOT NULL COMMENT 'Ubicación asignada al chaman',
  `idturno` int(11) NOT NULL COMMENT 'Identificador del turno asignado al chaman'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `chamanes`
--

INSERT INTO `chamanes` (`id`, `idpersona`, `desde`, `hasta`, `idpunto`, `idturno`) VALUES
(38, 4, '2018-01-11', NULL, 11, 1),
(39, 2, '2018-01-11', '2018-01-13', 5, 1),
(40, 2, '2018-01-01', '2018-01-10', 5, 1);

--
-- Disparadores `chamanes`
--
DELIMITER $$
CREATE TRIGGER `TBI_chamanes` BEFORE INSERT ON `chamanes` FOR EACH ROW BEGIN
    DECLARE num_rows INT;
    DECLARE msg VARCHAR(100);
    SELECT count(idpersona) FROM persona_externos WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona es externo y no puede ser chaman!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    SELECT count(idpersona) FROM equipos_composicion WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona forma parte de un equipo y no puede ser chaman!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    
    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TBU_chamanes` BEFORE UPDATE ON `chamanes` FOR EACH ROW BEGIN
    DECLARE num_rows INT;
    DECLARE msg VARCHAR(100);
    SELECT count(idpersona) FROM persona_externos WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona es externo y no puede ser chaman!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    SELECT count(idpersona) FROM equipos_composicion WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona forma parte de un equimo y no puede ser chaman!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clave`
--

CREATE TABLE `clave` (
  `id` int(11) NOT NULL COMMENT 'Identificador de registro',
  `orden` int(11) NOT NULL COMMENT 'Numero preferiblemente en centenas para poder reordenar en el futuro y ajustar cadencia de turnos',
  `idturno` int(11) NOT NULL COMMENT 'Identificador del turno'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clave`
--

INSERT INTO `clave` (`id`, `orden`, `idturno`) VALUES
(1, 100, 3),
(2, 200, 4),
(7, 500, 1),
(19, 400, 2),
(21, 300, 4),
(22, 700, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` int(11) NOT NULL COMMENT 'Identificador de registro\n',
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción y nombre del equipo',
  `codigo` varchar(5) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Abreviatura del equipo',
  `orden` int(11) NOT NULL COMMENT 'Orden de los equipos preferiblemente en centenas para un posterior ordenamiento',
  `color` varchar(7) COLLATE utf8_spanish_ci DEFAULT '#000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `descripcion`, `codigo`, `orden`, `color`) VALUES
(1, 'Equipo 1', 'E1', 100, '#ffffd3'),
(2, 'Equipo 2', 'E2', 200, '#dfffce'),
(3, 'Equipo 3', 'E3', 300, '#dcffff'),
(4, 'Equipo 44', 'E44', 400, '#f8defa'),
(5, 'Equipo 5', 'E5', 500, '#f8ecc6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_composicion`
--

CREATE TABLE `equipos_composicion` (
  `id` int(11) NOT NULL,
  `idequipo` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `desde` date NOT NULL,
  `hasta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `equipos_composicion`
--

INSERT INTO `equipos_composicion` (`id`, `idequipo`, `idpersona`, `desde`, `hasta`) VALUES
(4, 1, 3, '2018-01-11', NULL),
(5, 1, 5, '2018-01-11', NULL);

--
-- Disparadores `equipos_composicion`
--
DELIMITER $$
CREATE TRIGGER `TBI_equipos_composicion` BEFORE INSERT ON `equipos_composicion` FOR EACH ROW BEGIN
    DECLARE num_rows INT;
    DECLARE msg VARCHAR(100);
    SELECT count(idpersona) FROM chamanes WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (chamanes.hasta>=new.desde OR chamanes.hasta is null ) AND chamanes.desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona es Chaman y no puede formar parte de ningun equipo!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    SELECT count(idpersona) FROM persona_externos WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona es externa y no puede formar parte de ningun equipo!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    
    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TBU_equipos_composicion` BEFORE UPDATE ON `equipos_composicion` FOR EACH ROW BEGIN
    DECLARE num_rows INT;
    DECLARE msg VARCHAR(100);
    SELECT count(idpersona) FROM chamanes WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (chamanes.hasta>=new.desde OR chamanes.hasta is null ) AND chamanes.desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona es Chaman y no puede formar parte de ningun equipo!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    SELECT count(idpersona) FROM persona_externos WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona es externa y no puede formar parte de ningun equipo!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id` int(11) NOT NULL COMMENT 'Identificador de registro',
  `idincidencia` int(11) NOT NULL COMMENT 'identificador al tipo de incidencia',
  `idpersona` int(11) NOT NULL COMMENT 'Identificador de persona afectada por la incidencia',
  `desde` date NOT NULL COMMENT 'Fecha de inicio de la incidencia',
  `hasta` date DEFAULT NULL COMMENT 'Fecha de final de incidencia.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id`, `idincidencia`, `idpersona`, `desde`, `hasta`) VALUES
(8, 7, 5, '2018-01-11', '2018-01-11'),
(10, 3, 2, '2018-01-11', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_11_17_123304_create_movies_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE `niveles` (
  `id` int(11) NOT NULL COMMENT 'Identificador de registro',
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción del nivel del punto de trabajo',
  `codigo` varchar(5) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código abreviado que identifique el nivel en cuadricula',
  `color` varchar(7) COLLATE utf8_spanish_ci NOT NULL DEFAULT '000000' COMMENT 'Color RGB que representa al nivel',
  `nivel` int(11) NOT NULL COMMENT 'Numero que representa el orden de los niveles, pueden expresarse en centenas para tener la posibiliad de intercalar niveles en el futuro.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`id`, `descripcion`, `codigo`, `color`, `nivel`) VALUES
(1, 'Asistencia unidad de observación', 'uni', '#ffc4ff', 100),
(2, 'Asistencial consultas verdes', 'V', '#c3ff78', 207),
(3, 'Asistencial Amarillo', 'A', '#fffad0', 300),
(4, 'Asistencia Encamamientos', 'AE', '#ff8000', 400);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL COMMENT 'Identificador de registro',
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre de l persona',
  `telefonos` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Teléfonos de contacto',
  `email` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Correo electronico',
  `urlfoto` varchar(45) COLLATE utf8_spanish_ci DEFAULT 'personal/NoFoto.gif' COMMENT 'Vinculo a una foto de la persona.',
  `activo` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Campo para dar de baja o ignorar al personal que interese. '
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `telefonos`, `email`, `urlfoto`, `activo`) VALUES
(1, 'Medico ONCE', '968112233', 'me1@quides.es', 'personal/NoFoto.gif', 1),
(2, 'Médico DOS', '968112233', 'me2@quides.es', 'personal/NoFoto.gif', 1),
(3, 'Médico TRES', '968112233', 'me3@quides.es', 'personal/NoFoto.gif', 1),
(4, 'Médico CUATRO', '968112233', 'me4@quides.es', 'personal/NoFoto.gif', 1),
(5, 'Médico CINCO', '968112233', 'me1@quides.es', 'personal/NoFoto.gif', 1),
(6, 'Médico SEIS', '968112233', 'me2@quides.es', 'personal/NoFoto.gif', 0),
(7, 'Médico SIETE', '968112233', 'me1@quides.es', 'personal/guapo.jpg', 0),
(8, 'Médico OCHO', '968112233', 'me2@quides.es', 'personal/NoFoto.gif', 1),
(9, 'Médico NUEVE', '968112233', 'me2@quides.es', 'personal/NoFoto.gif', 1),
(10, 'Médico DIEZ', '968112233 968514594 619230465', 'mediezderebenga@quides.es', 'personal/NoFoto.gif', 1),
(12, 'Médico DOCE', '4454545', 'lopez@ddd.es', 'personal/NoFoto.gif', 1),
(13, 'Medico UNO', '555', 'lopez@ddd.es', 'personal/NoFoto.gif', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_externos`
--

CREATE TABLE `persona_externos` (
  `id` int(11) NOT NULL COMMENT 'Identificador de registro',
  `idpersona` int(11) NOT NULL COMMENT 'Identificador de la persona',
  `idcategoria` int(11) NOT NULL COMMENT 'Identificador de la categoría de esa persona',
  `lugar_trabajo` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Lugar donde localizarlo',
  `predisposicion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Nivel de Disponibilidad',
  `desde` date NOT NULL COMMENT 'Desde que dia desempeña esa categoria el trabajador.',
  `hasta` date DEFAULT NULL COMMENT 'Hasta que día desempeña esa categoría el trabajador.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `persona_externos`
--

INSERT INTO `persona_externos` (`id`, `idpersona`, `idcategoria`, `lugar_trabajo`, `predisposicion`, `desde`, `hasta`) VALUES
(4, 13, 3, 'Practiser', 'Buena', '2018-01-11', NULL),
(5, 8, 1, 'Los Dolores', 'Buena', '2018-01-11', NULL),
(6, 8, 1, '---', '---', '2018-01-01', '2018-01-10');

--
-- Disparadores `persona_externos`
--
DELIMITER $$
CREATE TRIGGER `TBI_persona_externos` BEFORE INSERT ON `persona_externos` FOR EACH ROW BEGIN
    DECLARE num_rows INT;
    DECLARE msg VARCHAR(100);
    SELECT count(idpersona) FROM chamanes WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona es chaman y no puede ser externo!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    SELECT count(idpersona) FROM equipos_composicion WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona forma parte de un equimo y no puede ser externa!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    
    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TBu_persona_externos` BEFORE UPDATE ON `persona_externos` FOR EACH ROW BEGIN
    DECLARE num_rows INT;
    DECLARE msg VARCHAR(100);
    SELECT count(idpersona) FROM chamanes WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona es chaman y no puede ser externo!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    SELECT count(idpersona) FROM equipos_composicion WHERE idpersona  =
                                            new.idpersona
                                             AND
					    (hasta>=new.desde OR hasta is null ) AND desde<=new.desde
					     INTO num_rows;

    IF num_rows <> 0
    THEN
        set msg = concat('Error: La persona forma parte de un equimo y no puede ser externa!, id persona:',cast(new.idpersona as char));

        signal sqlstate '45000' set message_text = msg;
    END IF;
    
    
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos`
--

CREATE TABLE `puntos` (
  `id` int(11) NOT NULL COMMENT 'Identificador de registro',
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `codigo` varchar(5) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Abreviatura que identifique el punto o ubicación de trabajo',
  `idcentro` int(11) NOT NULL COMMENT 'Identificador del centro donde está ubicado el punto de trabajo',
  `idnivel` int(11) NOT NULL COMMENT 'Identificador de nivel del punto seleccionado. Este identificador relacina el color del nivel para el punto de trabajo.',
  `prioridad` int(11) NOT NULL COMMENT 'Numero que establezca la prioridad a la hora de repartir personas en las ubicaciones o puntos, preferiblemante en centenas para poder intercalar nuevas ubicaciones en el futuro.',
  `guardia` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `puntos`
--

INSERT INTO `puntos` (`id`, `descripcion`, `codigo`, `idcentro`, `idnivel`, `prioridad`, `guardia`) VALUES
(1, 'Unidad 1', 'U1', 1, 1, 80, 0),
(3, 'Consulta General 1', 'V1', 1, 2, 100, 0),
(4, 'Consulta General 2', 'V2', 1, 2, 110, 0),
(5, 'Consula 4', 'C4', 1, 3, 130, 0),
(6, 'Consulta 5', 'C5', 1, 3, 140, 0),
(7, 'Consula 6', 'C6', 1, 3, 150, 0),
(8, 'Consulta 7', 'C7', 1, 3, 160, 0),
(9, 'Consula 8', 'C8', 1, 3, 170, 0),
(10, 'Consulta 9', 'C9', 1, 3, 180, 0),
(11, 'Consula 10', 'C10', 1, 3, 190, 0),
(12, 'Consulta 11', 'C11', 1, 3, 200, 0),
(13, 'Consulta 12', 'C12', 2, 3, 210, 0),
(14, 'Consulta 13', 'C13', 2, 3, 220, 0),
(15, 'Responsable de Guardia', 'GR', 1, 1, 10, 1),
(16, 'Turno de Guardia  STL', 'G1', 1, 1, 20, 1),
(17, 'Turno de Guardia RO', 'G2', 2, 1, 30, 1),
(18, 'Turno de Guardia  STL', 'G3', 1, 1, 40, 1),
(19, 'Turno de Guardia STL', 'G4', 1, 1, 50, 1),
(20, 'Turno de Guardia  STL', 'G5', 1, 1, 60, 1),
(26, 'Unidad 2', 'U2', 1, 1, 90, 0),
(39, 'Turno de Guardia STL', 'G6', 1, 1, 70, 1),
(45, 'Turno de Guardia STL', 'G14', 2, 2, 45, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sabadosydomingos`
--

CREATE TABLE `sabadosydomingos` (
  `id` int(11) NOT NULL COMMENT 'Identificador de registro',
  `idpunto` int(11) NOT NULL COMMENT 'Identificador de Punto',
  `idturno` int(11) NOT NULL COMMENT 'Identificador de Turno',
  `sabados` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Consideración de laborable las sabados por la mañana',
  `domingos` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Consideración de laborable',
  `desde` date NOT NULL COMMENT 'Consideraciones desde la fecha',
  `hasta` date DEFAULT NULL COMMENT 'Consideraciones hasta la fecha'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sabadosydomingos`
--

INSERT INTO `sabadosydomingos` (`id`, `idpunto`, `idturno`, `sabados`, `domingos`, `desde`, `hasta`) VALUES
(19, 5, 1, 1, 0, '2018-01-03', NULL),
(20, 7, 1, 1, 0, '2018-01-10', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sustituciones`
--

CREATE TABLE `sustituciones` (
  `id` int(11) NOT NULL COMMENT 'Identificador de registro',
  `idpersona` int(11) NOT NULL COMMENT 'Identificador de la persona sustituida',
  `idpersona_externa` int(11) NOT NULL COMMENT 'Identificador del sustituto (persona_externa)',
  `desde` date NOT NULL COMMENT 'Fecha de inicio de la sustitución',
  `hasta` date DEFAULT NULL COMMENT 'Fecha en la que termina la sustitución'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sustituciones`
--

INSERT INTO `sustituciones` (`id`, `idpersona`, `idpersona_externa`, `desde`, `hasta`) VALUES
(7, 5, 4, '2018-01-11', '2018-01-11'),
(8, 2, 5, '2018-01-11', '2018-01-14'),
(9, 2, 4, '2018-01-15', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_incidencias`
--

CREATE TABLE `tipos_incidencias` (
  `id` int(11) NOT NULL COMMENT 'Identificador de registro',
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción de la incidencia.',
  `codigo` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `color` varchar(7) COLLATE utf8_spanish_ci DEFAULT '#000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipos_incidencias`
--

INSERT INTO `tipos_incidencias` (`id`, `descripcion`, `codigo`, `color`) VALUES
(1, 'Vacaciones', 'V', '#0000ff'),
(2, 'IT Accidente', 'IT', '#fc0000'),
(3, 'IT Enfermedad', 'IT', '#000000'),
(5, 'Permiso Personal', 'PP', '#000000'),
(6, 'Comision de Servicios', 'CS', '#000000'),
(7, 'Libre disposición', 'LD', '#0000cc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id` int(11) NOT NULL COMMENT 'Identificador de regidtro',
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción de la jornada.',
  `desde` time(4) NOT NULL COMMENT 'Hora de inicio del turno',
  `hasta` time(4) NOT NULL COMMENT 'Hora de finalización del turno',
  `codigo` varchar(5) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código o abreviatura que representa al turno M mañana T tarde',
  `activo` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Para poder dejar en desuso'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `descripcion`, `desde`, `hasta`, `codigo`, `activo`) VALUES
(1, 'Mañana', '08:00:00.0000', '15:00:00.0000', 'M', 1),
(2, 'Tarde', '15:00:00.0000', '22:00:00.0000', 'T', 1),
(3, 'Guardia', '08:00:00.0000', '07:59:00.0000', 'G', 1),
(4, 'Descanso Guardia', '08:00:00.0000', '07:59:00.0000', 'D', 1),
(7, 'Cenicienta', '12:00:00.0000', '23:59:00.0000', 'CE', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Francisco Andrés', 'dismun@dismun.com', '$2y$10$vjoKWYE4N7PogeXu51JDM.xDK98vWRu7SokKkhyGDkw1oL2NL9OcW', 1, 'gTsCJoFz7tmwxRjo066zFTq506uFeq2c1wvW007obkUwlBRW0htbMc7KB9po', '2017-12-17 16:40:36', '2017-12-17 16:40:36'),
(2, 'Pedro', 'k22@dismun.com', '$2y$10$LC6XzAC5AoYkt4EtGqzKGOTwdsYtIdnk3DWS3YKV3K1NMLv05/Bg2', 0, 'J5XpgeHbqUw0t5VR5tgXeWtRxB65UTHRttid5lPXnqI5DWy2VCnaDKYPNdNB', '2017-12-17 16:43:26', '2017-12-17 16:43:26'),
(3, 'Juan', 'casa@dismun.com', '$2y$10$X0p.Zkz6YOGNlOPh92KuLumxzVlI9V5w49hn/P3xPR9zklz0oDmMi', 0, '5YLgtja9xQAlO6ThDzBErjibaovXnRWmyaOV3CZ5RBbOFl5KiAlX3gDxZNvg', '2017-12-20 21:11:16', '2017-12-20 21:11:16');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewbosquejo1`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `viewbosquejo1` (
`fecha` date
,`id` int(11)
,`bloqueado` tinyint(4)
,`nombre` varchar(45)
,`codigoturno` varchar(5)
,`turno` varchar(45)
,`codigopunto` varchar(5)
,`punto` varchar(45)
,`colornivel` varchar(7)
,`nivel` varchar(45)
,`centro` varchar(45)
,`colorcentro` varchar(7)
,`codigocentro` varchar(5)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_externos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_externos` (
`id` int(11)
,`nombre` varchar(45)
,`desde` date
,`hasta` date
);

-- --------------------------------------------------------

--
-- Estructura para la vista `viewbosquejo1`
--
DROP TABLE IF EXISTS `viewbosquejo1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewbosquejo1`  AS  select sql_cache `bosquejo`.`fecha` AS `fecha`,`bosquejo`.`id` AS `id`,`bosquejo`.`bloqueado` AS `bloqueado`,`personas`.`nombre` AS `nombre`,`turnos`.`codigo` AS `codigoturno`,`turnos`.`descripcion` AS `turno`,`puntos`.`codigo` AS `codigopunto`,`puntos`.`descripcion` AS `punto`,`niveles`.`color` AS `colornivel`,`niveles`.`descripcion` AS `nivel`,`centros`.`descripcion` AS `centro`,`centros`.`color` AS `colorcentro`,`centros`.`codigo` AS `codigocentro` from (((((`bosquejo` join `personas` on((`personas`.`id` = `bosquejo`.`idpersona`))) join `turnos` on((`turnos`.`id` = `bosquejo`.`idturno`))) join `puntos` on((`puntos`.`id` = `bosquejo`.`idpunto`))) join `centros` on((`centros`.`id` = `puntos`.`idcentro`))) join `niveles` on((`niveles`.`id` = `puntos`.`idnivel`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_externos`
--
DROP TABLE IF EXISTS `view_externos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_externos`  AS  select `persona_externos`.`id` AS `id`,`personas`.`nombre` AS `nombre`,`persona_externos`.`desde` AS `desde`,`persona_externos`.`hasta` AS `hasta` from (`persona_externos` join `personas` on((`persona_externos`.`idpersona` = `personas`.`id`))) order by `persona_externos`.`desde` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bosquejo`
--
ALTER TABLE `bosquejo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_fecha_persona` (`fecha`,`idpersona`,`idturno`),
  ADD KEY `fk_personas_bosquejo_idx` (`idpersona`),
  ADD KEY `fk_turnos_bosquejo_idx` (`idturno`),
  ADD KEY `fk_puntos_bosquejo_idx` (`idpunto`);

--
-- Indices de la tabla `calendario_laboral`
--
ALTER TABLE `calendario_laboral`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias_externos`
--
ALTER TABLE `categorias_externos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `centros`
--
ALTER TABLE `centros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chamanes`
--
ALTER TABLE `chamanes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_personas_chamanes_idx` (`idpersona`),
  ADD KEY `fk_puntos_chamanes_idx` (`idpunto`),
  ADD KEY `fk_turnos_chamanes_idx` (`idturno`);

--
-- Indices de la tabla `clave`
--
ALTER TABLE `clave`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_turnos_clave_idx` (`idturno`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipos_composicion`
--
ALTER TABLE `equipos_composicion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_equipos_eq_composicion_idx` (`idequipo`),
  ADD KEY `fk_personas_eq_composicion_idx` (`idpersona`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipos_incidencias_incidencias_idx` (`idincidencia`),
  ADD KEY `fk_personas_incidencia_idx` (`idpersona`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNQ_nombre` (`nombre`);

--
-- Indices de la tabla `persona_externos`
--
ALTER TABLE `persona_externos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_personas_persona_externos_idx` (`idpersona`),
  ADD KEY `fk_categoria_persona_externos_idx` (`idcategoria`);

--
-- Indices de la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_centros_puntos_idx` (`idcentro`),
  ADD KEY `fk_niveles_puntos_idx` (`idnivel`);

--
-- Indices de la tabla `sabadosydomingos`
--
ALTER TABLE `sabadosydomingos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_puntos_sabadosydomingos_idx` (`idpunto`),
  ADD KEY `fk_turnos_sabadosydomingos_idx` (`idturno`);

--
-- Indices de la tabla `sustituciones`
--
ALTER TABLE `sustituciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_persona_sustituciones_idx` (`idpersona`),
  ADD KEY `fk_persona_externa_sustituciones_idx` (`idpersona_externa`);

--
-- Indices de la tabla `tipos_incidencias`
--
ALTER TABLE `tipos_incidencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bosquejo`
--
ALTER TABLE `bosquejo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro';

--
-- AUTO_INCREMENT de la tabla `calendario_laboral`
--
ALTER TABLE `calendario_laboral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categorias_externos`
--
ALTER TABLE `categorias_externos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `centros`
--
ALTER TABLE `centros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de Reginstro', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `chamanes`
--
ALTER TABLE `chamanes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `clave`
--
ALTER TABLE `clave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro\n', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `equipos_composicion`
--
ALTER TABLE `equipos_composicion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `niveles`
--
ALTER TABLE `niveles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `persona_externos`
--
ALTER TABLE `persona_externos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `puntos`
--
ALTER TABLE `puntos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `sabadosydomingos`
--
ALTER TABLE `sabadosydomingos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `sustituciones`
--
ALTER TABLE `sustituciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipos_incidencias`
--
ALTER TABLE `tipos_incidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de regidtro', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bosquejo`
--
ALTER TABLE `bosquejo`
  ADD CONSTRAINT `fk_personas_bosquejo` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_puntos_bosquejo` FOREIGN KEY (`idpunto`) REFERENCES `puntos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_turnos_bosquejo` FOREIGN KEY (`idturno`) REFERENCES `turnos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `chamanes`
--
ALTER TABLE `chamanes`
  ADD CONSTRAINT `fk_personas_chamanes` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_puntos_chamanes` FOREIGN KEY (`idpunto`) REFERENCES `puntos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_turnos_chamanes` FOREIGN KEY (`idturno`) REFERENCES `turnos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clave`
--
ALTER TABLE `clave`
  ADD CONSTRAINT `fk_turnos_clave` FOREIGN KEY (`idturno`) REFERENCES `turnos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `equipos_composicion`
--
ALTER TABLE `equipos_composicion`
  ADD CONSTRAINT `fk_equipos_eq_composicion` FOREIGN KEY (`idequipo`) REFERENCES `equipos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personas_eq_composicion` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `fk_personas_incidencia` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipos_incidencias_incidencias` FOREIGN KEY (`idincidencia`) REFERENCES `tipos_incidencias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona_externos`
--
ALTER TABLE `persona_externos`
  ADD CONSTRAINT `fk_categoria_persona_externos` FOREIGN KEY (`idcategoria`) REFERENCES `categorias_externos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personas_persona_externos` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD CONSTRAINT `fk_centros_puntos` FOREIGN KEY (`idcentro`) REFERENCES `centros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_niveles_puntos` FOREIGN KEY (`idnivel`) REFERENCES `niveles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sabadosydomingos`
--
ALTER TABLE `sabadosydomingos`
  ADD CONSTRAINT `fk_puntos_sabadosydomingos` FOREIGN KEY (`idpunto`) REFERENCES `puntos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_turnos_sabadosydomingos` FOREIGN KEY (`idturno`) REFERENCES `turnos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sustituciones`
--
ALTER TABLE `sustituciones`
  ADD CONSTRAINT `fk_persona_externa_sustituciones` FOREIGN KEY (`idpersona_externa`) REFERENCES `persona_externos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_persona_sustituciones` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
