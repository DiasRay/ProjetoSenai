-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Mar-2024 às 14:48
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `avaliacao_tcc`
--
CREATE DATABASE IF NOT EXISTS `avaliacao_tcc` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `avaliacao_tcc`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacoes`
--

CREATE TABLE IF NOT EXISTS `avaliacoes` (
  `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `id_projeto` int(11) NOT NULL,
  `nif_docente` int(11) NOT NULL,
  `criterio1` int(11) NOT NULL,
  `criterio2` int(11) NOT NULL,
  `criterio3` int(11) NOT NULL,
  `criterio4` int(11) NOT NULL,
  `criterio5` int(11) NOT NULL,
  `criterio6` int(11) NOT NULL,
  `criterio7` int(11) NOT NULL,
  `criterio8` int(11) NOT NULL,
  `observacoes` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_avaliacao`),
  KEY `id_projeto` (`id_projeto`),
  KEY `nif_docente` (`nif_docente`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `avaliacoes`
--

INSERT INTO `avaliacoes` (`id_avaliacao`, `id_projeto`, `nif_docente`, `criterio1`, `criterio2`, `criterio3`, `criterio4`, `criterio5`, `criterio6`, `criterio7`, `criterio8`, `observacoes`) VALUES
(1, 1, 1234567, 2, 8, 2, 5, 8, 5, 5, 4, ''),
(3, 4, 1234567, 3, 8, 3, 6, 7, 5, 4, 4, ''),
(4, 3, 7654321, 10, 10, 6, 7, 10, 9, 8, 8, ''),
(5, 2, 1234567, 8, 9, 10, 9, 10, 10, 9, 7, ''),
(8, 5, 7654321, 2, 2, 2, 2, 2, 2, 2, 2, 'Lá');

-- --------------------------------------------------------

--
-- Estrutura da tabela `docentes`
--

CREATE TABLE IF NOT EXISTS `docentes` (
  `nif` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`nif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `docentes`
--

INSERT INTO `docentes` (`nif`, `nome`) VALUES
(1234567, 'Antônio'),
(7654321, 'Alberto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projetos`
--

CREATE TABLE IF NOT EXISTS `projetos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `turma` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `projetos`
--

INSERT INTO `projetos` (`id`, `nome`, `turma`) VALUES
(1, 'Zequinha', '1MDS2'),
(2, 'TCC 1', '3RT2'),
(3, 'TCC 2', '1MDS2'),
(4, 'TESTE', 'TESTE'),
(5, 'OI', 'OI'),
(7, 'TCC 1', '3TR2'),
(8, 'LINDAS', 'LINDAS');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD CONSTRAINT `avaliacoes_ibfk_1` FOREIGN KEY (`id_projeto`) REFERENCES `projetos` (`id`),
  ADD CONSTRAINT `avaliacoes_ibfk_2` FOREIGN KEY (`nif_docente`) REFERENCES `docentes` (`nif`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
