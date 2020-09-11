INSERT INTO `categories` (`name`, `symbol_code`) VALUES ('Доски и лыжи', 'doski_i_lishi'), ('Крепления', 'kreplenia');
INSERT INTO `categories` (`name`, `symbol_code`) VALUES ('Ботинки', 'botinki'), ('Одежда', 'odeshda');
INSERT INTO `categories`(`name`, `symbol_code`) VALUES ('Инструменты','Разное');
INSERT INTO `users` (`date_registration`, `email`, `name`, `password`, `contacts`) VALUES ('2020-04-05 00:00:00', 'misha@gmail.com', 'Misha Colinchuk', '123456789', 'город Киев, борисоглебская 100);
INSERT INTO `users` (`date_registration`, `email`, `name`, `password`, `contacts`) VALUES ('2020-08-02 00:00:00', 'halustyan@ukr.net', 'Maxym', '123456789', 'город Чернигов, улица Мира 290');
INSERT INTO `users` (`date_registration`, `email`, `name`, `password`, `contacts`) VALUES ('2020-08-09 00:00:00', 'halkamaka@ukr.net', 'masha', 'qwerty', 'Полтава, ленона 300');
INSERT INTO `lots` (`date_of_creation`, `name_of_the_lot`, `deskription`, `img`, `start_price`, `finish_date`, `step_of_the_bid`, `authorid`, `winnerid`, `categoryid`) VALUES ('2020-08-01 00:00:00', '2014 Rossignol District Snowboard', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.\r\n\r\n', 'lot-1.jpg', '10999', '2020-07-12', '5', '159', '144', '10'), ('2020-08-24 00:00:00', 'DC Ply Mens 2016/2017 Snowboard', 'Low in price but not in performance, the DC Ply has long been a favourite for riders on a budget. Male riders should seek out the slightly tweaked men’s version, but this one’s for the ladies.', 'img/lot-2.jpg', '159999', '2021-11-22', '5', '159', '1544', '10');
INSERT INTO `lots` (`date_of_creation`, `name_of_the_lot`, `deskription`, `img`, `start_price`, `finish_date`, `step_of_the_bid`, `authorid`, `winnerid`, `categoryid`) VALUES ('2020-07-02 00:00:00', 'Крепления Union Contact Pro 2015 года размер L/XL', 'Невероятно легкие универсальные крепления весом всего 720 грамм готовы порадовать прогрессирующих райдеров, практикующих как трассовое катание, так и взрывные спуски в паудере. Легкая нейлоновая база в сочетании с очень прочным хилкапом, выполненным из экструдированного алюминия, выдержит серьезные нагрузки, а бакли, выполненные из магния не только заметно снижают вес, но и имеют плавный механизм. Система стрепов 3D Connect обеспечивает равномерное давление на верхнюю часть ноги, что несомненно добавляет комфорта как во время выполнения трюков, так и во время катания в глубоком снегу.\r\n', 'lot-3.jpg', '8000', '2021-11-23', '45', '45', '890', '34444'), ('2020-07-21 00:05:20', 'Ботинки для сноуборда DC Mutiny Charocal', 'Эти ботинки созданы для фристайла и для того, чтобы на любом споте Вы чувствовали себя как дома в уютных тапочках, в которых Вы будете также прекрасно чувствовать свою доску, как ворсинки на любимом коврике около дивана. Каучуковая стелька Impact S погасит нежелательные вибрации и смягчит приземления, внутренник White Liner с запоминающим форму ноги наполением и фиксирующим верхним стрепом добавит эргономики в посадке, а традиционная шнуровка с блокирующими верхними крючками поможет идеально подогнать ботинок по ноге, тонко фиксируя натяжение шнурков.\r\n', 'lot-4.jpg', '10999', '2021-11-24', '34', '123', '465456', '345345345'), ('2020-07-03 10:05:25', 'Куртка для сноуборда DC Mutiny Charocal', 'высокотехнологичная мужская куртка с вентиляцией для горнолыжного спорта. Полностью проклеенные швы, влагозащитные молнии и мембрана с высокими показателями вoдoнeпpoницaeмoсти и дышимости надёжно защищают от холодного ветра и снега. Вентиляция под рукавами позволяет создавать комфортную терморегуляцию в солнечную погоду. Эластичные свойства мембраны обеспечивают свободу движения во время спусков на любой скорости. Артикуляционный крой рукавов гарантирует комфорт за счёт предварительного изгиба области локтей. Благодаря утеплителю и анатомическому крою в куртке будет комфортно и удобно. Снегозащитная юбка и эластичные внутренние манжеты с отверстиями под большие пальцы обеспечивают дополнительную изоляцию от холода.\r\n', 'lot-5.jpg', '7500', '2021-11-25', '12', '343446', '234234', '234234234'), ('2020-07-01 23:55:29', 'Маска Oakley Canopy', 'Маска г/л Oakley CANOPY MATTE BLACK PRIZM TORCH IRIDIUM\r\n \r\n\r\nУниверсальная горнолыжная маска подойдет мужчинам и девушкам. В данной модели использована оптика высокой четкости - HDO. Технология Prizm обеспечивает четкость передачи цвета, точный контраст, позволяет видеть все неровности на поверхности. Предусмотрена 100% защита от ультрафиолетового излучения. Линзы - Prizm Torch Iridium, подходят для катания в солнечную погоду. За антизапотевание отвечает технология F3 Аnti-fog и линзы Dual-Vented Lens. Оправа очень гибкая, прочная, выполнена из запатентованного материала O-Matter на основе нейлона и карбоновых волокон. Вспененный тройной слой микрофлиса равномерно балансирует давление маски на кожу и отводит влагу. Ремешок выполнен из силикона, регулируемый, не соскальзывает. Маска совместима со всеми видами шлемов.  \r\nПодробнее: https://estafeta.com.ua/p490781-maski_g-l_oakley_canopy_matte_black_prizm_torch_iridium', 'lot-6.jpg', '5400', '2021-12-20', '23', '123123', '1231233453', '678678678');
SELECT name FROM categories
SELECT lots.id, name_of_the_lot, start_price, img, finish_date, categories.id, category.name, FROM lots JOIN categories ON lots.id = categories.id JOIN bids ON bids.id = lots.id;
SELECT summary_of_the_lot FROM `bids` ORDER by lotid ASC
INSERT INTO `bids` (`id`, `date`, `summary_of_the_lot`, `userid`, `lotid`) VALUES ('12', '2020-09-19 00:00:00.000000', '1230000', '8888', '123578'), ('22', '2020-09-16 00:00:00.000000', '15935222', '15', '269')
UPDATE lots SET name_of_the_lot= "Botinki" WHERE id=1;
Select * from bids WHERE id = 3 order BY date ASC;
select bids.lotid, lots.categoryid from lots join bids on lots.id = bids.id where lots.id =3

select lots.id, categories.name from lots JOIN categories ON lots.categoryid = categories.id where lots.id =1
SELECT * FROM bids where lotid = 1 ORDER BY date ASC
Select lots.name_of_the_lot, lots.start_price, bids.summary_of_the_lot, lots.img, categories.name from lots JOIN bids ON lots.id = bids.lotid JOIN categories ON lots.id = categories.id;
