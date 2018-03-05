-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-01-2018 a las 09:49:11
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE IF NOT EXISTS `citas` (
`id` bigint(20) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `motivo` varchar(50) NOT NULL,
  `lugar` varchar(30) NOT NULL,
  `id_cliente` bigint(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `fecha`, `hora`, `motivo`, `lugar`, `id_cliente`) VALUES
(11, '2017-12-13', '11:22:00', 'Entrega llaves piso', 'C/ tortola, 44', 3),
(15, '2018-01-22', '17:00:00', 'Ver chalet ', 'Carretera de la Sierra, 12', 15),
(16, '2018-01-30', '09:00:00', 'Firma de papeles ático', 'Oficina', 3),
(20, '2018-01-30', '13:00:00', 'Visitar piso', 'Calle rosales, 17', 2),
(21, '2018-01-24', '11:00:00', 'Ver piso', 'Plaza de la Nava, 5', 15),
(22, '2018-01-26', '09:00:00', 'Firma de papeles ', 'Oficina', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
`id` bigint(20) unsigned NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono1` varchar(9) NOT NULL,
  `telefono2` varchar(9) DEFAULT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `pass` varchar(32) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `direccion`, `telefono1`, `telefono2`, `nombre_usuario`, `pass`) VALUES
(0, 'disponible', '', '', '', NULL, '', ''),
(1, 'administrador', 'administrador', 'administrador', '111111111', '', 'admin', 'c3284d0f94606de1fd2af172aba15bf3'),
(2, 'Marisa', 'Perez Martínez', 'Av. Nueva, 123', '611622633', '', '', ''),
(3, 'Timoteo', 'Torrecillas ', 'Plaza vieja, 89', '611622633', '644323198', '', ''),
(15, 'Rubén', 'Segura Romo', 'C/ Doctor Pareja Yébenes, 8', '664790808', '', 'ruben', '8b9251b98a24c09124db5a9f7271c522'),
(16, 'Delia', 'Sánchez Carrillo', 'C/ industrial, 17', '612321441', '', 'delia', '6bc5e6e2c31e813fb33bef0f2d938f05'),
(17, 'José', 'Torrecillas Fernández', 'C/ Tahona ,5', '685633215', '615993215', 'jose', '9b68086445d968e8a97f74f00df9738f');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles`
--

CREATE TABLE IF NOT EXISTS `inmuebles` (
`id` bigint(20) unsigned NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `descripcion` varchar(1500) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `id_cliente` bigint(20) NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `inmuebles`
--

INSERT INTO `inmuebles` (`id`, `direccion`, `descripcion`, `precio`, `id_cliente`, `imagen`) VALUES
(7, 'Carretera de la sierra, 24', 'Chalet totalmente reformado y equ', '99000.00', 15, './img_inmuebles/7.png'),
(8, 'Calle del triunfo, 3 Ático B', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec tristique tellus. Phasellus id finibus quam. Vivamus odio velit, porttitor ac condimentum sit amet, pharetra sit amet lacus. Nullam quis nunc congue, volutpat nibh quis, ultricies nibh. Donec quis suscipit mi. Aenean vel vulputate augue. Vivamus ligula mauris, laoreet non augue a, facilisis fringilla est. Suspendisse tempor justo sed augue sagittis, non pulvinar metus feugiat. Sed ac nulla erat. Proin ornare pharetra leo, et elementum nunc consectetur sed. Nullam consectetur viverra lacus non feugiat.', '500000.00', 14, './img_inmuebles/8.png'),
(10, 'Av. de andalucía, 77', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos culpa tempora deleniti omnis nihil! Sit odit, culpa earum, repellendus et est adipisci odio eum amet. Rerum tempore, enim cumque expedita!', '700000.00', 0, './img_inmuebles/10.jpg'),
(12, 'Casa adosada en Los Llanos / Playa Blanca, Yaiza', 'Villa coloradas Playa se encuentra ubicada en un conjunto residencial en primera linea de de mar formado por 31 villas de dos plantas con fantasticas vistas. Dispone de 3 dormitorios, dos cuartos de baño, un aseo, cocina independiente, salón comedor, solana, 3 terrazas, piscina privada, plaza de aparcamiento subterráneo y trastero.', '400000.00', 0, './img_inmuebles/12.png'),
(13, 'Apartamento en Barrio Arcocha, 86 / Zaratamo', 'Coqueto piso muy luminoso, con hermosas vistas recién reformado. Zona residencial. Amplia cocina salón de un ambiente (placa de inducción). Puertas y ventanas de PVC abatibles nuevas, persianas eléctricas con mando a distancia. Instalación eléctrica nueva con luces LED. Balcón Lavadero cerrado con nstalación de lavadora y secadora. Calefacción individual de gas. Trastero 10 MT2. Garaje con ascensor directo.', '240000.00', 0, './img_inmuebles/13.png'),
(15, 'Chalet en La Moraleja - La Moraleja Distrito, 42', 'Consta de 657 m² sobre una parcela de 2.800 m². Se distribuye en dos cómodas plantas junto a sótanos. Iniciando su recorrido, tras un representativo hall, nos da la bienvenida un fabuloso salón distribuido en varios ambientes, con comedor independiente y grandes cristaleras que aportan gran luminosidad en esta estancia, lindando con su parcela privada donde hallamos una preciosa piscina. La cocina, una gran estancia con espacio para office, aseo de cortesía, y para completar esta planta, tras el pasillo, se distribuyen tres dormitorios y dos cuartos de baño completos', '2600000.00', 0, './img_inmuebles/15.png'),
(16, 'Piso en Alicante ,Centro ', 'Tipo de inmueble : Piso\r\nPlanta : 2ª planta\r\nEstado : Muy buen estado\r\nAntigüedad : De 30 a 50 años\r\nOrientación : Orientación Oeste', '260000.00', 0, './img_inmuebles/16.png'),
(17, 'Chalet en Urbanización Santa Maria, 5', 'Espectacular chalet en la zona “la Miranda” con vistas al Montseny.Sobre una parcela de 860 m² en terreno ascendente situamos la estructura de 280m² compuesta de 3 plantas y rodeada por 4 terrazas.En la primera planta un garaje de 50m² con lavadero y trastero (caldera gasoil y deposito 1000lt), espacio para dos coches en el interior y dos mas en la parte exterior.En la segunda planta un amplio recibidor, cocina totalmente equipada con acceso a una terraza de 50m² , una habitación doble, lavabo con ducha, comedor con chimenea y salida a otra terraza de 60m².En la tercera planta una suite con vestidor (armarios empotrados) y lavabo privado con bañera, dos habitaciones dobles (una de ella con salida a otra terraza de 35m²) y un lavabo con ducha.En la parte trasera encontramos un jardín de 350m² con césped, casita de herramientas de 8m², huerto de 35m² y gallinero.', '485000.00', 16, './img_inmuebles/17.png'),
(18, 'Ático en Centro ', 'Ático -Dúplex con gran terraza junto al Museo Reina Sofía. Magnífica vivienda de 92 M2 situada en una cuarta planta con ascensor, distribuida en dos plantas: En planta baja disponemos de salón comedor, cocina y aseo, y en planta superior los 2 dormitorios, baño, un espacioso vestidor amueblado y una gran terraza de 15 m2 con pérgola japonesa y muebles de jardín de teka, orientada hacia un enorme patio de manzana muy tranquilo. La vivienda es muy luminosa, gracias a su altura y a su orientación Sur y Este. Aire acondicionado con bomba de calor. Carpintería exterior de aluminio con ventanas con aislante termo acústico. ', '485000.00', 0, './img_inmuebles/18.png'),
(19, 'Chalet en Marratxí, Zona Residencial', 'Chalet unifamiliar en solar de 2.200m2 aprox. en zona residencial, vivienda de 400m2 aprox., amplio salon comedor de 60m2 aprox con chimenea, cocina amueblada con office, 5 habitaciones (1 en planta baja), armarios, 3 baños (1 en suite), suelos de parquet, a.a. frío- calor, suelo radiante, porches, 1500m2 aprox de jardin, piscina, barbacoa, garaje patra 4 coches, trastero.', '900000.00', 0, './img_inmuebles/19.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
`id` bigint(20) unsigned NOT NULL,
  `titular` varchar(30) NOT NULL,
  `contenido` varchar(1500) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titular`, `contenido`, `imagen`, `fecha`) VALUES
(1, 'Black friday inmobiliario', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut soluta commodi, aperiam, sint assumenda, sit deserunt quas, cupiditate reprehenderit cum sunt dolor vitae vel voluptas maxime maiores iste non. Magnam!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut soluta commodi, aperiam, sint assumenda, sit deserunt quas, cupiditate reprehenderit cum sunt dolor vitae vel voluptas maxime maiores iste non. Magnam!', './img_noticias/1.png', '2017-11-28'),
(4, 'Nuevos pisos', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut soluta commodi, aperiam, sint assumenda, sit deserunt quas, cupiditate reprehenderit cum sunt dolor vitae vel voluptas maxime maiores iste non. Magnam!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut soluta commodi, aperiam, sint assumenda, sit deserunt quas, cupiditate reprehenderit cum sunt dolor vitae vel voluptas maxime maiores iste non. Magnam!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut soluta commodi, aperiam, sint assumenda, sit deserunt quas, cupiditate reprehenderit cum sunt dolor vitae vel voluptas maxime maiores iste non. Magnam!', './img_noticias/4.png', '2017-11-27'),
(7, 'Acceso a la vivienda', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', './img_noticias/6.png', '2017-11-28'),
(16, 'Nuevo sector estrella en Bolsa', 'El sector inmobiliario centra este año las miradas en el mercado. Tras una década donde ninguna promotora inmobiliaria salía a Bolsa, este año, dos de ellas (Neinor y Aedas) han saltado al parqué; mientras que la histórica Colonial, convertida en Socimi en junio, protagoniza una operación de más de 1.200 millones al lanzar, el pasado 13 de noviembre, una opa sobre su homóloga Axiare.\r\nTodas estas operaciones han puesto en el foco en este tipo de empresas que, tras años fuera de la lista de recomendaciones bursátiles, cuentan en su mayoría con el apoyo de los analistas.', './img_noticias/16.png', '2017-12-11'),
(17, 'Piratas inmobiliarios', 'inmobiliaria', './img_noticias/17.png', '2017-12-13'),
(18, 'Las promotoras te buscan ', 'Las promotoras inmobiliarias se han puesto a vender atención. Una limpieza integral del piso y de las zonas comunes antes de la entrega de las llaves, una botella de vino dispuesta en el recibidor al abrir la puerta, compromiso de respuesta en la gestión de desperfectos en menos de 48 horas, canales de comunicación digitales o trato personalizado son algunas de las atenciones que están recibiendo los nuevos compradores de vivienda. Unos años de crisis y de sequía en las ventas han bastado para que este sector empiece a tener en cuenta a su cliente, antes y después de la compra.', './img_noticias/18.png', '2017-12-13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
