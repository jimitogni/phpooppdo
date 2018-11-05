-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 05/11/2018 às 08:29
-- Versão do servidor: 10.1.26-MariaDB-0+deb9u1
-- Versão do PHP: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `phpoo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cardapio`
--

CREATE TABLE `cardapio` (
  `idCard` int(2) NOT NULL,
  `tituloCard` varchar(20) NOT NULL,
  `itensCard` int(2) NOT NULL,
  `descricaoCard` varchar(50) DEFAULT NULL,
  `dataCard` date DEFAULT NULL,
  `publicadoCard` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `nome_produto` varchar(20) NOT NULL,
  `descricao_produto` varchar(20) NOT NULL,
  `valor_produto` double NOT NULL,
  `datacadastro` varchar(10) NOT NULL,
  `fornecedor` varchar(50) DEFAULT NULL,
  `pk_produto` int(11) NOT NULL,
  `publicado` int(2) DEFAULT NULL,
  `urlimagem` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `produtos`
--

INSERT INTO `produtos` (`nome_produto`, `descricao_produto`, `valor_produto`, `datacadastro`, `fornecedor`, `pk_produto`, `publicado`, `urlimagem`) VALUES
('produto 1', 'produto 1', 9999, '05/11/2018', 'produto 1', 57, 1, 'c506bfcaa93e1451a8a969cb187bf285.jpeg'),
('produto 5', 'produto 1', 9999, '05/11/2018', 'produto 1', 58, 1, '3df3f3a6732f00a27cdbb20f90612f8a.jpg'),
('hquefhauefh', 'ehfuahfuah', 32323232, '05/11/2018', 'produto 1', 59, 1, 'c0ca0ce5a1829d7e7a6601378e5b3f78.png'),
('garga ergre ar erg a', 'ergqergq erg qreg qe', 4.545324422386921e20, '05/11/2018', 'produto 7', 61, 1, 'b84b3044913a28055d689c8ba855412c.jpg'),
('gsdfgsdfgsdf sgdf gd', 'ehfuahfuah', 455345340416, '05/11/2018', 'fornecedor 10', 62, 1, 'f99b61d86dfa634630d9ee25dd35a6ab.jpg'),
('dgfsdfg sdfg sdfg sd', 'produto 1', 444, '05/11/2018', 'fornecedor 10', 63, 1, '798049555a0f7d6fc43afdf6f92ed91e.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `receita`
--

CREATE TABLE `receita` (
  `idreceira` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `receita` varchar(200) NOT NULL,
  `datacriacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `pk` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `data_cadastro` date NOT NULL,
  `senha` varchar(50) NOT NULL,
  `nivel` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `usuarios`
--

INSERT INTO `usuarios` (`pk`, `nome`, `email`, `data_cadastro`, `senha`, `nivel`) VALUES
(11, '1', '1', '2018-08-27', '1', 0),
(20, 'jimi', 'jimi', '2018-11-04', '341322', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `videos`
--

CREATE TABLE `videos` (
  `idvideo` int(5) NOT NULL,
  `url` varchar(50) NOT NULL,
  `descricao` varchar(20) NOT NULL,
  `nivel` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `cardapio`
--
ALTER TABLE `cardapio`
  ADD PRIMARY KEY (`idCard`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`pk_produto`);

--
-- Índices de tabela `receita`
--
ALTER TABLE `receita`
  ADD PRIMARY KEY (`idreceira`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`pk`);

--
-- Índices de tabela `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`idvideo`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `cardapio`
--
ALTER TABLE `cardapio`
  MODIFY `idCard` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `pk_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT de tabela `receita`
--
ALTER TABLE `receita`
  MODIFY `idreceira` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de tabela `videos`
--
ALTER TABLE `videos`
  MODIFY `idvideo` int(5) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
