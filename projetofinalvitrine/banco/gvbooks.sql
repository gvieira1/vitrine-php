-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/07/2024 às 21:07
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gvbooks`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `usuario_cad` varchar(100) NOT NULL,
  `nomeprod_cad` varchar(100) NOT NULL,
  `data_cad` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro`
--

INSERT INTO `cadastro` (`usuario_cad`, `nomeprod_cad`, `data_cad`) VALUES
('joaoaoliveira', 'A Culpa é das Estrelas', '2024-07-01 23:15:50'),
('joaoaoliveira', 'A Falência', '2024-07-01 23:14:19'),
('joaoaoliveira', 'Bíblia NVI', '2024-07-01 23:12:19'),
('joaoaoliveira', 'O Pequeno Príncipe', '2024-07-01 23:15:11'),
('joaoaoliveira', 'Orgulho e Preconceito', '2024-07-01 23:13:16'),
('rsilva', 'A mensagem', '2024-07-01 23:02:53'),
('rsilva', 'Contos de Aprendiz', '2024-07-01 23:04:46'),
('rsilva', 'Cristianismo Puro e Simples', '2024-07-01 23:06:54'),
('rsilva', 'Dois Irmãos', '2024-07-01 23:05:28'),
('rsilva', 'Memórias Póstumas de Brás Cubas', '2024-07-01 23:03:51'),
('rsilva', 'Minhas Últimas Palavras', '2024-07-01 23:07:30'),
('rsilva', 'Sermões', '2024-07-01 23:06:14');

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hash_senha` varchar(255) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `tipo` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`nome`, `email`, `hash_senha`, `usuario`, `data_nascimento`, `telefone`, `id`, `tipo`) VALUES
('Jose Arnaldo de Souza Sá', 'jose@arnaldos.com', '$2y$10$FMU/XYUuow9GiNzOXZiOfOrheIDvkMIEk0lWKXMGffohjsChkBHz6', 'jarnaldos', '1987-04-11', '11 98271211', 1324, 0),
('João Antunes de Oliveira', 'joaoantunes@gmail.com', '$2y$10$b0JI5fEoQ/CVdxSEQXOUKu.lIdcT0/Yx3KaTcUlHA/C3mSg8zSpvu', 'joaoaoliveira', '1998-09-06', '11 92736483', 2876, 0),
('Nathan Amorim Vieira', 'nathan@gmail.com', '$2y$10$DE97nBqXIRhXF89Jp0unb.HAaE0sl7uiPgcV7g0PtbHP40kaDPNAe', 'natsilva', '2003-08-09', '11 92938473', 4433, 1),
('Anselmo Florentino', 'anselmoprof@gmail.com', '$2y$10$NrqyRhvX8z1NbcI9gWmdgutQrgdPWglpiyimWU45xHptIaieFaSWq', 'profanselmo', '1983-02-24', '11 97263548', 1020, 0),
('Renata Silva', 'renata@gmail.com', '$2y$10$K9SaPzWb//9a4eBP5XH3aO9FVKK/L1a6r/0DUAkCn.b01CK3PeLJK', 'rsilva', '1998-02-09', '11 92222222', 8273, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `nomeprod` varchar(100) NOT NULL,
  `preco` decimal(6,2) NOT NULL,
  `categoria` int(11) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `imagem` varchar(50) DEFAULT NULL,
  `autor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`nomeprod`, `preco`, `categoria`, `data_criacao`, `imagem`, `autor`) VALUES
('A Culpa é das Estrelas', 43.90, 2, '2024-07-01 23:15:50', 'a5b4ee5dc221aa2321c635dfff4dfb27.PNG', 'John Green'),
('A Falência', 14.00, 2, '2024-07-01 23:14:19', '2faf9549cfcedebdae8f2dfbf85fdcc3.PNG', 'Julia Lopes'),
('A mensagem', 26.50, 0, '2024-07-01 23:02:53', 'f914e77c153ec4d3661a8f7d40efc5ba.PNG', 'Fernando Pessoa'),
('Bíblia NVI', 65.80, 1, '2024-07-01 23:12:19', '18067ab83d8aa20c41dc30b40229ab22.PNG', 'Vários autores'),
('Contos de Aprendiz', 58.70, 0, '2024-07-01 23:04:46', '1347f51f6da7bb09e71bcebdada1d3a8.PNG', 'Carlos Drummond'),
('Cristianismo Puro e Simples', 39.90, 1, '2024-07-01 23:06:54', '33bf2c6791ed22574998ae6ac1a8d8a3.PNG', 'C.S. Lewis'),
('Dois Irmãos', 33.40, 0, '2024-07-01 23:05:28', '4a62146a75d9313da0691f4857e7e5f1.PNG', ' Milton Hatoum'),
('Memórias Póstumas de Brás Cubas', 28.90, 0, '2024-07-01 23:03:51', '9e48f3e25874fe75042bed3e62db7b2c.PNG', 'Machado de Assis'),
('Minhas Últimas Palavras', 39.90, 1, '2024-07-01 23:07:30', '0038eaef52cdc9f58756e56f2a55d701.PNG', 'Billy Graham'),
('O Pequeno Príncipe', 21.80, 2, '2024-07-01 23:15:11', '8a48dcfb83581dd77432337826c29052.PNG', 'Antoine de Saint-Exupéry'),
('Orgulho e Preconceito', 57.80, 2, '2024-07-01 23:13:16', 'f98319c9e9227f56cd7ecf6f82771215.PNG', ' Jane Austen'),
('Sermões', 21.10, 1, '2024-07-01 23:06:14', '7e443a667769f64c46906dcc784eaf7c.PNG', 'Padre Antonio Vieira');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`usuario_cad`,`nomeprod_cad`),
  ADD KEY `nomeprod_cad` (`nomeprod_cad`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`usuario`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`nomeprod`);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cadastro`
--
ALTER TABLE `cadastro`
  ADD CONSTRAINT `cadastro_ibfk_1` FOREIGN KEY (`usuario_cad`) REFERENCES `funcionarios` (`usuario`),
  ADD CONSTRAINT `cadastro_ibfk_2` FOREIGN KEY (`nomeprod_cad`) REFERENCES `produtos` (`nomeprod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
