-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 16/05/2025 às 19:14
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `montink`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cupom`
--

DROP TABLE IF EXISTS `cupom`;
CREATE TABLE IF NOT EXISTS `cupom` (
  `cod_cupom` int NOT NULL AUTO_INCREMENT,
  `codigo_desconto` varchar(100) NOT NULL,
  `valor_desconto` double NOT NULL,
  `validade` date NOT NULL,
  `valor_minimo` double NOT NULL,
  PRIMARY KEY (`cod_cupom`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `cupom`
--

INSERT INTO `cupom` (`cod_cupom`, `codigo_desconto`, `valor_desconto`, `validade`, `valor_minimo`) VALUES
(8, 'Desconta10', 10, '2025-11-23', 15),
(7, 'Desconta20', 20, '2024-11-25', 20);

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque`
--

DROP TABLE IF EXISTS `estoque`;
CREATE TABLE IF NOT EXISTS `estoque` (
  `cod_variacao` int NOT NULL AUTO_INCREMENT,
  `nome_variacao` varchar(250) NOT NULL,
  `preco_variacao` double NOT NULL,
  `qtd_estoque` int NOT NULL,
  `cod_produto` int NOT NULL,
  PRIMARY KEY (`cod_variacao`),
  KEY `cod_produto` (`cod_produto`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `estoque`
--

INSERT INTO `estoque` (`cod_variacao`, `nome_variacao`, `preco_variacao`, `qtd_estoque`, `cod_produto`) VALUES
(33, '1L', 6, 24, 40),
(32, '2L', 10, 45, 40),
(31, '1 L', 4, 12, 39),
(30, '500 ml', 2.5, 9, 39);

-- --------------------------------------------------------

--
-- Estrutura para tabela `item_pedido`
--

DROP TABLE IF EXISTS `item_pedido`;
CREATE TABLE IF NOT EXISTS `item_pedido` (
  `cod_item` int NOT NULL AUTO_INCREMENT,
  `cod_pedido` int NOT NULL,
  `cod_variacao` int NOT NULL,
  `preco` double NOT NULL,
  `quantidade` int NOT NULL,
  PRIMARY KEY (`cod_item`),
  KEY `fk_item_pedido` (`cod_pedido`),
  KEY `fk_item_variacao` (`cod_variacao`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `item_pedido`
--

INSERT INTO `item_pedido` (`cod_item`, `cod_pedido`, `cod_variacao`, `preco`, `quantidade`) VALUES
(30, 26, 33, 6, 1),
(29, 26, 31, 4, 1),
(28, 26, 32, 10, 5),
(27, 25, 30, 2.5, 1),
(26, 25, 31, 4, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `cod_pedido` int NOT NULL AUTO_INCREMENT,
  `preco_subtotal` double NOT NULL,
  `frete` double NOT NULL,
  `desconto` double NOT NULL,
  `email` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cep` varchar(8) NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pendente',
  PRIMARY KEY (`cod_pedido`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `pedido`
--

INSERT INTO `pedido` (`cod_pedido`, `preco_subtotal`, `frete`, `desconto`, `email`, `cep`, `status`) VALUES
(26, 60, 15, 0, 'teste@teste', '01001001', 'pendente'),
(25, 10.5, 20, 0, 'teste@teste', '01001001', 'pendente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `cod_produto` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  PRIMARY KEY (`cod_produto`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`cod_produto`, `nome`) VALUES
(40, 'Refrigerante Fulano'),
(39, 'Detergente Tal');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
