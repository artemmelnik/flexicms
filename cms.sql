-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 14 2017 г., 07:37
-- Версия сервера: 5.7.13
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `name`) VALUES
(1, 'header menu'),
(2, 'footer menu'),
(3, 'weewew');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_item`
--

CREATE TABLE IF NOT EXISTS `menu_item` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `parent` tinyint(1) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '999',
  `link` varchar(255) NOT NULL DEFAULT '#'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu_item`
--

INSERT INTO `menu_item` (`id`, `menu_id`, `name`, `parent`, `position`, `link`) VALUES
(1, 0, 'Home', 0, 0, '#'),
(2, 0, 'About', 0, 0, '#'),
(3, 0, 'Sample post', 0, 0, '#'),
(4, 0, 'Contact', 0, 0, '#'),
(6, 2, '23232323', 0, 2, '#'),
(8, 2, 'New item', 0, 0, '#'),
(9, 1, 'New item', 0, 999, '#'),
(10, 1, 'New item', 0, 999, '#'),
(11, 2, 'New item', 0, 3, '#'),
(12, 2, 'New item', 0, 1, '#');

-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `title`, `content`, `date`) VALUES
(1, 'Hello world 444', '<p>​hello im cms dfdfdfdf</p>', '2017-07-10 10:28:18'),
(2, 'Test page 222', '<p>​shdjksdsdsd</p><p>sdsdsdsds</p><ul><li>​sdsds</li><li>sdsdsd</li><li>dsdsd</li></ul><p>​<strong data-verified="redactor" data-redactor-tag="strong">​dfdfdfdfdfdfdfd</strong></p>', '2017-07-10 10:29:13'),
(3, 'fddfdf', '<p>​dfdfdfdf</p>', '2017-07-15 17:25:25'),
(4, 'Hello cat 55555', '<p>​sdsdsdsdsdd</p>', '2017-07-15 17:25:43'),
(5, '263562723 6577676', '<p>sdsdsdsd\r\n</p>', '2017-07-15 17:26:01');

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `date`) VALUES
(6, 'xcccxc', '<p>​xcxcxcxc</p>', '2017-07-21 16:15:32'),
(7, 'впавоава 222', '<p>​</p>', '2017-07-21 16:35:47');

-- --------------------------------------------------------

--
-- Структура таблицы `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `key_field` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `setting`
--

INSERT INTO `setting` (`id`, `name`, `key_field`, `value`) VALUES
(1, 'Name site', 'name_site', 'Cms 2222'),
(2, 'Description', 'description', 'Example description Cms'),
(3, 'Admin email', 'admin_email', 'admin@admin.com'),
(4, 'Language', 'language', 'english');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` enum('admin','moderator','user','') NOT NULL,
  `hash` varchar(32) NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `role`, `hash`, `date_reg`) VALUES
(1, 'admin@admin.com', 'b59c67bf196a4758191e42f76670ceba', 'admin', '478004ba245d2b40d3636332229f475c', '2017-06-18 17:20:59'),
(2, 'test@admin.com', '45c48cce2e2d7fbdea1afc51c7c6ad26', 'user', 'new', '2017-07-01 19:44:51'),
(3, 'test@admin.com', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 'user', 'new', '2017-07-04 20:45:16'),
(4, 'test@admin.com', '8f14e45fceea167a5a36dedd4bea2543', 'user', 'new', '2017-07-04 20:45:26');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu_item`
--
ALTER TABLE `menu_item`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `key` (`key_field`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `menu_item`
--
ALTER TABLE `menu_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
