CREATE DATABASE  IF NOT EXISTS `rmdb11` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci */;
USE `rmdb11`;
-- MySQL dump 10.13  Distrib 5.6.13, for osx10.6 (i386)
--
-- Host: mysql02.rmdb1.hospedagemdesites.ws    Database: rmdb11
-- ------------------------------------------------------
-- Server version	5.6.30-76.3-log

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
-- Table structure for table `atividades`
--

DROP TABLE IF EXISTS `atividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atividades` (
  `id_atividade` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_atividade` text NOT NULL,
  `data_atividade` datetime NOT NULL,
  `tipo_atividade` varchar(15) NOT NULL,
  `id_projeto` int(11) NOT NULL,
  PRIMARY KEY (`id_atividade`)
) ENGINE=MyISAM AUTO_INCREMENT=166 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `estorias`
--

DROP TABLE IF EXISTS `estorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estorias` (
  `id_estoria` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_estoria` text NOT NULL,
  `id_projeto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `prioridade_estoria` int(11) NOT NULL,
  `data_estoria` date NOT NULL,
  `info_estoria` text,
  PRIMARY KEY (`id_estoria`)
) ENGINE=MyISAM AUTO_INCREMENT=148 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `papeis`
--

DROP TABLE IF EXISTS `papeis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `papeis` (
  `id_papel` int(11) NOT NULL AUTO_INCREMENT,
  `nome_papel` varchar(50) NOT NULL,
  PRIMARY KEY (`id_papel`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `projetos`
--

DROP TABLE IF EXISTS `projetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projetos` (
  `id_projeto` int(11) NOT NULL AUTO_INCREMENT,
  `nome_projeto` varchar(120) NOT NULL,
  `descricao_projeto` text NOT NULL,
  `infos_projeto` text NOT NULL,
  `url_projeto` varchar(240) NOT NULL,
  `slug_projeto` varchar(200) NOT NULL,
  PRIMARY KEY (`id_projeto`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sprints`
--

DROP TABLE IF EXISTS `sprints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sprints` (
  `id_sprint` int(11) NOT NULL AUTO_INCREMENT,
  `tamanho_sprint` varchar(20) NOT NULL,
  `objetivo_sprint` varchar(200) NOT NULL,
  `id_projeto` int(11) NOT NULL,
  `num_sprint` int(11) NOT NULL,
  `data_ini_sprint` date NOT NULL,
  `data_fim_sprint` date NOT NULL,
  `status_sprint` varchar(20) NOT NULL DEFAULT 'planning',
  `info_sprint` text NOT NULL,
  `velocidade_sprint` int(11) NOT NULL,
  PRIMARY KEY (`id_sprint`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sprints_has_estorias`
--

DROP TABLE IF EXISTS `sprints_has_estorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sprints_has_estorias` (
  `id_sprints_has_estorias` int(11) NOT NULL AUTO_INCREMENT,
  `id_sprint` int(11) NOT NULL,
  `id_estoria` int(11) NOT NULL,
  PRIMARY KEY (`id_sprints_has_estorias`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `status_tarefas`
--

DROP TABLE IF EXISTS `status_tarefas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_tarefas` (
  `id_status_tarefas` int(11) NOT NULL AUTO_INCREMENT,
  `id_tarefa` int(11) DEFAULT NULL,
  `status_tarefa` varchar(15) COLLATE latin1_general_ci DEFAULT 'todo',
  `data_status_tarefa` date DEFAULT NULL,
  `dia_sprint` int(11) DEFAULT '1',
  PRIMARY KEY (`id_status_tarefas`)
) ENGINE=InnoDB AUTO_INCREMENT=1157 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tarefas`
--

DROP TABLE IF EXISTS `tarefas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarefas` (
  `id_tarefa` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_tarefa` varchar(200) NOT NULL,
  `id_sprints_has_estorias` int(11) NOT NULL,
  `id_usuarios_has_projetos` int(11) NOT NULL,
  `pontos_tarefa` int(11) NOT NULL,
  `tipo_tarefa` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_tarefa`)
) ENGINE=MyISAM AUTO_INCREMENT=216 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(100) DEFAULT NULL,
  `senha_usuario` varchar(20) DEFAULT NULL,
  `email_usuario` varchar(100) DEFAULT NULL,
  `hash_usuario` int(11) NOT NULL,
  `ativo` int(11) NOT NULL DEFAULT '0',
  `img_usuario` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios_has_projetos`
--

DROP TABLE IF EXISTS `usuarios_has_projetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios_has_projetos` (
  `id_usuarios_has_projetos` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_projeto` int(11) NOT NULL,
  `id_papel` int(11) NOT NULL,
  PRIMARY KEY (`id_usuarios_has_projetos`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-08 16:10:44
