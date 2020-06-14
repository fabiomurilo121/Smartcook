

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `ingredientrecipes`;
CREATE TABLE IF NOT EXISTS `ingredientrecipes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ingredientId` int(11) NOT NULL,
  `recipeId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE IF NOT EXISTS `ingredients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `recipes`
--

DROP TABLE IF EXISTS `recipes`;
CREATE TABLE IF NOT EXISTS `recipes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `preparationMethod` text  NOT NULL,
  `totalMinutes` varchar(255) NOT NULL,
  `serves` varchar(40) NOT NULL,
  `link` varchar(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `useringredients`
--

DROP TABLE IF EXISTS `useringredients`;
CREATE TABLE IF NOT EXISTS `useringredients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `ingredientId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `ingredientId` (`ingredientId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Restrições para despejos de tabelas

--
-- Limitadores para a tabela `ingredientrecipes`
--
ALTER TABLE `ingredientrecipes`
  ADD CONSTRAINT `ingredientrecipes_ibfk_1` FOREIGN KEY (`ingredientId`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ingredientrecipes_ibfk_2` FOREIGN KEY (`recipeId`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `useringredients`
--
ALTER TABLE `useringredients`
  ADD CONSTRAINT `useringredients_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `useringredients_ibfk_2` FOREIGN KEY (`ingredientId`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

