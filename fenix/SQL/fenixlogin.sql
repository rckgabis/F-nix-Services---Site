-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/03/2024 às 08:07
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
  `pont_ref` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `cpf`, `rg`, `email`, `telefone`, `tipo`, `CEP`, `rua`, `num`, `bairro`, `cidade`, `estado`, `pont_ref`) VALUES
(113, 'Gabriela Aguiar Lima', '572367', '53860', 'gabrielaaguiar2105@gmail.com', '0', 'residencial', '8190', 'Rua Aguamaré', '19', 'Vila Aimoré', 'São Paulo', '0', 'Itaim'),
(114, 'Gabriela Aguiar Lima', '572367', '53860', 'gabrielaaguiar2105@gmail.com', '0', 'residencial', '8190', 'Rua Aguamaré', '19', 'Vila Aimoré', 'São Paulo', '0', 'Itaim'),
(115, 'Gabriela Aguiar Lima', '572367', '45455', 'gabrielaaguiar2105@gmail.com', '0', 'residencial', '8190', 'Rua Aguamaré', '19', 'Vila Aimoré', 'São Paulo', 'SP', 'Itaim'),
(116, 'AAAAAAAA', '572.367.938', '53.860.046', 'gabrielaaguiar2105@gmail.com', '0', 'residencial', '08190-16', 'Rua Aguamaré', '19', 'Vila Aimoré', 'São Paulo', 'SP', 'Itaim');

-- --------------------------------------------------------

--
-- Estrutura para tabela `registro`
--

CREATE TABLE `registro` (
  `id` int(5) NOT NULL,
  `cliente` char(100) NOT NULL,
  `data` date NOT NULL,
  `hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ocorrencia` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `registro`
--

INSERT INTO `registro` (`id`, `cliente`, `data`, `hora`, `ocorrencia`) VALUES
(1, '2024-03-10', '2024-03-10', '2024-03-10 03:00:03', ''),
(2, '2024-03-10', '2024-03-10', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `codigo_servico` int(11) NOT NULL,
  `nome_servico` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servicos`
--

INSERT INTO `servicos` (`codigo_servico`, `nome_servico`) VALUES
(1, 'envio de imagem'),
(2, 'ativacao pgm'),
(3, 'disparo de alarme'),
(21, 'saida assistida'),
(25, 'aa');

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
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`codigo_servico`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT de tabela `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `codigo_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
