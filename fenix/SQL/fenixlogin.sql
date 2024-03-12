-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/03/2024 às 10:03
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
-- Banco de dados: `fenixlogin`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` char(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(16) NOT NULL,
  `tipo` char(15) NOT NULL,
  `CEP` varchar(14) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `num` varchar(11) NOT NULL,
  `bairro` char(50) NOT NULL,
  `cidade` char(50) NOT NULL,
  `estado` char(2) NOT NULL,
  `pont_ref` varchar(100) NOT NULL,
  `nome_contato1` char(100) NOT NULL,
  `parentesco_contato1` char(100) NOT NULL,
  `numero_contato1` varchar(16) NOT NULL,
  `nome_contato2` char(100) NOT NULL,
  `parentesco_contato2` char(100) NOT NULL,
  `numero_contato2` varchar(16) NOT NULL,
  `nome_contato3` char(100) NOT NULL,
  `parentesco_contato3` char(100) NOT NULL,
  `numero_contato3` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `cpf`, `rg`, `email`, `telefone`, `tipo`, `CEP`, `rua`, `num`, `bairro`, `cidade`, `estado`, `pont_ref`, `nome_contato1`, `parentesco_contato1`, `numero_contato1`, `nome_contato2`, `parentesco_contato2`, `numero_contato2`, `nome_contato3`, `parentesco_contato3`, `numero_contato3`) VALUES
(128, 'Gabriela Aguiara', '572.367.938-41', '53.860.046-9', 'gabrielaaguiar2105@gmail.com', '(11) 98866-3489', 'residencial', '08190-160', 'Rua Aguamaré', '19', 'Vila Aimoré', 'São Paulo', 'SP', 'Estação Itaim', 'AA', 'Pai', '(11) 91212-1212', 'BB', 'Mãe', '(11) 91313-1313', 'CC', 'Pai', '(11) 91414-1414'),
(130, 'vfvg', '572.367.938-41', '53.860.046-9', 'liduinaa2015@gmail.com', '(52) 11110-1415', 'comercial', '01311-000', 'Avenida Paulista', '40000000', 'Bela Vista', 'São Paulo', 'SP', 'Paulista', 'fbb', 'Pai', '(11) 91212-1212', 'BB', 'Pai', '(11) 91313-1313', 'CC', 'Mãe', '(11) 91414-1414');

-- --------------------------------------------------------

--
-- Estrutura para tabela `registro`
--

CREATE TABLE `registro` (
  `id` int(5) NOT NULL,
  `cliente` char(100) NOT NULL,
  `data` date NOT NULL,
  `hora` time DEFAULT NULL,
  `ocorrencia` char(100) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `servico_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `registro`
--

INSERT INTO `registro` (`id`, `cliente`, `data`, `hora`, `ocorrencia`, `cliente_id`, `servico_id`) VALUES
(15, 'Gabriela Aguiar', '2024-03-11', '18:56:21', 'disparo de alarme', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `nome_servico` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servicos`
--

INSERT INTO `servicos` (`id`, `nome_servico`) VALUES
(1, 'envio de imagem'),
(3, 'disparo de alarme'),
(38, 'ATIVAÇÃO PGM');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `nivel_acesso` enum('comum','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `usuario`, `senha`, `nivel_acesso`) VALUES
(1, 'rafael', 'rafael-fenix', '303030', 'comum'),
(2, 'gabriela ribeiro', 'gabriela-tmkt', '202020', 'admin'),
(3, 'aline', 'aline-mooca', '121212', 'admin'),
(4, 'patricia', 'patricia-centro', '101010', 'comum'),
(5, 'Ricardo', 'ricardo', '202020', 'admin');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_registro_cliente` (`cliente_id`),
  ADD KEY `fk_registro_servico` (`servico_id`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT de tabela `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `fk_registro_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `fk_registro_servico` FOREIGN KEY (`servico_id`) REFERENCES `servicos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
