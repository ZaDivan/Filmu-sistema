-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 17 2023 г., 13:29
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `video`
--

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Detektīvs'),
(2, 'Drāma'),
(5, 'Dokumentāla'),
(6, 'Trilleris');

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `photo` text NOT NULL,
  `source_1` text NOT NULL,
  `source_2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `name`, `genre_id`, `year_id`, `description`, `photo`, `source_1`, `source_2`) VALUES
(1, 'Bēgšana no Šoušenkas', 2, 1, 'Filma ir par baņķieri Endiju Defrēnu, kam piespriesti divi mūža ieslodzījumi par sievas un viņas mīļākā nogalināšanu. Cietumā viņš sadraudzējas ar Elisu Boidu \"Redu\" Redingu, Defrēns jūtas drošībā pēc tam, kad viņa zināšanas finanšu nozarē izmanto cietuma darbinieki un ieslodzītie', 'https://m.media-amazon.com/images/I/61-vQDr7ecL._AC_UF894,1000_QL80_.jpg', 'https://viedtelevizija.lv/skaties/begsana-no-sousenkas', 'https://go3.lv/movies/the-shawshank-redemption,vod-6488436'),
(2, 'Meitene ar pūķa tetovējumu', 1, 2, 'Filma stāsta par meiteni, kas pazudusi pirms 40 gadiem un kuras liktenis nedod mieru kādam vīram. Pēdējā mēģinājumā atklāt meitenes pazušanas noslēpumu viņš noalgo žurnālistu, kas spējis atrisināt vissarežģītāko noziegumu detaļas.', 'https://www.film.ru/sites/default/files/movies/posters/1629398-812342.jpg', 'https://www.primevideo.com/dp/amzn1.dv.gti.aa4904ab-aa12-424f-bb4d-043c2cbc97f2?autoplay=0&ref_=atv_cf_strg_wb', 'https://play.google.com/store/movies/details?id=blyLV366xGg'),
(7, 'Pēdējais no mums', 2, 3, '20 gadus pēc tam, kad modernā civilizācija ir iznīcināta, Džoels tiek nolīgts, lai aizvestu Eliju no karantīnas zonas. Šķietami vieglais darbs kļūst par brutālu ceļojumu pāri ASV, paļaujoties vienam uz otru, lai izdzīvotu.', 'https://straume.mstatic.lv/mlmt/images/video/hbo/9393/hbo_season_poster_1673837110.jpg', 'https://viedtelevizija.lv/skaties/lv-hbo-series-120814', 'https://go3.lv/series/pedejais-no-mums,serial-5404556'),
(8, 'Pāršķirts: Attiecības digitālajā laikmetā', 5, 4, 'Atklāts skatījums uz pārmaiņām seksā un attiecībās digitālajā laikmetā, ko sniedz intervijas ar ASV jauniešiem, ekspertiem un iepazīšanās aplikāciju radītājiem.', 'https://straume.mstatic.lv/mlmt/images/video/hbo/1031939/hbo_poster_1536666738.jpg', 'https://viedtelevizija.lv/skaties/lv-hbo-swiped-hooking-up-in-the-digital-age', 'https://go3.lv/movies/parskirts-attiecibas-digitalaja-laikmeta,vod-6070874'),
(9, 'Tenet', 6, 5, 'Bruņojies ar vienu vārdu – Tenet –, filmas galvenais varonis dodas cīņā, lai novērstu Trešo pasaules karu. Viņa misija ved cauri krēslainajiem starptautiskās spiegošanas koridoriem, un atklājas, ka tā pārkāpj esošā laika rāmjus. Tā nav ceļošana laikā. Tā ir inversija.', 'https://vtv-public.mstatic.lv/images/FILMAS_SERI%C4%80LI/Filmas/500x707/Tenet-5.jpg', 'https://viedtelevizija.lv/skaties/tenet', 'https://tet.plus/media/1608543623188');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(0, 'Admin'),
(1, 'User');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(27, 'kavo', '123@gmail.com', 'asd', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `years`
--

CREATE TABLE `years` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `years`
--

INSERT INTO `years` (`id`, `name`) VALUES
(1, '1994'),
(2, '2011'),
(3, '2023'),
(4, '2018'),
(5, '2020');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `year_id` (`year_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- Индексы таблицы `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `years`
--
ALTER TABLE `years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `genre_id` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`),
  ADD CONSTRAINT `year_id` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `role` FOREIGN KEY (`role`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
