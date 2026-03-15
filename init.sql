-- ==========================================================
-- vertebrAragón — Inicialización de bases de datos
-- ==========================================================

-- Base de datos principal: vertebra
-- ==========================================================
CREATE DATABASE IF NOT EXISTS vertebra CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE USER IF NOT EXISTS 'myfemmenca'@'%' IDENTIFIED BY '2959_0469';
GRANT ALL PRIVILEGES ON vertebra.* TO 'myfemmenca'@'%';

USE vertebra;

CREATE TABLE IF NOT EXISTS `firmas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `apellidos` varchar(150) NOT NULL DEFAULT '',
  `dni` varchar(20) NOT NULL DEFAULT '',
  `profesion` varchar(150) DEFAULT '',
  `email` varchar(150) NOT NULL DEFAULT '',
  `localidad` varchar(100) DEFAULT '',
  `provincia` varchar(100) DEFAULT '',
  `cargo` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=ciudadano, 1=cargo político',
  `privacidad` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=visible, 1=privado',
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uni_dni` (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `padre` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(150) NOT NULL DEFAULT '',
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `titulo` varchar(200) DEFAULT '',
  `comentario` text,
  `aceptado` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=pendiente, 1=publicado, 2=destacado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `municipios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `localidad` varchar(100) NOT NULL DEFAULT '',
  `encuentra` varchar(100) DEFAULT '',
  `gentilicio` varchar(100) DEFAULT '',
  `habitantes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Datos iniciales de municipios de la Ribera Alta
INSERT IGNORE INTO `municipios` (`localidad`, `encuentra`, `gentilicio`, `habitantes`) VALUES
('Alagón',       'Alagon',       'alagunense',    8000),
('Pedrola',      'Pedrola',      'pedrolano',     3500),
('Gallur',       'Gallur',       'gallurero',     3000),
('Figueruelas',  'Figueruelas',  'figueruelano',  1200),
('Sobradiel',    'Sobradiel',    'sobradielano',   850),
('Alcalá de Ebro','Alcala',      'alcalaíno',      600),
('Cabañas de Ebro','Cabanas',    'cabañano',       600),
('Torres de Berrellén','Torres', 'torreño',        900),
('Remolinos',    'Remolinos',    'remolinero',     900),
('Boquiñeni',    'Boquineni',    'boquiñenense',   500),
('Luceni',       'Luceni',       'lucenense',      800),
('Pradilla de Ebro','Pradilla',  'pradillano',     600),
('Mallén',       'Mallen',       'mallenero',     3000),
('Grisén',       'Grisen',       'grisenero',      500);

CREATE TABLE IF NOT EXISTS `noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(300) NOT NULL DEFAULT '',
  `h3` varchar(200) DEFAULT '',
  `h4` varchar(200) DEFAULT '',
  `imagen` varchar(300) DEFAULT '',
  `descripcion` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uni_url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ==========================================================
-- Base de datos secundaria: vertebraragon
-- ==========================================================
CREATE DATABASE IF NOT EXISTS vertebraragon CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE USER IF NOT EXISTS 'myelegirco'@'%' IDENTIFIED BY 'qR024AJp';
GRANT ALL PRIVILEGES ON vertebraragon.* TO 'myelegirco'@'%';

USE vertebraragon;

-- Misma estructura que vertebra (copia/espejo alternativo)
CREATE TABLE IF NOT EXISTS `firmas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `apellidos` varchar(150) NOT NULL DEFAULT '',
  `dni` varchar(20) NOT NULL DEFAULT '',
  `profesion` varchar(150) DEFAULT '',
  `email` varchar(150) NOT NULL DEFAULT '',
  `localidad` varchar(100) DEFAULT '',
  `provincia` varchar(100) DEFAULT '',
  `cargo` tinyint(1) NOT NULL DEFAULT '0',
  `privacidad` tinyint(1) NOT NULL DEFAULT '0',
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uni_dni` (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `padre` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(150) NOT NULL DEFAULT '',
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `titulo` varchar(200) DEFAULT '',
  `comentario` text,
  `aceptado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `municipios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `localidad` varchar(100) NOT NULL DEFAULT '',
  `encuentra` varchar(100) DEFAULT '',
  `gentilicio` varchar(100) DEFAULT '',
  `habitantes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO `municipios` (`localidad`, `encuentra`, `gentilicio`, `habitantes`) VALUES
('Alagón',       'Alagon',       'alagunense',    8000),
('Pedrola',      'Pedrola',      'pedrolano',     3500),
('Gallur',       'Gallur',       'gallurero',     3000),
('Figueruelas',  'Figueruelas',  'figueruelano',  1200),
('Sobradiel',    'Sobradiel',    'sobradielano',   850),
('Torres de Berrellén','Torres', 'torreño',        900),
('Remolinos',    'Remolinos',    'remolinero',     900),
('Mallén',       'Mallen',       'mallenero',     3000),
('Grisén',       'Grisen',       'grisenero',      500);

FLUSH PRIVILEGES;
