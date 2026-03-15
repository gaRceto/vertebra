-- phpMyAdmin SQL Dump
-- version 4.2.6
-- http://www.phpmyadmin.net
--
-- Servidor: 172.31.131.168
-- Tiempo de generación: 16-09-2017 a las 19:21:12
-- Versión del servidor: 5.5.57-0+deb7u1-log
-- Versión de PHP: 5.3.29-1~dotdeb.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `enconstruccion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
`id` int(20) unsigned NOT NULL,
  `padre` int(20) unsigned NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `comentario` text NOT NULL,
  `aceptado` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `padre`, `nombre`, `email`, `fecha`, `titulo`, `comentario`, `aceptado`) VALUES
(1, 1, 'andres', 'ancucalon@gmail.com', '1505561446', 'Primarias en Podemos Â¿PorquÃ©?', 'Pues que hay que hacerlas al renunciar Echenique a dirigir PODEMOS ARAGÃ“N. Nada que criticar, mÃ¡s bien aplaudir, el inmenso trabajo y esfuerzo de muchas personas que han confluido en la elaboraciÃ³n de documentos y candidaturas. Y animar a quienes no nos vemos plenamente representados en los mismos a lanzar iniciativas colectivas, como espero sea Ã©sta, para hacer visible otra forma de creer en este Proyecto.', 1),
(2, 2, 'andres', 'ancucalon@gmail.com', '1505561923', 'Primarias en Podemos Â¿PorquÃ©?', 'ese comentario responde a la pregunta de quÃ© opinaba sobre la celebraciÃ³n de primarias en AragÃ³n.', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentxt`
--

CREATE TABLE IF NOT EXISTS `comentxt` (
`id` int(20) unsigned NOT NULL,
  `abuelo` int(20) unsigned NOT NULL,
  `padre` int(20) unsigned NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `titulo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `comentario` text COLLATE utf8_spanish_ci NOT NULL,
  `aceptado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `firmas`
--

CREATE TABLE IF NOT EXISTS `firmas` (
`id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `localidad` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `provincia` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `privacidad` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=46 ;

--
-- Volcado de datos para la tabla `firmas`
--

INSERT INTO `firmas` (`id`, `name`, `email`, `localidad`, `provincia`, `privacidad`) VALUES
(1, 'MARÃA PILAR HERNANDEZ MARZO', 'pilarh1960@gmail.com', 'ZARAGOZA', 'Zaragoza', 1),
(2, 'mamen lÃ³pez', 'menchotin@gmail.com', 'Zaragoza', 'Zaragoza', 0),
(3, 'Jonatan GÃ³mez CasalÃ©', 'jonangc@gmail.com', 'AlagÃ³n', 'Zaragoza', 0),
(4, 'Guillermo GarcÃ­a RougÃ©', 'guillermogarciarouge@gmail.com', 'AlcalÃ¡ de Ebro', 'Zaragoza', 0),
(7, 'JosÃ© Ignacio SÃ¡nchez Elipe', 'nachosaneli@gmail.com', 'Zaragoza', 'Zaragoza', 0),
(8, 'Itai Lozano', 'itailozano@gmail.com', 'ZARAGOZA', 'Zaragoza', 1),
(9, 'Milagros Maria JosÃ© PÃ©rez Torres', 'starencendida@hotmail.com', 'Zaragoza', 'Zaragoza', 0),
(10, 'MarÃ­a del Pino lopez', 'mariap1962@hotmail.es', 'Barrio Garrapinillos', 'Zaragoza', 0),
(11, 'CÃ©sar FernÃ¡ndz Arias', 'clfarias@telefonica.net', 'Toral de los Vados', 'LeÃ³n', 0),
(12, 'Eduardo Lozano SÃ¡ez', 'ecotornillo@gmail.com', 'Barboles', 'Zaragoza', 0),
(13, 'Fernando Arias Hernandez', 'fer.ariher55@gmail.com', 'Ponferrada', 'Leon', 0),
(14, 'miguel angel sanz', 'pcmasterzgz@gmail.com', 'zaragoza', 'zaragoza', 0),
(15, 'FRAN PEDRAJAS PEREZ', 'fpedrajas@hotmail.es', 'Zaragoza', 'Zaragoza', 0),
(16, 'Ana Mora Infantes', 'anamorainfantes@gmail.com', 'Zaragoza', 'Zaragoza', 0),
(17, 'MarÃ­a IbÃ¡Ã±ez', 'mariaiban@live.com', 'Zaragoza', 'Zaragoza', 0),
(18, 'Marta ChordÃ¡', 'mrtchorda@gmail.com', 'Zaragoza', 'Zaragoza', 1),
(19, 'Nuria morera', 'nuria_mpa@hotmail.com', 'Zaragoza', 'Zaragoza', 1),
(20, 'Amor Olomi Calderon', 'aolomi@gmail.com', 'Pardinella', 'Huesca', 0),
(21, 'JosÃ© Antonio', 'manloti@hotmail.com', 'Zuera', 'Zaragoza', 0),
(22, 'JosÃ© Manuel Magallon', 'jm.magallon@gmail.com', 'Zaragoza', 'Zaragoza', 0),
(23, 'Alexander', 'alinchl@yahoo.es', 'Zaragoza', 'Zaragoza', 0),
(24, 'JosÃ© Antonio PuÃ©rtolas PuÃ©rtolas', 'japselfmadenan@yahoo.es', 'Huesca', 'Huesca', 1),
(25, 'Pedro Triguero Palencia', 'triguero.pedro@gmail.com', 'La Muela', 'Zaragoza', 0),
(26, 'Jose Luis Romero MartÃ­nez', 'j-l-romero@hotmail.com', 'Huesca', 'Huesca', 0),
(27, 'Julian Ferrer', 'jufese@gmail.com', 'Zaragoza', 'Zaragoza', 0),
(28, 'Luis Salamero', 'luissalamero@hotmail.es', 'Barbastro', 'Huesca', 0),
(29, 'Marisa Almor SabirÃ³n', 'marisa.almor@gmail.com', 'Bea', 'Teruel', 1),
(30, 'Felix DÃ­a Morales', 'flix.1983@gmail.com', 'barbastro', 'Huesca', 1),
(31, 'Yolanda Lesmes Martinez', 'yolandalesmes@msn.com', 'Barbastro', 'HUESCA', 0),
(32, 'Mari sol cÃ¡ncer campo', 'msol.cancer@hotmail.com', 'Barbastro', 'Huesca', 0),
(33, 'Miguel Cerdan Gomez', 'miguelcerdangomez@gmail.com', 'Elche', 'Alicante', 0),
(34, 'Julio Labandera Garcia', 'juliolabandera@gmail.com', 'Zaragoza', 'Zaragoza', 0),
(35, 'AndrÃ©s CucalÃ³n Arenal', 'ancucalon@gmail.com', 'Andorra', 'Teruel', 0),
(36, 'MarÃ­a Luisa CarreÃ±o Armengol', 'la_chiri_@hotmail.com', 'AlcaÃ±iz', 'Teruel', 1),
(37, 'JosÃ© Luis MartÃ­nez Armengod', 'losmontalvos@hotmail.es', 'AlcaÃ±iz', 'Teruel', 1),
(38, 'Jordi Martin Calvo', 'martinetjovb@hotmail.es', 'ALCORISA', 'TERUEL', 0),
(39, 'Manuel dellgado', 'mde00023@gmail.com', 'Zaragoza', 'Zaragoza', 1),
(40, 'Angel Lalinde Laita', 'angel@lyt.net', 'Zaragoza', 'Zaragoza', 1),
(41, 'Vanesa SÃ¡nchez', 'vane.arkana@yahoo.es', 'Utebo', 'Zaragoza', 1),
(42, 'Javier Villarroya Andreu', 'javier.villarroya@hotmail.com', 'AlcaÃ±iz', 'Teruel', 1),
(43, 'Isabel Espes Repolles', 'isabelespesrepolles@hotmail.com', 'Samper de Calanda', 'Teruel', 0),
(44, 'JesÃºs Campos LÃ³pez', 'chesus1963@hotmail.com', 'La Puebla de Alfinden', 'Zaragoza', 0),
(45, 'Diana Serafi per', 'dianaserafi@gmail.com', 'Samper de calanda', 'Teruel', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentxt`
--
ALTER TABLE `comentxt`
 ADD PRIMARY KEY (`id`), ADD KEY `abuelo` (`abuelo`,`padre`);

--
-- Indices de la tabla `firmas`
--
ALTER TABLE `firmas`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
MODIFY `id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `comentxt`
--
ALTER TABLE `comentxt`
MODIFY `id` int(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `firmas`
--
ALTER TABLE `firmas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
