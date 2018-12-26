-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 26 2018 г., 22:48
-- Версия сервера: 10.1.37-MariaDB
-- Версия PHP: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `d_wolf`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dictionary_list`
--

CREATE TABLE `dictionary_list` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_dictionary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dictionary_list`
--

INSERT INTO `dictionary_list` (`id`, `name`, `id_dictionary`) VALUES
(1, 'top_40_verbs', 1),
(2, 'top_40_adjectives', 2),
(3, 'top_45_nouns', 3),
(4, 'top_phrasal_verbs', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dictionary_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `password`, `email`, `dictionary_id`) VALUES
(1, 'admin', 'admin', '$2y$10$YoxRa5eSk.1jQY/sU5JikuyR3tKUOrpFjgVWhG1EzADn5wRyTtSFO', 'd@admin.ru', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `dictionary_list`
--
ALTER TABLE `dictionary_list`
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
-- AUTO_INCREMENT для таблицы `dictionary_list`
--
ALTER TABLE `dictionary_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
