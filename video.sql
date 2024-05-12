-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 12 2024 г., 19:58
-- Версия сервера: 8.0.36-0ubuntu0.20.04.1
-- Версия PHP: 7.4.26

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
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `film_id` int NOT NULL,
  `user_id` int NOT NULL,
  `date` datetime NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `liked` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `film_id`, `user_id`, `date`, `message`, `liked`) VALUES
(3, 1, 29, '2024-04-18 22:21:12', 'asd3', 1),
(4, 1, 29, '2024-04-18 23:08:42', 'ads4', 1),
(5, 1, 27, '2024-04-18 23:08:52', 'asdfghffdsfdf', 1),
(6, 1, 29, '2024-04-24 22:59:11', 'хороший фильм', 1),
(8, 1, 27, '2024-05-03 15:13:55', 'test oo1', 0),
(10, 7, 28, '2024-05-10 09:37:13', 'labs serials', 0),
(11, 1, 29, '2024-05-10 11:13:57', 'хороший посмотрел', 0),
(12, 7, 28, '2024-05-10 11:58:52', 'good', 0),
(13, 7, 28, '2024-05-10 12:01:47', 'test', 0),
(14, 7, 28, '2024-05-10 12:01:55', 'hhhhhhhhhhhhhhhhh', 1),
(15, 7, 28, '2024-05-10 12:01:55', 'hhhhhhhhhhhhhhhhh', 0),
(16, 7, 28, '2024-05-10 12:01:55', 'hhhhhhhhhhhhhhhhh', 1),
(21, 8, 28, '2024-05-10 12:34:52', '4654564654564', 1),
(25, 7, 27, '2024-05-12 11:29:56', 'da', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `comments_user`
--

CREATE TABLE `comments_user` (
  `id` int NOT NULL,
  `comments_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `comments_user`
--

INSERT INTO `comments_user` (`id`, `comments_id`, `user_id`) VALUES
(2, 5, 27),
(3, 3, 27),
(5, 6, 28),
(7, 4, 28),
(12, 14, 27),
(13, 21, 27),
(14, 16, 27);

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
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
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `genre_id` int NOT NULL,
  `year_id` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `source_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `source_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rating` decimal(2,1) NOT NULL DEFAULT '0.0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `name`, `genre_id`, `year_id`, `description`, `photo`, `source_1`, `source_2`, `rating`) VALUES
(1, 'Bēgšana no Šoušenkas', 2, 1, 'Filma ir par baņķieri Endiju Defrēnu, kam piespriesti divi mūža ieslodzījumi par sievas un viņas mīļākā nogalināšanu. Cietumā viņš sadraudzējas ar Elisu Boidu \"Redu\" Redingu, Defrēns jūtas drošībā pēc tam, kad viņa zināšanas finanšu nozarē izmanto cietuma darbinieki un ieslodzītie', 'https://m.media-amazon.com/images/I/61-vQDr7ecL._AC_UF894,1000_QL80_.jpg', 'https://viedtelevizija.lv/skaties/begsana-no-sousenkas', 'https://go3.lv/movies/the-shawshank-redemption,vod-6488436', '3.5'),
(7, 'Pēdējais no mums', 2, 3, '20 gadus pēc tam, kad modernā civilizācija ir iznīcināta, Džoels tiek nolīgts, lai aizvestu Eliju no karantīnas zonas. Šķietami vieglais darbs kļūst par brutālu ceļojumu pāri ASV, paļaujoties vienam uz otru, lai izdzīvotu.', 'https://straume.mstatic.lv/mlmt/images/video/hbo/9393/hbo_season_poster_1673837110.jpg', 'https://viedtelevizija.lv/skaties/lv-hbo-series-120814', 'https://go3.lv/series/pedejais-no-mums,serial-5404556', '4.0'),
(8, 'Pāršķirts: Attiecības digitālajā laikmetā', 5, 4, 'Atklāts skatījums uz pārmaiņām seksā un attiecībās digitālajā laikmetā, ko sniedz intervijas ar ASV jauniešiem, ekspertiem un iepazīšanās aplikāciju radītājiem.', 'https://straume.mstatic.lv/mlmt/images/video/hbo/1031939/hbo_poster_1536666738.jpg', 'https://viedtelevizija.lv/skaties/lv-hbo-swiped-hooking-up-in-the-digital-age', 'https://go3.lv/movies/parskirts-attiecibas-digitalaja-laikmeta,vod-6070874', '0.0'),
(12, 'Tenet', 6, 5, 'Bruņojies ar vienu vārdu – Tenet –, filmas galvenais varonis dodas cīņā, lai novērstu Trešo pasaules karu. Viņa misija ved cauri krēslainajiem starptautiskās spiegošanas koridoriem, un atklājas, ka tā pārkāpj esošā laika rāmjus. Tā nav ceļošana laikā. Tā ir inversija.\r\n\r\n', 'https://vtv-public.mstatic.lv/images/FILMAS_SERI%C4%80LI/Filmas/500x707/Tenet-5.jpg', 'https://viedtelevizija.lv/skaties/tenet', '', '0.0');

-- --------------------------------------------------------

--
-- Структура таблицы `items_rating`
--

CREATE TABLE `items_rating` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `items_id` int NOT NULL,
  `stars` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `items_rating`
--

INSERT INTO `items_rating` (`id`, `user_id`, `items_id`, `stars`) VALUES
(1, 27, 1, 3),
(3, 28, 1, 4),
(4, 28, 7, 5),
(5, 27, 7, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'User'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(27, 'kavo', '123@gmail.com', 'asdfg', 2),
(28, 'Janis', 'test@abc', '123456', 1),
(29, 'Ivans', '123@gmail.com', '1234', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `years`
--

CREATE TABLE `years` (
  `id` int NOT NULL,
  `name` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `years`
--

INSERT INTO `years` (`id`, `name`) VALUES
(1, '1994'),
(2, '2011'),
(3, '2023'),
(4, '2018'),
(5, '2020'),
(6, '2017');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `film_id` (`film_id`);

--
-- Индексы таблицы `comments_user`
--
ALTER TABLE `comments_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_id` (`comments_id`);

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
-- Индексы таблицы `items_rating`
--
ALTER TABLE `items_rating`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `comments_user`
--
ALTER TABLE `comments_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `items_rating`
--
ALTER TABLE `items_rating`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `years`
--
ALTER TABLE `years`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `film_id` FOREIGN KEY (`film_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `comments_user`
--
ALTER TABLE `comments_user`
  ADD CONSTRAINT `comments_user_ibfk_1` FOREIGN KEY (`comments_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

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
