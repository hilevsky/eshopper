-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 26 2018 г., 00:58
-- Версия сервера: 5.6.37
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `phpshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `sort_order`, `status`) VALUES
(13, 'Ноутбуки', 1, 1),
(14, 'Планшеты', 2, 1),
(15, 'Мониторы', 3, 1),
(16, 'Игровые компьютеры', 4, 1),
(17, 'Телефоны', 5, 0),
(18, 'Радиостанции', 6, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `price` float NOT NULL,
  `availability` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_new` int(11) NOT NULL DEFAULT '0',
  `is_recommended` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `category_id`, `code`, `price`, `availability`, `brand`, `image`, `description`, `is_new`, `is_recommended`, `status`) VALUES
(34, 'Ноутбук Asus X200MA (X200MA-KX315D)', 13, 1839707, 395, 1, 'Asus', '34.jpg', 'Экран 11.6\" (1366x768) HD LED, глянцевый / Intel Pentium N3530 (2.16 - 2.58 ГГц) / RAM 4 ГБ / HDD 750 ГБ / Intel HD Graphics / без ОД / Bluetooth 4.0 / Wi-Fi / LAN / веб-камера / без ОС / 1.24 кг / синий', 0, 0, 1),
(35, 'Ноутбук HP Stream 11-d050nr', 13, 2343847, 305, 0, 'Hewlett Packard', '35.jpg', 'Экран 11.6” (1366x768) HD LED, матовый / Intel Celeron N2840 (2.16 ГГц) / RAM 2 ГБ / eMMC 32 ГБ / Intel HD Graphics / без ОД / Wi-Fi / Bluetooth / веб-камера / Windows 8.1 + MS Office 365 / 1.28 кг / синий', 1, 1, 1),
(36, 'Ноутбук Asus X200MA White ', 13, 2028027, 270, 1, 'Asus', '36.jpg', 'Экран 11.6\" (1366x768) HD LED, глянцевый / Intel Celeron N2840 (2.16 ГГц) / RAM 2 ГБ / HDD 500 ГБ / Intel HD Graphics / без ОД / Bluetooth 4.0 / Wi-Fi / LAN / веб-камера / без ОС / 1.24 кг / белый', 0, 1, 1),
(37, 'Ноутбук Acer Aspire E3-112-C65X', 13, 2019487, 325, 1, 'Acer', '37.jpg', 'Экран 11.6\'\' (1366x768) HD LED, матовый / Intel Celeron N2840 (2.16 ГГц) / RAM 2 ГБ / HDD 500 ГБ / Intel HD Graphics / без ОД / LAN / Wi-Fi / Bluetooth / веб-камера / Linpus / 1.29 кг / серебристый', 0, 1, 1),
(38, 'Ноутбук Acer TravelMate TMB115', 13, 1953212, 275, 1, 'Acer', '38.jpg', 'Экран 11.6\'\' (1366x768) HD LED, матовый / Intel Celeron N2840 (2.16 ГГц) / RAM 2 ГБ / HDD 500 ГБ / Intel HD Graphics / без ОД / LAN / Wi-Fi / Bluetooth 4.0 / веб-камера / Linpus / 1.32 кг / черный', 0, 0, 1),
(39, 'Ноутбук Lenovo Flex 10', 13, 1602042, 370, 0, 'Lenovo', '39.jpg', 'Экран 10.1\" (1366x768) HD LED, сенсорный, глянцевый / Intel Celeron N2830 (2.16 ГГц) / RAM 2 ГБ / HDD 500 ГБ / Intel HD Graphics / без ОД / Wi-Fi / Bluetooth / веб-камера / Windows 8.1 / 1.2 кг / черный', 0, 0, 1),
(40, 'Ноутбук Asus X751MA', 13, 2028367, 430, 1, 'Asus', '40.jpg', 'Экран 17.3\" (1600х900) HD+ LED, глянцевый / Intel Pentium N3540 (2.16 - 2.66 ГГц) / RAM 4 ГБ / HDD 1 ТБ / Intel HD Graphics / DVD Super Multi / LAN / Wi-Fi / Bluetooth 4.0 / веб-камера / DOS / 2.6 кг / белый', 0, 1, 1),
(41, 'Samsung Galaxy Tab S 10.5 16GB', 14, 1129365, 780, 1, 'Samsung', '41.jpg', 'Samsung Galaxy Tab S создан для того, чтобы сделать вашу жизнь лучше. Наслаждайтесь своим контентом с покрытием 94% цветов Adobe RGB и 100000:1 уровнем контрастности, который обеспечивается sAmoled экраном с функцией оптимизации под отображаемое изображение и окружение. Яркий 10.5” экран в ультратонком корпусе весом 467 г порадует вас высоким уровнем портативности. Работа станет проще вместе с Hancom Office и удаленным доступом к вашему ПК. E-Meeting и WebEx – отличные помощники для проведения встреч, когда вы находитесь вне офиса. Надежно храните ваши данные благодаря сканеру отпечатка пальцев.', 1, 1, 1),
(42, 'Samsung Galaxy Tab S 8.4 16GB', 14, 1128670, 640, 1, 'Samsung', '42.jpg', 'Экран 8.4\" Super AMOLED (2560x1600) емкостный Multi-Touch / Samsung Exynos 5420 (1.9 ГГц + 1.3 ГГц) / RAM 3 ГБ / 16 ГБ встроенной памяти + поддержка карт памяти microSD / Bluetooth 4.0 / Wi-Fi 802.11 a/b/g/n/ac / основная камера 8 Мп, фронтальная 2.1 Мп / GPS / ГЛОНАСС / Android 4.4.2 (KitKat) / 294 г / белый', 0, 0, 1),
(43, 'Gazer Tegra Note 7', 14, 683364, 210, 1, 'Gazer', '43.jpg', 'Экран 7\" IPS (1280x800) емкостный Multi-Touch / NVIDIA Tegra 4 (1.8 ГГц) / RAM 1 ГБ / 16 ГБ встроенной памяти + поддержка карт памяти microSD / Wi-Fi / Bluetooth 4.0 / основная камера 5 Мп, фронтальная - 0.3 Мп / GPS / ГЛОНАСС / Android 4.4.2 (KitKat) / вес 320 г', 0, 0, 1),
(44, 'Монитор 23\" Dell E2314H Black', 15, 355025, 175, 1, 'Dell', '44.jpg', 'С расширением Full HD Вы сможете рассмотреть мельчайшие детали. Dell E2314H предоставит Вам резкое и четкое изображение, с которым любая работа будет в удовольствие. Full HD 1920 x 1080 при 60 Гц разрешение (макс.)', 1, 0, 1),
(45, 'Компьютер Everest Game ', 16, 1563832, 1320, 1, 'Everest', '45.jpg', 'Everest Game 9085 — это компьютеры премимум класса, собранные на базе эксклюзивных компонентов, тщательно подобранных и протестированных лучшими специалистами нашей компании. Это топовый сегмент систем, который отвечает наилучшим характеристикам показателей качества и производительности.', 0, 0, 1),
(46, 'Apple iPad 32GB Silver', 14, 1563833, 820, 1, 'Apple ', '46.jpg', '9.7\" IPS (2048x1536), iOS, флэш-память 32 ГБ, цвет белый/серебристый', 0, 0, 1),
(47, 'ASUS Transformer Mini T102HA-GR012T 64GB', 14, 1563834, 930, 1, 'ASUS', '47.jpg', '10.1\" IPS (1280x800), Windows 10, ОЗУ 4 ГБ, флэш-память 64 ГБ, клавиатура, цвет серый', 0, 0, 1),
(48, 'Samsung Galaxy Tab A (2016) 16GB Black ', 14, 1563835, 520, 1, 'Samsung', '48.jpg', '10.1\" (1920x1200), Android, ОЗУ 2 ГБ, флэш-память 16 ГБ, цвет черный', 0, 0, 1),
(49, 'Lenovo Yoga Tab 3 Plus YT-X703L 32GB LTE', 14, 1563836, 980, 1, 'Lenovo ', '49.jpg', '10.1\" IPS (2560x1600), Android, ОЗУ 3 ГБ, флэш-память 32 ГБ, LTE, цвет черный', 0, 0, 1),
(50, 'Apple iPad Pro 10.5 64GB Space Gray', 14, 1563837, 1430, 1, 'Apple ', '50.jpg', '10.5\" IPS (2224x1668), iOS, флэш-память 64 ГБ, цвет серый', 0, 0, 1),
(51, 'Lenovo Tab 2 A10-70F 16GB Blue', 14, 1563839, 379, 1, 'Lenovo', '51.jpg', '10.5\" IPS (2224x1668), iOS, флэш-память 64 ГБ, цвет серый', 0, 0, 1),
(52, 'Huawei MediaPad M3 lite 10 32GB LTE', 14, 1563840, 700, 1, 'Huawei', '52.jpg', '10.1\" IPS (1920x1200), Android, ОЗУ 3 ГБ, флэш-память 32 ГБ, LTE, цвет серый', 0, 0, 1),
(53, 'Prestigio Grace 3101 16GB LTE', 14, 1563843, 280, 1, 'Prestigio', '53.jpg', '10.1\" IPS (1280x800), Android, ОЗУ 2 ГБ, флэш-память 16 ГБ, LTE, цвет черный', 0, 0, 1),
(54, 'Xiaomi Mi Pad 2 64GB Champagne Gold ', 14, 1563845, 280, 1, 'Xiaomi ', '54.jpg', '7.9\" IPS (2048x1536), Android, ОЗУ 2 ГБ, флэш-память 64 ГБ, цвет золотистый/черный', 0, 0, 1),
(55, 'Samsung Galaxy Tab S3 32GB LTE Black', 14, 1563850, 1540, 1, 'Samsung', '55.jpg', '9.7\" AMOLED (2048x1536), Android, ОЗУ 4 ГБ, флэш-память 32 ГБ, LTE, цвет черный', 0, 0, 1),
(56, 'Lenovo Yoga Tab 3 X50F 16GB ZA0H0060UA', 14, 1563852, 420, 1, 'Lenovo', '56.jpg', '10.1\" IPS (1280x800), Android, ОЗУ 2 ГБ, флэш-память 16 ГБ, цвет черный', 0, 0, 1),
(57, 'Lenovo Yoga Book YB1-X90F 64GB', 14, 1563854, 1334, 1, 'Lenovo', '57.jpg', '10.1\" IPS (1920x1200), Android, ОЗУ 4 ГБ, флэш-память 64 ГБ, цвет золотистый', 0, 0, 1),
(67, '222', 13, 222, 222, 1, '222', '', '222222222222222222222222222222222222222222222222222222222222', 1, 1, 1),
(69, 'Xiaomi Mi Notebook Pro 15.6 JYU4036CN ', 13, 159684, 1150, 1, 'Xiaomi ', '', '15.6\" 1920 x 1080 глянцевый, Intel Core i5 8250U 1600 МГц, 8 ГБ, 256 ГБ (SSD), NVIDIA GeForce MX150, цвет крышки темно-серый, цвет корпуса темно-серый', 1, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_comment` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `products` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_order`
--

INSERT INTO `product_order` (`id`, `user_name`, `user_phone`, `user_comment`, `user_id`, `date`, `products`, `status`) VALUES
(45, 'fsdfsd', '1', '123123123', 4, '2015-05-14 09:54:45', '{\"1\":1,\"2\":1,\"3\":2}', 3),
(46, 'САША1', 'g3424242342', '', 4, '2015-05-18 15:34:42', '{\"44\":3,\"43\":3}', 1),
(47, 'егор', '', '', 0, '2018-02-22 10:38:58', '{\"56\":5,\"55\":9,\"57\":4}', 1),
(48, 'Иван Иваныч Иванов', '123-45-67', 'трали-вали', 0, '2018-02-20 11:59:43', '{\"40\":1}', 4),
(50, 'Егор', '321-54-67', 'перезвоните', 6, '2018-02-25 17:49:44', '{\"45\":1,\"68\":1,\"56\":1}', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`) VALUES
(3, 'Александр', 'alex@mail.com', '111111', ''),
(5, 'Сергей', 'serg@mail.com', '111111', ''),
(6, 'Егор', 'e_gilevski@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin'),
(7, 'Егор1', 'egor@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT для таблицы `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
