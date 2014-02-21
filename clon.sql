# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.9)
# Database: clon
# Generation Time: 2012-07-19 10:15:14 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `post_id` int(11) unsigned NOT NULL,
  `texto` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `texto`)
VALUES
	(533,23,99,'editar comentario'),
	(554,1,113,'este post tiene un nuevo comentario'),
	(556,17,121,'Este comentario es para probar esta funcionalidad.'),
	(557,17,99,'Otro comentario.');

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`version`)
VALUES
	(5);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `titulo` varchar(100) NOT NULL DEFAULT '',
  `contenido` text NOT NULL,
  `fecha` datetime NOT NULL,
  `mostrar` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `user_id`, `tag_id`, `titulo`, `contenido`, `fecha`, `mostrar`)
VALUES
	(99,1,6,'post de pruebaa','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','2012-03-28 10:28:58',1),
	(100,1,7,'post 2','aSed ut perspiciatis unde omnis iste natus essrror sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidun','2012-03-28 10:28:58',1),
	(101,1,1,'post 3','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.','2012-03-28 10:28:58',1),
	(113,1,4,'POST DE SALUD','POST NUEVO PARA PROBAR LA LISTA DE LOS POST Y LOS VOTOS','2012-03-28 10:28:58',1),
	(121,17,5,'trabajo ADD','Este post es para probar el usuario general.','2012-03-28 10:28:58',1),
	(122,1,7,'Dinero ADD','Este post es para probar si funciona.','2012-03-28 10:28:58',1),
	(123,1,1,'post fecha','probar fecha','2012-03-28 10:28:58',0);

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tema` varchar(25) NOT NULL DEFAULT '',
  `nombre` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;

INSERT INTO `tags` (`id`, `tema`, `nombre`)
VALUES
	(1,'amistad','Amistad'),
	(2,'espana','Así es España'),
	(3,'estudios','Estudios'),
	(4,'salud','Salud'),
	(5,'trabajo','Trabajo'),
	(6,'amor','Amor'),
	(7,'dinero','Dinero'),
	(8,'familia','Familia'),
	(9,'sexo','Sexo'),
	(10,'varios','Varios');

/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL DEFAULT '',
  `last_name` varchar(100) NOT NULL DEFAULT '',
  `email_address` varchar(100) NOT NULL DEFAULT '',
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '' COMMENT 'SHA1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email_address`, `username`, `password`)
VALUES
	(1,'admin','admin','admin@admin.com','admin','d033e22ae348aeb5660fc2140aec35850c4da997'),
	(3,'Juan','Reyes','juan@gmail.com','juan','9c572b43455c8a299ee7812c95faaa357b122f44'),
	(17,'user','user','user@user.com','user','1abebea503cb965953f5c7c84328a038b1003ee9'),
	(29,'usuario','usuario','usuario@gmail.com','usuario','473fccaa87e9ddff83c2b49ecffc8a163500b0c3'),
	(33,'amovens','amovens','amovens@amovens.com','amovens','11b12c86cdd9a6b00ad42d0485ba481aa4dd6796'),
	(144,'maria','maria','maria@aol.com','maria','e21fc56c1a272b630e0d1439079d0598cf8b8329');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table votes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `votes`;

CREATE TABLE `votes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `valor` int(11) NOT NULL DEFAULT '0' COMMENT 'Si vale 1 gusta. Si vale 0 no gusta.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `votes` WRITE;
/*!40000 ALTER TABLE `votes` DISABLE KEYS */;

INSERT INTO `votes` (`id`, `user_id`, `post_id`, `valor`)
VALUES
	(1,1,106,1),
	(2,6,101,0),
	(3,7,101,1),
	(4,3,101,0),
	(5,3,99,1),
	(6,7,99,0),
	(7,1,99,1),
	(368,17,121,1);

/*!40000 ALTER TABLE `votes` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
