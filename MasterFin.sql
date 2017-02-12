-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2014 at 12:21 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `master`
--

-- --------------------------------------------------------

--
-- Table structure for table `carro`
--

CREATE TABLE IF NOT EXISTS `carro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` varchar(12) COLLATE utf8_bin NOT NULL,
  `id_pelicula` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `nombrePelicula` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_peli` (`id_pelicula`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `id_pelicula` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` varchar(255) COLLATE utf8_bin NOT NULL,
  `nick` varchar(12) CHARACTER SET latin1 NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pelicula` (`id_pelicula`),
  KEY `nick` (`nick`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=32 ;

--
-- Dumping data for table `comentario`
--

INSERT INTO `comentario` (`id_pelicula`, `id`, `comentario`, `nick`, `fecha`) VALUES
(6, 27, 'Gran pelicula', 'Giancarlo', '2014-06-02'),
(6, 28, 'Lo secundo.', 'Manolo23', '2014-06-11'),
(6, 29, 'Excelente', 'Paco', '2014-06-05'),
(11, 30, 'Una gran pelicula, aunque le faltaron OVNIS.', 'Paco', '2014-06-05'),
(12, 31, 'Superficial y pueril, no la recomiendo ni a mi peor enemigo.', 'Paco', '2014-06-05');

-- --------------------------------------------------------

--
-- Table structure for table `pelicula`
--

CREATE TABLE IF NOT EXISTS `pelicula` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) COLLATE utf8_bin NOT NULL,
  `anyo` int(11) NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `sala` int(11) NOT NULL,
  `cartel` varchar(50) COLLATE utf8_bin NOT NULL,
  `sinopsis` varchar(1000) COLLATE utf8_bin NOT NULL,
  `precio` double NOT NULL DEFAULT '5',
  PRIMARY KEY (`id`),
  KEY `sala` (`sala`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=33 ;

--
-- Dumping data for table `pelicula`
--

INSERT INTO `pelicula` (`id`, `nombre`, `anyo`, `puntuacion`, `sala`, `cartel`, `sinopsis`, `precio`) VALUES
(6, 'Non Stop2', 2014, 2, 1, 'img/nonstop.jpg', 'Bill Marks (Liam Neeson), un veterano agente del servicio aereo de los Marshalls, se siente bastante quemado tanto con el mundo como con su profesion: no entiende su labor como un deber para salvaguardar vidas, sino como un rutinario trabajo de oficina a bordo de un avión. Sin embargo, un dia, en un viaje trasatlantico de Nueva York a Londres recibe una serie de misteriosos mensajes de texto, en los que se le pide que inste al gobierno a hacer una transferencia de 150 millones de dolares a una cuenta secreta, pues, en caso contrario, un pasajero moriria cada 20 minutos. El juego del gato y el ratï¿½n se desarrollado a 40.000 pies de altura y con la vida de 200 pasajeros pendiente de un hilo. ', 14),
(11, 'El origen de un imperio', 2014, 5, 2, 'img/300.jpg', 'Tras el éxito de “300″, su precuela “300: El origen de un imperio” lleva la acción a otro campo de batalla: el mar. La historia enfrenta al general griego Temístocles con las grandiosas fuerzas invasivas de Persia, dominadas por Jerjes, un mortal convertido en dios, y guiadas por Artemisia, vengativa comandante de la armada persa. Sabiendo que la única esperanza de derrotar a la arrolladora armada persa será unir toda Grecia, finalmente Temístocles dirige el ataque que cambiará el curso de la guerra.', 14),
(12, '8 apellidos Vascos', 2014, 4, 3, 'img/apellidosVascos.jpg', 'Rafa (Dani Rovira) es un joven señorito andaluz que no ha tenido que salir jamás de su Sevilla natal para conseguir lo único que le importa en la vida: el fino, la gomina, el Betis y las mujeres. Todo cambia cuando conoce a la primera mujer que se resiste a sus encantos: Amaia (Clara Lago), una chica vasca. Decidido a conquistarla, se traslada a un pueblo de "las Vascongadas", donde se hace pasar por vasco para conseguir que le haga caso. Adopta el nombre de Antxon, seguido de varios apellidos vascos: Arguiñano, Igartiburu, Erentxun, Gabilondo, Urdangarín, Otegi, Zubizarreta y… Clemente.', 14),
(14, 'Noe', 2014, 0, 4, 'img/noe.jpg', 'Inspirado por la épica historia de valor, sacrificio, esperanza y redención, Darren Aronofsky lleva al cine su personal visión de Noé. Russell Crowe interpreta al hombre elegido por Dios para llevar a cabo una  trascendental misión de rescate antes de que una inundación apocalíptica destruya el mundo. La historia completa nunca antes se había llevado a la gran pantalla en una epopeya, invitando al público a vivir esos espectaculares acontecimientos a través de la mirada y las emociones de Noé y su familia en su periplo por el miedo y la fe, la destrucción y el triunfo, la calamidad y la esperanza.', 14),
(31, 'Gran Estafa', 2014, 0, 5, 'img/granEstafa.jpg', 'Estado de Nueva York, años setenta. Irving Rosenfeld (Christian Bale), un brillante estafador, y su inteligente y seductora compañera Sydney Prosser (Amy Adams) se ven obligados a trabajar para un tempestuoso agente del FBI, Richie DiMaso (Bradley Cooper), que sin querer los arrastra al peligroso mundo de la polÃ­tica y la mafia de Nueva Jersey. ', 14);

-- --------------------------------------------------------

--
-- Table structure for table `puntuacion`
--

CREATE TABLE IF NOT EXISTS `puntuacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelicula` int(11) NOT NULL,
  `puntuacion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `puntuacion_ibfk_1` (`id_pelicula`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=20 ;

--
-- Dumping data for table `puntuacion`
--

INSERT INTO `puntuacion` (`id`, `id_pelicula`, `puntuacion`) VALUES
(1, 6, 4),
(2, 6, 3),
(3, 11, 5),
(4, 12, 3),
(5, 31, 5),
(7, 31, 3),
(8, 14, 4),
(9, 6, 0),
(10, 6, 0),
(11, 6, 4),
(12, 11, 4),
(13, 6, 4),
(14, 14, 1),
(15, 14, 0),
(16, 14, 4),
(17, 14, 0),
(18, 14, 0),
(19, 14, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sala`
--

CREATE TABLE IF NOT EXISTS `sala` (
  `id` int(11) NOT NULL,
  `Fila` int(11) NOT NULL,
  `Columna` int(11) NOT NULL,
  `Estado` int(11) NOT NULL,
  `butacas_disponibles` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `sala`
--

INSERT INTO `sala` (`id`, `Fila`, `Columna`, `Estado`, `butacas_disponibles`) VALUES
(1, 8, 10, 0, 50),
(2, 1, 2, 0, 50),
(3, 1, 3, 0, 50),
(4, 4, 2, 0, 47),
(5, 1, 1, 0, 49),
(6, 2, 4, 0, 49);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `nick` varchar(12) CHARACTER SET latin1 NOT NULL,
  `nombre` varchar(12) CHARACTER SET latin1 NOT NULL,
  `apellido` varchar(12) CHARACTER SET latin1 NOT NULL,
  `nCompras` int(11) NOT NULL,
  `contrasena` varchar(20) CHARACTER SET latin1 NOT NULL,
  `esAdmin` bit(1) NOT NULL,
  `SegundoApellido` varchar(12) COLLATE utf8_bin NOT NULL,
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `puntuacion` int(11) NOT NULL,
  PRIMARY KEY (`nick`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`nick`, `nombre`, `apellido`, `nCompras`, `contrasena`, `esAdmin`, `SegundoApellido`, `email`, `puntuacion`) VALUES
('admin', 'admin', 'admin', 32, 'admin', b'1', '', '', 160),
('Giancarlo', 'Giancarlo', 'McGregor', 1, '1234', b'0', 'Luizzi', 'mcgregor@mail.com', 0),
('Manolo23', 'Manolo', 'Garcia', 2, '1234', b'0', 'Montes', 'eseManu@gmail.com', 0),
('Paco', 'Paco', 'Jemez', 5, '1234', b'0', 'Hernando', 'paco@mail.com', 15);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carro`
--
ALTER TABLE `carro`
  ADD CONSTRAINT `fk_peli` FOREIGN KEY (`id_pelicula`) REFERENCES `pelicula` (`id`);

--
-- Constraints for table `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`nick`) REFERENCES `usuario` (`nick`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_IdTabla` FOREIGN KEY (`id_pelicula`) REFERENCES `pelicula` (`id`);

--
-- Constraints for table `puntuacion`
--
ALTER TABLE `puntuacion`
  ADD CONSTRAINT `puntuacion_ibfk_1` FOREIGN KEY (`id_pelicula`) REFERENCES `pelicula` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
