-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 05-Nov-2018 às 18:09
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpoo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cardapio`
--

CREATE TABLE `cardapio` (
  `idCard` int(2) NOT NULL,
  `tituloCard` varchar(20) NOT NULL,
  `itensCard` int(2) NOT NULL,
  `descricaoCard` varchar(50) DEFAULT NULL,
  `dataCard` date DEFAULT NULL,
  `publicadoCard` int(2) NOT NULL,
  `diadasemana` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `nome_produto` varchar(20) NOT NULL,
  `descricao_produto` varchar(20) NOT NULL,
  `valor_produto` double NOT NULL,
  `datacadastro` varchar(10) NOT NULL,
  `fornecedor` varchar(50) DEFAULT NULL,
  `pk_produto` int(11) NOT NULL,
  `publicado` int(2) DEFAULT NULL,
  `urlimagem` varchar(100) DEFAULT NULL,
  `diadasemana` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`nome_produto`, `descricao_produto`, `valor_produto`, `datacadastro`, `fornecedor`, `pk_produto`, `publicado`, `urlimagem`, `diadasemana`) VALUES
('hquefhauefh', 'ehfuahfuah', 32323232, '05/11/2018', 'produto 1', 59, 1, 'c0ca0ce5a1829d7e7a6601378e5b3f78.png', NULL),
('garga ergre ar erg a', 'ergqergq erg qreg qe', 4.545324422386921e20, '05/11/2018', 'produto 7', 61, 1, 'b84b3044913a28055d689c8ba855412c.jpg', NULL),
('gsdfgsdfgsdf sgdf gd', 'ehfuahfuah', 455345340416, '05/11/2018', 'fornecedor 10', 62, 1, 'f99b61d86dfa634630d9ee25dd35a6ab.jpg', NULL),
('dgfsdfg sdfg sdfg sd', 'produto 1', 444, '05/11/2018', 'fornecedor 10', 63, 1, '798049555a0f7d6fc43afdf6f92ed91e.jpg', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita`
--

CREATE TABLE `receita` (
  `idreceira` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `receita` varchar(200) NOT NULL,
  `datacriacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
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
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`pk`, `nome`, `email`, `data_cadastro`, `senha`, `nivel`) VALUES
(11, '1', '1', '2018-08-27', '1', 0),
(20, 'jimi', 'jimi', '2018-11-04', '341322', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `videos`
--

CREATE TABLE `videos` (
  `idvideo` int(5) NOT NULL,
  `url` varchar(50) NOT NULL,
  `descricao` varchar(20) NOT NULL,
  `nivel` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cardapio`
--
ALTER TABLE `cardapio`
  ADD PRIMARY KEY (`idCard`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`pk_produto`);

--
-- Indexes for table `receita`
--
ALTER TABLE `receita`
  ADD PRIMARY KEY (`idreceira`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`pk`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`idvideo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cardapio`
--
ALTER TABLE `cardapio`
  MODIFY `idCard` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `pk_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `receita`
--
ALTER TABLE `receita`
  MODIFY `idreceira` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `idvideo` int(5) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
