-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 27 2018 г., 03:52
-- Версия сервера: 5.6.41
-- Версия PHP: 7.1.22

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
  `title` varchar(255) NOT NULL,
  `id_dictionary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dictionary_list`
--

INSERT INTO `dictionary_list` (`id`, `name`, `title`, `id_dictionary`) VALUES
(1, 'top_40_verbs', '', 1),
(2, 'top_40_adjectives', '', 2),
(3, 'top_45_nouns', '', 3),
(4, 'top_phrasal_verbs', '', 4);

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

-- --------------------------------------------------------

--
-- Структура таблицы `user_answers`
--

CREATE TABLE `user_answers` (
  `user_id` int(11) NOT NULL,
  `word_id` int(11) NOT NULL,
  `dictionary_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `answerd` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `words`
--

CREATE TABLE `words` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `translate` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `words`
--

INSERT INTO `words` (`id`, `name`, `translate`, `type_id`) VALUES
(2, 'word', 'translate', 4),
(3, 'word', 'translate', 1),
(4, 'word', 'translate', 2),
(5, 'word', 'translate', 2),
(6, 'word2', 'tr2', 1),
(7, 'word3', 'tr3', 1),
(8, 'word4', 'tr4', 1),
(9, 'word5', 'tr5', 1),
(10, 'word6', 'tr6', 1),
(11, 'word7', 'tr7', 1),
(12, 'word8', 'tr8', 1),
(13, 'word9', 'tr9', 1),
(14, 'word10', 'tr10', 1),
(15, 'word10', 'tr10', 1),
(16, 'word13', 'tr13', 1),
(17, 'fdsnkl', 'lskjfgd', 1),
(18, 'sdlfkg', 'dsfgnjd', 1);

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
-- Индексы таблицы `words`
--
ALTER TABLE `words`
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

--
-- AUTO_INCREMENT для таблицы `words`
--
ALTER TABLE `words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
