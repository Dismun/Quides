-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 31-01-2018 a las 22:00:00
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
(5, '2018-01-06', 'Día de Reyes', 'Nacional'),
(6, '2018-03-19', 'San José', 'Regional'),
(7, '2018-03-23', 'Viernes de Dolores', 'Local'),
(8, '2018-03-29', 'Jueves Santo', 'Regional'),
(9, '2018-03-30', 'Viernes Santo', 'Nacional'),
(10, '2018-05-01', 'Día del Trabajo', 'Nacional'),
(11, '2018-06-09', 'Día de la Región de Murcia', 'Regional'),
(12, '2018-08-15', 'Asunción de la Virgen', 'Nacional'),
(13, '2018-09-28', 'Cartagineses y Romanos', 'Local'),
(14, '2018-10-12', 'Ispanidad', 'Nacional'),
(15, '2018-11-01', 'Todos los Santos', 'Nacional'),
(16, '2018-12-06', 'Dia de la Constitución', 'Nacional'),
(17, '2018-12-08', 'Inmaculada Concepción', 'Nacional'),
(18, '2018-12-25', 'Navidad', 'Nacional');

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
(2, 'Rossel', 'RO', '#ff00ff', 'Paseo Alfonso XIII', '999887222', 'Cartagena', 'centros/ro.jpg');

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
(43, 33, '2018-01-01', NULL, 6, 1),
(44, 34, '2018-01-01', NULL, 7, 1),
(45, 35, '2018-01-01', NULL, 8, 1),
(46, 36, '2018-01-01', NULL, 13, 1),
(47, 37, '2018-01-01', NULL, 14, 1),
(49, 38, '2018-01-01', NULL, 60, 1);

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
(7, 600, 1),
(19, 500, 2),
(22, 700, 1),
(23, 300, 9);

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
(1, 'Equipo 1', 'E1', 100, '#ff908d'),
(2, 'Equipo 2', 'E2', 200, '#f6ec78'),
(3, 'Equipo 3', 'E3', 300, '#dcffff'),
(4, 'Equipo 4', 'E4', 400, '#f8defa'),
(5, 'Equipo 5', 'E5', 500, '#f8cec6'),
(6, 'Equipo 6', 'E6', 600, '#9ef1d0');

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
(9, 1, 5, '2018-01-01', NULL),
(10, 1, 4, '2018-01-01', NULL),
(11, 1, 10, '2018-01-01', NULL),
(12, 1, 12, '2018-01-01', NULL),
(13, 1, 2, '2018-01-01', NULL),
(14, 2, 9, '2018-01-01', NULL),
(15, 2, 8, '2018-01-01', NULL),
(16, 2, 1, '2018-01-01', NULL),
(17, 2, 3, '2018-01-01', NULL),
(18, 2, 13, '2018-01-01', NULL),
(19, 3, 6, '2018-01-01', NULL),
(20, 3, 7, '2018-01-01', NULL),
(21, 3, 14, '2018-01-01', NULL),
(22, 3, 15, '2018-01-01', NULL),
(23, 3, 16, '2018-01-01', NULL),
(24, 4, 17, '2018-01-01', NULL),
(25, 4, 18, '2018-01-01', NULL),
(26, 4, 19, '2018-01-01', NULL),
(27, 4, 20, '2018-01-01', NULL),
(28, 4, 21, '2018-01-01', NULL),
(29, 5, 22, '2018-01-01', NULL),
(30, 5, 23, '2018-01-01', NULL),
(31, 5, 24, '2018-01-01', NULL),
(32, 5, 25, '2018-01-01', NULL),
(33, 5, 26, '2018-01-01', NULL),
(34, 5, 27, '2018-01-01', NULL),
(35, 6, 28, '2018-01-01', NULL),
(36, 6, 29, '2018-01-01', NULL),
(37, 6, 30, '2018-01-01', NULL),
(38, 6, 31, '2018-01-01', NULL),
(39, 6, 32, '2018-01-01', NULL);

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

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('dismun@dismun.com', '$2y$10$/16A.ZxJW1FKBeGivirW5Oij3OpZ45552xjaqBMwslogYB5s9YF2.', '2018-01-16 19:18:51');

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
(0, 'Vacio', NULL, NULL, 'personal/NoFoto.gif', 0),
(1, 'Mcm', '968112233', 'me1@quides.es', 'personal/NoFoto.gif', 1),
(2, 'Leandro', '968112233', 'me2@quides.es', 'personal/NoFoto.gif', 1),
(3, 'Toñi', '968112233', 'me3@quides.es', 'personal/NoFoto.gif', 1),
(4, 'Ruben', '968112233', 'me4@quides.es', 'personal/NoFoto.gif', 1),
(5, 'Luichi', '968112233', 'me1@quides.es', 'personal/NoFoto.gif', 1),
(6, 'Miki', '968112233', 'me2@quides.es', 'personal/NoFoto.gif', 1),
(7, 'Paola', '968112233', 'me1@quides.es', 'personal/NoFoto.gif', 1),
(8, 'Nasser', '968112233', 'me2@quides.es', 'personal/NoFoto.gif', 1),
(9, 'Jesus Gin', '968112233', 'me2@quides.es', 'personal/NoFoto.gif', 1),
(10, 'Hugo', '968112233 968514594 619230465', 'mediezderebenga@quides.es', 'personal/NoFoto.gif', 1),
(12, 'Alicia', '4454545', 'lopez@ddd.es', 'personal/NoFoto.gif', 1),
(13, 'Marga', '555', 'lopez@ddd.es', 'personal/NoFoto.gif', 1),
(14, 'Ana Barba', '23424234', 'dasdasd@sfsdf.com', 'personal/NoFoto.gif', 1),
(15, 'Ana Carrillo', '619230465', 'ana@carrillo.com', 'personal/NoFoto.gif', 1),
(16, 'Alberto', '619230465', 'alberto@alberto.es', 'personal/NoFoto.gif', 1),
(17, 'Montoro', '619230465', 'Montoro@xn--tocameelcoo-beb.es', 'personal/NoFoto.gif', 1),
(18, 'A. Victoria', '4454545', 'a@victoria.es', 'personal/NoFoto.gif', 1),
(19, 'Ana Isabel', '659563281', 'ana@isabel.es', 'personal/NoFoto.gif', 1),
(20, 'Paco G.', '619230465', 'Paco@g.es', 'personal/NoFoto.gif', 1),
(21, 'Juanma', '619230465', 'Juan@ma.es', 'personal/NoFoto.gif', 1),
(22, 'Imanol', '659563281', 'Ima@nol.es', 'personal/NoFoto.gif', 1),
(23, 'Grego', '659563281', 'gre@go.es', 'personal/NoFoto.gif', 1),
(24, 'Sofia', '659563281', 'Sofia@sofia.es', 'personal/NoFoto.gif', 1),
(25, 'Andrés B', '659563281', 'andres@b.es', 'personal/NoFoto.gif', 1),
(26, 'Leticia', '659563281', 'Leticia@leticia.es', 'personal/NoFoto.gif', 1),
(27, 'Fernando (IT Andres)', '777666', 'fernando@itandres.es', 'personal/NoFoto.gif', 1),
(28, 'Vanesa', '659563281', 'Vanesa@vanesa.es', 'personal/NoFoto.gif', 1),
(29, 'Rocio', '659563281', 'Rocio@rocio.es', 'personal/NoFoto.gif', 1),
(30, 'Paqui', '777666', 'Paqui@garcia.es', 'personal/NoFoto.gif', 1),
(31, 'E. Guirao', '659563281', 'e@guirao.es', 'personal/NoFoto.gif', 1),
(32, 'A. Gonzalez', '659563281', 'a@gonzalez.es', 'personal/NoFoto.gif', 1),
(33, 'Agustín', '659563281', 'agustin@agus.es', 'personal/NoFoto.gif', 1),
(34, 'Enrique', '659563281', 'Enrique@manipulador.es', 'personal/NoFoto.gif', 1),
(35, 'León', '619230465', 'Leon@seat.es', 'personal/NoFoto.gif', 1),
(36, 'Lola', '659563281', 'Lola@lali.es', 'personal/NoFoto.gif', 1),
(37, 'Ramón', '659563281', 'Ramon@liron.es', 'personal/NoFoto.gif', 1),
(38, 'Mj Gomez', '659563281', 'mj@gomez.es', 'personal/NoFoto.gif', 1),
(39, 'Jesus Cruzado', '659563281', 'Jesus@cruzado.es', 'personal/NoFoto.gif', 1),
(40, 'Nai', '619230465', 'Nai@nai.es', 'personal/NoFoto.gif', 1),
(41, 'Car', '659563281', 'CAr@car.es', 'personal/NoFoto.gif', 1),
(42, 'Lau', '659563281', 'Lau@lau.es', 'personal/NoFoto.gif', 1),
(43, 'Bok', '659563281', 'Bok@bok.es', 'personal/NoFoto.gif', 1),
(44, 'Oma', '659563281', 'oma@oma.es', 'personal/NoFoto.gif', 1),
(45, 'And', '659563281', 'andres@b.es', 'personal/NoFoto.gif', 1),
(46, 'Linder', '659563281', 'linder@super.es', 'personal/NoFoto.gif', 1),
(47, 'Ele', '659563281', 'ele@ele.es', 'personal/NoFoto.gif', 1),
(48, 'Isa', '659563281', 'isa@isa.es', 'personal/NoFoto.gif', 1),
(49, 'Ces', '659563281', 'ces@ces.es', 'personal/NoFoto.gif', 1),
(50, 'Lui', '659563281', 'Lui@frg.es', 'personal/NoFoto.gif', 1),
(51, 'San', '619230465', 'San@kkk.es', 'personal/NoFoto.gif', 1),
(52, 'Mr co', '659563281', 'mr@fco.es', 'personal/NoFoto.gif', 1),
(53, 'Joa', '659563281', 'Joa@kin.es', 'personal/NoFoto.gif', 1),
(54, 'Leo', '659563281', 'Leo@yas.es', 'personal/NoFoto.gif', 1),
(55, 'Yas', '659563281', 'Yas@ta.es', 'personal/NoFoto.gif', 1),
(56, 'Ale', '659563281', 'ale@ale.es', 'personal/NoFoto.gif', 1),
(57, 'Carmen', '659563281', 'Carmen@carmen.es', 'personal/NoFoto.gif', 1),
(58, 'Cay', '659563281', 'Cay@cay.es', 'personal/NoFoto.gif', 1),
(59, 'Con', '659563281', 'Con@suelo.es', 'personal/NoFoto.gif', 1),
(60, 'Orl', '659563281', 'Orl@lando.es', 'personal/NoFoto.gif', 1),
(61, 'Gui', '659563281', 'Gui@quepisao.es', 'personal/NoFoto.gif', 1);

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
(1, 44, 1, NULL, NULL, '2018-01-01', NULL),
(2, 40, 1, NULL, NULL, '2018-01-01', NULL),
(3, 43, 1, NULL, NULL, '2018-01-01', NULL),
(4, 41, 2, NULL, NULL, '2018-01-01', NULL),
(5, 56, 2, NULL, NULL, '2018-01-01', NULL),
(6, 61, 2, NULL, NULL, '2018-01-01', NULL),
(7, 45, 2, NULL, NULL, '2018-01-01', NULL),
(8, 48, 2, NULL, NULL, '2018-01-01', NULL),
(9, 55, 2, NULL, NULL, '2018-01-01', NULL),
(10, 52, 2, NULL, NULL, '2018-01-01', NULL),
(11, 49, 2, NULL, NULL, '2018-01-01', NULL),
(12, 58, 2, NULL, NULL, '2018-01-01', NULL),
(13, 47, 3, NULL, NULL, '2018-01-01', NULL),
(14, 60, 3, NULL, NULL, '2018-01-01', NULL),
(15, 54, 3, NULL, NULL, '2018-01-01', NULL),
(16, 46, 3, NULL, NULL, '2018-01-01', NULL),
(17, 57, 3, NULL, NULL, '2018-01-01', NULL),
(18, 50, 3, NULL, NULL, '2018-01-01', NULL),
(19, 53, 3, NULL, NULL, '2018-01-01', NULL),
(20, 51, 3, NULL, NULL, '2018-01-01', NULL),
(21, 42, 3, NULL, NULL, '2018-01-01', NULL),
(22, 59, 3, NULL, NULL, '2018-01-01', NULL);

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
(15, 'Responsable de Guardia', 'R', 1, 1, 10, 1),
(16, 'Guardia 1 STL', '1', 1, 1, 20, 1),
(26, 'Unidad 2', 'U2', 1, 1, 90, 0),
(53, 'Guardia 3  STL', '3', 1, 1, 40, 1),
(54, 'Guardia 2  STL', '2', 1, 1, 30, 1),
(55, 'Guardia 4  STL', '4', 1, 1, 50, 1),
(57, 'Guardia 5 RO', '5', 2, 1, 60, 1),
(58, 'Guardia 6 RO', '6', 2, 1, 70, 1),
(60, 'Consulta 14', 'C14', 2, 3, 230, 0),
(61, 'Consulta 15', 'C15', 2, 3, 240, 0),
(68, 'Unidad de preingreso', 'UPI', 1, 4, 115, 0),
(69, 'Consultor de Residentes', 'CR', 1, 3, 125, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos_detalle`
--

CREATE TABLE `puntos_detalle` (
  `id` int(11) NOT NULL,
  `idpunto` int(11) NOT NULL,
  `idturno` int(11) NOT NULL,
  `lunes` tinyint(1) NOT NULL DEFAULT '1',
  `martes` tinyint(1) NOT NULL DEFAULT '1',
  `miercoles` tinyint(1) NOT NULL DEFAULT '1',
  `jueves` tinyint(1) NOT NULL DEFAULT '1',
  `viernes` tinyint(1) NOT NULL DEFAULT '1',
  `sabado` tinyint(1) NOT NULL DEFAULT '0',
  `domingo` tinyint(1) NOT NULL DEFAULT '0',
  `festivo` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Control de turnos en puntos';

--
-- Volcado de datos para la tabla `puntos_detalle`
--

INSERT INTO `puntos_detalle` (`id`, `idpunto`, `idturno`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `sabado`, `domingo`, `festivo`) VALUES
(1, 15, 3, 1, 1, 1, 1, 1, 1, 1, 1),
(5, 3, 1, 1, 1, 1, 1, 1, 1, 0, 0),
(6, 3, 2, 1, 1, 1, 1, 1, 0, 0, 0),
(10, 4, 1, 1, 1, 1, 1, 1, 0, 0, 0),
(11, 4, 2, 1, 1, 1, 1, 1, 0, 0, 0),
(12, 9, 1, 1, 1, 1, 1, 1, 0, 0, 1),
(13, 16, 3, 1, 1, 1, 1, 1, 1, 1, 1),
(14, 54, 3, 1, 1, 1, 1, 1, 1, 1, 1),
(15, 53, 3, 1, 1, 1, 1, 1, 1, 1, 1),
(16, 55, 3, 1, 1, 1, 1, 1, 1, 1, 1),
(17, 57, 3, 1, 1, 1, 1, 1, 1, 1, 1),
(18, 58, 3, 0, 0, 0, 0, 0, 0, 1, 1);

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
(22, 3, 1, 1, 0, '2018-01-01', NULL),
(23, 5, 1, 1, 0, '2018-01-01', NULL);

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
(1, 'Vacaciones', 'V', '#a3ff80'),
(2, 'IT Accidente', 'IT', '#fc0000'),
(3, 'IT Enfermedad', 'IT', '#000000'),
(5, 'Permiso Personal', 'PP', '#000000'),
(6, 'Comision de Servicios', 'CS', '#000000'),
(7, 'Libre disposición', 'LD', '#8bc3ff'),
(8, 'Permiso Particular', 'PP', '#a8bebb');

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
  `activo` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Para poder dejar en desuso',
  `horas` decimal(10,2) DEFAULT '7.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `descripcion`, `desde`, `hasta`, `codigo`, `activo`, `horas`) VALUES
(1, 'Mañana', '08:00:00.0000', '15:00:00.0000', 'M', 1, '7.00'),
(2, 'Tarde', '15:00:00.0000', '22:00:00.0000', 'T', 1, '7.00'),
(3, 'Guardia', '08:00:00.0000', '07:59:00.0000', 'G', 1, '24.00'),
(4, 'Descanso Guardia', '08:00:00.0000', '07:59:00.0000', 'D', 1, '0.00'),
(9, 'Actividad extra asistencial', '08:00:00.0000', '15:00:00.0000', 'AEA', 1, '0.00');

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
(1, 'Francisco Andrés', 'dismun@dismun.com', '$2y$10$vjoKWYE4N7PogeXu51JDM.xDK98vWRu7SokKkhyGDkw1oL2NL9OcW', 1, 'YV2JedL5bhie7aalrzOjiYIpxjcXHEq2cc5hdW4iIfkoDEZDvxOKbx71gjm8', '2017-12-17 16:40:36', '2017-12-17 16:40:36'),
(2, 'Pedro', 'k22@dismun.com', '$2y$10$LC6XzAC5AoYkt4EtGqzKGOTwdsYtIdnk3DWS3YKV3K1NMLv05/Bg2', 1, 'JADHXAI5lzjWX6qWRHjVN2x2XLwLXiGO4VsAwzr292Azrs8qoCrecANrUgIz', '2017-12-17 16:43:26', '2017-12-17 16:43:26'),
(3, 'Juan', 'casa@dismun.com', '$2y$10$X0p.Zkz6YOGNlOPh92KuLumxzVlI9V5w49hn/P3xPR9zklz0oDmMi', 0, '5YLgtja9xQAlO6ThDzBErjibaovXnRWmyaOV3CZ5RBbOFl5KiAlX3gDxZNvg', '2017-12-20 21:11:16', '2017-12-20 21:11:16'),
(4, 'Pedro', 'Paco@g.es', '$2y$10$DGRW3zrV3dkAefMSqafJ5eWlmIUl3L8VdeqSVRGmsYyv0PQfNeD1G', 0, 'w0qgcg6aYB5GrPxe098aHNsnvUDHflFM1eyyWehYHYqzGWyZvPNaMWJcT6DW', '2018-01-16 11:49:03', '2018-01-16 11:49:03');

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
-- Estructura Stand-in para la vista `viewbosquejo2`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `viewbosquejo2` (
`fecha` date
,`id` int(11)
,`bloqueado` tinyint(4)
,`nombre` varchar(45)
,`idperona` int(11)
,`codigoturno` varchar(5)
,`turno` varchar(45)
,`codigopunto` varchar(5)
,`punto` varchar(45)
,`colornivel` varchar(7)
,`nivel` varchar(45)
,`centro` varchar(45)
,`colorcentro` varchar(7)
,`codigocentro` varchar(5)
,`codigoequipo` varchar(5)
,`colorequipo` varchar(7)
,`ordenequipo` int(11)
,`ideqcomp` int(11)
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
-- Estructura para la vista `viewbosquejo2`
--
DROP TABLE IF EXISTS `viewbosquejo2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewbosquejo2`  AS  select sql_cache `bosquejo`.`fecha` AS `fecha`,`bosquejo`.`id` AS `id`,`bosquejo`.`bloqueado` AS `bloqueado`,`personas`.`nombre` AS `nombre`,`personas`.`id` AS `idpersona`,`turnos`.`codigo` AS `codigoturno`,`turnos`.`descripcion` AS `turno`,`puntos`.`codigo` AS `codigopunto`,`puntos`.`descripcion` AS `punto`,`niveles`.`color` AS `colornivel`,`niveles`.`descripcion` AS `nivel`,`centros`.`descripcion` AS `centro`,`centros`.`color` AS `colorcentro`,`centros`.`codigo` AS `codigocentro`,`equipos`.`codigo` AS `codigoequipo`,`equipos`.`color` AS `colorequipo`,`equipos`.`orden` AS `ordenequipo`,`equipos_composicion`.`id` AS `ideqcomp` from (((((((`bosquejo` join `personas` on((`personas`.`id` = `bosquejo`.`idpersona`))) join `turnos` on((`turnos`.`id` = `bosquejo`.`idturno`))) join `puntos` on((`puntos`.`id` = `bosquejo`.`idpunto`))) join `equipos_composicion` on((`equipos_composicion`.`idpersona` = `bosquejo`.`idpersona`))) join `equipos` on((`equipos`.`id` = `equipos_composicion`.`idequipo`))) join `centros` on((`centros`.`id` = `puntos`.`idcentro`))) join `niveles` on((`niveles`.`id` = `puntos`.`idnivel`))) ;

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
  ADD UNIQUE KEY `unq_fecha_persona` (`fecha`,`idpersona`,`idturno`,`idpunto`) USING BTREE,
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
-- Indices de la tabla `puntos_detalle`
--
ALTER TABLE `puntos_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_puntos_puntosdetalle_idx` (`idpunto`),
  ADD KEY `fk_turnos_puntos_detalle_idx` (`idturno`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `categorias_externos`
--
ALTER TABLE `categorias_externos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `centros`
--
ALTER TABLE `centros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de Reginstro', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `chamanes`
--
ALTER TABLE `chamanes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `clave`
--
ALTER TABLE `clave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro\n', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `equipos_composicion`
--
ALTER TABLE `equipos_composicion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=19;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `persona_externos`
--
ALTER TABLE `persona_externos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `puntos`
--
ALTER TABLE `puntos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `puntos_detalle`
--
ALTER TABLE `puntos_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `sabadosydomingos`
--
ALTER TABLE `sabadosydomingos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `sustituciones`
--
ALTER TABLE `sustituciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipos_incidencias`
--
ALTER TABLE `tipos_incidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de registro', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de regidtro', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Filtros para la tabla `puntos_detalle`
--
ALTER TABLE `puntos_detalle`
  ADD CONSTRAINT `fk_puntos_puntosdetalle` FOREIGN KEY (`idpunto`) REFERENCES `puntos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_turnos_puntosdetalle` FOREIGN KEY (`idturno`) REFERENCES `turnos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
