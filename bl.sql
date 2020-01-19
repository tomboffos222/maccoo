-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Янв 06 2020 г., 10:10
-- Версия сервера: 5.7.26
-- Версия PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `rcore`
--

-- --------------------------------------------------------

--
-- Структура таблицы `black_listeds`
--

CREATE TABLE `black_listeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `zhsn` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `black_listeds`
--

INSERT INTO `black_listeds` (`id`, `zhsn`, `created_at`, `updated_at`) VALUES
(1, '191440012383', '2020-01-06 03:56:50', '2020-01-06 03:56:50'),
(2, '191440012383', '2020-01-06 03:57:34', '2020-01-06 03:57:34'),
(3, '840920300452', '2020-01-06 03:57:46', '2020-01-06 03:57:46'),
(4, '710503400900', '2020-01-06 03:58:39', '2020-01-06 03:58:39'),
(5, '1231313123', '2020-01-06 04:02:37', '2020-01-06 04:02:37');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `black_listeds`
--
ALTER TABLE `black_listeds`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `black_listeds`
--
ALTER TABLE `black_listeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
