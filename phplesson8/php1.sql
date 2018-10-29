-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 29 2018 г., 21:26
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
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id_author` int(11) NOT NULL,
  `rights` int(11) NOT NULL DEFAULT '3',
  `author_name` varchar(100) NOT NULL,
  `author_family` varchar(100) NOT NULL,
  `author_login` varchar(100) NOT NULL,
  `author_pass` varchar(100) NOT NULL,
  `author_email` varchar(100) NOT NULL,
  `date_reg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id_author`, `rights`, `author_name`, `author_family`, `author_login`, `author_pass`, `author_email`, `date_reg`) VALUES
(6, 3, 'Имя', 'Фамилия', 'login', '$2y$10$H8A8Enk3LsKsOQMEOWfC5u7pxzFg7VW/Cx0KXNfwi5VWWh2kAZkPO', 'user@email.ru', 1539601055),
(7, 1, 'Администратор', 'Фамилия2', 'adm', '$2y$10$ONksAfWEyqSpDzHA83wNa.ByQ.f5YlqSCgCQu0P68vCZHuXv8OQ9q', 'adm@mail.t', 1540806039);

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `user_cookie` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `num_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `comm` text NOT NULL,
  `order_date` int(11) NOT NULL,
  `order_state` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `phone_number`, `comm`, `order_date`, `order_state`) VALUES
(24, 6, 123456, 'Привезите по адресу Городу, улица, дом', 1540802310, 'finished'),
(25, 6, 123456, 'Привезите утром!!!', 1540802323, 'start');

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
-- Структура таблицы `products_in_order`
--

CREATE TABLE `products_in_order` (
  `id_product_in_order` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `ammount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products_in_order`
--

INSERT INTO `products_in_order` (`id_product_in_order`, `id_order`, `id_product`, `ammount`) VALUES
(12, 24, 7, 1),
(13, 24, 3, 2),
(14, 24, 6, 1),
(15, 25, 6, 1);

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
-- Структура таблицы `temp_orders`
--

CREATE TABLE `temp_orders` (
  `id_temp_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `num_of product` int(11) NOT NULL
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
(10, 1, 7),
(11, 8, 7),
(12, 1, 6),
(13, 7, 6),
(14, 1, 3),
(15, 2, 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id_author`),
  ADD KEY `rights` (`rights`);

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `order_date` (`order_date`),
  ADD KEY `order_state` (`order_state`);

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
-- Индексы таблицы `products_in_order`
--
ALTER TABLE `products_in_order`
  ADD PRIMARY KEY (`id_product_in_order`);

--
-- Индексы таблицы `products_photos`
--
ALTER TABLE `products_photos`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `id_product` (`id_product`);

--
-- Индексы таблицы `temp_orders`
--
ALTER TABLE `temp_orders`
  ADD PRIMARY KEY (`id_temp_order`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `num_of product` (`num_of product`);

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
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `products_groups`
--
ALTER TABLE `products_groups`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `products_in_order`
--
ALTER TABLE `products_in_order`
  MODIFY `id_product_in_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `products_photos`
--
ALTER TABLE `products_photos`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `temp_orders`
--
ALTER TABLE `temp_orders`
  MODIFY `id_temp_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `uid_groups`
--
ALTER TABLE `uid_groups`
  MODIFY `uid_groups` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
