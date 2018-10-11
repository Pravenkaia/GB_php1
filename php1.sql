-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 11 2018 г., 14:32
-- Версия сервера: 8.0.12
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `php1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE `photos` (
  `id_photo` int(11) NOT NULL,
  `photo_big` varchar(50) NOT NULL,
  `photo_thumb` varchar(50) NOT NULL,
  `photo_alt` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `photos`
--

INSERT INTO `photos` (`id_photo`, `photo_big`, `photo_thumb`, `photo_alt`, `likes`) VALUES
(1, '/img/big/bear_4569.jpg', '/img/thumb/bear_4569.jpg', 'Такой медвежонок', 16),
(5, '/img/big/_8809.jpg', '/img/thumb/_8809.jpg', 'Здравствуйте, товарищи участники!', 2),
(6, '/img/big/1_5897.jpg', '/img/thumb/1_5897.jpg', '', 6),
(7, '/img/big/2_5347.jpg', '/img/thumb/2_5347.jpg', 'Новый этап! Бегом на остров!', 1),
(8, '/img/big/3_6405.jpg', '/img/thumb/3_6405.jpg', 'КП в водопаде', 0),
(9, '/img/big/4_8149.jpg', '/img/thumb/4_8149.jpg', 'КП на разрушенной мельнице', 0),
(10, '/img/big/6_8688.jpg', '/img/thumb/6_8688.jpg', 'Каньонинг! КП в водопаде \"Белые мосты\"', 1),
(11, '/img/big/5_4905.jpg', '/img/thumb/5_4905.jpg', 'КП на разрушенной мельнице. Водопад, однако!', 0),
(12, '/img/big/7_8905.jpg', '/img/thumb/7_8905.jpg', 'Финиш!', 0),
(13, '/img/big/dog_2453.jpg', '/img/thumb/dog_2453.jpg', 'Собака!', 2),
(14, '/img/big/haer_9944.jpg', '/img/thumb/haer_9944.jpg', 'Заяц', 1),
(15, '/img/big/sesame_537.jpg', '/img/thumb/sesame_537.jpg', 'Cooky!', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `product_name` varchar(70) NOT NULL,
  `product_text` text NOT NULL,
  `price` int(11) NOT NULL,
  `photo_big` varchar(100) NOT NULL,
  `photo_thumb` varchar(100) NOT NULL,
  `product_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id_product`, `product_name`, `product_text`, `price`, `photo_big`, `photo_thumb`, `product_time`) VALUES
(3, 'Медведь белый', 'Мягкая игрушка засыпающий мишка', 1000, '/img/big/medved_beliy.jpg', '/img/thumb/medved_beliy.jpg', 1539252910),
(5, 'Собака Жулька', 'Весёлая собака', 800, '/img/big/sobaka_julka.jpg', '/img/thumb/sobaka_julka.jpg', 1539255628),
(6, 'Заяц', 'Заяц. Это заяц', 700, '', '', 1539255716),
(7, 'Бисквитный монстр', 'Мягкая игрушка', 2000, '/img/big/biskvitniy_monstr.jpg', '/img/thumb/biskvitniy_monstr.jpg', 1539255787);

-- --------------------------------------------------------

--
-- Структура таблицы `products_groups`
--

CREATE TABLE `products_groups` (
  `id_group` int(11) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `id_group_parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products_groups`
--

INSERT INTO `products_groups` (`id_group`, `group_name`, `id_group_parent`) VALUES
(1, 'Игрушки', 0),
(2, 'Медведи', 1),
(3, 'Собаки', 1),
(4, 'Книги', 0),
(5, 'Программирование', 4),
(6, 'Математика', 4),
(7, 'Зайцы', 1),
(8, 'Персонажи', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `products_photos`
--

CREATE TABLE `products_photos` (
  `id_photo` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `photo_thumb` varchar(100) NOT NULL,
  `photo_big` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `uid_groups`
--

CREATE TABLE `uid_groups` (
  `uid_groups` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `uid_groups`
--

INSERT INTO `uid_groups` (`uid_groups`, `id_group`, `id_product`) VALUES
(7, 1, 3),
(8, 2, 3),
(10, 1, 7),
(11, 8, 7),
(12, 1, 6),
(13, 7, 6);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `like` (`likes`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `product_time` (`product_time`);

--
-- Индексы таблицы `products_groups`
--
ALTER TABLE `products_groups`
  ADD PRIMARY KEY (`id_group`),
  ADD KEY `id_group_parent` (`id_group_parent`);

--
-- Индексы таблицы `products_photos`
--
ALTER TABLE `products_photos`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `id_product` (`id_product`);

--
-- Индексы таблицы `uid_groups`
--
ALTER TABLE `uid_groups`
  ADD PRIMARY KEY (`uid_groups`),
  ADD KEY `id_group` (`id_group`),
  ADD KEY `id_product` (`id_product`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `products_groups`
--
ALTER TABLE `products_groups`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `products_photos`
--
ALTER TABLE `products_photos`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `uid_groups`
--
ALTER TABLE `uid_groups`
  MODIFY `uid_groups` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
