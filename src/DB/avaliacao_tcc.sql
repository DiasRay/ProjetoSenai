-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/04/2024 às 15:18
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `id_avaliacao` int(11) NOT NULL,
  `id_projeto` int(11) NOT NULL,
  `nif_docente` int(11) DEFAULT NULL,
  `criterio1` int(11) NOT NULL,
  `criterio2` int(11) NOT NULL,
  `criterio3` int(11) NOT NULL,
  `criterio4` int(11) NOT NULL,
  `criterio5` int(11) NOT NULL,
  `criterio6` int(11) NOT NULL,
  `criterio7` int(11) NOT NULL,
  `criterio8` int(11) NOT NULL,
  `observacoes` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `avaliacoes`
--

/*

INSERT INTO `avaliacoes` (`id_avaliacao`, `id_projeto`, `nif_docente`, `criterio1`, `criterio2`, `criterio3`, `criterio4`, `criterio5`, `criterio6`, `criterio7`, `criterio8`, `observacoes`) VALUES
(1, 1, 1234567, 2, 8, 2, 5, 8, 5, 5, 4, ''),
(3, 4, 1234567, 3, 8, 3, 6, 7, 5, 4, 4, ''),
(4, 3, 7654321, 10, 10, 6, 7, 10, 9, 8, 8, ''),
(5, 2, 1234567, 8, 9, 10, 9, 10, 10, 9, 7, ''),
(8, 5, 7654321, 2, 2, 2, 2, 2, 2, 2, 2, 'Lá'),
(16, 11, 1234567, 5, 7, 2, 6, 6, 7, 8, 2, 'sdsdaasda');

*/

-- --------------------------------------------------------

--
-- Estrutura para tabela `docentes`
--

CREATE TABLE `docentes` (
  `id_docente` int(11) NOT NULL,
  `nif` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `perm` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `docentes`
--

/* 

INSERT INTO `docentes` (`id_docente`, `nif`, `nome`, `perm`) VALUES
(1, 1234567, 'Antônio', 0),
(2, 7654321, 'Alberto', 1),
(5, 9876543, 'teste', 1),
(6, 1357911, 'abc', 0);

*/ 

-- --------------------------------------------------------

--
-- Estrutura para tabela `projetos`
--

CREATE TABLE `projetos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `turma` varchar(10) NOT NULL,
  `data` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `projetos`
--

/* 

INSERT INTO `projetos` (`id`, `nome`, `turma`, `data`) VALUES
(1, 'Zequinha', '1MDS2', '2024-04-20'),
(2, 'TCC 1', '3RT2', '2024-04-20'),
(3, 'TCC 2', '1MDS2', '2024-04-20'),
(4, 'TESTE', 'TESTE', '2024-04-20'),
(5, 'OI', 'OI', '2024-04-20'),
(7, 'TCC 1', '3TR2', '2024-04-20'),
(8, 'LINDAS', 'LINDAS', '2024-04-20'),
(10, 'ABC', 'TURMA1', '2024-04-20'),
(11, 'TURMA1', 'TURMA1', '2024-04-20'),
(12, 'ABC', 'ABC', '2024-04-20'); 

*/

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD PRIMARY KEY (`id_avaliacao`),
  ADD KEY `id_projeto` (`id_projeto`),
  ADD KEY `nif_docente` (`nif_docente`);

--
-- Índices de tabela `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id_docente`),
  ADD UNIQUE KEY `nif` (`nif`);

--
-- Índices de tabela `projetos`
--
ALTER TABLE `projetos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  MODIFY `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `projetos`
--
ALTER TABLE `projetos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD CONSTRAINT `avaliacoes_ibfk_1` FOREIGN KEY (`id_projeto`) REFERENCES `projetos` (`id`),
  ADD CONSTRAINT `avaliacoes_ibfk_2` FOREIGN KEY (`nif_docente`) REFERENCES `docentes` (`nif`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
