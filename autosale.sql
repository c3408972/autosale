-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 03 2016 г., 01:22
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `autosale`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Ad`
--

CREATE TABLE IF NOT EXISTS `Ad` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `City` int(11) NOT NULL,
  `Model` int(11) NOT NULL,
  `EngineCapacity` int(11) NOT NULL,
  `NumberHosts` int(11) NOT NULL,
  `Mileage` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `DateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Mileage` (`Mileage`),
  KEY `NumberHosts` (`NumberHosts`),
  KEY `EngineCapacity` (`EngineCapacity`),
  KEY `Model_2` (`Model`),
  KEY `City` (`City`),
  KEY `IdUser` (`IdUser`),
  KEY `Model_3` (`Model`),
  KEY `Model` (`Model`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=176 ;

--
-- Дамп данных таблицы `Ad`
--

INSERT INTO `Ad` (`Id`, `City`, `Model`, `EngineCapacity`, `NumberHosts`, `Mileage`, `IdUser`, `DateTime`) VALUES
(165, 6, 7, 17, 3, 4, 21, '2016-05-31 22:10:33'),
(166, 10, 8, 15, 3, 2, 21, '2016-05-31 22:11:00'),
(167, 1, 8, 15, 5, 6, 21, '2016-05-31 22:11:34'),
(168, 15, 10, 20, 1, 7, 21, '2016-05-31 22:12:05'),
(169, 15, 10, 14, 2, 6, 21, '2016-05-31 22:13:19'),
(170, 11, 14, 11, 3, 4, 21, '2016-05-31 22:14:02'),
(171, 11, 13, 14, 1, 4, 21, '2016-05-31 22:14:39'),
(172, 5, 17, 15, 1, 1, 24, '2016-06-02 23:46:35'),
(173, 4, 16, 11, 1, 1, 24, '2016-06-02 23:54:55'),
(174, 6, 15, 19, 8, 9, 24, '2016-06-03 00:08:02'),
(175, 18, 2, 12, 3, 4, 24, '2016-06-03 00:55:29');

-- --------------------------------------------------------

--
-- Структура таблицы `City`
--

CREATE TABLE IF NOT EXISTS `City` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `IdRegion` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  KEY `IdRegion` (`IdRegion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `City`
--

INSERT INTO `City` (`Id`, `Name`, `IdRegion`) VALUES
(1, 'Белая Церковь', 1),
(2, 'Бровары', 1),
(4, 'Украинка', 1),
(5, 'Днепродзержинск', 2),
(6, 'Кривой Рог', 2),
(7, 'Никополь', 2),
(8, 'Павлоград', 2),
(9, 'Жёлтые Воды', 2),
(10, 'Артемовск', 3),
(11, 'Горловка', 3),
(12, 'Краматорск', 3),
(13, 'Макеевка', 3),
(14, 'Мариуполь', 3),
(15, 'Бердянск', 4),
(16, 'Энергодар', 4),
(17, 'Мелитополь', 4),
(18, 'Васильевка', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `EngineCapacity`
--

CREATE TABLE IF NOT EXISTS `EngineCapacity` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Value` float NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `EngineCapacity`
--

INSERT INTO `EngineCapacity` (`Id`, `Value`) VALUES
(11, 1.1),
(12, 1.2),
(13, 1.3),
(14, 1.4),
(15, 1.5),
(16, 1.6),
(17, 1.7),
(18, 1.8),
(19, 1.9),
(20, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `Images`
--

CREATE TABLE IF NOT EXISTS `Images` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Url` text NOT NULL,
  `IdAd` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `IdAd` (`IdAd`),
  KEY `IdAd_2` (`IdAd`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=192 ;

--
-- Дамп данных таблицы `Images`
--

INSERT INTO `Images` (`Id`, `Url`, `IdAd`) VALUES
(161, '1464721833574de1a93e15f1.jpg', 165),
(162, '1464721833574de1a93e92f2.jpg', 165),
(163, '1464721860574de1c40d24c3.jpg', 166),
(164, '1464721860574de1c40da1c4.jpg', 166),
(165, '1464721894574de1e6932bca4(1).jpg', 167),
(166, '1464721894574de1e693e74a4(2).jpg', 167),
(167, '1464721894574de1e694a2ca4(3).jpg', 167),
(168, '1464721894574de1e6959cca4(4).jpg', 167),
(169, '1464721925574de205712d9Audi A4 2015 (5).jpg', 168),
(170, '1464721925574de20571aa9Audi A4 2015 (6).jpg', 168),
(171, '1464721999574de24f863b6Audi A6 2015 (8).jpg', 169),
(172, '1464721999574de24f86b87Audi A6 2015 (9).jpg', 169),
(173, '1464722042574de27a748561.jpg', 170),
(174, '1464722042574de27a74c3e2.jpg', 170),
(175, '1464722042574de27a7540e3.jpg', 170),
(176, '1464722079574de29facb471.jpg', 171),
(177, '1464722079574de29fad3172.jpg', 171),
(178, '1464722079574de29fadae73.jpg', 171),
(179, '1464722079574de29fae2b84.jpg', 171),
(180, '146490039557509b2b1c532.jpg', 172),
(181, '146490039557509b2b1cd03.jpg', 172),
(182, '146490039557509b2b1d0eb.jpg', 172),
(183, '146490089557509d1f6fba4.jpg', 173),
(184, '146490089557509d1f70374.jpg', 173),
(185, '146490089557509d1f70f2d.jpg', 173),
(186, '14649016825750a032b06e9.jpg', 174),
(187, '14649016825750a032b0eb9.jpg', 174),
(188, '14649016825750a032b168a.jpg', 174),
(189, '14649045295750ab512fb92.jpg', 175),
(190, '14649045295750ab5130f1b.jpg', 175),
(191, '14649045295750ab513a775.jpg', 175);

-- --------------------------------------------------------

--
-- Структура таблицы `Mark`
--

CREATE TABLE IF NOT EXISTS `Mark` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `Mark`
--

INSERT INTO `Mark` (`Id`, `Name`) VALUES
(3, 'Audi'),
(4, 'BMW'),
(5, 'Volkswagen'),
(6, 'Mercedes');

-- --------------------------------------------------------

--
-- Структура таблицы `Mileage`
--

CREATE TABLE IF NOT EXISTS `Mileage` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Value` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `Mileage`
--

INSERT INTO `Mileage` (`Id`, `Value`) VALUES
(1, 1000),
(2, 5000),
(3, 10000),
(4, 50000),
(5, 70000),
(6, 100000),
(7, 150000),
(8, 200000),
(9, 250000),
(10, 300000);

-- --------------------------------------------------------

--
-- Структура таблицы `Model`
--

CREATE TABLE IF NOT EXISTS `Model` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `IdMark` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `IdMark` (`IdMark`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `Model`
--

INSERT INTO `Model` (`Id`, `Name`, `IdMark`) VALUES
(1, 'S500', 6),
(2, 'GLA250', 6),
(3, 'GLS500', 6),
(4, 'GLS450', 6),
(7, 'A3', 3),
(8, 'A4', 3),
(9, 'A5', 3),
(10, 'A6', 3),
(13, 'X1', 4),
(14, 'X3', 4),
(15, 'X5', 4),
(16, 'X6', 4),
(17, 'Passat', 5),
(18, 'Golf', 5),
(19, 'Vento', 5),
(20, 'T4', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `NumberHosts`
--

CREATE TABLE IF NOT EXISTS `NumberHosts` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Value` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `NumberHosts`
--

INSERT INTO `NumberHosts` (`Id`, `Value`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `Region`
--

CREATE TABLE IF NOT EXISTS `Region` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `Region`
--

INSERT INTO `Region` (`Id`, `Name`) VALUES
(1, 'Киевская'),
(2, 'Днепропетровская'),
(3, 'Донецкая'),
(4, 'Запорожская');

-- --------------------------------------------------------

--
-- Структура таблицы `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password_hash` text NOT NULL,
  `status` int(11) NOT NULL,
  `auth_key` text NOT NULL,
  `limitation` int(11) NOT NULL DEFAULT '3',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Дамп данных таблицы `User`
--

INSERT INTO `User` (`id`, `email`, `password_hash`, `status`, `auth_key`, `limitation`, `created_at`, `updated_at`) VALUES
(21, 'c3088253@trbvn.com', '$2y$13$YlA87rO6N1AC8a1fQfyI/ufkUTwl.zNYKAzaaIBPaIjwZNVJYD1/m', 10, '0VB6qfWeTAYVmZQAtLE3xcRRI9_nQXT2', 3, '0000-00-00', '0000-00-00'),
(22, 'c3088253@trbvn.com1', '$2y$13$2pQEz4Zq9k0.PUuM8rjxY.eRKUrtLEHSUFDZCNjEaD4hXAMdlcokq', 10, '3d0csAg4uAOTH-FzFAwbSpCDAEsonYqL', 3, '0000-00-00', '0000-00-00'),
(23, 'c308825325@trbvn.com', '$2y$13$oHcfpGtp4tD9aIvZmVAMneIywnk7ai1o6h7Fnei3o2NzXhJskUxFK', 10, 'mGe52emkU5ziZyPw6a_mQdc1eCVMYK6D', 3, '0000-00-00', '0000-00-00'),
(24, 'c30882532@trbvn.com', '$2y$13$Wn4MOtWLz4DmshoghfDEDePk/YOf26Xh2rCVTJtqUa1xcCQ8q9pd2', 10, 'J-Oa52hNIAvEnWn6jNDDA17TofyiMUCS', 3, '0000-00-00', '0000-00-00'),
(25, 'c3088253@trbvn.com2', '$2y$13$zrAoEKnrq54EFH9UUztkreUJMoy5ZLppSOiZFxlSx20HFUFNMGgRG', 10, 'mLpR7HHUWm7wHSTi3agpjroyTh6jD03_', 3, '0000-00-00', '0000-00-00');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Ad`
--
ALTER TABLE `Ad`
  ADD CONSTRAINT `ad_ibfk_1` FOREIGN KEY (`City`) REFERENCES `City` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ad_ibfk_2` FOREIGN KEY (`Model`) REFERENCES `Model` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ad_ibfk_3` FOREIGN KEY (`EngineCapacity`) REFERENCES `EngineCapacity` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ad_ibfk_4` FOREIGN KEY (`NumberHosts`) REFERENCES `NumberHosts` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ad_ibfk_5` FOREIGN KEY (`Mileage`) REFERENCES `Mileage` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ad_ibfk_6` FOREIGN KEY (`IdUser`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `City`
--
ALTER TABLE `City`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`IdRegion`) REFERENCES `Region` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Images`
--
ALTER TABLE `Images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`IdAd`) REFERENCES `Ad` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Model`
--
ALTER TABLE `Model`
  ADD CONSTRAINT `model_ibfk_1` FOREIGN KEY (`IdMark`) REFERENCES `Mark` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
