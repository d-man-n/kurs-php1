-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 26 2022 г., 20:22
-- Версия сервера: 10.3.16-MariaDB
-- Версия PHP: 7.3.6

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
-- Структура таблицы `catalog`
--

CREATE TABLE `catalog` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cdate` datetime NOT NULL,
  `mdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`id`, `name`, `description`, `alias`, `cdate`, `mdate`) VALUES
(1, 'Все', 'Все товары', 'all', '2022-04-18 00:00:00', '2022-04-18 17:52:20'),
(2, 'Женщины', 'Товары для женщин', 'woman', '2022-04-18 00:00:00', '2022-04-18 17:53:37'),
(3, 'Мужчины', 'Товары для мужчин', 'man', '2022-04-18 00:00:00', '2022-04-18 17:53:37'),
(4, 'Дети', 'Товары для детей', 'children', '2022-04-18 00:00:00', '2022-04-18 17:54:37'),
(5, 'Аксессуары', 'Прочий хлам', 'accessories', '2022-04-18 00:00:00', '2022-04-18 17:54:37');

-- --------------------------------------------------------

--
-- Структура таблицы `catalog_product`
--

CREATE TABLE `catalog_product` (
  `catalog_id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `catalog_product`
--

INSERT INTO `catalog_product` (`catalog_id`, `id_product`) VALUES
(2, 1),
(2, 2),
(2, 7),
(2, 9),
(5, 3),
(5, 5),
(5, 9),
(4, 6),
(4, 8),
(4, 4),
(2, 14);

-- --------------------------------------------------------

--
-- Структура таблицы `catalog_structure`
--

CREATE TABLE `catalog_structure` (
  `id_parent` int(11) DEFAULT NULL,
  `id_children` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `catalog_structure`
--

INSERT INTO `catalog_structure` (`id_parent`, `id_children`) VALUES
(NULL, 1),
(NULL, 2),
(NULL, 3),
(NULL, 4),
(NULL, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `delivery_order`
--

CREATE TABLE `delivery_order` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `delivery_order`
--

INSERT INTO `delivery_order` (`id`, `name`) VALUES
(1, 'Самовывоз'),
(2, 'Курьерная доставка');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `cdate` datetime NOT NULL,
  `mdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `cdate`, `mdate`) VALUES
(2, 'Операторы', 'Может заходить в административный интерфейс и видеть список заказов.', '2022-04-18 00:00:00', '2022-04-18 17:22:15'),
(3, 'Администраторы', 'Может заходить в административный интерфейс, видеть список заказов и управлять товарами.', '2022-04-18 00:00:00', '2022-04-18 17:22:03');

-- --------------------------------------------------------

--
-- Структура таблицы `group_user`
--

CREATE TABLE `group_user` (
  `id_user` int(11) NOT NULL,
  `id_group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `group_user`
--

INSERT INTO `group_user` (`id_user`, `id_group`) VALUES
(3, 3),
(2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `id_product`, `sort`, `image`) VALUES
(1, 1, 0, '/products/product-1.jpg'),
(2, 2, 0, '/products/product-2.jpg'),
(3, 3, 0, '/products/product-3.jpg'),
(4, 4, 0, '/products/product-4.jpg'),
(5, 5, 0, '/products/product-5.jpg'),
(6, 6, 0, '/products/product-6.jpg'),
(7, 7, 0, '/products/product-7.jpg'),
(8, 8, 0, '/products/product-8.jpg'),
(9, 9, 0, '/products/product-9.jpg'),
(11, 14, 0, '/products/7.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `name`, `path`, `sort`, `admin`) VALUES
(1, 'Главная', '/', 1, 1),
(2, 'Новинки', '/catalog/new/', 2, 0),
(3, 'Sale', '/catalog/sale/', 3, 0),
(4, 'Доставка', '/delivery/', 4, 0),
(5, 'Товары', '/products/', 1, 2),
(6, 'Заказы', '/orders/', 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `delivery` int(11) NOT NULL,
  `address` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pay` int(11) NOT NULL,
  `price` double(15,2) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `cdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `id_product`, `name`, `phone`, `email`, `delivery`, `address`, `pay`, `price`, `comment`, `status`, `cdate`) VALUES
(112, 14, 'Корлыханов Дмитрий Викторович', '89032034140', 'd-man-n@mail.ru', 2, 'Москва Петровка 3 6', 2, 1279.00, 'Ураааааа', 1, '2022-05-23 21:08:28'),
(113, 4, 'Иванов Иван Иваныч', '+7(909)123-45-67', 'ivanovii@email.ru', 1, '', 1, 1289.00, 'ЫЫыыыыыы', 0, '2022-05-25 18:37:52');

-- --------------------------------------------------------

--
-- Структура таблицы `order_pay`
--

CREATE TABLE `order_pay` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `order_pay`
--

INSERT INTO `order_pay` (`id`, `name`) VALUES
(1, 'Наличные'),
(2, 'Банковской картой');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` double(15,2) NOT NULL,
  `new` tinyint(1) NOT NULL DEFAULT 0,
  `sale` tinyint(1) NOT NULL DEFAULT 0,
  `cdate` datetime NOT NULL,
  `mdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `new`, `sale`, `cdate`, `mdate`) VALUES
(1, 'Платье со складками', 'Какая то белая накидка', 2999.00, 1, 1, '2022-04-18 00:00:00', '2022-04-18 18:04:03'),
(2, 'Рубаха в клетку', 'Идет в комплекте с шортами', 3999.00, 0, 1, '2022-04-18 00:00:00', '2022-04-18 18:04:03'),
(3, 'Часы', 'Часы со стрелками', 6000.00, 1, 0, '2022-04-18 00:00:00', '2022-04-18 18:05:05'),
(4, 'Полосатые штаны', 'Можно спать или играть в футбол', 1009.00, 0, 0, '2022-04-18 00:00:00', '2022-04-18 18:05:05'),
(5, 'Сумка', 'Коричневая сумка, поэтому не пачкается', 5999.00, 1, 1, '2022-04-18 00:00:00', '2022-04-18 18:06:48'),
(6, 'Платье', 'Красное платье, хорошо подходит к красным очкам', 4999.00, 0, 1, '2022-04-18 00:00:00', '2022-04-18 18:06:48'),
(7, 'Пальто', 'Розовое пальто, что бы не мерзнуть на море', 7999.00, 0, 0, '2022-04-18 00:00:00', '2022-04-18 18:07:57'),
(8, 'Джинсы', 'Не драные', 1999.00, 1, 0, '2022-04-18 00:00:00', '2022-04-18 18:07:57'),
(9, 'Туфля', 'При покупке двух - второй бесплатно', 2999.00, 0, 1, '2022-04-18 00:00:00', '2022-04-18 18:08:42'),
(14, 'Какая-то хрень', 'Новый товар', 999.00, 1, 0, '2022-04-27 20:37:21', '2022-04-27 18:37:21');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cdate` datetime NOT NULL,
  `mdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `email`, `phone`, `cdate`, `mdate`) VALUES
(1, 'ivanov', '827ccb0eea8a706c4c34a16891f84e7b', 'Иванов Иван', 'ivanov@email.ru', '+7(123)456-78-90', '2022-04-18 00:00:00', '2022-04-18 17:25:25'),
(2, 'petrov', '827ccb0eea8a706c4c34a16891f84e7b', 'Петров Петька', 'petrov@email.ru', '+7(123)456-78-91', '2022-04-18 00:00:00', '2022-04-18 17:26:44'),
(3, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'Администратор', 'admin@email.ru', '+7(123)456-78-92', '2022-04-18 00:00:00', '2022-04-18 17:26:28');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `catalog_product`
--
ALTER TABLE `catalog_product`
  ADD KEY `catalog_id_c` (`catalog_id`),
  ADD KEY `id_product_c` (`id_product`);

--
-- Индексы таблицы `catalog_structure`
--
ALTER TABLE `catalog_structure`
  ADD KEY `id_parent_c` (`id_parent`),
  ADD KEY `id_children_c` (`id_children`);

--
-- Индексы таблицы `delivery_order`
--
ALTER TABLE `delivery_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `group_user`
--
ALTER TABLE `group_user`
  ADD KEY `id_group_c` (`id_group`),
  ADD KEY `id_user_c` (`id_user`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product_c2` (`id_product`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pay_c` (`pay`),
  ADD KEY `id_delivery_c` (`delivery`),
  ADD KEY `id_product_order` (`id_product`);

--
-- Индексы таблицы `order_pay`
--
ALTER TABLE `order_pay`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `delivery_order`
--
ALTER TABLE `delivery_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT для таблицы `order_pay`
--
ALTER TABLE `order_pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `catalog_product`
--
ALTER TABLE `catalog_product`
  ADD CONSTRAINT `catalog_id_c` FOREIGN KEY (`catalog_id`) REFERENCES `catalog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_product_c` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `catalog_structure`
--
ALTER TABLE `catalog_structure`
  ADD CONSTRAINT `id_children_c` FOREIGN KEY (`id_children`) REFERENCES `catalog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_parent_c` FOREIGN KEY (`id_parent`) REFERENCES `catalog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `group_user`
--
ALTER TABLE `group_user`
  ADD CONSTRAINT `id_group_c` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user_c` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `id_product_c2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `id_delivery_c` FOREIGN KEY (`delivery`) REFERENCES `delivery_order` (`id`),
  ADD CONSTRAINT `id_pay_c` FOREIGN KEY (`pay`) REFERENCES `order_pay` (`id`),
  ADD CONSTRAINT `id_product_order` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
