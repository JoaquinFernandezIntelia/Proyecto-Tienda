-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-04-2025 a las 10:27:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda-prueba1`
--
CREATE DATABASE IF NOT EXISTS `tienda-prueba1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tienda-prueba1`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `codigo_usuario` int(11) NOT NULL,
  `codigo_producto` varchar(12) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_agregado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `codigo_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL,
  `catgeneral_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`codigo_categoria`, `nombre_categoria`, `catgeneral_id`) VALUES
(1, 'General', NULL),
(2, 'Componentes', 1),
(3, 'Monitores', 1),
(4, 'Perifericos', 1),
(5, 'Hornos', 2),
(6, 'Aires Acondicionados', 2),
(7, 'Frigorificos', 2),
(8, 'Lavadoras', 2),
(10, 'Sofas', 3),
(11, 'Muebles', 3),
(12, 'Decoracion', 3),
(13, 'Collares', 4),
(14, 'Anillos', 4),
(15, 'Accesorios', 4),
(17, 'Jardin', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_generales`
--

CREATE TABLE `categorias_generales` (
  `codigo_catgeneral` int(11) NOT NULL,
  `nombre_catgeneral` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias_generales`
--

INSERT INTO `categorias_generales` (`codigo_catgeneral`, `nombre_catgeneral`) VALUES
(4, 'Bisuteria'),
(2, 'Electrodomesticos'),
(1, 'Electronica'),
(5, 'Farmacia'),
(6, 'Jardineria'),
(3, 'Para tu Hogar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codigo` varchar(12) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `precio` double NOT NULL,
  `imagen` varchar(500) NOT NULL,
  `descripcion` text NOT NULL,
  `vendedor` varchar(100) NOT NULL,
  `fecha_subida` datetime NOT NULL,
  `rebajado` tinyint(1) NOT NULL,
  `categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codigo`, `nombre_producto`, `precio`, `imagen`, `descripcion`, `vendedor`, `fecha_subida`, `rebajado`, `categoria`) VALUES
('ACC001', 'Pendientes Aro Grandes', 19.99, 'pendientes-aro.jpg', 'Pendientes de aro de 5cm de diámetro, acabado dorado mate.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 15),
('ACC002', 'Pulsera Elástica con Charms', 24.99, 'pulsera-charms.jpg', 'Pulsera elástica con diferentes charms decorativos, ajustable a todas las muñecas.', '192923492934221234-B', '2025-04-11 10:20:25', 1, 15),
('ACC003', 'Broche Floral Vintage', 15.99, 'broche-floral.jpg', 'Broche con diseño floral estilo vintage, acabado en oro envejecido con detalles de cristal.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 15),
('ACC004', 'Set de Horquillas Decorativas', 12.99, 'horquillas-deco.jpg', 'Conjunto de 6 horquillas decorativas con perlas y cristales para peinados de ocasión.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 15),
('ACC005', 'Tobillera con Colgantes', 18.99, 'tobillera-colgantes.jpg', 'Tobillera ajustable con pequeños colgantes en forma de estrella, chapada en plata.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 15),
('AIRE001', 'Aire Acondicionado Split Daikin 2200 frig/h', 549.99, 'daikin-split.jpg', 'Aire acondicionado inverter con 2200 frigorías, eficiencia A++ y muy silencioso.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 6),
('AIRE002', 'Aire Acondicionado Portátil Delonghi PAC', 349.99, 'delonghi-portatil.jpg', 'Aire acondicionado portátil de 2700 frigorías con función deshumidificador y mando a distancia.', '192923492934221234-B', '2025-04-11 10:20:25', 1, 6),
('AIRE003', 'Multi Split Mitsubishi 3x1', 1299.99, 'mitsubishi-multi.jpg', 'Sistema multisplit 3x1 con unidad exterior y tres unidades interiores para climatizar varias habitaciones.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 6),
('AIRE004', 'Ventilador de Torre Rowenta Eole Infinite', 89.99, 'rowenta-ventilador.jpg', 'Ventilador de torre con 3 velocidades, modo noche y temporizador de 8 horas.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 6),
('ANIL001', 'Anillo Solitario con Circonita', 49.99, 'anillo-solitario.jpg', 'Anillo solitario con piedra circonita central de 6mm, acabado en plata de ley.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 14),
('ANIL002', 'Set de 3 Anillos Apilables', 39.99, 'anillos-apilables.jpg', 'Conjunto de 3 anillos finos para combinar en acabados oro, plata y oro rosa.', '192923492934221234-B', '2025-04-11 10:20:25', 1, 14),
('ANIL003', 'Anillo Ajustable con Perla', 29.99, 'anillo-perla.jpg', 'Anillo ajustable con perla sintética y detalles en forma de hojas.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 14),
('ANIL004', 'Alianza Fina con Grabado', 59.99, 'alianza-grabado.jpg', 'Alianza fina con posibilidad de grabado interior, en plata de primera ley.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 14),
('COLL001', 'Collar Gargantilla con Cristales', 29.99, 'collar-gargantilla.jpg', 'Gargantilla ajustable con cristales transparentes, acabado en plata.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 13),
('COLL002', 'Collar Colgante Corazón', 39.99, 'collar-corazon.jpg', 'Cadena con colgante de corazón y detalle de circonita, baño en oro rosa.', '192923492934221234-B', '2025-04-11 10:20:25', 1, 13),
('COLL003', 'Collar Perlas Cultivadas', 59.99, 'collar-perlas.jpg', 'Collar de perlas cultivadas de agua dulce con cierre de plata.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 13),
('COLL004', 'Collar Personalizado con Nombre', 45.99, 'collar-nombre.jpg', 'Collar con nombre personalizable en letra cursiva, chapado en oro.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 13),
('COMP001', 'Procesador Intel Core i7-12700K', 349.99, 'procesador-i7.jpg', 'Procesador de 12 núcleos y 20 hilos, velocidad base de 3.6GHz y turbo hasta 5.0GHz.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 2),
('COMP002', 'Tarjeta Gráfica NVIDIA RTX 4060', 399.99, 'rtx-4060.jpg', 'Tarjeta gráfica con 8GB GDDR6, ideal para gaming en 1440p.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 2),
('COMP003', 'Memoria RAM Corsair Vengeance 16GB', 89.99, 'ram-corsair.jpg', 'Kit de memoria RAM DDR4 de 16GB (2x8GB) a 3200MHz con iluminación RGB.', '192923492934221234-B', '2025-04-11 10:20:25', 1, 2),
('COMP004', 'Placa Base ASUS ROG Strix B550-F', 169.99, 'asus-b550.jpg', 'Placa base ATX con soporte para AMD Ryzen 5000, WiFi 6 y puertos USB 3.2.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 2),
('COMP005', 'Fuente de Alimentación EVGA 750W', 99.99, 'evga-psu.jpg', 'Fuente modular 80 Plus Gold con capacidad de 750W y ventilador silencioso.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 2),
('DECO001', 'Lámpara de Pie Moderna', 89.99, 'lampara-pie.jpg', 'Lámpara de pie con pantalla textil y estructura metálica negra, altura ajustable.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 12),
('DECO002', 'Conjunto de 3 Cuadros Abstractos', 59.99, 'cuadros-abstractos.jpg', 'Set de 3 cuadros con diseños abstractos geométricos, marco negro y tamaño 30x40cm.', '192923492934221234-B', '2025-04-11 10:20:25', 1, 12),
('DECO003', 'Espejo de Pared Redondo', 79.99, 'espejo-redondo.jpg', 'Espejo de pared redondo con marco dorado de 80cm de diámetro.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 12),
('DECO004', 'Alfombra Salón 160x230cm', 129.99, 'alfombra-salon.jpg', 'Alfombra de pelo corto para salón con diseño geométrico en tonos grises y blancos.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 12),
('DECO005', 'Set de Velas Aromáticas', 24.99, 'velas-aromaticas.jpg', 'Conjunto de 3 velas aromáticas en recipiente de cristal con aromas de vainilla, lavanda y cítricos.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 12),
('FRIG001', 'Frigorífico Combi Bosch KGN39VIDA', 699.99, 'bosch-combi.jpg', 'Frigorífico combi No Frost de 203x60cm, clase A+++ con cajón VitaFresh y acabado en acero inoxidable.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 7),
('FRIG002', 'Frigorífico Side by Side Samsung RS68A8840S9', 1499.99, 'samsung-side.jpg', 'Frigorífico americano con dispensador de agua y hielo, pantalla digital y tecnología SpaceMax.', '192923492934221234-B', '2025-04-11 10:20:25', 1, 7),
('FRIG003', 'Mini Nevera Klarstein 48L', 129.99, 'klarstein-mini.jpg', 'Mini nevera de 48 litros ideal para habitaciones, oficinas o zonas de ocio.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 7),
('FRIG004', 'Frigorífico una puerta Liebherr K 3130', 449.99, 'liebherr-una.jpg', 'Frigorífico de una puerta con 297 litros de capacidad y eficiencia energética A++.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 7),
('GEN001', 'Set de Maletas 3 piezas', 149.99, 'maletas-set.jpg', 'Conjunto de 3 maletas rígidas con ruedas 360° en diferentes tamaños, color azul marino.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 1),
('GEN002', 'Reloj de Pared Moderno', 34.99, 'reloj-pared.jpg', 'Reloj de pared con diseño minimalista, números grandes y marco metálico negro.', '192923492934221234-B', '2025-04-11 10:20:25', 1, 1),
('GEN003', 'Set de Toallas 5 piezas', 49.99, 'toallas-set.jpg', 'Conjunto de 5 toallas de diferentes tamaños en algodón 100%, color gris antracita.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 1),
('GEN004', 'Báscula Digital de Baño', 19.99, 'bascula-baño.jpg', 'Báscula digital con pantalla LCD, capacidad hasta 180kg y función de medición de grasa corporal.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 1),
('GEN005', 'Paraguas Plegable Automático', 24.99, 'paraguas-auto.jpg', 'Paraguas plegable con apertura y cierre automáticos, tejido repelente al agua y estructura reforzada.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 1),
('HOR001', 'Horno Balay 3HB4331X0', 329.99, 'balay-horno.jpg', 'Horno multifunción de acero inoxidable con 7 funciones y sistema de limpieza pirolítica.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 5),
('HOR002', 'Horno Bosch HBA5370S0', 449.99, 'bosch-horno.jpg', 'Horno eléctrico con 10 modos de cocción, display LCD y eficiencia energética A+.', '192923492934221234-B', '2025-04-11 10:20:25', 1, 5),
('HOR003', 'Microondas con Grill Samsung MG23K3515AK', 129.99, 'samsung-microondas.jpg', 'Microondas de 23L con función grill, 800W de potencia y panel táctil.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 5),
('HOR004', 'Horno de Vapor Siemens iQ700', 799.99, 'siemens-vapor.jpg', 'Horno de vapor con funciones avanzadas, pantalla TFT y conexión Home Connect.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 5),
('JARD001', 'Conjunto Mesa y 4 Sillas para Exterior', 299.99, 'conjunto-jardin.jpg', 'Conjunto de mesa y 4 sillas para jardín en ratán sintético resistente a la intemperie.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 17),
('JARD002', 'Barbacoa de Gas a Quemadores', 249.99, 'barbacoa-gas.jpg', 'Barbacoa de gas con 3 quemadores, tapa con termómetro y parrillas de hierro fundido.', '192923492934221234-B', '2025-04-11 10:20:25', 1, 17),
('JARD003', 'Parasol Reclinable 3 metros', 79.99, 'parasol-reclinable.jpg', 'Parasol reclinable de 3 metros de diámetro con manivela para apertura fácil, color beige.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 17),
('JARD004', 'Set de Herramientas de Jardinería', 39.99, 'herramientas-jardin.jpg', 'Kit completo con 8 herramientas esenciales para jardinería con estuche organizador.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 17),
('JARD005', 'Macetero Vertical para Hierbas', 59.99, 'macetero-hierbas.jpg', 'Macetero vertical con 5 niveles para cultivo de hierbas aromáticas y pequeñas plantas.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 17),
('LAV001', 'Lavadora Siemens WM14T790ES', 599.99, 'siemens-lavadora.jpg', 'Lavadora de carga frontal de 9kg, 1400rpm, eficiencia A+++ y motor iQdrive.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 8),
('LAV002', 'Lavadora-Secadora LG F4DN408S0', 749.99, 'lg-lavaseca.jpg', 'Lavadora-secadora con capacidad de 8/5kg, 1400rpm y tecnología 6 Motion Direct Drive.', '192923492934221234-B', '2025-04-11 10:20:25', 1, 8),
('LAV003', 'Lavadora Carga Superior Indesit BTW L60300', 329.99, 'indesit-superior.jpg', 'Lavadora de carga superior con 6kg de capacidad, 1000rpm y programas rápidos.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 8),
('LAV004', 'Secadora Balay 3SC377B', 449.99, 'balay-secadora.jpg', 'Secadora de condensación con bomba de calor, 7kg de capacidad y eficiencia A++.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 8),
('MON001', 'Monitor LG UltraGear 27\" 144Hz', 249.99, 'lg-monitor.jpg', 'Monitor gaming de 27 pulgadas con resolución 1440p, 144Hz y tiempo de respuesta de 1ms.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 3),
('MON002', 'Monitor Samsung Odyssey G5 32\"', 329.99, 'samsung-odyssey.jpg', 'Monitor curvo gaming de 32 pulgadas con resolución 2K y frecuencia de 165Hz.', '192923492934221234-B', '2025-04-11 10:20:25', 1, 3),
('MON003', 'Monitor ASUS ProArt 27\" 4K', 499.99, 'asus-proart.jpg', 'Monitor profesional con pantalla 4K, calibrado de fábrica para diseño gráfico y edición de vídeo.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 3),
('MON004', 'Monitor Dell UltraSharp 24\"', 199.99, 'dell-ultrasharp.jpg', 'Monitor de 24 pulgadas con panel IPS, resolución 1080p y excelente calibración de color.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 3),
('MUEB001', 'Mesa de Comedor Extensible', 299.99, 'mesa-comedor.jpg', 'Mesa de comedor extensible de 140/200cm, con acabado en madera de roble y patas metálicas.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 11),
('MUEB002', 'Armario 4 Puertas con Espejo', 399.99, 'armario-espejo.jpg', 'Armario de 4 puertas con espejo central, acabado en blanco mate y gran capacidad interior.', '192923492934221234-B', '2025-04-11 10:20:25', 1, 11),
('MUEB003', 'Cómoda de 6 Cajones', 199.99, 'comoda-cajones.jpg', 'Cómoda con 6 cajones espaciosos, acabado en madera de pino natural con tiradores metálicos.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 11),
('MUEB004', 'Escritorio con Estantería', 149.99, 'escritorio-estanteria.jpg', 'Escritorio con estantería lateral integrada, acabado en blanco y roble con cajón organizador.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 11),
('MUEB005', 'Mesita de Noche Nórdica', 69.99, 'mesita-nordica.jpg', 'Mesita de noche con 2 cajones, diseño nórdico en madera clara con patas inclinadas.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 11),
('PER001', 'Teclado Mecánico Logitech G Pro', 129.99, 'logitech-teclado.jpg', 'Teclado mecánico gaming con switches GX Blue y retroiluminación RGB.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 4),
('PER002', 'Ratón Razer DeathAdder V2', 69.99, 'razer-deathadder.jpg', 'Ratón gaming ergonómico con sensor óptico de 20.000 DPI y switches ópticos.', '192923492934221234-B', '2025-04-11 10:20:25', 1, 4),
('PER003', 'Auriculares HyperX Cloud Alpha', 99.99, 'hyperx-cloud.jpg', 'Auriculares gaming con micrófono desmontable y sonido envolvente 7.1.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 4),
('PER004', 'Webcam Logitech C920 HD Pro', 79.99, 'logitech-webcam.jpg', 'Webcam Full HD 1080p con micrófono dual y corrección automática de luz.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 4),
('PER005', 'Alfombrilla SteelSeries QcK XXL', 29.99, 'steelseries-pad.jpg', 'Alfombrilla de gran tamaño (900x400mm) con base antideslizante y superficie microtexturada.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 4),
('SOFA001', 'Sofá 3 plazas IKEA KIVIK', 499.99, 'ikea-kivik.jpg', 'Sofá de 3 plazas con reposapiés incluido, tapizado en tela gris oscuro y asientos extraíbles.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 10),
('SOFA002', 'Sofá Chaise Longue Reclinable', 699.99, 'chaise-longue.jpg', 'Sofá con chaise longue a la derecha, asientos reclinables y función cama, tapizado en polipiel.', '192923492934221234-B', '2025-04-11 10:20:25', 1, 10),
('SOFA003', 'Sofá Cama Clic-Clac', 349.99, 'sofa-cama.jpg', 'Sofá cama con sistema clic-clac para convertirlo en cama de matrimonio, tapizado en tela azul.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 10),
('SOFA004', 'Sillón Orejero Reclinable', 279.99, 'sillon-orejero.jpg', 'Sillón orejero con función relax manual, tapizado en tela antimanchas color beige.', '192923492934221234-B', '2025-04-11 10:20:25', 0, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `codigo_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`codigo_usuario`, `nombre_usuario`, `password`) VALUES
(3, 'Admin', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `codigo_vendedor` varchar(20) NOT NULL,
  `nombre_vendedor` varchar(100) NOT NULL,
  `NIF` varchar(9) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`codigo_vendedor`, `nombre_vendedor`, `NIF`, `password`) VALUES
('192923492934221234-B', 'Joaquin', 'X8282727S', '1234');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carrito_usuario` (`codigo_usuario`),
  ADD KEY `fk_carrito_producto` (`codigo_producto`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`codigo_categoria`),
  ADD UNIQUE KEY `Unico` (`nombre_categoria`),
  ADD KEY `fk_categoria_catgeneral` (`catgeneral_id`);

--
-- Indices de la tabla `categorias_generales`
--
ALTER TABLE `categorias_generales`
  ADD PRIMARY KEY (`codigo_catgeneral`),
  ADD UNIQUE KEY `nombre_catgeneral` (`nombre_catgeneral`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_vendedor` (`vendedor`),
  ADD KEY `fk_productos_categoria` (`categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`codigo_usuario`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`codigo_vendedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `codigo_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `categorias_generales`
--
ALTER TABLE `categorias_generales`
  MODIFY `codigo_catgeneral` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `codigo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_carrito_producto` FOREIGN KEY (`codigo_producto`) REFERENCES `productos` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_carrito_usuario` FOREIGN KEY (`codigo_usuario`) REFERENCES `usuarios` (`codigo_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categoria_catgeneral` FOREIGN KEY (`catgeneral_id`) REFERENCES `categorias_generales` (`codigo_catgeneral`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_categoria` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`codigo_categoria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vendedor` FOREIGN KEY (`vendedor`) REFERENCES `vendedor` (`codigo_vendedor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
