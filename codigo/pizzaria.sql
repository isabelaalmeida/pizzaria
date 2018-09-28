-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 25-Set-2018 às 04:20
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `pizzaria`
--
CREATE DATABASE IF NOT EXISTS `pizzaria` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pizzaria`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bebidas`
--

CREATE TABLE IF NOT EXISTS `bebidas` (
  `id_bebida` int(11) NOT NULL AUTO_INCREMENT,
  `nome_bebida` varchar(100) NOT NULL,
  `preco_bebida` int(11) NOT NULL,
  `Industrializado` enum('sim','nao','','') NOT NULL,
  `ingrediente_bebida` int(100) NOT NULL,
  PRIMARY KEY (`id_bebida`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bebida_ingredienteb`
--

CREATE TABLE IF NOT EXISTS `bebida_ingredienteb` (
  `id_bebida` int(11) NOT NULL AUTO_INCREMENT,
  `nome_bebida` varchar(100) NOT NULL,
  `industrializado` enum('sim','nao','','') NOT NULL,
  PRIMARY KEY (`id_bebida`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingrediente`
--

CREATE TABLE IF NOT EXISTS `ingrediente` (
  `ingrediente_pizza` varchar(100) NOT NULL,
  `id_pizza` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_pizza`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingredienteb`
--

CREATE TABLE IF NOT EXISTS `ingredienteb` (
  `nome_bebida` int(11) NOT NULL,
  `preco_bebida` int(11) NOT NULL,
  `industrializado` enum('sim','nao','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pizza`
--

CREATE TABLE IF NOT EXISTS `pizza` (
  `Nome_pizza` varchar(100) NOT NULL,
  `id_pizza` int(11) NOT NULL AUTO_INCREMENT,
  `preco_pizza` int(11) NOT NULL,
  `ingrediente_pizza` varchar(100) NOT NULL,
  PRIMARY KEY (`id_pizza`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=182 ;

--
-- Extraindo dados da tabela `pizza`
--

INSERT INTO `pizza` (`Nome_pizza`, `id_pizza`, `preco_pizza`, `ingrediente_pizza`) VALUES
('presunto', 181, 0, 'Mussarela');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pizza_ingrediente`
--

CREATE TABLE IF NOT EXISTS `pizza_ingrediente` (
  `id_pizza` int(11) NOT NULL AUTO_INCREMENT,
  `ingrediente_pizza` varchar(100) NOT NULL,
  `nome_pizza` varchar(100) NOT NULL,
  PRIMARY KEY (`id_pizza`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `bebida_ingredienteb`
--
ALTER TABLE `bebida_ingredienteb`
  ADD CONSTRAINT `bebida_ingredienteb_ibfk_1` FOREIGN KEY (`id_bebida`) REFERENCES `bebidas` (`id_bebida`);

--
-- Limitadores para a tabela `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD CONSTRAINT `ingrediente_ibfk_1` FOREIGN KEY (`id_pizza`) REFERENCES `pizza` (`id_pizza`);

--
-- Limitadores para a tabela `pizza_ingrediente`
--
ALTER TABLE `pizza_ingrediente`
  ADD CONSTRAINT `pizza_ingrediente_ibfk_1` FOREIGN KEY (`id_pizza`) REFERENCES `pizza` (`id_pizza`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
