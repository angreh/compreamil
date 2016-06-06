CREATE DATABASE  IF NOT EXISTS `compreamil` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `compreamil`;
-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: localhost    Database: compreamil
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.13-MariaDB

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
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_ibge` varchar(4) NOT NULL,
  `sigla` char(2) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `dtm_lcto` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` VALUES (1,'12','AC','Acre','2016-05-06 12:58:45'),(2,'27','AL','Alagoas','2016-05-06 12:58:45'),(3,'13','AM','Amazonas','2016-05-06 12:58:45'),(4,'16','AP','Amapá','2016-05-06 12:58:45'),(5,'29','BA','Bahia','2016-05-06 12:58:45'),(6,'23','CE','Ceará','2016-05-06 12:58:45'),(7,'53','DF','Distrito Federal','2016-05-06 12:58:45'),(8,'32','ES','Espírito Santo','2016-05-06 12:58:45'),(9,'52','GO','Goiás','2016-05-06 12:58:45'),(10,'21','MA','Maranhão','2016-05-06 12:58:45'),(11,'31','MG','Minas Gerais','2016-05-06 12:58:45'),(12,'50','MS','Mato Grosso do Sul','2016-05-06 12:58:45'),(13,'51','MT','Mato Grosso','2016-05-06 12:58:45'),(14,'15','PA','Pará','2016-05-06 12:58:45'),(15,'25','PB','Paraíba','2016-05-06 12:58:45'),(16,'26','PE','Pernambuco','2016-05-06 12:58:45'),(17,'22','PI','Piauí','2016-05-06 12:58:45'),(18,'41','PR','Paraná','2016-05-06 12:58:45'),(19,'33','RJ','Rio de Janeiro','2016-05-06 12:58:45'),(20,'24','RN','Rio Grande do Norte','2016-05-06 12:58:45'),(21,'11','RO','Rondônia','2016-05-06 12:58:45'),(22,'14','RR','Roraima','2016-05-06 12:58:45'),(23,'43','RS','Rio Grande do Sul','2016-05-06 12:58:45'),(24,'42','SC','Santa Catarina','2016-05-06 12:58:45'),(25,'28','SE','Sergipe','2016-05-06 12:58:45'),(26,'35','SP','São Paulo','2016-05-06 12:58:45'),(27,'17','TO','Tocantins','2016-05-06 12:58:45');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_cp`
--

DROP TABLE IF EXISTS `gp_cp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_cp` (
  `cp_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cp_rp` varchar(255) NOT NULL,
  `cp_jk` varchar(255) NOT NULL,
  PRIMARY KEY (`cp_id`),
  UNIQUE KEY `cp_id_UNIQUE` (`cp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_cp`
--

LOCK TABLES `gp_cp` WRITE;
/*!40000 ALTER TABLE `gp_cp` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_cp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_db`
--

DROP TABLE IF EXISTS `gp_db`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_db` (
  `db_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `db_pc` varchar(255) NOT NULL,
  `db_bn` varchar(255) NOT NULL,
  `db_ne` varchar(255) NOT NULL,
  `db_xo` varchar(255) NOT NULL,
  `db_mc` varchar(255) NOT NULL,
  `db_dv` varchar(255) NOT NULL,
  `db_dd` varchar(255) NOT NULL,
  PRIMARY KEY (`db_id`),
  UNIQUE KEY `db_id_UNIQUE` (`db_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_db`
--

LOCK TABLES `gp_db` WRITE;
/*!40000 ALTER TABLE `gp_db` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_db` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_ef`
--

DROP TABLE IF EXISTS `gp_ef`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_ef` (
  `ef_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ef_qf_id` int(10) unsigned NOT NULL,
  `ef_ce` tinyint(1) unsigned NOT NULL,
  `ef_ps` varchar(255) NOT NULL,
  `ef_ac` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`ef_id`),
  UNIQUE KEY `ef_id_UNIQUE` (`ef_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_ef`
--

LOCK TABLES `gp_ef` WRITE;
/*!40000 ALTER TABLE `gp_ef` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_ef` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_eg`
--

DROP TABLE IF EXISTS `gp_eg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_eg` (
  `eg_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eg_qf_id` int(10) unsigned NOT NULL,
  `eg_nm` varchar(255) NOT NULL,
  `eg_cp` varchar(255) NOT NULL,
  `eg_dn` varchar(8) NOT NULL,
  `eg_sx` tinyint(1) unsigned NOT NULL,
  `eg_gr` tinyint(1) unsigned NOT NULL,
  `eg_ec` tinyint(1) unsigned NOT NULL,
  `eg_ma` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`eg_id`),
  UNIQUE KEY `cg_id_UNIQUE` (`eg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_eg`
--

LOCK TABLES `gp_eg` WRITE;
/*!40000 ALTER TABLE `gp_eg` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_eg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_fo`
--

DROP TABLE IF EXISTS `gp_fo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_fo` (
  `fo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fo_qf_id` int(11) NOT NULL,
  `fo_cp` varchar(8) NOT NULL,
  `fo_lg` varchar(255) NOT NULL,
  `fo_nu` varchar(8) DEFAULT NULL,
  `fo_co` varchar(245) DEFAULT NULL,
  `fo_br` varchar(245) DEFAULT NULL,
  `fo_mn` varchar(245) NOT NULL,
  `fo_uf` int(11) NOT NULL,
  PRIMARY KEY (`fo_id`),
  UNIQUE KEY `fo_id_UNIQUE` (`fo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_fo`
--

LOCK TABLES `gp_fo` WRITE;
/*!40000 ALTER TABLE `gp_fo` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_fo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_gq`
--

DROP TABLE IF EXISTS `gp_gq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_gq` (
  `gq_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gq_qf_id` int(10) unsigned NOT NULL,
  `gq_bc` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`gq_id`),
  UNIQUE KEY `gq_id_UNIQUE` (`gq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_gq`
--

LOCK TABLES `gp_gq` WRITE;
/*!40000 ALTER TABLE `gp_gq` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_gq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_qf`
--

DROP TABLE IF EXISTS `gp_qf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_qf` (
  `qf_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qf_mh` tinyint(1) NOT NULL,
  `qf_st` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `qf_lc` int(11) DEFAULT NULL,
  `qf_vt_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`qf_id`),
  UNIQUE KEY `qf_id_UNIQUE` (`qf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_qf`
--

LOCK TABLES `gp_qf` WRITE;
/*!40000 ALTER TABLE `gp_qf` DISABLE KEYS */;
INSERT INTO `gp_qf` VALUES (1,2,1,NULL,NULL);
/*!40000 ALTER TABLE `gp_qf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_sg`
--

DROP TABLE IF EXISTS `gp_sg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_sg` (
  `sg_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sg_qf_id` int(10) unsigned NOT NULL,
  `sg_nm` varchar(255) NOT NULL,
  `sg_cp` varchar(255) NOT NULL,
  `sg_rg` varchar(255) NOT NULL,
  `sg_dn` varchar(8) NOT NULL,
  `sg_sx` tinyint(1) unsigned NOT NULL,
  `sg_ec` tinyint(1) unsigned NOT NULL,
  `sg_em` varchar(255) NOT NULL,
  `sg_gr` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`sg_id`),
  UNIQUE KEY `sg_id_UNIQUE` (`sg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_sg`
--

LOCK TABLES `gp_sg` WRITE;
/*!40000 ALTER TABLE `gp_sg` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_sg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_uh`
--

DROP TABLE IF EXISTS `gp_uh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_uh` (
  `uh_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uh_qf_id` int(11) NOT NULL,
  `uh_nm` varchar(245) NOT NULL,
  `uh_cp` varchar(255) NOT NULL,
  `uh_rg` varchar(255) NOT NULL,
  `uh_dn` varchar(8) NOT NULL,
  `uh_sx` tinyint(1) unsigned NOT NULL,
  `uh_ec` tinyint(1) unsigned NOT NULL,
  `uh_em` varchar(255) NOT NULL,
  `uh_tr` varchar(255) DEFAULT NULL,
  `uh_tc` varchar(245) DEFAULT NULL,
  `uh_ma` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uh_id`),
  UNIQUE KEY `uh_id_UNIQUE` (`uh_id`),
  UNIQUE KEY `uh_cp_UNIQUE` (`uh_cp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_uh`
--

LOCK TABLES `gp_uh` WRITE;
/*!40000 ALTER TABLE `gp_uh` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_uh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_ui`
--

DROP TABLE IF EXISTS `gp_ui`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_ui` (
  `ui_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ui_nm` varchar(255) NOT NULL,
  `ui_em` varchar(255) NOT NULL,
  `ui_tc` varchar(45) NOT NULL,
  `ui_qf_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ui_id`),
  UNIQUE KEY `ui_id_UNIQUE` (`ui_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_ui`
--

LOCK TABLES `gp_ui` WRITE;
/*!40000 ALTER TABLE `gp_ui` DISABLE KEYS */;
INSERT INTO `gp_ui` VALUES (1,'André F. Pinto','angreh@gmail.com','(11) 9 7586-8182',1);
/*!40000 ALTER TABLE `gp_ui` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tz_mp`
--

DROP TABLE IF EXISTS `tz_mp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tz_mp` (
  `mp_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mp_ac` varchar(255) NOT NULL,
  `mp_tb` varchar(8) DEFAULT NULL,
  `mp_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mp_vt_id` int(11) DEFAULT NULL,
  `mp_qf_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`mp_id`),
  UNIQUE KEY `mp_id_UNIQUE` (`mp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tz_mp`
--

LOCK TABLES `tz_mp` WRITE;
/*!40000 ALTER TABLE `tz_mp` DISABLE KEYS */;
/*!40000 ALTER TABLE `tz_mp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tz_vt`
--

DROP TABLE IF EXISTS `tz_vt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tz_vt` (
  `vt_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vt_em` varchar(255) NOT NULL,
  `vt_ps` varchar(255) NOT NULL,
  `vt_nv` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`vt_id`),
  UNIQUE KEY `vt_em_UNIQUE` (`vt_em`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tz_vt`
--

LOCK TABLES `tz_vt` WRITE;
/*!40000 ALTER TABLE `tz_vt` DISABLE KEYS */;
INSERT INTO `tz_vt` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3',0),(2,'angreh','202cb962ac59075b964b07152d234b70',0),(3,'felps','202cb962ac59075b964b07152d234b70',0),(4,'pedron','202cb962ac59075b964b07152d234b70',1);
/*!40000 ALTER TABLE `tz_vt` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-06 18:24:28
