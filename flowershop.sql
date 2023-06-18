-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 18 2023 г., 22:58
-- Версия сервера: 5.7.39
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `flowershop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`name`, `pass`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `cartid` int(11) NOT NULL,
  `customerid` int(10) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `productid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` tinyint(3) UNSIGNED NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Новый'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`cartid`, `customerid`, `date`, `productid`, `quantity`, `status`) VALUES
(68, 21, '2021-12-22 21:13:03', '00000000-11', 5, 'Обработан'),
(69, 21, '2021-12-22 21:13:22', '000000000-4', 6, 'Оплачен'),
(70, 32, '2021-12-22 21:14:46', '000000000-4', 10, 'Выполнен'),
(71, 33, '2021-12-22 21:26:03', '00000000-10', 1, 'Доставлен'),
(72, 21, '2021-12-23 05:46:57', '00000000-12', 10, 'Оплачен'),
(73, 34, '2021-12-24 14:57:35', '00000000-10', 2, 'Выполнен'),
(74, 34, '2021-12-24 15:14:17', '000000000-8', 1, 'Новый'),
(75, 35, '2021-12-27 20:29:52', '000000000-8', 5, 'Новый'),
(76, 35, '2021-12-27 20:29:52', '000000000-9', 7, 'Новый'),
(78, 36, '2023-06-18 19:52:21', '00000000-10', 8, 'Обработан');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL,
  `category_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`categoryid`, `category_name`) VALUES
(1, 'Большие букеты'),
(2, 'Самые большие букеты'),
(3, 'Средние букеты'),
(4, 'Маленькие букеты'),
(5, 'На заказ');

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(32) NOT NULL,
  `address` varchar(120) NOT NULL,
  `city` varchar(40) NOT NULL,
  `zipcode` varchar(40) NOT NULL,
  `cookie` varchar(32) DEFAULT NULL,
  `avatar` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'zero.jpg',
  `block` varchar(5) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `email`, `password`, `address`, `city`, `zipcode`, `cookie`, `avatar`, `block`) VALUES
(36, 'Иван', 'Иванов', 'Ivan@mail.ru', '62c8ad0a15d9d1ca38d5dee762a16e01', 'ул. Петрова, д. 27', 'Москва', '824763', NULL, '1.jpg', 'false');

-- --------------------------------------------------------

--
-- Структура таблицы `flowers`
--

CREATE TABLE `flowers` (
  `flower_num` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `flower_title` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flower_image` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flower_descr` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flower_price` decimal(6,2) NOT NULL,
  `categoryid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `flowers`
--

INSERT INTO `flowers` (`flower_num`, `flower_title`, `flower_image`, `flower_descr`, `flower_price`, `categoryid`) VALUES
('00000000-10', 'Романтический вечер', 'd-xZZaiEP4k.jpg', 'Букет из 15 мыльных роз разного цвета.', '850.00', 4),
('00000000-11', 'Мармелад', 'g3M5eHjisho.jpg', 'Букет из 11 мыльных роз разного цвета.', '750.00', 4),
('00000000-12', 'Для мамы', 'F7WNcyA9VSE.jpg', 'Букет из 25 мыльных роз белого и темно-красного цветов.', '1000.00', 5),
('000000000-1', 'Голубой рассвет', 'qwPN95RbPrs.jpg', 'Букет из 27 мыльных роз синего и белого цвета.', '1500.00', 1),
('000000000-2', 'Слияние цветов', 'MzQdFArM_hg.jpg', 'Букет из 33 мыльных роз в виде переливающегося градиента.', '2000.00', 2),
('000000000-3', 'Вишневое настроение', 'aWisUvp_aZI.jpg', 'Букет из 18 мыльных роз разного цвета.', '1300.00', 3),
('000000000-4', 'От всего сердца', 'WimOjHLItUA.jpg', 'Букет из 37 мыльных роз красного и желтого цветов.', '1800.00', 2),
('000000000-5', 'Красная любовь', 'chQISLk1ibA.jpg', 'Букет из 27 мыльных роз, собранных в виде сердца.', '1500.00', 1),
('000000000-6', 'Нежное восхищение', 'FsCMXC4qE-Q.jpg', 'Букет из 17 мыльных роз нежных цветов.', '1200.00', 3),
('000000000-7', 'Розовые розы', 't61IsQS1H0s.jpg', 'Букет из 15 мыльных роз розовых оттенков.', '850.00', 5),
('000000000-8', 'Яркий чизкейк', 'xmKle-br6GE.jpg', 'Букет из 21 мыльной розы различных ярких цветов.', '950.00', 3),
('000000000-9', 'Оранжевое счастье', 'D0cex2ON6js.jpg', 'Букет из 21 мыльной розы оранжевого и желтого цветов.', '950.00', 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartid`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `flowers`
--
ALTER TABLE `flowers`
  ADD PRIMARY KEY (`flower_num`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
