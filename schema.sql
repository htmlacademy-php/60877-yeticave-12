-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 15 2021 г., 14:26
-- Версия сервера: 5.7.25
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yeticave`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bids`
--

CREATE TABLE `bids` (
  `id` int(11) NOT NULL,
  `date` datetime(6) NOT NULL,
  `summary_of_the_lot` int(10) NOT NULL,
  `userid` int(30) NOT NULL,
  `lotid` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bids`
--

INSERT INTO `bids` (`id`, `date`, `summary_of_the_lot`, `userid`, `lotid`) VALUES
(1, '2020-10-19 17:00:00.000000', 80000, 1, 1),
(2, '2020-08-04 00:00:00.000000', 45000, 2, 2),
(3, '2020-08-05 00:00:00.000000', 45050, 3, 3),
(4, '2020-09-02 00:00:00.000000', 85913, 4, 4),
(5, '2020-10-13 00:00:00.000000', 1000000, 5, 5),
(6, '2021-06-17 00:00:00.000000', 450000, 4, 6),
(7, '2021-06-17 00:00:00.000000', 78000, 10, 24),
(8, '2020-12-26 09:10:12.000000', 3, 3, 4),
(9, '2020-12-26 12:58:25.000000', 1, 10, 17),
(10, '2020-12-26 13:45:43.000000', 1, 10, 24),
(11, '2020-12-27 11:03:30.000000', 3333, 10, 4),
(12, '2020-12-27 11:26:59.000000', 455, 10, 19),
(13, '2020-12-27 11:27:09.000000', 1596333333, 10, 19),
(14, '2020-12-30 19:28:07.000000', 223333, 10, 23),
(15, '2020-12-30 19:28:48.000000', 333333, 10, 23),
(16, '2021-01-04 16:42:28.000000', 3333, 10, 18),
(17, '2021-01-04 23:38:13.000000', 8999655, 10, 21),
(18, '2021-01-04 23:39:05.000000', 89566226, 10, 23),
(19, '2021-01-07 00:11:43.000000', 159, 10, 17),
(20, '2021-01-07 11:23:42.000000', 222, 10, 11),
(21, '2021-02-12 13:24:28.000000', 34, 9, 5),
(22, '2021-02-12 13:25:54.000000', 123123, 9, 5),
(23, '2021-02-12 13:26:01.000000', 123123, 9, 5),
(24, '2021-02-12 16:26:09.000000', 45345, 9, 20),
(25, '2021-02-14 00:25:21.000000', 444, 11, 13),
(26, '2021-02-14 00:25:44.000000', 9999, 11, 13),
(27, '2021-02-14 00:32:15.000000', 3333, 11, 6),
(28, '2021-02-14 12:08:55.000000', 23132, 11, 25),
(29, '2021-02-14 13:21:56.000000', 344, 11, 16),
(30, '2021-02-14 14:06:13.000000', 123, 12, 29),
(31, '2021-02-14 14:06:29.000000', 123, 12, 27);

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `symbol_code` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `symbol_code`) VALUES
(1, 'Ботинки', 'boots'),
(2, 'Доски и лыжи', 'boards'),
(3, 'Инструменты', 'tools'),
(4, 'Крепления', 'attachment'),
(5, 'Одежда', 'clothing'),
(6, 'Разное', 'other');

-- --------------------------------------------------------

--
-- Структура таблицы `lots`
--

CREATE TABLE `lots` (
  `id` int(11) NOT NULL,
  `date_of_creation` datetime DEFAULT NULL,
  `name_of_the_lot` varchar(50) NOT NULL,
  `deskription` longtext NOT NULL,
  `img` varchar(255) NOT NULL,
  `start_price` int(11) NOT NULL,
  `finish_date` datetime NOT NULL,
  `step_of_the_bid` int(11) NOT NULL,
  `authorid` int(50) DEFAULT NULL,
  `winnerid` int(50) DEFAULT NULL,
  `categoryid` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lots`
--

INSERT INTO `lots` (`id`, `date_of_creation`, `name_of_the_lot`, `deskription`, `img`, `start_price`, `finish_date`, `step_of_the_bid`, `authorid`, `winnerid`, `categoryid`) VALUES
(1, '2020-12-24 00:00:00', 'Крепления Union Contact Pro 2015 года размер L/XL', 'Невероятно легкие универсальные крепления весом всего 720 грамм готовы порадовать прогрессирующих райдеров, практикующих как трассовое катание, так и взрывные спуски в паудере. Легкая нейлоновая база в сочетании с очень прочным хилкапом, выполненным из экструдированного алюминия, выдержит серьезные нагрузки, а бакли, выполненные из магния не только заметно снижают вес, но и имеют плавный механизм. Система стрепов 3D Connect обеспечивает равномерное давление на верхнюю часть ноги, что несомненно добавляет комфорта как во время выполнения трюков, так и во время катания в глубоком снегу.\r\n', '/uploads/lot-3.jpg', 8000, '2021-11-23 00:00:00', 45, 1, NULL, 4),
(2, '2020-07-01 00:05:20', 'Ботинки для сноуборда DC Mutiny Charocal', 'Эти ботинки созданы для фристайла и для того, чтобы на любом споте Вы чувствовали себя как дома в уютных тапочках, в которых Вы будете также прекрасно чувствовать свою доску, как ворсинки на любимом коврике около дивана. Каучуковая стелька Impact S погасит нежелательные вибрации и смягчит приземления, внутренник White Liner с запоминающим форму ноги наполением и фиксирующим верхним стрепом добавит эргономики в посадке, а традиционная шнуровка с блокирующими верхними крючками поможет идеально подогнать ботинок по ноге, тонко фиксируя натяжение шнурков.\r\n', '/uploads/lot-4.jpg', 10999, '2021-11-24 00:00:00', 34, 1, NULL, 1),
(3, '2020-07-01 10:05:25', 'Куртка для сноуборда DC Mutiny Charocal', 'высокотехнологичная мужская куртка с вентиляцией для горнолыжного спорта. Полностью проклеенные швы, влагозащитные молнии и мембрана с высокими показателями вoдoнeпpoницaeмoсти и дышимости надёжно защищают от холодного ветра и снега. Вентиляция под рукавами позволяет создавать комфортную терморегуляцию в солнечную погоду. Эластичные свойства мембраны обеспечивают свободу движения во время спусков на любой скорости. Артикуляционный крой рукавов гарантирует комфорт за счёт предварительного изгиба области локтей. Благодаря утеплителю и анатомическому крою в куртке будет комфортно и удобно. Снегозащитная юбка и эластичные внутренние манжеты с отверстиями под большие пальцы обеспечивают дополнительную изоляцию от холода.\r\n', '/uploads/lot-5.jpg', 7500, '2021-11-25 00:00:00', 12, 1, NULL, 5),
(4, '2020-07-01 23:55:20', 'Маска Oakley Canopy', 'Маска г/л Oakley CANOPY MATTE BLACK PRIZM TORCH IRIDIUM\r\n \r\n\r\nУниверсальная горнолыжная маска подойдет мужчинам и девушкам. В данной модели использована оптика высокой четкости - HDO. Технология Prizm обеспечивает четкость передачи цвета, точный контраст, позволяет видеть все неровности на поверхности. Предусмотрена 100% защита от ультрафиолетового излучения. Линзы - Prizm Torch Iridium, подходят для катания в солнечную погоду. За антизапотевание отвечает технология F3 Аnti-fog и линзы Dual-Vented Lens. Оправа очень гибкая, прочная, выполнена из запатентованного материала O-Matter на основе нейлона и карбоновых волокон. Вспененный тройной слой микрофлиса равномерно балансирует давление маски на кожу и отводит влагу. Ремешок выполнен из силикона, регулируемый, не соскальзывает. Маска совместима со всеми видами шлемов.  \r\nПодробнее: https://estafeta.com.ua/p490781-maski_g-l_oakley_canopy_matte_black_prizm_torch_iridium', '/uploads/lot-6.jpg', 5400, '2021-12-20 00:00:00', 23, 1, NULL, 6),
(5, '2021-05-20 00:00:00', '2014 Rossignol District Snowboard', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.\r\n\r\n', '/uploads/lot-1.jpg', 10999, '2022-07-12 00:00:00', 5, 1, NULL, 2),
(6, '2020-08-23 00:00:00', 'DC Ply Mens 2016/2017 Snowboard', 'Low in price but not in performance, the DC Ply has long been a favourite for riders on a budget. Male riders should seek out the slightly tweaked men’s version, but this one’s for the ladies.', '/uploads/lot-2.jpg', 159999, '2022-11-22 00:00:00', 5, 10, NULL, 2),
(7, '2020-11-16 19:15:44', 'Winned Lot', '333', '/uploads/lot-3.jpg', 33, '2020-11-24 00:00:00', 33, 10, NULL, 4),
(8, '2020-11-16 19:21:07', '333', '222', '/uploads/Tablet (4).jpg', 22, '2022-11-24 00:00:00', 22, 1, NULL, 4),
(9, '2020-11-16 19:32:24', '333', '123', '/uploads/Tablet (4).jpg', 123, '2022-11-24 00:00:00', 123, 1, NULL, 2),
(10, '2020-11-16 20:46:29', '333', 'ttttttttttttttttttttttttttttttttttttttttttt', '/uploads/Tablet (4).jpg', 12, '2022-11-24 00:00:00', 12, 1, NULL, 2),
(11, '2020-11-16 20:47:56', '333', 'iren', '/uploads/персик3.jpg', 12, '2022-11-24 00:00:00', 159, 1, NULL, 2),
(12, '2020-11-16 23:11:29', '333', 'кккк', '/uploads/Tablet (4).jpg', 44, '2022-11-24 00:00:00', 444, 1, NULL, 2),
(13, '2020-11-16 23:32:14', '333', '33', '/uploads/website.png', 33, '2022-11-24 00:00:00', 33, 1, NULL, 4),
(14, '2020-11-17 17:48:45', '333', '111', '/uploads/Tablet (4).jpg', 111, '2022-11-24 00:00:00', 11, 1, NULL, 2),
(15, '2020-11-17 17:49:18', '333', '234234', '/uploads/Tablet (4).jpg', 234, '2022-11-24 00:00:00', 234, 1, NULL, 4),
(16, '2020-11-17 17:49:32', '333', '234234', '/uploads/Tablet (4).jpg', 234, '2022-11-24 00:00:00', 234, 1, NULL, 4),
(17, '2020-11-17 17:50:01', '444444', '222', '/uploads/Tablet (4).jpg', 12, '2022-11-24 00:00:00', 12, 1, NULL, 5),
(18, '2020-11-28 20:27:32', 'tttt', 'ffgh', '/uploads/Tablet (4).jpg', 34, '2022-11-24 00:00:00', 34, 1, NULL, 2),
(19, '2020-11-28 20:29:59', '444', '6767', '/uploads/question.png', 656, '2022-11-24 00:00:00', 656, 1, NULL, 4),
(20, '2020-12-03 22:54:47', 'tttt', 'rrrrr', '/uploads/question.png', 123, '2022-11-24 00:00:00', 123, 10, NULL, 3),
(21, '2020-12-05 18:22:13', '333', 'ttttttt', '/uploads/Desktop (3).jpg', 159, '2022-11-24 00:00:00', 16, 10, NULL, 2),
(22, '2010-05-28 00:00:00', 'Testbidlot', 'Testbid about date', '/uploads/Desktop (3).jpg', 234, '2012-12-29 00:00:00', 234, 10, NULL, 6),
(23, '2020-12-05 21:56:24', '3', 'serwer', '/uploads/IMG_20201130_233911.jpg', 234, '2022-11-24 00:00:00', 234, 10, NULL, 2),
(24, '2020-12-06 23:50:21', 'Lot not winned ', 'tyutyu', '/uploads/IMG_20201130_233911.jpg', 56, '2020-12-29 00:00:00', 56, 10, 10, 4),
(25, '2021-02-13 21:43:33', '23123', '123123', '/uploads/rate1.jpg', 123, '2021-02-19 00:00:00', 123, 9, NULL, 2),
(26, '2021-02-13 21:44:39', '23', '2323', '/uploads/rate4.jpg', 23, '2021-02-17 00:00:00', 23, 9, NULL, 3),
(27, '2021-02-13 22:14:55', 'Maxym Berezynets', 'uuuuuuuuuuuuuuuu', '/uploads/category-1.jpg', 15, '2021-04-17 00:00:00', 16, 9, NULL, 3),
(28, '2021-02-13 23:15:20', 'eeee', 'eee', '/uploads/rate4.jpg', 333, '2021-02-17 00:00:00', 33, 9, NULL, 3),
(29, '2021-02-13 23:19:25', '45', '45', '/uploads/user.jpg', 45, '2021-02-18 00:00:00', 45, 9, NULL, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `date_registration` datetime NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(70) NOT NULL,
  `contacts` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `date_registration`, `email`, `name`, `password`, `contacts`) VALUES
(1, '2020-04-05 00:00:00', 'misha@gmail.com', 'Misha Colinchuk', 'e473aac4a1c5b40019873e5402b538d7', 'город Киев, борисоглебская 100'),
(2, '2020-08-02 00:00:00', 'halustyan@ukr.net', 'Maxym', '8b4cf0258846b23e0a8272bee22c38dd', 'город Чернигов, улица Мира 290'),
(3, '2020-08-09 00:00:00', 'halkamaka@ukr.net', 'masha', 'qwerty', 'Полтава, ленона 300'),
(4, '2020-08-19 00:00:00', 'test@ukr.net', 'yulya', '*49A0F43C1FF6FDDB84A22F846F98A4ACAD959DE9', 'Чернигов, рокосовского, 17'),
(6, '2020-11-27 18:14:05', 'name@ukr.net', '234', '', '234'),
(7, '2020-11-27 18:29:47', 'namenamememememem@ukr.net', '234234', '$2y$10$jSj4wJwaaFkaRAROEaGaQeQDJKTaxDYjOpkzde9l/uK9Ur7spMTvu', '234234234'),
(8, '2020-11-28 00:34:26', 'kontekstexeo@gmail.com', 'Виктор Орлов', '$2y$10$lHRF082pg.prxfJ.vHBO8eg1ayQp8ZnkEJJf3HQmsk9DY8RCAcpeC', 'nsmsmsm'),
(9, '2020-12-03 16:43:02', 'test1@ukr.net', 'test1', '$2y$10$lhWTbT7m4SRgO/y2YbwYHevGz.lxtYiUOUhuU3G3bN0cf/c2VToqi', 'test1'),
(10, '2020-12-03 18:49:51', 'itexpeditionamerica@gmail.com', 'Виктор Орлов', '$2y$10$mNnwXGgbhXfo/bgPRo6xAeXCdzgZ9kBrmU9kBIb4GglTjH.ngI0C2', 'ertertert'),
(11, '2021-02-13 23:54:54', 'nina@ukr.net', 'Nina', '$2y$10$ZC9A8Lu69gcWgoOpfeJK2ud0qDcPLlaNQVwFYrka8IMtA37OAc/SS', 'nina@ukr.net'),
(12, '2021-02-14 14:05:49', 'budya123@ukr.net', 'budya', '$2y$10$Txhsvlu8sF45JHx.u0CaKugnDcP25U6ot.AAOAY/ETvbgnTfCymXO', 'chernigiv region'),
(5, '2023-08-19 00:00:00', 'test@ukr.net', 'Sveta', '8526913Klojush', 'Чернигов, Rокосовского, 200');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bids`
--
ALTER TABLE `bids`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `date` (`date`),
  ADD KEY `summary_of_the_lot` (`summary_of_the_lot`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `name` (`name`);

--
-- Индексы таблицы `lots`
--
ALTER TABLE `lots`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `date_of_creation` (`date_of_creation`),
  ADD KEY `name_of_the_lot` (`name_of_the_lot`);
ALTER TABLE `lots` ADD FULLTEXT KEY `yeticave_search` (`name_of_the_lot`,`deskription`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `date_registration` (`date_registration`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `name` (`name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `lots`
--
ALTER TABLE `lots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
