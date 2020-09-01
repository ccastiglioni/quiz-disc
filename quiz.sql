-- MySQL dump 10.13  Distrib 5.7.31, for Linux (x86_64)
--
-- Host: localhost    Database: php-kuiz
-- ------------------------------------------------------
-- Server version	5.7.31-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('adm','super-adm') DEFAULT 'adm',
  `status` varchar(15) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `imagem` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin-super','admin@admin.com','9ae2be73b58b565bce3e47493a56e26a','adm',NULL,NULL,NULL),(2,'admin-super','admin@admin.com','e10adc3949ba59abbe56e057f20f883e','adm','1',NULL,NULL);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coach`
--

DROP TABLE IF EXISTS `coach`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coach` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) DEFAULT NULL,
  `nome_empresa` varchar(230) DEFAULT NULL,
  `cpf` varchar(130) DEFAULT NULL,
  `rg` varchar(130) DEFAULT NULL,
  `genero` varchar(18) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(160) DEFAULT NULL,
  `redes_sociais` text,
  `redes_sociais2` varchar(200) DEFAULT NULL,
  `escolaridade` varchar(230) DEFAULT NULL,
  `logradouro` varchar(250) DEFAULT NULL,
  `numero` int(10) DEFAULT NULL,
  `complemento` varchar(200) DEFAULT NULL,
  `bairro` varchar(200) DEFAULT NULL,
  `cep` varchar(150) DEFAULT NULL,
  `uf` varchar(60) DEFAULT NULL,
  `tipo_endereco` varchar(80) DEFAULT NULL,
  `municipio` varchar(200) DEFAULT NULL,
  `imagem` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `password` varchar(210) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coach`
--

LOCK TABLES `coach` WRITE;
/*!40000 ALTER TABLE `coach` DISABLE KEYS */;
INSERT INTO `coach` VALUES (67,'Cleber castiglioni',NULL,'993.373.470-91','123432432432','masculino',NULL,'admin','https://www.facebook.com/cleber.castiglioni','https://www.facebook.com/cleber.castiglioni2','fundamental','rua borges de medeiros',NULL,'Casa ',NULL,'97010-001','','Residencial','','','2020-08-11 10:40:57',1,NULL,'e10adc3949ba59abbe56e057f20f883e'),(68,'Maria paula',NULL,'987827324','12054717368717','feminino',NULL,'carlos@bol.com','https://www.facebook.com/cleber.castiglioni','https://www.facebook.com/cleber.castiglioni2','fundamental_incompleto','rua borges de medeiros',NULL,'Apt 544',NULL,'97610000','','Residencial','','','2020-08-11 11:01:32',1,'https://www.instagram.com/kriyayogaguru/','e10adc3949ba59abbe56e057f20f883e'),(70,'Carlos Andre Coach ','mercado santo antonio','993.373.470-91','12054717368717','masculino','+5551997559868','carlos@bol.com.br','https://www.facebook.com/cleber.castiglioni','https://www.facebook.com/cleber.castiglioni2','fundamental_incompleto','rua borges de medeiros',NULL,'Ideal',NULL,'93332040','Rio Grande do Sul','Residencial','Novo Hamburgo','perfil_n.jpg','2020-08-16 22:12:50',1,'https://www.instagram.com/kriyayogaguru/','202cb962ac59075b964b07152d234b70'),(71,'coach user teste','mercadocs','993.373.470-91','123432432432','masculino','+5551997559868','admin-supercleen@gmail.com','https://www.facebook.com/cleber.castiglioni','https://www.facebook.com/cleber.castiglioni','doutorado','rua borges de medeiros',NULL,'Idealfd','centro','93332040','Rio Grande do Sul','Residencial','Novo Hamburgo','','2020-08-16 22:15:28',1,NULL,'e10adc3949ba59abbe56e057f20f883e'),(74,'marcos ','Ideal','993.373.470-91','123432432432','','+5551997559868','user@gmail.com.re','https://www.facebook.com/cleber.castiglioni','BasicAdmin','fundamental_incompleto','',NULL,'Ideal','centro','93332040','Rio Grande do Sul','Residencial','','','2020-08-16 22:27:11',NULL,NULL,'e10adc3949ba59abbe56e057f20f883e');
/*!40000 ALTER TABLE `coach` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deleteduser`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deleteduser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `deltime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deleteduser`
--

LOCK TABLES `deleteduser` WRITE;
/*!40000 ALTER TABLE `deleteduser` DISABLE KEYS */;
INSERT INTO `deleteduser` VALUES (1,'preslye@hotm.om','2020-08-18 22:59:57');
/*!40000 ALTER TABLE `deleteduser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(50) NOT NULL,
  `reciver` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `feedbackdata` varchar(500) NOT NULL,
  `attachment` varchar(50) NOT NULL,
  `coach_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (19,'cleber@bol.com','Admin','rerev','df fefe',' ',0);
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notiuser` varchar(50) NOT NULL,
  `notireciver` varchar(50) NOT NULL,
  `notitype` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (18,'cleber@bol.com','Admin','Send Feedback','2020-08-10 02:30:28'),(19,'admin','Admin','Create Account','2020-08-10 13:06:47'),(20,'','coach','Password changed nome:Carlos Andre Coach ','2020-08-18 22:44:11');
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `qno` int(11) NOT NULL,
  `question` text NOT NULL,
  `ans1` text NOT NULL,
  `ans2` text NOT NULL,
  `ans3` text NOT NULL,
  `ans4` text NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `coach_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (17,1,' Para conseguir obter bons\nresultados é preciso... ','I - Ter incertezas','O - Controlar o essencial ','C - Diversão e celebração','A - Planejar e obter recursos','1',70),(15,2,'  Eu gosto de... ','A - Ser piloto','C - Conversar com os passageiros','O - Planejar a viagem','I - Explorar novas rotas','0',67),(16,3,' comigo....','I - Me dê liberdade','O - Me deixe saber sua expectativa','A - Lidere, siga ou saia do caminho','C - Seja amigável, carinhoso e\ncompreensivo','1',70),(14,4,' Eu me divirto quando... ','A - Estou me exercitando','I - Tenho novidades','C - Estou com os outros','O - Determino as regras ','1',NULL),(13,5,' Eu sou...','I - Idealista, criativo e visionário','C - Divertido, espiritual e benéfico','O - Confiável, meticuloso e previsíve','A - Focado, determinado e persistente','0',NULL),(18,6,'Eu penso que...','C - Unidos venceremos, divididos perderemos',' I - É bom ser manso, mas andar com um porrete ','A - O ataque é melhor que a defesa ','O - Um homem prevenido vale por dois','1',70),(20,7,'Eu sou..',' C - Divertido, espiritual e benéfico ','I - Idealista, criativo e visionário ',' A - Focado, determinado e persistente ',' O - Confiável, meticuloso e previsível ','1',70),(21,2,' Eu gosto de...',' C - Conversar com os passageiros ','I - Explorar novas rotas ','A - Ser piloto ','O - Planejar a viagem ','1',70),(22,8,' Se você quiser se dar bem comigo...','C- Seja amigável, carinhoso e compreensivo','I - Me dê liberdade',' A - Lidere, siga ou saia do caminho ','O - Me deixe saber sua expectativa ','1',70),(23,4,'Para conseguir obter bons resultados é preciso','C - Diversão e celebração','I - Ter incertezas',' A - Planejar e obter recursos ',' O - Controlar o essencial ','1',70),(24,5,' Eu me divirto quando... ','C - Estou com os outros ','I - Tenho novidades ','A - Estou me exercitando ',' O - Determino as regras ','1',70),(25,9,' Eu gosto de chegar...','C - Junto ','I - Em outro lugar ','A - Na frente ','O - Na hora ','1',70),(26,10,'Um ótimo dia para mim é quando..','C - Me divirto com meus amigos ','I - Desfruto de coisas novas e estimulantes ','. A - Consigo fazer muitas coisas ','O - Tudo segue conforme planejado ','1',70);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_items`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_items` (
  `itemId` int(11) NOT NULL AUTO_INCREMENT,
  `itemHeader` varchar(512) NOT NULL COMMENT 'Heading',
  `itemSub` varchar(1021) NOT NULL COMMENT 'sub heading',
  `itemDesc` text COMMENT 'content or description',
  `itemImage` varchar(80) DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedDtm` datetime DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`itemId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_items`
--

LOCK TABLES `tbl_items` WRITE;
/*!40000 ALTER TABLE `tbl_items` DISABLE KEYS */;
INSERT INTO `tbl_items` VALUES (1,'jquery.validation.js','Contribution towards jquery.validation.js','jquery.validation.js is the client side javascript validation library authored by Jörn Zaefferer hosted on github for us and we are trying to contribute to it. Working on localization now','validation.png',0,1,'2015-09-02 00:00:00',NULL,NULL),(2,'CodeIgniter User Management','Demo for user management system','This the demo of User Management System (Admin Panel) using CodeIgniter PHP MVC Framework and AdminLTE bootstrap theme. You can download the code from the repository or forked it to contribute. Usage and installation instructions are provided in ReadMe.MD','cias.png',0,1,'2015-09-02 00:00:00',NULL,NULL);
/*!40000 ALTER TABLE `tbl_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_reset_password`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_reset_password` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` bigint(20) NOT NULL DEFAULT '1',
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_reset_password`
--

LOCK TABLES `tbl_reset_password` WRITE;
/*!40000 ALTER TABLE `tbl_reset_password` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_reset_password` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_roles`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text',
  PRIMARY KEY (`roleId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_roles`
--

LOCK TABLES `tbl_roles` WRITE;
/*!40000 ALTER TABLE `tbl_roles` DISABLE KEYS */;
INSERT INTO `tbl_roles` VALUES (1,'System Administrator'),(2,'Manager'),(3,'Employee');
/*!40000 ALTER TABLE `tbl_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_users`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `mobile` varchar(20) DEFAULT NULL,
  `roleId` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` VALUES (1,'thutor@thutor.com.br','','System Administrator','9890098900',1,0,0,'2015-07-01 18:56:49',1,'2017-03-03 12:08:39'),(2,'manager@codeinsect.com','$2y$10$quODe6vkNma30rcxbAHbYuKYAZQqUaflBgc4YpV9/90ywd.5Koklm','Manager','9890098900',2,0,1,'2016-12-09 17:49:56',1,'2017-02-10 17:23:53'),(3,'employee@codeinsect.com','$2y$10$M3ttjnzOV2lZSigBtP0NxuCtKRte70nc8TY5vIczYAQvfG/8syRze','Employee','9890098900',3,0,1,'2016-12-09 17:50:22',NULL,NULL);
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` int(10) NOT NULL,
  `played_on` varchar(150) NOT NULL,
  `coach_id` int(10) NOT NULL,
  `score` varchar(220) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'CLEBER RODRIGUES CASTIGLIONI','cleber.castiglioni@gmail.com',0,'2020-08-18 18:07:23',68,'A - 0%,C - 0%,O - 0%,I - 100%'),(2,'sandra','sandra@gmaol.com',0,'2020-08-11 19:00:47',67,' I  C  I  I  O '),(4,'letica','letica@gmailc.com',0,'2020-08-13 16:23:44',67,' C  I  O  A  A '),(5,'sabrina','sabrin@GMAI.com',0,'2020-08-13 16:30:21',67,', C , I , I , I , O '),(6,'Larissa','larrissa@hota.com',0,'2020-08-13 16:47:29',67,'a - 20%,c - 40%,i - 40%,o - 0%'),(7,'maria slva','silva@gmal.com',0,'2020-08-13 17:22:11',67,'a - 60%,c - 20%,i - 0%,o - 20%'),(8,'vivi','vivi@hotmal.com',0,'2020-08-13 17:28:44',67,'a - 40%,c - 40%,i - 20%,o - 0%'),(9,'carla','carla@horma.com',0,'2020-08-13 17:30:29',67,'I - 0%,O - 20%,A - 40%,C - 40%'),(13,'marta','mar@hotma.com',0,'2020-08-17 16:03:28',70,'A - 0%,O - 20%,C - 40%,I - 40%'),(14,'carla rosa','carla@bol.com',0,'2020-08-17 16:14:07',70,'I - 0%,C - 20%,A - 40%,O - 40%'),(15,'sandra','agda@talentobahia.com.br',0,'2020-08-17 16:21:09',70,'A - 0%,I - 0%,O - 0%,C - 100%'),(17,'sabrina','sabrina@htom.com',0,'2020-08-18 16:31:25',70,'A - 0%,C - 0%,I - 0%,O - 100%'),(19,'xassaxsa','cleber.xsaxsacastiglioni@gmail.com',0,'2020-08-18 18:03:33',70,'C - 0%,O - 0%,I - 20%,A - 80%'),(20,'CLEBER RxasxsODRIGUES CASTIGLIONI','xasxacastiglioni@gmail.com',0,'2020-08-18 18:06:28',68,'A - 0%,C - 0%,I - 0%,O - 100%'),(21,'heitor castiglioni','heitor@gmail.com',0,'2020-08-19 16:12:48',70,NULL),(22,'sergio castiglioni','serrgio@hotmil.com',0,'2020-08-19 16:14:48',70,NULL),(23,'darbge CASTIGLIONI','cle121ber.castiglioni@gmail.com',0,'2020-08-19 16:22:06',70,NULL),(24,'carlos','caarola@gas.com',0,'2020-08-19 16:25:02',70,NULL),(25,'sofia ','sofia@gmail.com',0,'2020-08-19 16:31:27',70,'A - 0%,I - 0%,O - 0%,C - 100%'),(26,'favio','vfavio@fsds.com',0,'2020-08-19 16:32:32',70,'O - 0%,A - 33.333333333333%,C - 33.333333333333%,I - 33.333333333333%'),(27,'flavio silva','flavio@gmail.com',0,'2020-08-19 17:06:14',70,NULL),(28,'gabirl','grail@vfed.com',0,'2020-08-19 17:08:31',70,'I - 0%,C - 0%,O - 10%,A - 90%');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'php-kuiz'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-19 17:15:59
