-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-02-2018 a las 10:09:40
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `innovaled_v2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristica`
--

CREATE TABLE `caracteristica` (
  `IdCarecterisctica` smallint(5) NOT NULL,
  `IdProducto` smallint(5) DEFAULT NULL,
  `Titulo` varchar(50) NOT NULL,
  `Valor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caracteristica`
--

INSERT INTO `caracteristica` (`IdCarecterisctica`, `IdProducto`, `Titulo`, `Valor`) VALUES
(22, 13, 'Color Luz', 'Blanca'),
(23, 13, 'Amperes', '500'),
(26, 16, 'MATERIAL', 'ALUMINIO'),
(27, 16, 'COLOR', 'NEGRO/BLANCO'),
(28, 39, 'TAMAÑO', 'GRANDE'),
(29, 39, 'COLOR', 'AZUL'),
(30, 40, 'Color', 'Ambar'),
(31, 40, 'Amargor', 'Suave'),
(32, 40, 'Grados', '6.1'),
(33, 40, 'IBU', '18'),
(34, 40, 'Pais', 'Peru'),
(35, 40, 'Botella', '345ml'),
(36, 23, 'GARANTIA', '1 AÑO'),
(37, 109, 'GARANTIA', '3 AÑOS'),
(38, 110, 'GARANTIA', '3 AÑOS'),
(39, 111, 'GARANTIA', '5 AÑOS'),
(40, 112, 'GARANTIA', '7 AÑOS'),
(41, 117, 'Garantia ', '3 años '),
(42, 118, 'GARANTIA ', '2 AÑOS'),
(43, 119, 'GARANTIA ', '2 AÑOS '),
(44, 120, 'GARANTIA ', '2 AÑOS'),
(45, 121, 'GARANTÍA ', '2 AÑOS '),
(46, 122, 'GARANTIA ', '2 AÑOS '),
(47, 123, 'GARANTIA ', '2 AÑOS '),
(48, 124, 'GARANTIA ', '2 AÑOS '),
(49, 126, 'GARANTIA ', '2 AÑOS ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `IdConfiguracion` smallint(5) NOT NULL,
  `ImpuestoPorcentaje` double NOT NULL,
  `Correo1` varchar(40) NOT NULL,
  `Correo2` varchar(40) NOT NULL,
  `Correo3` varchar(40) NOT NULL,
  `Correo4` varchar(40) NOT NULL,
  `Correo5` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`IdConfiguracion`, `ImpuestoPorcentaje`, `Correo1`, `Correo2`, `Correo3`, `Correo4`, `Correo5`) VALUES
(1, 18, 'imoran@innovaled.pe', 'ventas@innovaled.pe', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE `cotizacion` (
  `IdCotizacion` smallint(5) NOT NULL,
  `NombreCliente` varchar(30) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `Telefono` varchar(30) NOT NULL,
  `Empresa` varchar(30) NOT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `Tipo` enum('producto','servicio','','') NOT NULL DEFAULT 'producto',
  `TimeUpload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`IdCotizacion`, `NombreCliente`, `Correo`, `Telefono`, `Empresa`, `Descripcion`, `Tipo`, `TimeUpload`) VALUES
(5, 'William Cottle', 'Wcottle@gym.com.pe', '999045507', 'Boutique hotel Lizzy Wasi', 'Favor cotizar lo siguiente:\r\n- 120 focos de luz cálida E27 de 8 Watts\r\n- 40 focos de luz blanca E27 de 8 Watts\r\n\r\nCotización a nombre de Boutique Hotel Lizzy Wasi.\r\n\r\nMuchas gracias/William Cottle\r\n', 'producto', '2017-11-20 00:53:07'),
(7, 'Anderson Buddy Cundia Delgado', 'andersoncundia@gmail.com', '966633828', 'ApuByte', 'pOR FAVOR cOTIZACION PARA VIDEO WALL INCLUYE INSTALACION ', 'producto', '2017-11-21 20:40:53'),
(8, 'JOSE TIRAVANTI', 'ELECTROFERRETERO2017@hotmail.c', '921909433', 'ELECTRO FERRETERO', 'BUENAS TARDES , SOLICITO COTIZACION DE PRODUCTOS LUMINARIAS LED , ENTRE ESTOS MODELOS , Y DESEO SABER SI HAY UN PRECIO POR MAYOR A LO INDICADO EN SU PAGINA. \r\nGRACIAS', 'producto', '2017-11-21 23:42:03'),
(9, 'Milagros', 'mmanriquecunyas98@hotmail.com', '968694734', 'CASMOR PERU', 'Buen dia, quisera saber la cotizacion de la luminaria spot, gracias.', 'producto', '2017-11-22 13:47:46'),
(10, 'erick bernabe rosario', 'mpb.logistica@gmail.com', '975162563', 'MUNICIPALIDAD PROVINCIAL DE BO', 'solicito cotizacion de:\r\n\r\nREFLECTORES TEMPO 450 W - MARCA PHILLIP \r\n\r\n30 UNIDADES\r\n\r\nMUNICIPALIDAD PROVINCIAL DE BOLOGNESI - ANCASH', 'producto', '2017-11-23 17:49:39'),
(16, 'Fernando Pinedo Lopez', 'pinedo_fer@hotmail.com', '942856569', 'SEM TECHNICS SRL', '', 'producto', '2017-11-24 15:33:21'),
(17, 'danny velasquez', 'danny.velasquez@joabhtelcom.co', '990012430', 'JOABH TELCOM EIRL', 'Buenas tardes, deseo que me puedan cotizar con el mejor precio 24 monitores LG de 47\".\r\nindicar tiempo de entrega\r\ngracias', 'producto', '2017-11-27 21:14:08'),
(18, 'Evelyn Alavrez', 'ealvarez@jyngroup.com', '921828243', 'J&N GROUP', '', 'producto', '2017-11-29 14:38:03'),
(19, 'RUBEN VIDAL CASAS', 'ingenieria2@arguvi.com', '940240312', 'ARGUVI SAC', '', 'producto', '2017-11-30 15:11:44'),
(20, 'Leonardo Abad', 'labad@gygperu.com', '994301844', 'GyG Arquitectos', '', 'producto', '2017-11-30 16:54:10'),
(21, 'Leonardo Abad', 'labad@gygperu.com', '994301844', 'GyG Arquitectos SAC', '', 'producto', '2017-11-30 16:56:34'),
(22, 'Mario', 'mario.delgado@teayudo.pe', '950330576', 'teayudo', '', 'producto', '2017-12-12 17:25:22'),
(23, 'espinoza mestanza eber', 'extintores2b_peru@hotmail.com', '943640756', 'extintores 2b', 'necesito luces de emergencia.\r\n\r\nenviar marca y precio.\r\n\r\natt. eber espinoza mestanza.\r\nDNI.166873793', 'producto', '2017-12-18 17:08:30'),
(24, 'EDDIE GARCIA', 'egarcia@brazilgrupoinmobiliari', '983708496', 'Constructora e Inmobiliaria Br', 'Estimados buenas tardes, \r\nNEcesito que me puedan cotizar los productos seleccionados adjuntar ficha tecnica. Gracias.', 'producto', '2017-12-19 22:50:54'),
(25, 'ALEJANDRO LAZO', '83.alejandrolazo@hotmail.com', '988442666', '', '', 'producto', '2017-12-21 13:11:13'),
(26, '', '', '', '', '', 'producto', '2017-12-27 10:26:33'),
(27, '', '', '', '', '', 'producto', '2017-12-30 17:57:20'),
(28, '', '', '', '', '', 'producto', '2017-12-31 07:42:14'),
(29, '', '', '', '', '', 'producto', '2018-01-03 07:33:48'),
(30, '', '', '', '', '', 'producto', '2018-01-03 21:38:09'),
(31, 'SYLVIA GOMEZ', 'sgomez@orbita.com.pe', '992785859', 'orbita servicios inmobiiriario', '', 'producto', '2018-01-05 15:16:43'),
(32, '', '', '', '', '', 'producto', '2018-01-08 17:29:56'),
(33, '', '', '', '', '', 'producto', '2018-01-08 18:18:02'),
(34, 'Robert Alexander Álvarez Casti', 'robertalexander.ac@gmail.com', '980621566', 'Empresa S.T.K.A.S', 'Buenas tardes\r\nEstoy buscando un panel  para una terraza de un cuarto piso con las siguientes dimensiones: ancho 9,6 metros ,Largo 12,5 metros y de área 110 metros cuadrados disponibles .Espero que me den una recomendación con las características que necesito, que tenga el producto buena  calidad de imágenes , durabilidad del producto, resistencia del producto  en el caso de un escenario climático adverso. El precio lo considero relativo por eso quiero saber los precio de todos los productos de ', 'producto', '2018-01-08 22:57:49'),
(35, 'el', 'recontra_crema@hotmail.com', '555544444444444', 'hola', 'Hola', 'producto', '2018-01-10 01:03:42'),
(36, 'Esthefany Yanqui machaca', 'Esthefany.20922@gmail.com', '957287284', '', '', 'producto', '2018-01-10 16:39:24'),
(37, 'Marcopolo Cabanillas', 'alexis.cabanillas@incaone.com', '949157557', 'Inca One Gold Corp', 'Buenos Días,\r\n\r\nNecesitamos un cambio en la iluminación en nuestra planta, por lo que nos sería muy importante que nos enviasen una cotización sobre:\r\n•	Reflectores Led de 50W por 36 unidades [y la(s) marca(s)].\r\n•	Reflectores Led de 100W por 20 unidades [y la(s) marca(s)].\r\n\r\nAdicionalmente, deseamos saber el tiempo de garantía que tendría nuestra compra en cualquiera de las 2 opciones.\r\n\r\nMuchas Gracias de antemano.', 'producto', '2018-01-11 16:22:46'),
(38, '', '', '', '', '', 'producto', '2018-01-13 10:28:12'),
(39, '', '', '', '', '', 'producto', '2018-01-15 18:13:25'),
(40, 'Silvana galvez villavicencio', 'Aishiteru.21.21@gmail.com', '943389709', 'Inversiones yc.sac', 'Buenas tardes\r\nEstamos buscando cotizaciones de paneles publicitarios digitales para colocar en local y en av. Me gustaria saber las medidas y precios y de cuanto consta la garantia.\r\nGracias', 'producto', '2018-01-15 19:16:42'),
(41, '', '', '', '', '', 'producto', '2018-01-16 07:34:39'),
(42, 'Brady Bravo', '', '992992960', 'Happy ElecTic', 'Buenos dias, para indicar que la cantidad es variable, son algunas de las luminarias que requiero para mi proyecto, si me pudiera sugerir una para centro de sala y para cuarto de hoteles en adosable led.', 'producto', '2018-01-16 14:05:54'),
(43, '', '', '', '', '', 'producto', '2018-01-17 08:44:04'),
(44, 'Santos cutisaca', 'Electro_arequipa@hotmail.com', '927547304', 'Electroperu ingenieros s.a.c.', 'Necesito 10reflectorea de 50 w cada uno a cuánto es el costo ', 'producto', '2018-01-19 21:46:45'),
(45, '', '', '', '', '', 'producto', '2018-01-21 03:48:33'),
(46, '', '', '', '', '', 'producto', '2018-01-22 10:31:51'),
(47, 'omar villanueva', 'omircko@hotmail.com', '945117400', 'famvbeck-sac', '', 'producto', '2018-01-22 15:59:29'),
(48, 'fiorella romero bedoya', 'fica_rb@hotmail.com', '958961105', 'Publiviaaqp', 'Somos una empresa de publicidad, y estamos interesados en comprar pantallas led publicitarias, requerimos precios', 'producto', '2018-01-22 21:54:32'),
(49, 'Paúl Montes Matos', 'pmontesw@hotmail.com', '986877064', '', 'se desea comprar 06 tubos led de 2400 w. Indicar donde poder recoger', 'producto', '2018-01-22 22:18:25'),
(50, '', '', '', '', '', 'producto', '2018-01-23 00:00:25'),
(51, '', '', '', '', '', 'producto', '2018-01-23 16:09:48'),
(52, '', '', '', '', '', 'producto', '2018-01-23 21:38:21'),
(53, 'DICK ACUÑA|', 'DACUNAN@UCV.EDU.PE', '945455895', 'UCV', '', 'producto', '2018-01-24 22:16:59'),
(54, 'edda yupa reyes', 'eddayupareyes@gmail.com', '936954915', 'edda', 'que direccion tienen en lima para poder ir a verlos', 'producto', '2018-01-25 21:03:55'),
(55, 'Brian Narro', 'Brian.narro@gmaim.com', '988311921', 'DCA', 'Quiero cotizaciones de los modulos led', 'producto', '2018-01-28 19:04:34'),
(56, '', '', '', '', '', 'producto', '2018-01-29 02:31:26'),
(57, 'EVELIN GARCIA', 'egarcia@ciaserviciosgenerales.', '', 'CIA PERU S.A.C', 'Hola buenos días, me gustaría recibir información de estos productos y el costo de los mismos.\r\n\r\nCINTA LED LONTEC\r\nPERFIL: LP2515\r\nCINTA LED 1700ml\r\nFuente de Poder\r\n23  ml\r\n\r\nSi no es la misma descripcion alguno similar, gracias. Espero su respuesta', 'producto', '2018-01-31 14:53:13'),
(58, 'Edwing manchego davila', 'sceindustrial.proyectos@gmail.', '945289192', 'sce industrial E.I.R.L.', '', 'producto', '2018-01-31 18:29:06'),
(59, 'Edwing Manchego Davila', 'sceindustrial.proyectos@gmail.', '945289192', 'sce industrial  E.I.R.L.', '', 'producto', '2018-01-31 18:36:34'),
(60, 'JAVIER BAZO CAMPOS', 'jmartin.bazo@gmail.com', '959789566', 'COMIMSER', 'Buenas Tardes.\r\n\r\nEstamos en una obra en el EL HOTEL EL PUEBLO, donde se realiza en este momento la remodelación de varios ambientes y hay artefactos de iluminación que se necesitan en este caso para en centro de convenciones.\r\n\r\nlos artefactos son:\r\n\r\nSLIMFLUX/DURALAMP PANEL LED 40W,  4000LM, 4000K, CODIGO  LP6060NW.....    50 UNIDADES\r\nRTF EMPOTRABLE DURALAMP 15W, 1350LM, 4000K, CODIGO D407840....................30 UNIDADES\r\n\r\nEN CASO NO TUVIERAN LAS MARCAS REFERIDAS ENVIAR LA COTIZACIÓN CON S', 'producto', '2018-01-31 21:34:54'),
(61, 'javier bazo campos', 'jmartin.bazo@gmail.com', '959789566', 'COMIMSER', '', 'producto', '2018-01-31 21:39:21'),
(62, 'JAVIER BAZO CAMPOS', 'jmartin.bazo@gmail.com', '959789566', 'COMIMSER', '', 'producto', '2018-01-31 21:44:09'),
(63, 'JUAN RUIZ', 'juanruizb75@gmail.com', '990076126', 'FAP SESAN', 'POR FAVOR ENVIAR COTIZACION AL CORREO GRACIAS', 'producto', '2018-02-01 20:28:22'),
(64, 'franco', 'taicus@hotmail.com', '995854545', '', 'Pantalla de 5 metros de ancho por 10 metros de largo', 'producto', '2018-02-01 22:09:19'),
(65, '', '', '', '', '', 'producto', '2018-02-02 14:36:03'),
(66, '', '', '', '', '', 'producto', '2018-02-04 02:40:22'),
(67, '', '', '', '', '', 'producto', '2018-02-05 06:01:35'),
(68, 'Cesar', 'cancajima@yahoo.com', '952104015', 'CESAR M. ANCAJIMA MIÑAN', '.espero su cotización', 'producto', '2018-02-06 14:46:58'),
(69, 'Giuliano Vasquez Espinoza', 'vasquezespinoza9@gmail.com', '942398967', 'Salón las vegas', '', 'producto', '2018-02-07 14:49:52'),
(70, 'Erik Chy', 'erik.m.corp@hotmail.com', '986999979', 'Dastan', 'Quiero obtener mas info de este producto', 'producto', '2018-02-08 21:27:18'),
(71, 'Manuel Choque ', 'aftermacf@gmail.com', '', '', '', 'servicio', '2018-02-09 17:25:57'),
(72, '', '', '', '', '', 'producto', '2018-02-11 15:39:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacionproducto`
--

CREATE TABLE `cotizacionproducto` (
  `IdCotizacionProducto` smallint(5) NOT NULL,
  `IdCotizacion` smallint(5) DEFAULT NULL,
  `IdProducto` smallint(5) DEFAULT NULL,
  `Qty` smallint(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cotizacionproducto`
--

INSERT INTO `cotizacionproducto` (`IdCotizacionProducto`, `IdCotizacion`, `IdProducto`, `Qty`) VALUES
(15, 7, 116, 1),
(16, 8, 100, 1),
(17, 8, 99, 1),
(18, 8, 55, 1),
(19, 8, 30, 12),
(20, 8, 17, 12),
(21, 8, 54, 1),
(22, 8, 53, 1),
(36, 16, 71, 1),
(37, 17, 61, 24),
(38, 18, 72, 1),
(39, 18, 71, 1),
(40, 18, 47, 1),
(41, 18, 48, 1),
(42, 19, 49, 40),
(43, 20, 48, 286),
(44, 21, 48, 300),
(45, 22, 23, 1),
(46, 22, 22, 1),
(47, 24, 100, 130),
(48, 24, 52, 25),
(49, 25, 120, 6),
(50, 31, 71, 1),
(51, 31, 68, 1),
(52, 34, 124, 1),
(53, 34, 122, 1),
(54, 34, 121, 1),
(55, 34, 120, 1),
(56, 34, 123, 1),
(57, 35, 102, 2),
(58, 36, 124, 3),
(59, 37, 71, 20),
(60, 37, 68, 36),
(61, 40, 123, 1),
(62, 42, 76, 1),
(63, 42, 55, 1),
(64, 42, 54, 1),
(65, 42, 53, 1),
(66, 42, 52, 1),
(67, 42, 51, 1),
(68, 42, 50, 1),
(69, 44, 68, 1),
(70, 47, 29, 1),
(71, 47, 27, 1),
(72, 48, 124, 1),
(73, 53, 49, 700),
(74, 54, 71, 1),
(75, 57, 21, 1),
(76, 57, 22, 1),
(77, 57, 20, 1),
(78, 57, 19, 1),
(79, 57, 23, 1),
(80, 57, 16, 1),
(81, 58, 61, 9),
(82, 59, 117, 9),
(83, 59, 116, 4),
(84, 59, 61, 9),
(85, 59, 57, 4),
(86, 60, 76, 1),
(87, 61, 55, 1),
(88, 62, 54, 1),
(89, 62, 53, 1),
(90, 63, 49, 20),
(91, 63, 48, 20),
(92, 64, 124, 1),
(93, 68, 124, 1),
(94, 69, 120, 6),
(95, 70, 22, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacionservicio`
--

CREATE TABLE `cotizacionservicio` (
  `IdCotizacionServicio` smallint(5) NOT NULL,
  `IdCotizacion` smallint(5) DEFAULT NULL,
  `Proyecto` varchar(30) NOT NULL,
  `Tipo` varchar(30) NOT NULL,
  `Ambiente` varchar(30) NOT NULL,
  `Dimensiones` varchar(30) NOT NULL,
  `Calidad` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cotizacionservicio`
--

INSERT INTO `cotizacionservicio` (`IdCotizacionServicio`, `IdCotizacion`, `Proyecto`, `Tipo`, `Ambiente`, `Dimensiones`, `Calidad`) VALUES
(1, 71, 'Pantallas', 'Fijo', 'Interior', '1.5x2', 'HD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

CREATE TABLE `linea` (
  `IdLinea` smallint(5) NOT NULL,
  `Etiqueta` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `linea`
--

INSERT INTO `linea` (`IdLinea`, `Etiqueta`) VALUES
(4, 'Luminarias Led'),
(5, 'Paneles Solares'),
(6, 'Digital Signage'),
(8, 'Automatizacion '),
(9, 'Climatizacion '),
(10, 'Camaras de seguridad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

CREATE TABLE `moneda` (
  `IdMoneda` smallint(5) NOT NULL,
  `Etiqueta` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `moneda`
--

INSERT INTO `moneda` (`IdMoneda`, `Etiqueta`) VALUES
(1, 'S/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precioescala`
--

CREATE TABLE `precioescala` (
  `IdPrecioEscala` smallint(5) NOT NULL,
  `IdProducto` smallint(5) DEFAULT NULL,
  `Desde` smallint(5) NOT NULL,
  `Descuento` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `precioescala`
--

INSERT INTO `precioescala` (`IdPrecioEscala`, `IdProducto`, `Desde`, `Descuento`) VALUES
(1, 13, 10, '1'),
(2, 16, 2000, '1.5'),
(3, 41, 10, '10'),
(4, 41, 20, '15'),
(6, 40, 50, '15'),
(7, 40, 100, '18'),
(8, 40, 500, '25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `IdProducto` smallint(5) NOT NULL,
  `IdSubLinea` smallint(5) DEFAULT NULL,
  `IdMoneda` smallint(5) DEFAULT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Slug` varchar(100) NOT NULL,
  `Marca` varchar(30) NOT NULL,
  `Precio` varchar(20) NOT NULL,
  `MostrarPrecio` enum('Si','No') NOT NULL DEFAULT 'Si',
  `Descripcion` varchar(500) NOT NULL,
  `Estado` enum('1','0') NOT NULL DEFAULT '1',
  `Orden` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IdProducto`, `IdSubLinea`, `IdMoneda`, `Nombre`, `Slug`, `Marca`, `Precio`, `MostrarPrecio`, `Descripcion`, `Estado`, `Orden`) VALUES
(13, 14, 1, 'Lampara Led interior Auto', '', 'Syscon', '1500', 'Si', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages', '1', 10),
(16, 3, 1, 'CINTA LED SMD5050 IP20 4000-4500K 15-18 lm', '', 'INNOVALED', '49', 'Si', '', '1', 1),
(17, 5, 1, 'BOMBILLA LITEHOME 5W', '', 'INNOVALED', '2.1', 'Si', '', '1', 1),
(18, 15, 1, 'PANEL SOLAR 85W', '', 'INNOVALED', '309.4', 'Si', 'Los paneles solares aprovechan la radiación del sol a través de sus celdas fotovoltaicas para así generar energía eléctrica y almacenarlos en un banco de baterías.\r\n', '1', 1),
(19, 3, 1, 'CINTA LED SMD5050 IP20 4000-4500K 15-18 lm', '', 'INNOVALED', '49', 'Si', '', '1', 1),
(20, 3, 1, 'CINTA LED SMD5050 IP20 6500K 14-16 lm ', '', 'INNOVALED', '49', 'Si', '', '1', 1),
(21, 3, 1, 'CINTA LED RGB IP20 14-16 lm ', '', 'INNOVALED', '55', 'Si', '', '1', 1),
(22, 3, 1, 'CINTA LED RGB IP20 15-18 lm', '', 'INNOVALED', '55', 'Si', 'Las cintas LED se han convertido en uno de los productos preferidos de interioristas,\r\ndiseñadores y arquitectos que desean construir espacios únicos y confortables. Su conexión\r\nes muy sencilla, consumen poca energía, ocupan muy poco espacio y pueden ser utilizadas\r\nen paredes, techos, estructuras, contornear espacios, etc.', '1', 1),
(23, 3, 1, 'CINTA LED ZIGZAG SMD2835 IP20', '', 'INNOVALED', '38', 'Si', 'Las cintas led zigzag son ideales para letras corporeas. Su curvatura evita que se tenga que cortar y soldar ', '1', 1),
(24, 4, 1, 'MODULO LED SMD2835 6500K', '', 'INNOVALED', '100', 'Si', '3 LEDS\r\n', '0', 1),
(25, 4, 1, 'MODULO INNOVALED 3 LED SMD2835 ', '', 'INNOVALED', '2.6', 'Si', 'Módulo de LED o pastillas de LED, utilizados para la iluminación, ofrece iluminar\r\naquellas zonas de acceso difícil obteniendo una iluminación uniforme, y un ahorro\r\nenergético importante.\r\n', '1', 1),
(26, 4, 1, 'MODULO 3 LED SMD5050  ', '', 'INNOVALED', '1.8', 'Si', 'Módulo de LED o pastillas de LED, utilizados para la iluminación, ofrece iluminar\r\naquellas zonas de acceso difícil obteniendo una iluminación uniforme, y un ahorro\r\nenergético importante.', '1', 1),
(27, 4, 1, 'MODULO 3 LED SMD5050 RGB', '', 'INNOVALED', '2', 'Si', 'Módulo de LED o pastillas de LED, utilizados para la iluminación, ofrece iluminar\r\naquellas zonas de acceso difícil obteniendo una iluminación uniforme, y un ahorro\r\nenergético importante.\r\n', '1', 1),
(28, 4, 1, 'MODULO 3 LED SMD5050 DIGITAL', '', 'INNOVALED', '1', 'Si', 'Módulo de LED o pastillas de LED, utilizados para la iluminación, ofrece iluminar\r\naquellas zonas de acceso difícil obteniendo una iluminación uniforme, y un ahorro\r\nenergético importante.\r\nProgramable por computadora.', '1', 1),
(29, 4, 1, 'MODULO LED COB 10 000K', '', 'INNOVALED', '2.8', 'Si', '3 LEDS', '1', 3),
(30, 5, 1, 'BOMBILLA LITEHOME 5W', '', 'INNOVALED', '2.1', 'Si', '', '1', 1),
(31, 4, 1, 'MODULO INNOVALED 4 LED SMD2835 ', '', 'INNOVALED', '3.8', 'Si', 'Módulo de LED o pastillas de LED, utilizados para la iluminación, ofrece iluminar\r\naquellas zonas de acceso difícil obteniendo una iluminación uniforme, y un ahorro\r\nenergético importante.', '1', 1),
(32, 4, 1, 'MODULO LED SMD2835 9000K', '', 'INNOVALED', '0.0', 'Si', '4 LEDS\r\n', '0', 1),
(33, 4, 1, 'MODULO 4 LED SMD5050  ', '', 'INNOVALED', '2', 'Si', 'Módulo de LED o pastillas de LED, utilizados para la iluminación, ofrece iluminar\r\naquellas zonas de acceso difícil obteniendo una iluminación uniforme, y un ahorro\r\nenergético importante.\r\n', '1', 1),
(34, 4, 1, 'MODULO 4 LED SMD5050 RGB', '', 'INNOVALED', '2.1', 'Si', 'Módulo de LED o pastillas de LED, utilizados para la iluminación, ofrece iluminar\r\naquellas zonas de acceso difícil obteniendo una iluminación uniforme, y un ahorro\r\nenergético importante.\r\n', '1', 1),
(35, 5, 1, 'BOMBILLA UFO 26W', '', 'INNOVALED', '8.5', 'Si', '', '1', 2),
(36, 5, 1, 'BOMBILLA CORN 20W', '', 'INNOVALED', '20', 'Si', '', '1', 1),
(37, 6, 1, 'DICROICO 5W GU10 ', '', 'INNOVALED', '6.5', 'Si', '', '1', 1),
(38, 6, 1, 'DICROICO 7W GU5.3/MRU16', '', 'INNOVALED', '10', 'Si', '', '1', 1),
(39, 19, 1, 'PRODUCTO PRUEBA', '', 'INNOVALED', '89', 'Si', '', '0', 1),
(40, 26, 1, 'De Peso Pumpkin Ale', '', 'Barbarian ', '13.2', 'Si', 'Cerveza de edición temporal de Cervecería Barbarian. Esta cerveza está inspirada en las cervezas de calabaza (pumpkin ale) muy extendidas en Estados Unidos. En nariz se percibe canela y clavo de olor. En boca es una cerveza ligeramente dulce y de amargor bajo que armonizan maravillosamente con notas especiadas que nos transportan a postres navideños. Una chela de Peso.', '0', 1),
(41, 26, 1, 'Cusqueña de trigo', '', 'Cusqueña', '13.6', 'Si', 'Cerveza dorada y refrescante con toques de miel de Oxapampa. Cuerpo liviano malta Pale Ale y dos variedades de lúpulo.', '0', 2),
(42, 3, 1, 'Cable UTP Cat 6', '', 'AMP', '480', 'Si', '', '0', 1),
(43, 10, 1, 'REFLECTOR 30 W 6500k ( BLANCO NEUTRO) CHIP SM', '', 'DAXSO', '71.37', 'Si', 'REFLECTOR 30 W  6500k ( BLANCO NEUTRO) CHIP SMD', '0', 1),
(44, 10, 1, 'REFLECTOR 30 W LUXSO 6500k', '', 'DAXSO', '71.37', 'Si', 'REFLECTOR 30 W LUXSO 6500k CHIP SMD', '0', 1),
(45, 10, 1, 'Reflector LED 30W SMD', '', 'DAXSO', '71.37', 'Si', 'El reector LED de 30W SMD DAXSO ofrece una amplia e intensa iluminación debido a su\r\nalta ecacia lumínica de 120Lm/w. Diseñado bajo estrictos parámetros de calidad asegurando\r\nla óptima disipasión del calor y maximización de su vida útil.', '1', 1),
(46, 15, 1, 'PANEL POLICRISTALINO 150W', '', 'DAXSO', '572', 'Si', 'Los paneles solares aprovechan la radiación del sol a través de sus celdas fotovoltaicas\r\npara así generar energía eléctrica y almacenarlos en un banco de baterías.', '1', 1),
(47, 8, 1, 'TUBO LED  INTEGRADO 9 WATTS 0.6 M', '', 'LITEHOME', '13.00', 'Si', '', '1', 1),
(48, 8, 1, 'TUBO LED INTEGRADO 18 WATTS  1.20 M', '', 'LITEHOME', '15.60', 'Si', 'El tubo LED es ideal para sustituir los tubos uorescentes convencionales ahorrando más\r\ndel 50% de la electricidad consumida no emite parpadeos ni radiación UV y su encendido\r\nes instantáneo. Son de fácil instalación no requieren mantenimiento asegurando su alta\r\ndurabilidad', '1', 2),
(49, 8, 1, 'TUBO LED 20 WATTS 2400LM', '', 'DAXSO', '15.60', 'Si', 'El tubo LED es ideal para sustituir los tubos uorescentes convencionales ahorrando más\r\ndel 50% de la electricidad consumida no emite parpadeos ni radiación UV y su encendido\r\nes instantáneo. Son de fácil instalación no requieren mantenimiento asegurando su alta\r\ndurabilidad', '1', 3),
(50, 11, 1, 'PANEL LED CIRCULAR ADOSABLE 6 WATTS', '', 'DAXSO', '18.20', 'Si', 'El panel circular LED es ideal para los trabajos más sosticados que requieren de una\r\niluminación de la más alta calidad. Posee un amplio ángulo de apertura para ofrecer\r\nuna iluminación general con una elevada eciencia.', '1', 1),
(51, 11, 1, 'PANEL LED  CIRCULAR ADOSABLE 12 WATTS ', '', 'DAXSO', '23.4', 'Si', 'El panel circular LED es ideal para los trabajos más sofisticados que requieren de una\r\niluminación de la más alta calidad. Posee un amplio ángulo de apertura para ofrecer\r\nuna iluminación general con una elevada eciencia.', '1', 2),
(52, 11, 1, 'PANEL LED CIRCULAR ADOSABLE 18 WATTS', '', 'DAXSO', '27', 'Si', '', '1', 3),
(53, 11, 1, 'PANEL LED EMPOTRABLE 6 WATTS', '', 'DAXSO', '12.40', 'Si', 'El panel circular LED es ideal para los trabajos más sofisticados que requieren de\r\nuna iluminación de la más alta calidad. Posee un amplio ángulo de apertura para\r\nofrecer una iluminación general con una elevada eficiencia.', '1', 4),
(54, 11, 1, 'PANEL LED EMPOTRABLE 12 WATTS', '', 'DAXSO', '18.07', 'Si', 'El panel circular LED es ideal para los trabajos más sofisticados que requieren de\r\nuna iluminación de la más alta calidad. Posee un amplio ángulo de apertura para\r\nofrecer una iluminación general con una elevada eficiencia.', '1', 5),
(55, 11, 1, 'PANEL LED EMPOTRABLE 18 WATTS', '', 'DAXSO', '22.75', 'Si', 'El panel circular LED es ideal para los trabajos más sofisticados que requieren de\r\nuna iluminación de la más alta calidad. Posee un amplio ángulo de apertura para\r\nofrecer una iluminación general con una elevada eficiencia.', '1', 6),
(56, 15, 1, 'PANEL SOLAR POLICRISTALINO 220 W', '', 'DAXSO', '756', 'Si', 'Los paneles solares aprovechan la radiación del sol a través de sus celdas fotovoltaicas para así generar energía eléctrica y almacenarlos en un banco de baterías.\r\n', '1', 2),
(57, 20, 1, 'VIDEOWALL LG 55LV35A', '', 'LG', '8130.00', 'Si', 'Monitor LED 55\" Full HD / Marco 2.25 (izquierdo/superior) / 1.25 (derecho/inferior) mm / 500 nit / DVI Daisy Chain', '1', 1),
(58, 16, 1, 'CONTROLADOR SOLAR 12V 10 A', '', 'DAXSO', '83.65', 'Si', 'El controlador de carga es uno de los elementos importantes de los sistemas de energía solar ya que limita y deja el paso de la energía que se le suministra a la batería cuando esta se encuentre cargada o descargada.   \r\nCaracterísticas\r\n', '1', 1),
(59, 16, 1, 'CONTROLADOR SOLAR 20 A', '', 'DAXSO', '69.62', 'Si', 'El controlador de carga es uno de los elementos importantes de los sistemas de energía solar ya que limita y deja el paso de la energía que se le suministra a la batería cuando esta se encuentre cargada o descargada.   \r\nCaracterísticas\r\n', '1', 2),
(60, 16, 1, 'CONTROLADOR SOLAR 30 A', '', 'DAXSO', '161.2', 'Si', 'El controlador de carga es uno de los elementos importantes de los sistemas de energía solar ya que limita y deja el paso de la energía que se le suministra a la batería cuando esta se encuentre cargada o descargada.   \r\nCaracterísticas\r\n', '1', 3),
(61, 20, 1, 'VIDEOWALL LG 47LV35A', '', 'LG', '6480.00', 'Si', '', '1', 2),
(62, 16, 1, 'CONTROLADOR SOLAR 12V LCD 10 A', '', 'DAXSO', '83.65', 'Si', 'El controlador de carga es uno de los elementos importantes de los sistemas de energía solar ya que limita y deja el paso de la energía que se le suministra a la batería cuando esta se encuentre cargada o descargada.  \r\nCaracterísticas\r\n', '1', 4),
(63, 16, 1, 'CONTROLADOR SOLAR 20A LCD', '', 'DAXSO', '76.7', 'Si', 'El controlador de carga es uno de los elementos importantes de los sistemas de energía solar ya que limita y deja el paso de la energía que se le suministra a la batería cuando esta se encuentre cargada o descargada.  \r\nCaracterísticas\r\n', '1', 4),
(64, 16, 1, 'CONTROLADOR SOLAR LCD 30A', '', 'DAXSO', '122.2', 'Si', 'El controlador de carga es uno de los elementos importantes de los sistemas de energía solar ya que limita y deja el paso de la energía que se le suministra a la batería cuando esta se encuentre cargada o descargada.  \r\nCaracterísticas\r\n', '1', 5),
(65, 17, 1, 'INVERSOR SOLAR 300 W', '', 'DAXSO', '152.55', 'Si', 'El inversor de onda modificada es  el corazón de un sistema fotovoltaico autónomo es donde se gestiona la energía eléctrica en función de la demanda y la producción. Transforma la corriente continua de la batería (12 v o 24 v DC) en corriente alterna a 220V 60Hz entregando la energía necesaria al usuario en cada momento.', '1', 6),
(66, 17, 1, 'INVERSOR SOLAR 600W', '', 'DAXSO', '214.76', 'Si', 'El inversor de onda modificada es  el corazón de un sistema fotovoltaico autónomo es donde se gestiona la energía eléctrica en función de la demanda y la producción. Transforma la corriente continua de la batería (12 v o 24 v DC) en corriente alterna a 220V 60Hz entregando la energía necesaria al usuario en cada momento.', '1', 6),
(67, 10, 1, 'REFLECTOR 20 W', '', 'DAXSO', '55.93', 'Si', 'El reflector LED de 20W SMD DAXSO ofrece una amplia e intensa iluminación debido a su alta eficacia luminica de 120Lm/w. Diseñado bajo estrictos parámetros de calidad asegurando la óptima dispersión del calor y maximización de su vida útil.\r\n', '1', 1),
(68, 10, 1, 'REFLECTOR 50W', '', 'DAXSO', '110', 'Si', 'El reflector LED de 50W SMD DAXSO ofrece una amplia e intensa iluminación debido a su alta eficacia luminica de 120Lm/w. Diseñado bajo estrictos parámetros de calidad asegurando la óptima dispersión del calor y maximización de su vida útil.\r\n', '1', 3),
(69, 10, 1, 'REFLECTOR 50W', '', 'DAXSO', '110', 'Si', 'El reflector LED de 50W SMD DAXSO ofrece una amplia e intensa iluminación debido a su alta eficacia luminica de 120Lm/w. Diseñado bajo estrictos parámetros de calidad asegurando la óptima dispersión del calor y maximización de su vida útil.\r\n', '0', 3),
(70, 10, 1, 'REFLECTOR 50W', '', 'DAXSO', '110', 'Si', 'El reflector LED de 50W SMD DAXSO ofrece una amplia e intensa iluminación debido a su alta eficacia luminica de 120Lm/w. Diseñado bajo estrictos parámetros de calidad asegurando la óptima dispersión del calor y maximización de su vida útil.\r\n', '0', 3),
(71, 10, 1, 'REFLECTOR 100W SMD', '', 'DAXSO', '234', 'Si', 'El reflector LED de 100W SMD DAXSO ofrece una amplia e intensa iluminación debido a su alta eficacia lumínica de 120Lm/w. Diseñado bajo estrictos parámetros de calidad asegurando la óptima dispersión del calor y maximización de su vida útil.\r\n', '1', 4),
(72, 13, 1, 'LUMINARIA DE EMERGENCIA', '', 'DAXSO', '52.26', 'Si', '- Eficiencia energética optimizada  \r\n- Máxima potencia lumínica \r\n- Arranque instantáneo \r\n- No emite Radiación UV \r\n- Larga vida útil\r\n', '1', 1),
(73, 31, 1, 'DVR TRIBRIDO 4 canales', '', 'HIKVISION', '193.50', 'Si', 'Soporta cámaras Analogas, analogas HD-TVI y AHD. Tiene conexión vía coaxitron a cámaras y\r\ndomos PTZ HD-TVI. Ademas de ello cuenta con salidas HDMI y VGA con resolución de\r\nhasta 1920x1080P.', '1', 1),
(74, 31, 1, 'DVR TRIBRIDO 4 canales', '', 'HIKVISION', '00000', 'Si', '', '0', 1),
(75, 31, 1, 'DVR TRIBRIDO 8 canales', '', 'HIKVISION', '268.90', 'Si', 'Soporta cámaras Análogas análogas HD-TVI y AHD. Tiene conexión via coaxitron a cámaras y domos PTZ HD-TVI. Además tiene salidas HDMI y VGA con resolución de hasta 1920x1080P.', '1', 2),
(76, 11, 1, 'PANEL CUADRADO ADOSABLE 40w', '', 'DAXSO', '158', 'Si', 'El panel LED posee un diseño extraplano que ofrece una iluminación general de máxima calidad. Incluye un disipador de aluminio de alta calidad para una mínima emisión de calor y mayor eficiencia energética', '1', 1),
(77, 11, 1, 'PANEL 40W 60*60 EMPOTRABLE', '', 'DAXSO', '126.1', 'Si', 'El panel LED posee un diseño extraplano que ofrece una iluminación general de máxima calidad. Incluye un disipador de aluminio de alta calidad para una mínima emisión de calor y mayor eficiencia energética', '1', 2),
(78, 31, 1, 'DVR TRIBRIDO 16 canales', '', 'HIKVISION', '441.50', 'Si', 'Soporta cámaras análogas HD-TVI y AHD. Tiene conexión via coaxitron a cámaras y domos PTZ HD-TVI. También tiene salidas HDMI y VGA con resolución de hasta 1920x1080P.', '1', 3),
(79, 11, 1, 'PANEL LED 48 30*60 ADOSABLE', '', 'DAXSO', '158.5', 'Si', 'El panel LED posee un diseño extra plano que ofrece una iluminación general de máxima calidad. Incluye un disipador de aluminio de alta calidad para una mínima emisión de calor y tmayor eficiencia energética.\r\n', '1', 3),
(80, 31, 1, 'TURBO HD DVR 4 canales', '', 'HIKVISION', '260.00', 'Si', 'Soporta tecnologías: AHD HD-TVI ANÁLOGO e IP. Tiene resolución 1080P (1920 X 1080) y salida VGA/HDMI 1080P.', '1', 4),
(81, 11, 1, 'PANEL 48W 60*30 EMPOTRABLE', '', 'DAXSO', '127.4', 'Si', 'El panel LED posee un diseño extra plano que ofrece una iluminación general de máxima calidad. Incluye un disipador de aluminio de alta calidad para una mínima emisión de calor y tmayor eficiencia energética.\r\n', '1', 4),
(82, 31, 1, 'TURBO HD DVR 8 canales', '', 'HIKVISION', '380.00', 'Si', 'Soporta tecnologías: AHD HD-TVI ANÁLOGO e IP. Tiene resolución 1080P (1920 X 1080) y salida VGA/HDMI 1080P.', '1', 5),
(83, 31, 1, 'NVR 4 canales', '', 'HIKVISION', '255.00', 'Si', 'Soporta cámaras de otras marcas. Resolución de grabación de hasta 2Mp Y salidas HDMI/VGA con resolución de hasta 1920 x 1080P.', '1', 6),
(84, 31, 1, 'NVR 4 canales  (POE)', '', 'HIKCVISION', '411.30', 'Si', 'Soporte de visualización en vivo el almacenamiento y la reproducción de la cámara conectada con un máximo de la resolución de 2 megapíxeles. Salidas simultáneas HDMI y VGA a hasta 1920 × 1080 de resolución.', '1', 7),
(85, 14, 1, 'FOCO LED PARA AUTO H4 V8 (PAR)', '', '-', '170', 'Si', 'Las luces vehiculares se conectan directamente no requieres de transformadores u otros dispositivos de regulación además posee un sistema de enfriamiento dual que garantiza su larga vida útil\r\n', '1', 1),
(86, 14, 1, 'FOCO LED VEHICULAR  V6  H4  (PAR)', '', '-', '150', 'Si', 'Las luces vehiculares se conectan directamente no requieres de transformadores u otros dispositivos de regulación además posee un sistema de enfriamiento dual que garantiza su larga vida útil\r\n', '1', 2),
(87, 14, 1, 'FOCO LED VEHICULAR H1 (PAR)', '', '-', '136', 'Si', 'Las luces vehiculares se conectan directamente no requieres de transformadores u otros dispositivos de regulación además posee un sistema de enfriamiento dual que garantiza su larga vida útil\r\n', '1', 3),
(88, 14, 1, 'FOCO LED VEHICULAR H3  (PAR)', '', '-', '123', 'Si', 'Las luces vehiculares se conectan directamente no requieres de transformadores u otros dispositivos de regulación además posee un sistema de enfriamiento dual que garantiza su larga vida útil\r\n', '1', 5),
(89, 14, 1, 'FOCO LED VEHICULAR H7 ( PAR)', '', '-', '136', 'Si', 'Las luces vehiculares se conectan directamente no requieres de transformadores u otros dispositivos de regulación además posee un sistema de enfriamiento dual que garantiza su larga vida útil\r\n', '1', 5),
(90, 31, 1, 'NVR 8 canales', '', 'HIKVISION', '323.80', 'Si', 'Soporta cámaras de otras marcas. resolución de grabación de hasta 6Mp. Salidas HDMI/VGA con resolución de hasta 1920 x 1080P.', '1', 8),
(91, 14, 1, 'FOCO LED H1 (PAR)', '', '-', '136', 'Si', 'Las luces vehiculares se conectan directamente no requieres de transformadores u otros dispositivos de regulación además posee un sistema de enfriamiento dual que garantiza su larga vida útil\r\n', '0', 6),
(92, 14, 1, 'FOCO LED H11 (PAR)', '', '-', '136', 'Si', 'Las luces vehiculares se conectan directamente no requieres de transformadores u otros dispositivos de regulación además posee un sistema de enfriamiento dual que garantiza su larga vida útil\r\n', '1', 6),
(93, 14, 1, 'FOCO LED H1 (PAR)', '', '-', '136', 'Si', 'Las luces vehiculares se conectan directamente no requieres de transformadores u otros dispositivos de regulación además posee un sistema de enfriamiento dual que garantiza su larga vida útil\r\n', '0', 6),
(94, 31, 1, 'NVR 16 canales', '', 'HIKVISION', '440.80', 'Si', 'Soporta cámaras de otras marcas. resolución de grabación de hasta 6Mp. Salidas HDMI/VGA con resolución de hasta 1920 x 1080P.', '1', 9),
(95, 14, 1, 'FOCO LED H13 (PAR)', '', '-', '136', 'Si', 'Las luces vehiculares se conectan directamente no requieres de transformadores u otros dispositivos de regulación además posee un sistema de enfriamiento dual que garantiza su larga vida útil\r\n', '1', 7),
(96, 30, 1, 'CÁMARA ANALÓGICA EXTERIOR TIPO TUBO (METAL) ', '', 'HIKVISION', '85.80', 'Si', '1Mp de resolución CMOS de alto rendimiento y tecnología HD-TVI. Material de metal.', '1', 10),
(97, 30, 1, 'CÁMARA ANALÓGICA EXTERIOR TIPO TUBO (PLÁSTICO', '', 'HIKVISION', '61.20', 'Si', '1Mp de resolución CMOS de alto rendimiento y tecnología HD-TVI. Material de plástico.', '1', 10),
(98, 30, 1, 'CÁMARA ANALÓGICA EXTERIOR TIPO DOMO (METAL)', '', 'HIKVISION', '74.20', 'Si', '1Mp de resolución CMOS de alto rendimiento y Tecnología HD-TVI.', '1', 11),
(99, 9, 1, 'EQUIPO LINEAL 16W 0.60 cm', '', 'LITEHOME', '19.50', 'Si', 'EQUIPO LINEAL 16W 0.60 cm', '1', 1),
(100, 9, 1, 'EQUIPO LINEAL 32W 120 cm', '', 'LITEHOME', '29.77', 'Si', 'EQUIPO LINEAL 32W 120 cm', '1', 2),
(101, 33, 1, 'BATERIA SOLAR 12V 100A/H ', '', 'ETNA', '824', 'Si', '', '1', 1),
(102, 5, 1, 'BOMBILLA 26W UFO', '', 'DAXSO', '17.80', 'Si', 'La bombilla UFO LED gracias a su diseño plano consigue que toda la intensidad lumínica sea\r\ndirigida hacia el suelo con lo que no se tendrá pérdidas de luminosidad hacia ningún lugar\r\nque no deseemos iluminar.', '1', 3),
(103, 33, 1, 'BATERIA SOLAR 100A/H 12 V SECA', '', 'RITAR', '935', 'Si', '', '1', 2),
(104, 33, 1, 'BATERIA SOLAR 12V 65A/H', '', 'RITAR', '796', 'Si', '', '1', 2),
(105, 14, 1, 'BOMBILLA 42W', '', 'DAXSO', '48.30', 'Si', 'La bombilla UFO LED gracias a su diseño plano consigue que toda la intensidad lumínica sea\r\ndirigida hacia el suelo con lo que no se tendrá pérdidas de luminosidad hacia ningún lugar\r\nque no deseemos iluminar.', '1', 1),
(106, 33, 1, ' BATERIA SOLAR 12V 80 A/H', '', 'RITAR', '942.5', 'Si', '', '1', 4),
(107, 6, 1, 'DICROICO 5W GU10', '', 'LITEHOME', '10.27', 'Si', 'Ideales para conseguir una espléndida iluminación decorativa para cualquier tipo de ambiente\r\nhogar ocinas tiendas que necesitan un alto control energético y una gran fuente de luz continua.\r\nAdemás los dicroicos no alteran los colores de los objetos que iluminan. Son resistentes a golpes y\r\nvibraciones y no emiten radiaciones.', '1', 1),
(108, 33, 1, 'BATERIA SOLAR 12V 150 A/H SECA', '', 'RITAR', '1666', 'Si', '', '1', 5),
(109, 34, 1, 'TRANSFORMADOR MEANWELL LPV 60 - 12V', '', 'MEAN WELL', '85', 'Si', '', '1', 1),
(110, 34, 1, 'TRANSFORMADOR MEANWELL LPV 100-12V', '', 'MEANWELL', '360', 'Si', '', '1', 2),
(111, 34, 1, 'TRANSFORMADOR MEANWELL HLG 240', '', 'MEANWELL', '400', 'Si', '', '1', 3),
(112, 34, 1, 'TRANSFORMADOR MEANWELL HLG 360H-12V', '', 'MEANWELL', '470', 'Si', '', '1', 1),
(113, 26, 1, 'CONTROL ACESSO ZK-X7 ', '', 'ZKTECO', '211.016', 'Si', 'Uno de los innovadores lectores de huellas biométricas para aplicaciones de control de acceso. Ofreciendo un incomparable rendimiento utilizando un algoritmo avanzado para la fiabilidad precisión y excelente velocidad de coincidencia. Puede operar en modo independiente con la interfaz para cerradura eléctrica de terceros alarma sensor de puerta botón de salida y timbre. ', '1', 1),
(114, 26, 1, 'CONTROL ACCESO & ASISTENCIA  MA300', '', 'ZKTECO', '535.30', 'Si', 'MA300-BT ofrece la flexibilidad de ser instalado de manera independiente o con cualquier tercero\r\npaneles de fiesta que admiten wiegand de 26 bits. El usuario puede ser inscrito por\r\ntarjeta de administrador cuando el dispositivo funciona en modo independiente.TCP / IP\r\ny RS485 están disponibles por lo que el dispositivo se puede conectar fácilmente y\r\nconvenientemente', '1', 3),
(115, 26, 1, 'CONTROL DE ASISTENCIA  LX14', '', 'ZKTECO', '206.53', 'Si', 'es una terminal biométrica para la gestión de tiempo y asistencia de empleados con\r\nfunción SSR integrada lo que lo hace ideal para pequeñas empresas. La información de los\r\nempleados puede redactarse en formato de Excel.', '1', 2),
(116, 20, 1, 'Videowall 55 inch Samsung', '', 'SAMSUNG', '13140', 'Si', 'Con un marco de sólo 3.5mm de grosor (distancia Marco-Marco) el modelo UD46E-B permite ofrecer una experiencia de visionado perfecta permitiendo que la audiencia se concentre en el mensaje.', '1', 1),
(117, 20, 1, 'Videowall 46 inch Samsung', '', 'SAMSUNG', '8216', 'Si', 'Con un marco de sólo 3.5mm de grosor (distancia Marco-Marco) el modelo UD46E-B permite ofrecer una experiencia de visionado perfecta permitiendo que la audiencia se concentre en el mensaje.', '1', 2),
(118, 18, 1, 'Pantalla de Interior Servicio Delantero SMD  ', '', 'HUAHAI', '0000', 'Si', 'Las pantallas LED HUAHAI poseen una gran calidad de imagen ideal para mostrar contenidos audiovisuales en alta definición. Las pantallas LED se han convertido en la actualidad en una potente herramienta de marketing para las marcas.\r\n', '1', 1),
(119, 18, 1, 'Pantalla de Exterior  SMD- 06  (Rental)', '', 'HUAHAI', '0000', 'Si', 'PANTALLA P6 EXTERIOR RENTAL ', '1', 2),
(120, 18, 1, 'Pantalla  Rental  de Exterior RQ-06 -O', '', 'HUAHAI', '000', 'Si', 'Las pantallas LED HUAHAI poseen una gran calidad de imagen ideal para mostrar contenidos audiovisuales en alta definición. Las pantallas LED se han convertido en la actualidad en una potente herramienta de marketing para las marcas.', '1', 3),
(121, 18, 1, 'Pantalla de Exterior AA - 10 mm', '', 'HUAHAI', '0000', 'Si', 'Las pantallas LED HUAHAI poseen una gran calidad de imagen ideal para mostrar contenidos audiovisuales en alta definición. Las pantallas LED se han convertido en la actualidad en una potente herramienta de marketing para las marcas.', '1', 4),
(122, 18, 1, 'Pantalla de Exterior AA - 10 mm Clase B', '', 'HUAHAI', '000', 'Si', 'Las pantallas LED HUAHAI poseen una gran calidad de imagen ideal para mostrar contenidos audiovisuales en alta definición. Las pantallas LED se han convertido en la actualidad en una potente herramienta de marketing para las marcas.', '1', 5),
(123, 18, 1, 'Pantalla de Exterior AA - 16mm', '', 'HUAHAI', '000', 'Si', 'Las pantallas LED HUAHAI poseen una gran calidad de imagen ideal para mostrar contenidos audiovisuales en alta definición. Las pantallas LED se han convertido en la actualidad en una potente herramienta de marketing para las marcas.', '1', 7),
(124, 18, 1, 'Pantalla de Exterior AA - 16mm Clase B', '', 'HUAHAI', '0000', 'Si', 'Las pantallas LED HUAHAI poseen una gran calidad de imagen ideal para mostrar contenidos audiovisuales en alta definición. Las pantallas LED se han convertido en la actualidad en una potente herramienta de marketing para las marcas.', '1', 8),
(125, 18, 1, 'Pantalla de Interior AID - 03', '', 'HUAHAI', '0000', 'Si', '', '1', 9),
(126, 18, 1, 'Pantalla de Interior AID - 0 4', '', 'HUAHAI', '000', 'Si', '', '1', 10),
(127, 30, 1, 'CAMARA ANALOGICA EXTERIOR TIPO DOMO (PLASTICO', '', 'HIKVISION', '59.60', 'Si', 'CAMARA TIPO DOMO SOP PLASTICO ICR. RESOLUCION HD720P (1280 X 720). GRADO DE PROTECCION IP66.', '1', 12),
(128, 30, 1, 'CAMARA ANALOGICA EXTERIOR TIPO DOMO (PLASTICO', '', 'HIKVISION', '128.20', 'Si', 'Resolución: HD720P. Lente: 3.6mm. NTSC: 1280 (H) x 720 (V).', '1', 13),
(129, 29, 1, 'CAMARA IP EXTERIOR TIPO TUBO 2MP HD 1080P 30f', '', 'HIKVISION', '293.60', 'Si', 'Hasta 2Mp de resolución 1920 x 1080. Soporta Dual Stream y sub-stream para vigilancia móvil. Alto rendimiento y LEDs IR de larga duración rango de cobertura 10 a 30m.  ', '1', 15),
(130, 29, 1, 'CAMARA IP EXTERIOR TIPO DOMO  PTZ IP 1.3Mp', '', 'HIKVISION', '479.90', 'Si', 'Chip CMOS 1/3” de escaneo progresivo. Resolución 1280 x 960. Zoom optico de 20x zoom digital x16.', '1', 16),
(131, 29, 1, 'CAMARA IP INTERIOR TIPO ESFERA ', '', 'HIKVISION', '424.40', 'Si', 'Chip CMOS 1/4” Escaneo Progresivo. 1Mp de resolución. Video 1280×720 en Tiempo Real.', '1', 16),
(132, 29, 1, 'CAMARA IP INTERIOR TIPO MINI BULLET ', '', 'HIKVISION', '246.00', 'Si', 'Hasta 1Mp de resolución (1280 x 720). Audio 2-vias micro y parlante. PIR de Detección.', '1', 17),
(133, 29, 1, 'CAMARA IP INTERIOR TIPO DOMO', '', 'HIKVISION', '280.90', 'Si', 'Compresión de Video Estándar con Alto Nivel de compresión codificación ROI. Hasta 2Mp de resolución 1920 x 1080. Chip CMOS de Escaneo Progresivo. ', '1', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sublinea`
--

CREATE TABLE `sublinea` (
  `IdSubLinea` smallint(5) NOT NULL,
  `IdLinea` smallint(5) DEFAULT NULL,
  `Etiqueta` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sublinea`
--

INSERT INTO `sublinea` (`IdSubLinea`, `IdLinea`, `Etiqueta`) VALUES
(3, 4, 'Cintas Led'),
(4, 4, 'Modulos Led'),
(5, 4, 'Bombillas Led'),
(6, 4, 'Dicroico Led'),
(7, 4, 'Par Led'),
(8, 4, 'Tubos Led'),
(9, 4, 'Equipos Lineales Led'),
(10, 4, 'Reflectores Led'),
(11, 4, 'Paneles Led'),
(13, 4, 'Luces de Emergencia Led'),
(14, 4, 'Foco de Automovil Led'),
(15, 5, 'Panel Solar'),
(16, 5, 'Controlador Solar'),
(17, 5, 'Inversor Solar'),
(18, 6, 'Pantallas Led'),
(19, 6, 'Totem'),
(20, 6, 'VideoWall'),
(26, 8, 'Control de asistencia'),
(29, 10, 'Camaras IP'),
(30, 10, 'Camaras analogas '),
(31, 10, 'DVRs'),
(33, 5, 'BATERIAS SOLARES'),
(34, 4, 'Accesorios LED'),
(42, 8, 'Centrales telefonicas'),
(43, 9, 'Aire acondicionado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` smallint(5) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Contrasena` varchar(250) NOT NULL,
  `Nivel` enum('Cliente','Administrador') NOT NULL DEFAULT 'Cliente',
  `TimeUpload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `Nombre`, `Usuario`, `Contrasena`, `Nivel`, `TimeUpload`) VALUES
(1, 'Ian Moran', 'yinblack', '$2y$12$5SyvhxBrjUBko5d8zo8e..FjFHbVJk7ytGsDpmJvgPdSU.EH40wG.', 'Administrador', '2017-11-18 03:56:01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracteristica`
--
ALTER TABLE `caracteristica`
  ADD PRIMARY KEY (`IdCarecterisctica`),
  ADD KEY `IdProducto` (`IdProducto`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`IdConfiguracion`);

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`IdCotizacion`);

--
-- Indices de la tabla `cotizacionproducto`
--
ALTER TABLE `cotizacionproducto`
  ADD PRIMARY KEY (`IdCotizacionProducto`),
  ADD KEY `IdCotizacion` (`IdCotizacion`),
  ADD KEY `IdProducto` (`IdProducto`);

--
-- Indices de la tabla `cotizacionservicio`
--
ALTER TABLE `cotizacionservicio`
  ADD PRIMARY KEY (`IdCotizacionServicio`),
  ADD KEY `IdCotizacion` (`IdCotizacion`);

--
-- Indices de la tabla `linea`
--
ALTER TABLE `linea`
  ADD PRIMARY KEY (`IdLinea`);

--
-- Indices de la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD PRIMARY KEY (`IdMoneda`);

--
-- Indices de la tabla `precioescala`
--
ALTER TABLE `precioescala`
  ADD PRIMARY KEY (`IdPrecioEscala`),
  ADD KEY `IdProducto` (`IdProducto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`IdProducto`),
  ADD KEY `IdSubLinea` (`IdSubLinea`),
  ADD KEY `IdMoneda` (`IdMoneda`);

--
-- Indices de la tabla `sublinea`
--
ALTER TABLE `sublinea`
  ADD PRIMARY KEY (`IdSubLinea`),
  ADD KEY `IdLinea` (`IdLinea`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracteristica`
--
ALTER TABLE `caracteristica`
  MODIFY `IdCarecterisctica` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `IdConfiguracion` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  MODIFY `IdCotizacion` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT de la tabla `cotizacionproducto`
--
ALTER TABLE `cotizacionproducto`
  MODIFY `IdCotizacionProducto` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT de la tabla `cotizacionservicio`
--
ALTER TABLE `cotizacionservicio`
  MODIFY `IdCotizacionServicio` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `linea`
--
ALTER TABLE `linea`
  MODIFY `IdLinea` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `IdMoneda` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `precioescala`
--
ALTER TABLE `precioescala`
  MODIFY `IdPrecioEscala` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IdProducto` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
--
-- AUTO_INCREMENT de la tabla `sublinea`
--
ALTER TABLE `sublinea`
  MODIFY `IdSubLinea` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caracteristica`
--
ALTER TABLE `caracteristica`
  ADD CONSTRAINT `caracteristica_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cotizacionproducto`
--
ALTER TABLE `cotizacionproducto`
  ADD CONSTRAINT `cotizacionproducto_ibfk_1` FOREIGN KEY (`IdCotizacion`) REFERENCES `cotizacion` (`IdCotizacion`),
  ADD CONSTRAINT `cotizacionproducto_ibfk_2` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cotizacionservicio`
--
ALTER TABLE `cotizacionservicio`
  ADD CONSTRAINT `cotizacionservicio_ibfk_1` FOREIGN KEY (`IdCotizacion`) REFERENCES `cotizacion` (`IdCotizacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `precioescala`
--
ALTER TABLE `precioescala`
  ADD CONSTRAINT `precioescala_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`IdSubLinea`) REFERENCES `sublinea` (`IdSubLinea`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`IdMoneda`) REFERENCES `moneda` (`IdMoneda`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sublinea`
--
ALTER TABLE `sublinea`
  ADD CONSTRAINT `sublinea_ibfk_1` FOREIGN KEY (`IdLinea`) REFERENCES `linea` (`IdLinea`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
