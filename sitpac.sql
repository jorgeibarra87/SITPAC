-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2015 a las 23:01:07
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sitpac`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
`idcliente` int(11) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `direccion` longtext NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `nacionalidad` varchar(255) NOT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `permite_email` tinyint(1) NOT NULL,
  `fecha_alta` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nombres`, `apellidos`, `direccion`, `telefono`, `nacionalidad`, `empresa`, `email`, `password`, `salt`, `permite_email`, `fecha_alta`) VALUES
(1, 'Jorge Armando', 'Ibarra Palacios', 'direccion cliete 1', '12345', 'Colombiano', 'empresa cliete1', 'cliente1@gmail.com', 'cliente1', '', 0, '2015-03-21 00:00:00'),
(2, 'Juan Manuel', 'Sanchez Tovar', 'direccion cliete 2', '12345', 'España', 'empresa cliete2', 'cliente2@hotmail.com', 'cliente2', '', 0, '2015-03-22 00:00:00'),
(3, 'cliente tres', 'apellido cliente tres', 'dir cliente tres', '333', 'Colombiano', 'Ninguna', 'cliente3@gmail.com', 'cliente3{45892fad9f2b77747ab81a4a9fec97cf}', '45892fad9f2b77747ab81a4a9fec97cf', 0, '2015-04-09 23:56:25'),
(4, 'cliente cuatro', 'apellido cliente cuatro', '444', 'aaa', 'Peru', 'Viajes', 'cliente4@hotmail.com', '4{e72bc07db51090dab869af35667da5af}', 'e72bc07db51090dab869af35667da5af', 0, '2015-04-10 00:22:49'),
(7, 'cliente5', 'ap cliente5', '555', '555', 'Chileno', 'No', 'cliente5@gmail.com', 'cliente5{3a8328c46003a1dae140277954a072cf}', '3a8328c46003a1dae140277954a072cf', 1, '2015-04-10 06:55:36'),
(8, 'cliente prueba', 'prueba', '1111111', '111', 'Colombiano', 'no', 'prueba@prueba.com', 'prueba{d8c2647148b7d33f96d5d75ab21b7081}', 'd8c2647148b7d33f96d5d75ab21b7081', 1, '2015-04-13 17:03:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
`idcomentarios` int(11) NOT NULL,
  `calificacion` int(11) NOT NULL,
  `comentario` longtext NOT NULL,
  `fecha` datetime NOT NULL,
  `cliente_idcliente` int(11) DEFAULT NULL,
  `paquete_turistico_idpaquete_turistico` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad_alim`
--

CREATE TABLE IF NOT EXISTS `disponibilidad_alim` (
`id_disp_alim` int(11) NOT NULL,
  `desde` datetime NOT NULL,
  `hasta` datetime NOT NULL,
  `estado` varchar(100) NOT NULL,
  `id_serv_alim` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `disponibilidad_alim`
--

INSERT INTO `disponibilidad_alim` (`id_disp_alim`, `desde`, `hasta`, `estado`, `id_serv_alim`) VALUES
(4, '2015-10-07 00:00:00', '2015-10-09 00:00:00', 'no disponible', 3),
(5, '2015-10-07 00:00:00', '2015-10-08 00:00:00', 'no disponible', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad_alo`
--

CREATE TABLE IF NOT EXISTS `disponibilidad_alo` (
`id_disp_alo` int(11) NOT NULL,
  `desde` datetime NOT NULL,
  `hasta` datetime NOT NULL,
  `estado` varchar(100) NOT NULL,
  `id_serv_alo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad_excu`
--

CREATE TABLE IF NOT EXISTS `disponibilidad_excu` (
`id_disp_excu` int(11) NOT NULL,
  `desde` datetime NOT NULL,
  `hasta` datetime NOT NULL,
  `estado` varchar(100) NOT NULL,
  `id_serv_excu` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `disponibilidad_excu`
--

INSERT INTO `disponibilidad_excu` (`id_disp_excu`, `desde`, `hasta`, `estado`, `id_serv_excu`) VALUES
(1, '2015-09-25 00:00:00', '2015-09-25 00:00:00', 'no disponible', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad_vehi`
--

CREATE TABLE IF NOT EXISTS `disponibilidad_vehi` (
`id_disp_vehi` int(11) NOT NULL,
  `desde` datetime NOT NULL,
  `hasta` datetime NOT NULL,
  `estado` varchar(100) NOT NULL,
  `id_serv_vehi` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `disponibilidad_vehi`
--

INSERT INTO `disponibilidad_vehi` (`id_disp_vehi`, `desde`, `hasta`, `estado`, `id_serv_vehi`) VALUES
(1, '2015-09-25 00:00:00', '2015-09-25 00:00:00', 'no disponible', 1),
(2, '2015-09-24 00:00:00', '2015-09-26 00:00:00', 'no disponible', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad_vuel`
--

CREATE TABLE IF NOT EXISTS `disponibilidad_vuel` (
`id_disp_vuel` int(11) NOT NULL,
  `desde` datetime NOT NULL,
  `hasta` datetime NOT NULL,
  `estado` varchar(100) NOT NULL,
  `id_serv_vuel` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `disponibilidad_vuel`
--

INSERT INTO `disponibilidad_vuel` (`id_disp_vuel`, `desde`, `hasta`, `estado`, `id_serv_vuel`) VALUES
(1, '2015-09-25 00:00:00', '2015-09-25 00:00:00', 'no disponible', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE IF NOT EXISTS `factura` (
`idfactura` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `fecha_emision` datetime NOT NULL,
  `fecha_cobro` datetime NOT NULL,
  `valor` double NOT NULL,
  `iva` double NOT NULL,
  `total` double NOT NULL,
  `reserva_idreserva` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intinerario_reserva`
--

CREATE TABLE IF NOT EXISTS `intinerario_reserva` (
`id_intinerario` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `nombre_servicio` varchar(100) NOT NULL,
  `detalles` longtext NOT NULL,
  `duracion` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `descuento` int(11) NOT NULL,
  `precio_servicio` double NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_reserva` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `intinerario_reserva`
--

INSERT INTO `intinerario_reserva` (`id_intinerario`, `nombre_producto`, `nombre_servicio`, `detalles`, `duracion`, `fecha_inicio`, `fecha_fin`, `descuento`, `precio_servicio`, `id_proveedor`, `id_reserva`) VALUES
(1, 'Hotel San Martin', 'Suite Presidencial', 'En el primer piso podrás disfrutar de:\r\n\r\nLobby\r\nDos salas de diferente ambiente\r\nBar\r\nCocina completamente dotada\r\nBaño social\r\n1 Habitación sencilla con baño privado, minibar, Tv Led.\r\nLa mejor vista de la ciudad desde la terraza en donde ademas podrás realizar tus reuniones privadas con capacidad de hasta 30 personas.\r\n\r\nEn el segundo piso:\r\n\r\n2 Habitaciones con cama king size, Tv Led 40’, baño, jacuzzi, vestier, balcón exterior, wifi, cajilla de seguridad y minibar.\r\n1 Habitación sencilla con Tv Led y baño.', 3, '2015-09-01 00:00:00', '2015-09-04 00:00:00', 0, 100000, 6, 1),
(2, 'Hotel San Martin', 'Suite San Martín', 'Disfrutarás en el primer piso de:\r\n\r\nSala\r\nComedor\r\nCocina completamente dotada\r\nBaño\r\nVista del norte de la ciudad\r\nWifi\r\n\r\nEl segundo nivel cuenta con dos habitaciones, cada una de ellas con:\r\n\r\nCama King Size\r\nTv Led de 42?\r\nBaño con jacuzzi\r\nVestier\r\nEscritorio', 0, '2015-09-01 00:00:00', '2015-09-03 00:00:00', 0, 150000, 6, 1),
(3, 'Hotel San Martin', 'Suite Presidencial', 'En el primer piso podrás disfrutar de:\r\n\r\nLobby\r\nDos salas de diferente ambiente\r\nBar\r\nCocina completamente dotada\r\nBaño social\r\n1 Habitación sencilla con baño privado, minibar, Tv Led.\r\nLa mejor vista de la ciudad desde la terraza en donde ademas podrás realizar tus reuniones privadas con capacidad de hasta 30 personas.\r\n\r\nEn el segundo piso:\r\n\r\n2 Habitaciones con cama king size, Tv Led 40’, baño, jacuzzi, vestier, balcón exterior, wifi, cajilla de seguridad y minibar.\r\n1 Habitación sencilla con Tv Led y baño.', 0, '2015-09-01 00:00:00', '2015-09-04 00:00:00', 0, 100000, 6, 1),
(4, 'Asadero Pio Pio', 'Lengua a la criolla', 'Suspendisse at libero porttitor nisi aliquet vulputate vitae at velit. Aliquam eget arcu magna, vel congue dui. Nunc auctor mauris tempor leo aliquam vel porta ante sodales. Nulla facilisi. In accumsan mattis odio vel luctus.\r\n\r\nAenean vehicula vehicula aliquam. Aliquam lobortis cursus erat, in dictum neque suscipit id. In eget ante massa. Mauris ut mauris vel libero sagittis congue. Aenean id turpis lectus. Duis eget consequat velit. Suspendisse cursus nulla vel eros blandit placerat. Aliquam volutpat justo sit amet dui sollicitudin eget interdum nibh gravida. Cras nec placerat libero. Cras id risus sem. Maecenas sit amet ligula turpis, malesuada convallis dui. Ut ligula lorem, vestibulum sit amet fringilla lobortis, posuere at odio. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer egestas lectus egestas erat convallis et eleifend sapien tempor. Nulla aliquam nisi sed lorem rhoncus ut adipiscing leo semper. Vestibulum sit amet libero ante, a porta augue. Morbi ornare, leo a tristique rutrum, arcu nulla ornare purus, et pharetra tortor lectus at lectus. Cras congue rhoncus eros et facilisis. Maecenas vehicula pretium turpis, in volutpat mauris imperdiet vel. Nulla facilisi. Sed at justo sem, at iaculis ligula. Phasellus ligula tortor, porttitor in imperdiet et, dignissim in metus. Etiam vitae lorem at felis porta auctor. Nullam semper pharetra gravida.', 0, '2015-09-01 00:00:00', '2015-09-02 00:00:00', 0, 16500, 1, 1),
(5, 'Hotel San Martin', 'Máster Suite', 'En el primer nivel encontrará:\r\n\r\nSala-comedor\r\nCocina dotada\r\n\r\nEn el segundo nivel encontrará:\r\n\r\nCama King Size\r\nBaño con jacuzzi\r\nTv Led de 42?\r\nMinicomponente\r\nJacuzzi\r\nAmplio closet\r\nEscritorio', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 80000, 6, 2),
(6, 'Asadero Pio Pio', 'Lengua a la criolla', 'Suspendisse at libero porttitor nisi aliquet vulputate vitae at velit. Aliquam eget arcu magna, vel congue dui. Nunc auctor mauris tempor leo aliquam vel porta ante sodales. Nulla facilisi. In accumsan mattis odio vel luctus.\r\n\r\nAenean vehicula vehicula aliquam. Aliquam lobortis cursus erat, in dictum neque suscipit id. In eget ante massa. Mauris ut mauris vel libero sagittis congue. Aenean id turpis lectus. Duis eget consequat velit. Suspendisse cursus nulla vel eros blandit placerat. Aliquam volutpat justo sit amet dui sollicitudin eget interdum nibh gravida. Cras nec placerat libero. Cras id risus sem. Maecenas sit amet ligula turpis, malesuada convallis dui. Ut ligula lorem, vestibulum sit amet fringilla lobortis, posuere at odio. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer egestas lectus egestas erat convallis et eleifend sapien tempor. Nulla aliquam nisi sed lorem rhoncus ut adipiscing leo semper. Vestibulum sit amet libero ante, a porta augue. Morbi ornare, leo a tristique rutrum, arcu nulla ornare purus, et pharetra tortor lectus at lectus. Cras congue rhoncus eros et facilisis. Maecenas vehicula pretium turpis, in volutpat mauris imperdiet vel. Nulla facilisi. Sed at justo sem, at iaculis ligula. Phasellus ligula tortor, porttitor in imperdiet et, dignissim in metus. Etiam vitae lorem at felis porta auctor. Nullam semper pharetra gravida.', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 16500, 1, 2),
(7, 'Canopy las Ardillas', 'Zona de Vertigo', 'La emoción no se detiene en el canopy, continúa en los juegos de equilibrio sobre cinco desafiantes puentes colgantes para un recorrido de 155 metros, que te exigirán fuerza, destreza y resistencia para sobrepasarlos.  Son los ideales para quienes les gusta asumir retos.', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 15000, 7, 2),
(8, 'Canopy las Ardillas', 'Buseta', 'transportadora del terminal de Popayan', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 3000, 7, 2),
(9, 'Avianca', 'Avianca', 'Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles. Si vas a utilizar un pasaje de Lorem Ipsum, necesitás estar seguro de que no hay nada avergonzante escondido en el medio del texto. Todos los generadores de Lorem Ipsum que se encuentran en Internet tienden a repetir trozos predefinidos cuando sea necesario, haciendo a este el único generador verdadero (válido) en la Internet. Usa un diccionario de mas de 200 palabras provenientes del latín, combinadas con estructuras muy útiles de sentencias, para generar texto de Lorem Ipsum que parezca razonable. Este Lorem Ipsum generado siempre estará libre de repeticiones, humor agregado o palabras no características del lenguaje, etc.', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 200000, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE IF NOT EXISTS `municipio` (
`idmunicipio` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` longtext
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`idmunicipio`, `nombre`, `descripcion`) VALUES
(1, 'Popayan', NULL),
(2, 'Timbio', NULL),
(3, 'Piendamo', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operador`
--

CREATE TABLE IF NOT EXISTS `operador` (
`idoperador` int(11) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `direccion` longtext,
  `telefono` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `operador`
--

INSERT INTO `operador` (`idoperador`, `nombres`, `apellidos`, `direccion`, `telefono`, `email`, `Password`, `salt`) VALUES
(1, 'Operador Nombre', 'Operador Apellido', '111111', '123456', 'operador1@gmail.com', 'operador1', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete_turistico`
--

CREATE TABLE IF NOT EXISTS `paquete_turistico` (
`idpaquete_turistico` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `preciototal` double NOT NULL,
  `creadocliente` tinyint(1) NOT NULL,
  `creador` int(11) NOT NULL,
  `municipio_idmunicipio` int(11) DEFAULT NULL,
  `descripcion` longtext,
  `detalles` longtext,
  `estado` varchar(100) NOT NULL,
  `plazas` int(11) NOT NULL,
  `reservas` int(11) NOT NULL,
  `observaciones` longtext,
  `fecha_creacion` datetime NOT NULL,
  `duracion` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_cierre` datetime NOT NULL,
  `fecha_expiracion` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paquete_turistico`
--

INSERT INTO `paquete_turistico` (`idpaquete_turistico`, `nombre`, `foto`, `preciototal`, `creadocliente`, `creador`, `municipio_idmunicipio`, `descripcion`, `detalles`, `estado`, `plazas`, `reservas`, `observaciones`, `fecha_creacion`, `duracion`, `fecha_inicio`, `fecha_cierre`, `fecha_expiracion`) VALUES
(1, 'Paquete Prueba 1', 'paquete1.jpg', 150000, 0, 1, 3, '\r\nEs un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo "Contenido aquí, contenido aquí". Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de "Lorem Ipsum" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).', NULL, 'Aprobado', 1, 0, NULL, '2015-05-04 00:00:00', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-10 00:00:00'),
(2, 'Paquete Prueba 2', 'paquete2.jpg', 563000, 1, 1, 1, 'Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles. Si vas a utilizar un pasaje de Lorem Ipsum, necesitás estar seguro de que no hay nada avergonzante escondido en el medio del texto. Todos los generadores de Lorem Ipsum que se encuentran en Internet tienden a repetir trozos predefinidos cuando sea necesario, haciendo a este el único generador verdadero (válido) en la Internet. Usa un diccionario de mas de 200 palabras provenientes del latín, combinadas con estructuras muy útiles de sentencias, para generar texto de Lorem Ipsum que parezca razonable. Este Lorem Ipsum generado siempre estará libre de repeticiones, humor agregado o palabras no características del lenguaje, etc.', NULL, 'Pendiente', 1, 0, NULL, '2015-05-03 00:00:00', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-10 00:00:00'),
(3, 'Paquete Prueba 3', 'sitpac-554b7f7ab6fd4-foto1.jpg', 600000, 1, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis quam non eros tincidunt, in bibendum mauris tincidunt. Aliquam dignissim, turpis et egestas dignissim, arcu ante lacinia elit, eget pellentesque orci quam non dolor. Integer lacinia velit non neque porttitor, ac vehicula lacus maximus. Curabitur congue mi congue odio molestie semper. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dictum euismod tellus id consectetur. Aliquam lacinia consectetur urna, quis laoreet lorem tempus eget. Suspendisse commodo suscipit fringilla.', NULL, 'Solicitud registro', 1, 0, NULL, '2015-05-07 17:06:33', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-10 00:00:00'),
(4, 'Paquete Prueba 4', 'sitpac-554b8187b11a8-foto1.jpg', 0, 0, 0, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis quam non eros tincidunt, in bibendum mauris tincidunt. Aliquam dignissim, turpis et egestas dignissim, arcu ante lacinia elit, eget pellentesque orci quam non dolor. Integer lacinia velit non neque porttitor, ac vehicula lacus maximus. Curabitur congue mi congue odio molestie semper. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dictum euismod tellus id consectetur. Aliquam lacinia consectetur urna, quis laoreet lorem tempus eget. Suspendisse commodo suscipit fringilla.', NULL, 'Solicitud registro', 5, 0, NULL, '2015-05-07 17:15:18', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-10 00:00:00'),
(5, 'Paquete Prueba 5', 'sitpac-554b8219e1b77-foto1.jpg', 0, 0, 0, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis quam non eros tincidunt, in bibendum mauris tincidunt. Aliquam dignissim, turpis et egestas dignissim, arcu ante lacinia elit, eget pellentesque orci quam non dolor. Integer lacinia velit non neque porttitor, ac vehicula lacus maximus. Curabitur congue mi congue odio molestie semper. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dictum euismod tellus id consectetur. Aliquam lacinia consectetur urna, quis laoreet lorem tempus eget. Suspendisse commodo suscipit fringilla.', NULL, 'Solicitud registro', 5, 0, NULL, '2015-05-07 17:17:44', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-10 00:00:00'),
(6, 'Paquete Prueba 6', 'sitpac-554b82c6a0178-foto1.jpg', 0, 0, 0, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, 'Solicitud registro', 5, 0, NULL, '2015-05-07 17:20:37', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-10 00:00:00'),
(7, 'Paquete Prueba 7', 'sitpac-554b84d2627b6-foto1.jpg', 0, 0, 0, 1, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, 'Solicitud registro', 5, 0, NULL, '2015-05-07 17:29:21', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-10 00:00:00'),
(8, 'Paquete Prueba 8', 'sitpac-554b8543a079f-foto1.jpg', 0, 0, 1, 1, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, 'Pendiente', 5, 0, NULL, '2015-05-07 17:31:14', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-10 00:00:00'),
(9, 'Paquete Prueba 9', 'sitpac-554b869a77577-foto1.jpg', 175000, 0, 1, 1, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures', NULL, 'Pendiente', 5, 0, NULL, '2015-05-07 17:36:57', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-10 00:00:00'),
(10, 'Paquete Prueba 10', 'sitpac-554b873138727-foto1.jpg', 0, 0, 0, 1, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures', NULL, 'Pendiente', 5, 0, NULL, '2015-05-07 17:39:28', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-10 00:00:00'),
(11, 'Paquete Prueba 11', 'sitpac-554b89375ca3c-foto1.jpg', 0, 0, 0, 3, 'Maecenas sit amet porta est, sit amet sodales tellus. Fusce molestie nunc ut ex congue, eget dictum est vestibulum. Vestibulum eleifend orci non orci bibendum, vel efficitur nisi mollis. Vivamus scelerisque condimentum vulputate. Aliquam nec odio nec dolor rutrum hendrerit nec eget nisi. Mauris in risus et quam rhoncus mattis id vitae turpis. Donec nulla justo, ullamcorper sit amet dui et, aliquam dapibus mi. Integer tincidunt id nunc non fringilla. Sed hendrerit erat in eros euismod lobortis. Maecenas commodo lorem ut tortor ultricies lobortis. Praesent in tincidunt mi, nec fringilla mauris.', NULL, 'Aprobado', 5, 0, NULL, '2015-05-07 17:48:06', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-10 00:00:00'),
(12, 'Paquete Prueba 12', 'sitpac-554ba53429c8a-foto1.jpg', 50000, 0, 0, 1, 'Maecenas sit amet porta est, sit amet sodales tellus. Fusce molestie nunc ut ex congue, eget dictum est vestibulum. Vestibulum eleifend orci non orci bibendum, vel efficitur nisi mollis. Vivamus scelerisque condimentum vulputate. Aliquam nec odio nec dolor rutrum hendrerit nec eget nisi. Mauris in risus et quam rhoncus mattis id vitae turpis. Donec nulla justo, ullamcorper sit amet dui et, aliquam dapibus mi. Integer tincidunt id nunc non fringilla. Sed hendrerit erat in eros euismod lobortis. Maecenas commodo lorem ut tortor ultricies lobortis. Praesent in tincidunt mi, nec fringilla mauris.', NULL, 'Aprobado', 5, 0, NULL, '2015-05-07 19:47:31', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-10 00:00:00'),
(13, 'Paquete Prueba 13', 'sitpac-554bb1947a9cf-foto1.jpg', 916500, 0, 1, 1, 'Phasellus pretium, enim vitae vehicula fermentum, purus velit semper enim, vitae tempor nibh massa quis augue. Donec dapibus sed quam non tincidunt. Vestibulum et est fringilla, interdum purus et, ultrices mi. Morbi pharetra tempus congue. Sed vel lacus et lectus ullamcorper volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus et nibh sed erat ultricies tempus ac pulvinar urna. Duis sed erat nec lorem ultricies auctor. Nulla sed vestibulum eros. Proin rhoncus tincidunt fermentum. Pellentesque suscipit euismod risus, vel tristique turpis maximus eget. Donec libero purus, laoreet blandit dapibus vel, fermentum eu metus. Praesent molestie euismod tristique.', NULL, 'Aprobado', 5, 0, NULL, '2015-05-07 20:40:19', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-10 00:00:00'),
(14, 'Paquete cliente prueba', '', 491500, 1, 1, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi et venenatis leo. Curabitur quis sem sit amet turpis fringilla finibus et cursus lorem. Maecenas eu est et felis laoreet dictum eget eu nunc. Sed ut feugiat augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac odio commodo, condimentum massa semper, convallis augue. Duis sed laoreet nibh. Nunc a magna quis odio ullamcorper posuere. Morbi facilisis dolor a mi viverra aliquet nec eget metus. Phasellus condimentum eget magna eget molestie. Praesent ultricies malesuada dui. Mauris sodales dictum tortor, eget congue nunc maximus a. Integer lacinia vulputate eros, in ultricies augue luctus non. Proin tincidunt mauris accumsan, lacinia justo vel, placerat tellus.', NULL, 'Solicitud registro', 1, 0, NULL, '2015-05-09 15:44:44', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-10 00:00:00'),
(15, 'paquete cliente nuevo', '', 449500, 1, 1, 1, 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', NULL, 'Solicitud registro', 1, 0, NULL, '2015-05-10 20:08:52', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-10 00:00:00'),
(16, 'Paquete Hotel Monasterio', 'sitpac-55623d25ebc75-foto1.jpg', 616500, 0, 1, 1, '¡Como lo buscas! Bienvenido al Hotel Dann Monasterio Popayán, símbolo de la llamada Ciudad Blanca de Colombia: un antiguo convento franciscano de 1570 y arquitectura colonial española transformado en un hotel de lujo de la más alta calidad.\r\n\r\nCon su elegancia clásica y su emblemático pasado, este hotel de lujo en Popayán es una experiencia en sí mismo, un viaje al pasado, una estadía mágica en el corazón de una de las ciudades históricas de Colombia sin renunciar a los servicios más modernos.\r\n\r\nPatio interior, piscina, restaurante, desayuno americano, sauna y turco, gimnasio… Descanse en hotel de lujo en Popayán y déjese llevar por la belleza y elegancia de la memoria.', NULL, 'Solicitud registro', 5, 0, NULL, '2015-05-24 23:05:41', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-10 00:00:00'),
(17, 'vacaciones', 'sitpac-55f83c5debbd9-foto1.jpg', 0, 1, 0, 1, 'gmgmgmgmjg', 'gffhfnhf', 'Solicitud Registro', 0, 0, NULL, '2015-09-15 17:42:20', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-10 00:00:00'),
(18, 'Prueba cliente 18', NULL, 516500, 1, 1, 1, NULL, NULL, 'Creando', 0, 0, NULL, '2015-10-02 22:44:02', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-10 00:00:00'),
(19, 'Prueba cliente 19', NULL, 334500, 1, 1, 1, 'descripcion', NULL, 'Creando', 0, 0, NULL, '2015-10-02 23:05:00', 4, '2015-12-01 00:00:00', '2015-12-05 00:00:00', '2015-12-11 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pqr`
--

CREATE TABLE IF NOT EXISTS `pqr` (
`idpqr` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `descripcion` longtext NOT NULL,
  `fecha` datetime NOT NULL,
  `cliente_idcliente` int(11) DEFAULT NULL,
  `paquete_turistico_idpaquete_turistico` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
`idproducto` int(11) NOT NULL,
  `tipo_producto` varchar(100) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `descripcion` longtext NOT NULL,
  `detalles` longtext,
  `estado` varchar(100) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `categoria` int(11) DEFAULT NULL,
  `proveedor_idproveedor` int(11) DEFAULT NULL,
  `observaciones` longtext
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `tipo_producto`, `nombre`, `foto`, `descripcion`, `detalles`, `estado`, `fecha_creacion`, `categoria`, `proveedor_idproveedor`, `observaciones`) VALUES
(1, 'Alojamiento', 'Hotel San Martin', 'sanmartin.jpg', 'De la ciudad histórica, culta y de tradiciones nace para Colombia y el Mundo, el hotel más moderno y grande de la ciudad blanca, el HOTEL SAN MARTÍN POPAYÁN.\r\n\r\nProporciona una autentica y moderna experiencia para nuestros clientes en la “ciudad blanca”. Ubicados al norte de la ciudad, en una de las zonas más exclusivas y seguras; a 5 minutos del Aeropuerto Guillermo León Valencia y del centro comercial Campanario y a tan sólo 10 minutos del sector histórico.\r\n\r\nLa ciudad de Popayán o también llamada La Jerusalén del nuevo continente es una ciudad antigua llena de historia, cultura y tradiciones.', NULL, 'Creando', '2015-04-25 00:00:00', 5, 6, NULL),
(2, 'Alimentacion', 'Asadero Pio Pio', 'sitpac-55402d45a0153-foto1.jpg', 'En 1971 los hermanos Antonio y Leonardo Fernández, resolvieron abrir un restaurante y vender de forma directa la producción de pollo de una finca avícola de su familia, situada al oriente de Popayán, en cercanías al Molino de Moscopán, en Fucha. Los nuevos socios establecieron su negocio en un pequeño local, ubicado en la calle 6 # 8-11, al lado del afamado Sotareño, en el que instalaron cuatro mesas y 16 sillas. Su formato inicial era nocturno y de fines de semana. Pronto el Asadero PIO PIO se hizo conocer. Era usual que quienes salían de discotecas pasaran a PIO PIO a tomar consomé, comer pollo y seguir su camino a casa.', NULL, 'Creando', '2015-04-29 03:00:51', 5, 1, NULL),
(3, 'Excursion', 'Canopy las Ardillas', 'sitpac-554265d305c2c-foto1.jpg', 'Para CANOPY LAS ARDILLAS es muy grato ofrecerles un nuevo atractivo Eco Turístico, el primero en el departamento del Cauca y una opción diferente a las necesidades de recreación de propios y foráneos.\r\n \r\nVen y siente la magia de volar entre árboles en el CANOPY LAS ARDILLAS, un espacio de AVENTURA EXTREMA creado especialmente para ti, donde podrás disfrutar de 6 recorridos en el aire y contemplar el relieve generoso de la finca La Carolina, vestido de pastizales, guaduales, robledales, cultivos de caña de azúcar, yuca y frutales en medio de cañadas y ganado vacuno.\r\n \r\nTambién podrás disfrutar del muro de escalar, la zona de vértigo con 5 desafiantes puentes colgantes y una caminata por nuestro sendero ecológico, rumbo al rio La Honda donde podrás practicar Neumating.\r\n\r\nEsto y mucho más, te espera en Canopy las Ardillas!', NULL, 'Creando', '2015-04-30 19:26:42', 5, 7, NULL),
(4, 'Vuelo', 'Avianca', 'sitpac-5542ef1fb2a4a-foto1.jpg', 'AVIANCA S. A., es la principal aerolínea de Colombia. Fundada el 5 de diciembre de 1919 bajo el nombre SCADTA, es la compañía aérea más antigua de América y la segunda más antigua en el mundo.\r\n\r\nDirector ejecutivo: Fabio Villegas Ramírez\r\nFundadores: Rafael Palacio, Aristides Noguera, Jacobo Correa', NULL, 'Creando', '2015-05-01 05:12:30', 5, 2, NULL),
(5, 'Transporte', 'prueba transporte', 'sitpac-55456fd27d414-foto1.jpg', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', NULL, 'Solicitud Registro', '2015-05-02 20:56:00', 1, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
`idproveedor` int(11) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `direccion` longtext NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `documentos` varchar(255) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `observaciones` longtext
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idproveedor`, `nombres`, `apellidos`, `empresa`, `direccion`, `telefono`, `fax`, `email`, `password`, `salt`, `fecha_alta`, `documentos`, `estado`, `observaciones`) VALUES
(1, 'Francisco', 'Fernandez Rojas', 'empresa', '11111', '11111', '123', 'proveedor1@gmail.com', 'proveedor1{8c355cd0a36a4584594db08fc67c0c48}', '8c355cd0a36a4584594db08fc67c0c48', '2015-04-15 00:57:03', 'C:\\xampp\\tmp\\php2A.tmp', 'Aprobado', NULL),
(2, 'nombre2', 'apellido2', 'empresa2', '222222', '222222', '321', 'proveedor2@gmail.com', 'proveedor2{a22e4f92a9082732d5f51044c35ba395}', 'a22e4f92a9082732d5f51044c35ba395', '2015-04-16 04:08:36', 'C:\\xampp\\tmp\\phpB441.tmp', 'Aprobado', NULL),
(3, 'nombre3', 'apellido3', 'empresa3', '333333', '333333', '333', 'proveedor3@gmail.com', 'proveedor3{00f43ab14ee63d66fccb891ba106992e}', '00f43ab14ee63d66fccb891ba106992e', '2015-04-16 04:40:19', 'C:\\xampp\\tmp\\phpB974.tmp', 'Pendiente', NULL),
(4, 'nombre4', 'apellido4', 'empresa4', '444444', '444444', '444', 'proveedor4@gmail.com', 'proveedor4{0dbb6b632af0dfec02298d1d60d856bd}', '0dbb6b632af0dfec02298d1d60d856bd', '2015-04-16 06:30:43', 'C:\\xampp\\tmp\\phpD8D9.tmp', 'Aprobado', NULL),
(5, 'nombre5', 'apellido5', 'empresa5', '555555', '555555', '555', 'proveedor5@gmail.com', 'proveedor5{98ac1709d9cc247fd9885d5f7a0ad782}', '98ac1709d9cc247fd9885d5f7a0ad782', '2015-04-16 06:52:51', 'C:\\xampp\\tmp\\php1C5E.tmp', 'Solicitud registro', NULL),
(6, 'proveedor6', 'apellido6', 'empresa6', '123456', '123456', '654', 'proveedor6@gmail.com', 'proveedor6{cd6ccfbc0fe377709833d6ab1daa1ffb}', 'cd6ccfbc0fe377709833d6ab1daa1ffb', '2015-04-17 06:37:38', 'SistemaIndicadores.pdf', 'Aprobado', NULL),
(7, 'prov 7', 'apellido 7', 'la 7', '1234567', '777', '777', 'proveedor7@gmail.com', 'proveedor7{44fe157c51ddb68471f4b0a4c0493a42}', '44fe157c51ddb68471f4b0a4c0493a42', '2015-04-30 19:14:05', 'CD-0275.pdf', 'Aprobado', NULL),
(8, 'prov 8', 'apellido 8', 'empresa8', '88888888', '12345678', '888', 'proveedor8@gmail.com', 'proveedor8{8d47ee349040dc0cb5aeac64714cec37}', '8d47ee349040dc0cb5aeac64714cec37', '2015-05-01 04:34:57', 'CD-0275.pdf', 'Solicitud registro', NULL),
(9, 'prov 9', 'apellido 9', 'empresa9', '99999999', '987654321', '999', 'proveedor9@gmail.com', 'proveedor9{1ca568943540a9a73f912cf7501332c1}', '1ca568943540a9a73f912cf7501332c1', '2015-05-01 04:44:00', 'sitpac-5542e8720d550-documento1.pdf', 'Solicitud registro', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE IF NOT EXISTS `reserva` (
`idreserva` int(11) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `origen` varchar(100) NOT NULL,
  `adultos` int(11) NOT NULL,
  `ninos` int(11) NOT NULL,
  `nombre_paquete` varchar(100) NOT NULL,
  `descripcion` longtext NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_cierre` datetime NOT NULL,
  `duracion` int(11) NOT NULL,
  `precio_paquete` double NOT NULL,
  `precio_total` double NOT NULL,
  `estado` varchar(100) NOT NULL,
  `fecha_reservado` datetime NOT NULL,
  `fecha_expiracion` datetime NOT NULL,
  `paquete_turistico_idpaquete_turistico` int(11) DEFAULT NULL,
  `cliente_idcliente` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`idreserva`, `nombre_cliente`, `origen`, `adultos`, `ninos`, `nombre_paquete`, `descripcion`, `fecha_inicio`, `fecha_cierre`, `duracion`, `precio_paquete`, `precio_total`, `estado`, `fecha_reservado`, `fecha_expiracion`, `paquete_turistico_idpaquete_turistico`, `cliente_idcliente`) VALUES
(1, 'Jorge Armando Ibarra Palacios', 'Bogota', 2, 0, 'Paquete Prueba 13', 'Phasellus pretium, enim vitae vehicula fermentum, purus velit semper enim, vitae tempor nibh massa quis augue. Donec dapibus sed quam non tincidunt. Vestibulum et est fringilla, interdum purus et, ultrices mi. Morbi pharetra tempus congue. Sed vel lacus et lectus ullamcorper volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus et nibh sed erat ultricies tempus ac pulvinar urna. Duis sed erat nec lorem ultricies auctor. Nulla sed vestibulum eros. Proin rhoncus tincidunt fermentum. Pellentesque suscipit euismod risus, vel tristique turpis maximus eget. Donec libero purus, laoreet blandit dapibus vel, fermentum eu metus. Praesent molestie euismod tristique.', '2015-12-01 00:00:00', '2015-12-05 00:00:00', 4, 916500, 1833000, 'En Reserva', '2015-10-25 02:02:48', '2015-11-04 00:00:00', 13, 1),
(2, 'Jorge Armando Ibarra Palacios', 'Cali', 1, 0, 'Paquete Prueba 1', '\r\nEs un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo "Contenido aquí, contenido aquí". Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de "Lorem Ipsum" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).', '2015-12-01 00:00:00', '2015-12-05 00:00:00', 4, 150000, 150000, 'En Reserva', '2015-10-25 02:27:38', '2015-11-04 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_alimentacion`
--

CREATE TABLE IF NOT EXISTS `servicio_alimentacion` (
`idalimentacion` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `hora` time NOT NULL,
  `direccion` longtext NOT NULL,
  `detalles` longtext,
  `precio` double NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `estado` varchar(100) NOT NULL,
  `producto_idproducto` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio_alimentacion`
--

INSERT INTO `servicio_alimentacion` (`idalimentacion`, `nombre`, `tipo`, `foto`, `hora`, `direccion`, `detalles`, `precio`, `fecha_creacion`, `estado`, `producto_idproducto`) VALUES
(1, 'Lengua a la criolla', 'Almuerzo', 'sitpac-554253f612a3b-foto1.jpg', '12:00:00', '123123123', 'Suspendisse at libero porttitor nisi aliquet vulputate vitae at velit. Aliquam eget arcu magna, vel congue dui. Nunc auctor mauris tempor leo aliquam vel porta ante sodales. Nulla facilisi. In accumsan mattis odio vel luctus.\r\n\r\nAenean vehicula vehicula aliquam. Aliquam lobortis cursus erat, in dictum neque suscipit id. In eget ante massa. Mauris ut mauris vel libero sagittis congue. Aenean id turpis lectus. Duis eget consequat velit. Suspendisse cursus nulla vel eros blandit placerat. Aliquam volutpat justo sit amet dui sollicitudin eget interdum nibh gravida. Cras nec placerat libero. Cras id risus sem. Maecenas sit amet ligula turpis, malesuada convallis dui. Ut ligula lorem, vestibulum sit amet fringilla lobortis, posuere at odio. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer egestas lectus egestas erat convallis et eleifend sapien tempor. Nulla aliquam nisi sed lorem rhoncus ut adipiscing leo semper. Vestibulum sit amet libero ante, a porta augue. Morbi ornare, leo a tristique rutrum, arcu nulla ornare purus, et pharetra tortor lectus at lectus. Cras congue rhoncus eros et facilisis. Maecenas vehicula pretium turpis, in volutpat mauris imperdiet vel. Nulla facilisi. Sed at justo sem, at iaculis ligula. Phasellus ligula tortor, porttitor in imperdiet et, dignissim in metus. Etiam vitae lorem at felis porta auctor. Nullam semper pharetra gravida.', 16500, '2015-04-30 18:10:28', 'Creando', 2),
(3, 'Combo sánwich especial', 'Almuerzo', 'sitpac-56009a3618986-foto1.jpg', '12:00:00', 'Calle 6 # 8 - 67', NULL, 9600, '2015-09-22 02:00:00', 'Creando', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_alojamiento`
--

CREATE TABLE IF NOT EXISTS `servicio_alojamiento` (
`idservicio_alojamiento` int(11) NOT NULL,
  `codigo_alojamiento` varchar(10) NOT NULL,
  `tipo_alojamiento` varchar(100) NOT NULL,
  `precio` double NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detalles` longtext,
  `fecha_creacion` datetime NOT NULL,
  `estado` varchar(100) NOT NULL,
  `producto_idproducto` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio_alojamiento`
--

INSERT INTO `servicio_alojamiento` (`idservicio_alojamiento`, `codigo_alojamiento`, `tipo_alojamiento`, `precio`, `foto`, `detalles`, `fecha_creacion`, `estado`, `producto_idproducto`) VALUES
(1, '111', 'Suite Presidencial', 100000, 'suitepresidencial.jpg', 'En el primer piso podrás disfrutar de:\r\n\r\nLobby\r\nDos salas de diferente ambiente\r\nBar\r\nCocina completamente dotada\r\nBaño social\r\n1 Habitación sencilla con baño privado, minibar, Tv Led.\r\nLa mejor vista de la ciudad desde la terraza en donde ademas podrás realizar tus reuniones privadas con capacidad de hasta 30 personas.\r\n\r\nEn el segundo piso:\r\n\r\n2 Habitaciones con cama king size, Tv Led 40’, baño, jacuzzi, vestier, balcón exterior, wifi, cajilla de seguridad y minibar.\r\n1 Habitación sencilla con Tv Led y baño.', '2015-04-26 00:00:00', 'Creando', 1),
(2, '222', 'Suite San Martín', 150000, 'suitesanmartin.jpg', 'Disfrutarás en el primer piso de:\r\n\r\nSala\r\nComedor\r\nCocina completamente dotada\r\nBaño\r\nVista del norte de la ciudad\r\nWifi\r\n\r\nEl segundo nivel cuenta con dos habitaciones, cada una de ellas con:\r\n\r\nCama King Size\r\nTv Led de 42?\r\nBaño con jacuzzi\r\nVestier\r\nEscritorio', '2015-04-26 00:00:00', 'Creando', 1),
(3, '333', 'Máster Suite', 80000, 'mastersuite.jpg', 'En el primer nivel encontrará:\r\n\r\nSala-comedor\r\nCocina dotada\r\n\r\nEn el segundo nivel encontrará:\r\n\r\nCama King Size\r\nBaño con jacuzzi\r\nTv Led de 42?\r\nMinicomponente\r\nJacuzzi\r\nAmplio closet\r\nEscritorio', '2015-04-18 00:00:00', 'Creando', 1),
(4, '444', 'Junior Suite', 60000, 'suitejunior.jpg', 'Cama King Size\r\nTv Led de 42?\r\nMini-bar\r\nRadio despertador\r\nClóset\r\nEscritorio\r\nWifi', '2015-04-14 00:00:00', 'Creando', 1),
(5, '123', 'alojamiento prueba', 120000, 'sitpac-55465e0acc71c-foto1.jpg', 'asdasdasdasd', '2015-04-30 16:38:45', 'Creando', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_excursion`
--

CREATE TABLE IF NOT EXISTS `servicio_excursion` (
`idexcursiones` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detalles` longtext,
  `precio` double NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `estado` varchar(100) NOT NULL,
  `producto_idproducto` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio_excursion`
--

INSERT INTO `servicio_excursion` (`idexcursiones`, `nombre`, `tipo`, `foto`, `detalles`, `precio`, `fecha_creacion`, `estado`, `producto_idproducto`) VALUES
(1, 'Zona de Vertigo', 'Aventura', 'sitpac-554267f346736-foto1.jpg', 'La emoción no se detiene en el canopy, continúa en los juegos de equilibrio sobre cinco desafiantes puentes colgantes para un recorrido de 155 metros, que te exigirán fuerza, destreza y resistencia para sobrepasarlos.  Son los ideales para quienes les gusta asumir retos.', 15000, '2015-04-30 19:35:46', 'Creando', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_paq_alim`
--

CREATE TABLE IF NOT EXISTS `servicio_paq_alim` (
`idservicio_paq_alim` int(11) NOT NULL,
  `fotoservicio` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `precioservicio` double NOT NULL,
  `idproducto` int(11) NOT NULL,
  `duracion` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `descuento` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `paquete_turistico_idpaquete_turistico` int(11) DEFAULT NULL,
  `servicio_alimentacion_idalimentacion` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio_paq_alim`
--

INSERT INTO `servicio_paq_alim` (`idservicio_paq_alim`, `fotoservicio`, `nombre`, `precioservicio`, `idproducto`, `duracion`, `fecha_inicio`, `fecha_fin`, `descuento`, `fecha_creacion`, `paquete_turistico_idpaquete_turistico`, `servicio_alimentacion_idalimentacion`) VALUES
(1, 'sitpac-554253f612a3b-foto1.jpg', 'Lengua a la criolla', 16500, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2015-05-06 00:00:00', 1, 1),
(2, 'sitpac-554253f612a3b-foto1.jpg', 'Lengua a la criolla', 16500, 2, 0, '2015-09-01 00:00:00', '2015-09-02 00:00:00', 0, '2015-05-09 01:21:12', 13, 1),
(3, 'sitpac-554253f612a3b-foto1.jpg', 'Lengua a la criolla', 16500, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2015-05-09 19:15:50', 14, 1),
(4, 'sitpac-554253f612a3b-foto1.jpg', 'Lengua a la criolla', 16500, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2015-05-20 20:20:02', 15, 1),
(5, 'sitpac-554253f612a3b-foto1.jpg', 'Lengua a la criolla', 16500, 2, 0, '2015-10-07 00:00:00', '2015-10-08 00:00:00', 0, '2015-05-25 01:12:28', 16, 1),
(6, 'sitpac-554253f612a3b-foto1.jpg', 'Lengua a la criolla', 16500, 2, 0, '2015-10-03 00:00:00', '2015-10-04 00:00:00', 0, '2015-10-05 04:13:10', 19, 1),
(7, 'sitpac-554253f612a3b-foto1.jpg', 'Lengua a la criolla', 16500, 2, 1, '2015-12-01 00:00:00', '2015-12-01 00:00:00', 0, '2015-10-20 22:59:41', 18, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_paq_alo`
--

CREATE TABLE IF NOT EXISTS `servicio_paq_alo` (
`idservicio_paq_alo` int(11) NOT NULL,
  `fotoservicio` varchar(255) DEFAULT NULL,
  `tiposervicio` varchar(100) NOT NULL,
  `precioservicio` double NOT NULL,
  `idproducto` int(11) NOT NULL,
  `paquete_turistico_idpaquete_turistico` int(11) DEFAULT NULL,
  `servicio_habitacion_idservicio_habitacion` int(11) DEFAULT NULL,
  `duracion` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `descuento` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio_paq_alo`
--

INSERT INTO `servicio_paq_alo` (`idservicio_paq_alo`, `fotoservicio`, `tiposervicio`, `precioservicio`, `idproducto`, `paquete_turistico_idpaquete_turistico`, `servicio_habitacion_idservicio_habitacion`, `duracion`, `fecha_inicio`, `fecha_fin`, `descuento`, `fecha_creacion`) VALUES
(1, 'mastersuite.jpg', 'Máster Suite', 80000, 1, 1, 3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2015-05-04 00:00:00'),
(2, 'suitepresidencial.jpg', 'Suite Presidencial', 100000, 1, 13, 1, 0, '2015-09-01 00:00:00', '2015-09-04 00:00:00', 0, '2015-05-08 04:01:21'),
(3, 'suitesanmartin.jpg', 'Suite San Martín', 150000, 1, 13, 2, 0, '2015-09-01 00:00:00', '2015-09-03 00:00:00', 0, '2015-05-08 04:13:30'),
(4, 'mastersuite.jpg', 'Máster Suite', 80000, 1, 9, 3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2015-05-08 04:35:52'),
(5, 'suitepresidencial.jpg', 'Suite Presidencial', 100000, 1, 2, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 50, '2015-05-08 05:24:25'),
(6, 'suitepresidencial.jpg', 'Suite Presidencial', 100000, 1, 2, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 20, '2015-05-08 06:03:15'),
(7, 'suitepresidencial.jpg', 'Suite Presidencial', 100000, 1, 2, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 50, '2015-05-08 06:14:50'),
(8, 'suitepresidencial.jpg', 'Suite Presidencial', 100000, 1, 2, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 50, '2015-05-08 06:18:42'),
(9, 'suitepresidencial.jpg', 'Suite Presidencial', 100000, 1, 13, 1, 3, '2015-09-01 00:00:00', '2015-09-04 00:00:00', 0, '2015-05-08 19:52:00'),
(10, 'suitepresidencial.jpg', 'Suite Presidencial', 100000, 1, 14, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2015-05-09 19:12:35'),
(11, 'suitepresidencial.jpg', 'Suite Presidencial', 100000, 1, 15, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2015-05-20 18:15:16'),
(12, 'suitepresidencial.jpg', 'Suite Presidencial', 100000, 1, 16, 1, 0, '2015-10-07 00:00:00', '2015-10-09 00:00:00', 50, '2015-05-25 00:38:41'),
(13, 'suitepresidencial.jpg', 'Suite Presidencial', 100000, 1, 16, 1, 0, '2015-10-09 00:00:00', '2015-10-11 00:00:00', 50, '2015-05-25 00:38:42'),
(14, 'suitepresidencial.jpg', 'Suite Presidencial', 100000, 1, 16, 1, 0, '2015-10-11 00:00:00', '2015-10-13 00:00:00', 50, '2015-05-25 00:45:15'),
(15, 'suitepresidencial.jpg', 'Suite Presidencial', 100000, 1, 16, 1, 0, '2015-10-07 00:00:00', '2015-10-09 00:00:00', 50, '2015-05-25 00:47:36'),
(16, 'suitepresidencial.jpg', 'Suite Presidencial', 100000, 1, 16, 1, 0, '2015-10-09 00:00:00', '2015-10-11 00:00:00', 50, '2015-05-25 00:54:05'),
(17, 'suitepresidencial.jpg', 'Suite Presidencial', 100000, 1, 16, 1, 0, '2015-10-12 00:00:00', '2015-10-14 00:00:00', 50, '2015-05-25 00:59:07'),
(18, 'suitesanmartin.jpg', 'Suite San Martín', 150000, 1, 3, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2015-09-15 18:04:21'),
(19, 'suitepresidencial.jpg', 'Suite Presidencial', 100000, 1, 19, 1, 0, '2015-10-03 00:00:00', '2015-10-04 00:00:00', 0, '2015-10-05 01:25:14'),
(20, 'suitepresidencial.jpg', 'Suite Presidencial', 100000, 1, 18, 1, 5, '2015-10-03 00:00:00', '2015-10-08 00:00:00', 0, '2015-10-20 05:32:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_paq_excu`
--

CREATE TABLE IF NOT EXISTS `servicio_paq_excu` (
`idservicio_paq_excu` int(11) NOT NULL,
  `fotoservicio` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `precioservicio` double NOT NULL,
  `idproducto` int(11) NOT NULL,
  `duracion` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `descuento` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `servicio_excursion_idexcursiones` int(11) DEFAULT NULL,
  `paquete_turistico_idpaquete_turistico` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio_paq_excu`
--

INSERT INTO `servicio_paq_excu` (`idservicio_paq_excu`, `fotoservicio`, `nombre`, `precioservicio`, `idproducto`, `duracion`, `fecha_inicio`, `fecha_fin`, `descuento`, `fecha_creacion`, `servicio_excursion_idexcursiones`, `paquete_turistico_idpaquete_turistico`) VALUES
(1, 'sitpac-554267f346736-foto1.jpg', 'Zona de Vertigo', 15000, 3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2015-05-06 00:00:00', 1, 1),
(2, 'sitpac-554267f346736-foto1.jpg', 'Zona de Vertigo', 15000, 3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2015-05-09 03:03:43', 1, 9),
(3, 'sitpac-554267f346736-foto1.jpg', 'Zona de Vertigo', 15000, 3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2015-05-09 19:16:47', 1, 14),
(4, 'sitpac-554267f346736-foto1.jpg', 'Zona de Vertigo', 15000, 3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2015-05-20 20:47:24', 1, 15),
(5, 'sitpac-554267f346736-foto1.jpg', 'Zona de Vertigo', 15000, 3, 0, '2015-10-03 00:00:00', '2015-10-04 00:00:00', 0, '2015-10-05 04:46:58', 1, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_paq_vehi`
--

CREATE TABLE IF NOT EXISTS `servicio_paq_vehi` (
`idservicio_paq_vehi` int(11) NOT NULL,
  `fotoservicio` varchar(255) DEFAULT NULL,
  `tiposervicio` varchar(100) NOT NULL,
  `precioservicio` double NOT NULL,
  `idproducto` int(11) NOT NULL,
  `duracion` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `descuento` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `servicio_vehiculo_idservicio_vehiculo` int(11) DEFAULT NULL,
  `paquete_turistico_idpaquete_turistico` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio_paq_vehi`
--

INSERT INTO `servicio_paq_vehi` (`idservicio_paq_vehi`, `fotoservicio`, `tiposervicio`, `precioservicio`, `idproducto`, `duracion`, `fecha_inicio`, `fecha_fin`, `descuento`, `fecha_creacion`, `servicio_vehiculo_idservicio_vehiculo`, `paquete_turistico_idpaquete_turistico`) VALUES
(1, 'sitpac-55429a899bb34-foto1.jpg', 'Buseta', 3000, 3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2015-05-06 00:00:00', 1, 1),
(2, 'sitpac-55429a899bb34-foto1.jpg', 'Buseta', 3000, 3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 50, '2015-05-09 04:23:46', 1, 2),
(3, 'sitpac-55429a899bb34-foto1.jpg', 'Buseta', 3000, 3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2015-05-09 19:18:06', 1, 14),
(4, 'sitpac-55429a899bb34-foto1.jpg', 'Buseta', 3000, 3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2015-05-20 21:22:43', 1, 15),
(5, 'sitpac-55429a899bb34-foto1.jpg', 'Buseta', 3000, 3, 0, '2015-10-03 00:00:00', '2015-10-04 00:00:00', 0, '2015-10-05 06:07:36', 1, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_paq_vuel`
--

CREATE TABLE IF NOT EXISTS `servicio_paq_vuel` (
`idservicio_paq_vuel` int(11) NOT NULL,
  `fotoservicio` varchar(255) DEFAULT NULL,
  `compania` varchar(255) NOT NULL,
  `precioservicio` double NOT NULL,
  `idproducto` int(11) NOT NULL,
  `fecha_vuelo` datetime NOT NULL,
  `descuento` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `servicio_vuelo_idservicio_vuelo` int(11) DEFAULT NULL,
  `paquete_turistico_idpaquete_turistico` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio_paq_vuel`
--

INSERT INTO `servicio_paq_vuel` (`idservicio_paq_vuel`, `fotoservicio`, `compania`, `precioservicio`, `idproducto`, `fecha_vuelo`, `descuento`, `fecha_creacion`, `servicio_vuelo_idservicio_vuelo`, `paquete_turistico_idpaquete_turistico`) VALUES
(1, 'sitpac-5542f040110fe-foto1.jpg', 'Avianca', 200000, 4, '0000-00-00 00:00:00', 0, '2015-05-06 00:00:00', 1, 1),
(2, 'sitpac-5542f040110fe-foto1.jpg', 'Avianca', 200000, 4, '0000-00-00 00:00:00', 50, '2015-05-09 06:31:31', 1, 2),
(3, 'sitpac-5542f040110fe-foto1.jpg', 'Avianca', 200000, 4, '0000-00-00 00:00:00', 0, '2015-05-09 19:19:31', 1, 14),
(4, 'sitpac-5542f040110fe-foto1.jpg', 'Avianca', 200000, 4, '0000-00-00 00:00:00', 0, '2015-05-20 21:39:04', 1, 15),
(5, 'sitpac-5542f040110fe-foto1.jpg', 'Avianca', 200000, 4, '2015-10-03 00:00:00', 0, '2015-10-05 06:42:26', 1, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_vehiculo`
--

CREATE TABLE IF NOT EXISTS `servicio_vehiculo` (
`idservicio_vehiculo` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `chofer` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `modelo` varchar(20) NOT NULL,
  `placa` varchar(15) NOT NULL,
  `origen` varchar(255) NOT NULL,
  `destino` varchar(255) NOT NULL,
  `precio` double NOT NULL,
  `detalles` longtext,
  `fecha_creacion` datetime NOT NULL,
  `estado` varchar(100) NOT NULL,
  `producto_idproducto` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio_vehiculo`
--

INSERT INTO `servicio_vehiculo` (`idservicio_vehiculo`, `tipo`, `chofer`, `foto`, `modelo`, `placa`, `origen`, `destino`, `precio`, `detalles`, `fecha_creacion`, `estado`, `producto_idproducto`) VALUES
(1, 'Buseta', 'pepito perez', 'sitpac-55429a899bb34-foto1.jpg', '1989', 'btx123', 'Popayan', 'Timbio', 3000, 'transportadora del terminal de Popayan', '2015-04-30 23:11:36', 'Creando', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_vuelo`
--

CREATE TABLE IF NOT EXISTS `servicio_vuelo` (
`idservicio_vuelo` int(11) NOT NULL,
  `compania` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `origen` varchar(255) NOT NULL,
  `hora_salida` time NOT NULL,
  `destino` varchar(255) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `precio` double NOT NULL,
  `detalles` longtext,
  `fecha_creacion` datetime NOT NULL,
  `estado` varchar(100) NOT NULL,
  `producto_idproducto` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio_vuelo`
--

INSERT INTO `servicio_vuelo` (`idservicio_vuelo`, `compania`, `foto`, `fecha`, `origen`, `hora_salida`, `destino`, `categoria`, `precio`, `detalles`, `fecha_creacion`, `estado`, `producto_idproducto`) VALUES
(1, 'Avianca', 'sitpac-5542f040110fe-foto1.jpg', '2015-04-10 00:00:00', 'Bogota', '10:00:00', 'Popayan', 'Estandar', 200000, 'Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles. Si vas a utilizar un pasaje de Lorem Ipsum, necesitás estar seguro de que no hay nada avergonzante escondido en el medio del texto. Todos los generadores de Lorem Ipsum que se encuentran en Internet tienden a repetir trozos predefinidos cuando sea necesario, haciendo a este el único generador verdadero (válido) en la Internet. Usa un diccionario de mas de 200 palabras provenientes del latín, combinadas con estructuras muy útiles de sentencias, para generar texto de Lorem Ipsum que parezca razonable. Este Lorem Ipsum generado siempre estará libre de repeticiones, humor agregado o palabras no características del lenguaje, etc.', '2015-05-01 05:17:18', 'Creando', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE IF NOT EXISTS `solicitudes` (
`id_solicitud` int(11) NOT NULL,
  `descripcion` longtext NOT NULL,
  `respuesta` longtext,
  `estado` varchar(100) NOT NULL,
  `solicitante` int(11) NOT NULL,
  `id_elemento` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id_solicitud`, `descripcion`, `respuesta`, `estado`, `solicitante`, `id_elemento`) VALUES
(1, 'prueba de solicitud 1 de retiro de un proveedor', NULL, 'Solicitud retiro proveedor', 1, 1),
(2, 'prueba 1 Actualización producto', NULL, 'Solicitud actualizacion producto', 1, 2),
(3, 'prueba 1 de solicitud de retiro de producto', NULL, 'Solicitud retiro producto', 1, 1),
(4, 'prueba 1 actualizacion alojamiento', NULL, 'Solicitud actualizacion alojamiento', 6, 5),
(5, 'prueba 1 solicitud retiro alojamiento', NULL, 'Solicitud retiro alojamiento', 6, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
 ADD PRIMARY KEY (`idcliente`), ADD UNIQUE KEY `UNIQ_3BA1A2B9E7927C74` (`email`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
 ADD PRIMARY KEY (`idcomentarios`), ADD KEY `fk_comentarios_cliente1_idx` (`cliente_idcliente`), ADD KEY `fk_comentarios_paquete_turistico1_idx` (`paquete_turistico_idpaquete_turistico`);

--
-- Indices de la tabla `disponibilidad_alim`
--
ALTER TABLE `disponibilidad_alim`
 ADD PRIMARY KEY (`id_disp_alim`), ADD KEY `fk_disponibilidad_alim_idx` (`id_serv_alim`);

--
-- Indices de la tabla `disponibilidad_alo`
--
ALTER TABLE `disponibilidad_alo`
 ADD PRIMARY KEY (`id_disp_alo`), ADD KEY `fk_disponibilidad_alo_idx` (`id_serv_alo`);

--
-- Indices de la tabla `disponibilidad_excu`
--
ALTER TABLE `disponibilidad_excu`
 ADD PRIMARY KEY (`id_disp_excu`), ADD KEY `fk_disponibilidad_excu_idx` (`id_serv_excu`);

--
-- Indices de la tabla `disponibilidad_vehi`
--
ALTER TABLE `disponibilidad_vehi`
 ADD PRIMARY KEY (`id_disp_vehi`), ADD KEY `fk_disponibilidad_vehi_idx` (`id_serv_vehi`);

--
-- Indices de la tabla `disponibilidad_vuel`
--
ALTER TABLE `disponibilidad_vuel`
 ADD PRIMARY KEY (`id_disp_vuel`), ADD KEY `fk_disponibilidad_vuel_idx` (`id_serv_vuel`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
 ADD PRIMARY KEY (`idfactura`), ADD KEY `fk_factura_reserva1_idx` (`reserva_idreserva`);

--
-- Indices de la tabla `intinerario_reserva`
--
ALTER TABLE `intinerario_reserva`
 ADD PRIMARY KEY (`id_intinerario`), ADD KEY `fk_intinerario_servicio_reserva1_idx` (`id_reserva`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
 ADD PRIMARY KEY (`idmunicipio`);

--
-- Indices de la tabla `operador`
--
ALTER TABLE `operador`
 ADD PRIMARY KEY (`idoperador`);

--
-- Indices de la tabla `paquete_turistico`
--
ALTER TABLE `paquete_turistico`
 ADD PRIMARY KEY (`idpaquete_turistico`), ADD KEY `fk_paquete_turistico_municipio1_idx` (`municipio_idmunicipio`);

--
-- Indices de la tabla `pqr`
--
ALTER TABLE `pqr`
 ADD PRIMARY KEY (`idpqr`), ADD KEY `fk_pqr_cliente1_idx` (`cliente_idcliente`), ADD KEY `fk_pqr_paquete_turistico1_idx` (`paquete_turistico_idpaquete_turistico`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
 ADD PRIMARY KEY (`idproducto`), ADD KEY `fk_producto_Proveedor1_idx` (`proveedor_idproveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
 ADD PRIMARY KEY (`idproveedor`), ADD UNIQUE KEY `UNIQ_9431EA6DE7927C74` (`email`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
 ADD PRIMARY KEY (`idreserva`), ADD KEY `fk_reserva_paquete_turistico1_idx` (`paquete_turistico_idpaquete_turistico`), ADD KEY `fk_reserva_cliente1_idx` (`cliente_idcliente`);

--
-- Indices de la tabla `servicio_alimentacion`
--
ALTER TABLE `servicio_alimentacion`
 ADD PRIMARY KEY (`idalimentacion`), ADD KEY `fk_servicio_alimentacion_producto1_idx` (`producto_idproducto`);

--
-- Indices de la tabla `servicio_alojamiento`
--
ALTER TABLE `servicio_alojamiento`
 ADD PRIMARY KEY (`idservicio_alojamiento`), ADD KEY `fk_servicio_habitacion_producto1_idx` (`producto_idproducto`);

--
-- Indices de la tabla `servicio_excursion`
--
ALTER TABLE `servicio_excursion`
 ADD PRIMARY KEY (`idexcursiones`), ADD KEY `fk_excursion_producto1_idx` (`producto_idproducto`);

--
-- Indices de la tabla `servicio_paq_alim`
--
ALTER TABLE `servicio_paq_alim`
 ADD PRIMARY KEY (`idservicio_paq_alim`), ADD KEY `fk_servicio_paq_alim_paquete_turistico1_idx` (`paquete_turistico_idpaquete_turistico`), ADD KEY `fk_servicio_paq_alim_servicio_alimentacion1_idx` (`servicio_alimentacion_idalimentacion`);

--
-- Indices de la tabla `servicio_paq_alo`
--
ALTER TABLE `servicio_paq_alo`
 ADD PRIMARY KEY (`idservicio_paq_alo`), ADD KEY `fk_servicio_paq_aloj_paquete_turistico1_idx` (`paquete_turistico_idpaquete_turistico`), ADD KEY `fk_servicio_paq_hab_servicio_habitacion1_idx` (`servicio_habitacion_idservicio_habitacion`);

--
-- Indices de la tabla `servicio_paq_excu`
--
ALTER TABLE `servicio_paq_excu`
 ADD PRIMARY KEY (`idservicio_paq_excu`), ADD KEY `fk_servicio_paq_excu_paquete_turistico1_idx` (`paquete_turistico_idpaquete_turistico`), ADD KEY `fk_servicio_paq_excu_servicio_excursion1_idx` (`servicio_excursion_idexcursiones`);

--
-- Indices de la tabla `servicio_paq_vehi`
--
ALTER TABLE `servicio_paq_vehi`
 ADD PRIMARY KEY (`idservicio_paq_vehi`), ADD KEY `fk_servicio_paq_vehi_paquete_turistico1_idx` (`paquete_turistico_idpaquete_turistico`), ADD KEY `fk_servicio_paq_vehi_servicio_vehiculo1_idx` (`servicio_vehiculo_idservicio_vehiculo`);

--
-- Indices de la tabla `servicio_paq_vuel`
--
ALTER TABLE `servicio_paq_vuel`
 ADD PRIMARY KEY (`idservicio_paq_vuel`), ADD KEY `fk_servicio_paq_vuel_paquete_turistico1_idx` (`paquete_turistico_idpaquete_turistico`), ADD KEY `fk_servicio_paq_vuel_servicio_vuelo1_idx` (`servicio_vuelo_idservicio_vuelo`);

--
-- Indices de la tabla `servicio_vehiculo`
--
ALTER TABLE `servicio_vehiculo`
 ADD PRIMARY KEY (`idservicio_vehiculo`), ADD KEY `fk_servicio_vehiculo_producto1_idx` (`producto_idproducto`);

--
-- Indices de la tabla `servicio_vuelo`
--
ALTER TABLE `servicio_vuelo`
 ADD PRIMARY KEY (`idservicio_vuelo`), ADD KEY `fk_servicio_vuelo_producto1_idx` (`producto_idproducto`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
 ADD PRIMARY KEY (`id_solicitud`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
MODIFY `idcomentarios` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `disponibilidad_alim`
--
ALTER TABLE `disponibilidad_alim`
MODIFY `id_disp_alim` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `disponibilidad_alo`
--
ALTER TABLE `disponibilidad_alo`
MODIFY `id_disp_alo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `disponibilidad_excu`
--
ALTER TABLE `disponibilidad_excu`
MODIFY `id_disp_excu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `disponibilidad_vehi`
--
ALTER TABLE `disponibilidad_vehi`
MODIFY `id_disp_vehi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `disponibilidad_vuel`
--
ALTER TABLE `disponibilidad_vuel`
MODIFY `id_disp_vuel` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
MODIFY `idfactura` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `intinerario_reserva`
--
ALTER TABLE `intinerario_reserva`
MODIFY `id_intinerario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
MODIFY `idmunicipio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `operador`
--
ALTER TABLE `operador`
MODIFY `idoperador` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `paquete_turistico`
--
ALTER TABLE `paquete_turistico`
MODIFY `idpaquete_turistico` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `pqr`
--
ALTER TABLE `pqr`
MODIFY `idpqr` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
MODIFY `idproveedor` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
MODIFY `idreserva` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `servicio_alimentacion`
--
ALTER TABLE `servicio_alimentacion`
MODIFY `idalimentacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `servicio_alojamiento`
--
ALTER TABLE `servicio_alojamiento`
MODIFY `idservicio_alojamiento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `servicio_excursion`
--
ALTER TABLE `servicio_excursion`
MODIFY `idexcursiones` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `servicio_paq_alim`
--
ALTER TABLE `servicio_paq_alim`
MODIFY `idservicio_paq_alim` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `servicio_paq_alo`
--
ALTER TABLE `servicio_paq_alo`
MODIFY `idservicio_paq_alo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `servicio_paq_excu`
--
ALTER TABLE `servicio_paq_excu`
MODIFY `idservicio_paq_excu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `servicio_paq_vehi`
--
ALTER TABLE `servicio_paq_vehi`
MODIFY `idservicio_paq_vehi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `servicio_paq_vuel`
--
ALTER TABLE `servicio_paq_vuel`
MODIFY `idservicio_paq_vuel` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `servicio_vehiculo`
--
ALTER TABLE `servicio_vehiculo`
MODIFY `idservicio_vehiculo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `servicio_vuelo`
--
ALTER TABLE `servicio_vuelo`
MODIFY `idservicio_vuelo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
ADD CONSTRAINT `fk_comentarios_cliente1` FOREIGN KEY (`cliente_idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_comentarios_paquete_turistico1` FOREIGN KEY (`paquete_turistico_idpaquete_turistico`) REFERENCES `paquete_turistico` (`idpaquete_turistico`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `disponibilidad_alim`
--
ALTER TABLE `disponibilidad_alim`
ADD CONSTRAINT `disponibilidad_alim_ibfk_1` FOREIGN KEY (`id_serv_alim`) REFERENCES `servicio_alimentacion` (`idalimentacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `disponibilidad_alo`
--
ALTER TABLE `disponibilidad_alo`
ADD CONSTRAINT `disponibilidad_alo_ibfk_1` FOREIGN KEY (`id_serv_alo`) REFERENCES `servicio_alojamiento` (`idservicio_alojamiento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `disponibilidad_excu`
--
ALTER TABLE `disponibilidad_excu`
ADD CONSTRAINT `disponibilidad_excu_ibfk_1` FOREIGN KEY (`id_serv_excu`) REFERENCES `servicio_excursion` (`idexcursiones`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `disponibilidad_vehi`
--
ALTER TABLE `disponibilidad_vehi`
ADD CONSTRAINT `disponibilidad_vehi_ibfk_1` FOREIGN KEY (`id_serv_vehi`) REFERENCES `servicio_vehiculo` (`idservicio_vehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `disponibilidad_vuel`
--
ALTER TABLE `disponibilidad_vuel`
ADD CONSTRAINT `disponibilidad_vuel_ibfk_1` FOREIGN KEY (`id_serv_vuel`) REFERENCES `servicio_vuelo` (`idservicio_vuelo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
ADD CONSTRAINT `fk_factura_reserva1` FOREIGN KEY (`reserva_idreserva`) REFERENCES `reserva` (`idreserva`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `intinerario_reserva`
--
ALTER TABLE `intinerario_reserva`
ADD CONSTRAINT `intinerario_reserva_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`idreserva`);

--
-- Filtros para la tabla `paquete_turistico`
--
ALTER TABLE `paquete_turistico`
ADD CONSTRAINT `fk_paquete_turistico_municipio1` FOREIGN KEY (`municipio_idmunicipio`) REFERENCES `municipio` (`idmunicipio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pqr`
--
ALTER TABLE `pqr`
ADD CONSTRAINT `fk_pqr_cliente1` FOREIGN KEY (`cliente_idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_pqr_paquete_turistico1` FOREIGN KEY (`paquete_turistico_idpaquete_turistico`) REFERENCES `paquete_turistico` (`idpaquete_turistico`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
ADD CONSTRAINT `fk_producto_Proveedor1` FOREIGN KEY (`proveedor_idproveedor`) REFERENCES `proveedor` (`idproveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
ADD CONSTRAINT `fk_reserva_cliente1` FOREIGN KEY (`cliente_idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_reserva_paquete_turistico1` FOREIGN KEY (`paquete_turistico_idpaquete_turistico`) REFERENCES `paquete_turistico` (`idpaquete_turistico`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicio_alimentacion`
--
ALTER TABLE `servicio_alimentacion`
ADD CONSTRAINT `fk_servicio_alimentacion_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicio_alojamiento`
--
ALTER TABLE `servicio_alojamiento`
ADD CONSTRAINT `fk_servicio_habitacion_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicio_excursion`
--
ALTER TABLE `servicio_excursion`
ADD CONSTRAINT `fk_excursion_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicio_paq_alim`
--
ALTER TABLE `servicio_paq_alim`
ADD CONSTRAINT `fk_servicio_paq_alim_paquete_turistico1` FOREIGN KEY (`paquete_turistico_idpaquete_turistico`) REFERENCES `paquete_turistico` (`idpaquete_turistico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_servicio_paq_alim_servicio_alimentacion1` FOREIGN KEY (`servicio_alimentacion_idalimentacion`) REFERENCES `servicio_alimentacion` (`idalimentacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicio_paq_alo`
--
ALTER TABLE `servicio_paq_alo`
ADD CONSTRAINT `fk_servicio_paq_alo_servicio_alojamiento1` FOREIGN KEY (`servicio_habitacion_idservicio_habitacion`) REFERENCES `servicio_alojamiento` (`idservicio_alojamiento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_servicio_paq_aloj_paquete_turistico1` FOREIGN KEY (`paquete_turistico_idpaquete_turistico`) REFERENCES `paquete_turistico` (`idpaquete_turistico`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicio_paq_excu`
--
ALTER TABLE `servicio_paq_excu`
ADD CONSTRAINT `fk_servicio_paq_excu_paquete_turistico1` FOREIGN KEY (`paquete_turistico_idpaquete_turistico`) REFERENCES `paquete_turistico` (`idpaquete_turistico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_servicio_paq_excu_servicio_excursion1` FOREIGN KEY (`servicio_excursion_idexcursiones`) REFERENCES `servicio_excursion` (`idexcursiones`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicio_paq_vehi`
--
ALTER TABLE `servicio_paq_vehi`
ADD CONSTRAINT `fk_servicio_paq_vehi_paquete_turistico1` FOREIGN KEY (`paquete_turistico_idpaquete_turistico`) REFERENCES `paquete_turistico` (`idpaquete_turistico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_servicio_paq_vehi_servicio_vehiculo1` FOREIGN KEY (`servicio_vehiculo_idservicio_vehiculo`) REFERENCES `servicio_vehiculo` (`idservicio_vehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicio_paq_vuel`
--
ALTER TABLE `servicio_paq_vuel`
ADD CONSTRAINT `fk_servicio_paq_vuel_paquete_turistico1` FOREIGN KEY (`paquete_turistico_idpaquete_turistico`) REFERENCES `paquete_turistico` (`idpaquete_turistico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_servicio_paq_vuel_servicio_vuelo1` FOREIGN KEY (`servicio_vuelo_idservicio_vuelo`) REFERENCES `servicio_vuelo` (`idservicio_vuelo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicio_vehiculo`
--
ALTER TABLE `servicio_vehiculo`
ADD CONSTRAINT `fk_servicio_vehiculo_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicio_vuelo`
--
ALTER TABLE `servicio_vuelo`
ADD CONSTRAINT `fk_servicio_vuelo_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
