-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 29 2022 г., 00:37
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `phone_catalog`
--

--
-- Дамп данных таблицы `history_calls`
--

INSERT INTO `history_calls` (`id`, `id_from_user`, `id_to_user`, `id_from_phone`, `id_to_phone`, `start_call`, `finish_call`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, 2, 1661468521, 1661468522, 0.00, '2022-08-25 18:15:01', '2022-08-25 18:15:01'),
(2, 1, 3, 1, 2, 1661468521, 1661468522, 0.00, '2022-08-25 18:19:26', '2022-08-25 18:19:26'),
(3, 1, 3, 1, 2, 1661468521, 1661468522, 0.00, '2022-08-25 18:39:50', '2022-08-25 18:39:50'),
(4, 1, 3, 1, 2, 1661468521, 1661468522, 0.00, '2022-08-25 18:40:50', '2022-08-25 18:40:50'),
(5, 1, 3, 1, 2, 1661468521, 1661468522, 0.00, '2022-08-25 18:41:35', '2022-08-25 18:41:35'),
(6, 1, 3, 1, 2, 1661468521, 1661468522, 0.00, '2022-08-25 18:43:13', '2022-08-25 18:43:13'),
(7, 1, 3, 1, 9, 1661468521, 1661468523, 1.30, '2022-08-25 18:53:26', '2022-08-25 18:53:26'),
(8, 1, 3, 1, 9, 1661468521, 1661468523, 1.30, '2022-08-25 18:59:27', '2022-08-25 18:59:27'),
(9, 3, 1, 9, 1, 1661468521, 1661468523, 3.50, '2022-08-25 20:26:30', '2022-08-25 20:26:30'),
(10, 1, 4, 1, 3, 1661457721, 1661468521, 0.00, '2022-08-26 02:19:32', '2022-08-26 02:19:32'),
(11, 1, 4, 1, 3, 1661457721, 1661468521, 0.00, '2022-08-26 02:20:22', '2022-08-26 02:20:22'),
(12, 1, 4, 1, 3, 1661468522, 1661468530, 0.00, '2022-08-27 13:36:30', '2022-08-27 13:36:30'),
(13, 3, 4, 9, 3, 1661468522, 1661468525, 3.50, '2022-08-28 01:49:31', '2022-08-28 01:49:31'),
(14, 3, 4, 9, 3, 1661468523, 1661468526, 3.50, '2022-08-28 01:50:50', '2022-08-28 01:50:50'),
(15, 3, 4, 9, 3, 1661468521, 1661468522, 3.50, '2022-08-28 01:54:37', '2022-08-28 01:54:37'),
(16, 1, 3, 2, 9, 1661468521, 1661468522, 1.30, '2022-08-28 02:00:48', '2022-08-28 02:00:48'),
(17, 3, 6, 9, 1, 1661468521, 1661468522, 3.50, '2022-08-28 14:18:43', '2022-08-28 14:18:43'),
(18, 3, 1, 9, 2, 1661468521, 1661468522, 3.50, '2022-08-28 14:45:48', '2022-08-28 14:45:48'),
(19, 3, 4, 9, 3, 1661468521, 1661468581, 3.50, '2022-08-28 14:51:35', '2022-08-28 14:51:35'),
(20, 3, 1, 9, 2, 1661468521, 1661468581, 3.50, '2022-08-28 14:53:58', '2022-08-28 14:53:58'),
(21, 3, 4, 9, 3, 1661468521, 1661468522, 3.50, '2022-08-28 14:56:50', '2022-08-28 14:56:50'),
(22, 3, 4, 9, 3, 1661468521, 1661468522, 3.50, '2022-08-28 14:57:16', '2022-08-28 14:57:16'),
(23, 3, 4, 9, 3, 1661468521, 1661468522, 3.50, '2022-08-28 14:57:36', '2022-08-28 14:57:36'),
(24, 3, 4, 9, 3, 1661468521, 1661468522, 3.50, '2022-08-28 14:58:38', '2022-08-28 14:58:38'),
(25, 3, 4, 9, 3, 1661468521, 1661468522, 3.50, '2022-08-28 14:58:59', '2022-08-28 14:58:59'),
(26, 3, 4, 9, 3, 1661468521, 1661468522, 3.50, '2022-08-28 14:59:25', '2022-08-28 14:59:25'),
(27, 4, 3, 3, 9, 1661468521, 1661468522, 1.30, '2022-08-28 15:00:40', '2022-08-28 15:00:40');

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2022_08_23_175937_create_operators_table', 1),
(2, '2022_08_23_182429_create_users_table', 1),
(3, '2022_08_23_182703_create_phone_numbers_table', 1),
(4, '2022_08_23_182910_create_history_calls_table', 1),
(5, '2022_08_23_184010_create_price_operators_table', 1),
(6, '2022_08_23_210436_add_foreign_id_phone_number_to_users_table', 1),
(7, '2022_08_27_202140_add_unique_index_operators_to_price_operators_table', 2);

--
-- Дамп данных таблицы `operators`
--

INSERT INTO `operators` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'MTS', '2022-08-24 19:35:16', '2022-08-24 19:35:16'),
(2, 'НЕ MTS', '2022-08-24 19:41:36', '2022-08-24 19:41:36'),
(3, 'ТОЧНО MTS', '2022-08-24 19:41:39', '2022-08-24 19:41:39'),
(4, 'ывфывф', '2022-08-27 14:23:50', '2022-08-27 14:23:50'),
(5, 'dsdsads', '2022-08-28 16:08:42', '2022-08-28 16:08:42'),
(6, '213321', '2022-08-28 16:08:53', '2022-08-28 16:08:53'),
(7, 'выфвыфвыф', '2022-08-28 16:10:31', '2022-08-28 16:10:31'),
(8, 'dsadsa', '2022-08-28 17:31:04', '2022-08-28 17:31:04');

--
-- Дамп данных таблицы `phone_numbers`
--

INSERT INTO `phone_numbers` (`id`, `id_operator`, `number_phone`, `created_at`, `updated_at`) VALUES
(1, 1, '89049227253', '2022-08-24 19:35:25', '2022-08-24 19:35:25'),
(2, 1, '89049227256', '2022-08-24 19:41:15', '2022-08-24 19:41:15'),
(3, 1, '89049227251', '2022-08-24 19:41:21', '2022-08-24 19:41:21'),
(4, 1, '89049227258', '2022-08-24 19:41:27', '2022-08-24 19:41:27'),
(5, 2, '89059227256', '2022-08-24 19:41:48', '2022-08-24 19:41:48'),
(6, 2, '89059227253', '2022-08-24 19:41:54', '2022-08-24 19:41:54'),
(7, 2, '89059227252', '2022-08-24 19:41:59', '2022-08-24 19:41:59'),
(8, 3, '89009227257', '2022-08-24 19:42:18', '2022-08-24 19:42:18'),
(9, 3, '89009227256', '2022-08-24 19:42:23', '2022-08-24 19:42:23'),
(10, 3, '89009227252', '2022-08-24 19:42:27', '2022-08-24 19:42:27'),
(12, 1, '89049227252', '2022-08-27 12:21:36', '2022-08-27 12:21:36'),
(13, 1, '89049227233', '2022-08-27 12:21:50', '2022-08-27 12:21:50'),
(15, 1, '89049227254', '2022-08-27 12:22:50', '2022-08-27 12:22:50'),
(16, 1, '89049227283', '2022-08-27 12:24:42', '2022-08-27 12:24:42'),
(19, 1, '88049227252', '2022-08-28 16:36:13', '2022-08-28 16:36:13'),
(20, 1, '89069227253', '2022-08-28 16:41:05', '2022-08-28 16:41:05'),
(21, 1, '89099227253', '2022-08-28 16:44:05', '2022-08-28 16:44:05');

--
-- Дамп данных таблицы `price_operators`
--

INSERT INTO `price_operators` (`id`, `id_from_operator`, `id_to_operator`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2.00, '2022-08-24 19:42:40', '2022-08-24 19:42:40'),
(2, 1, 3, 1.30, '2022-08-24 19:42:45', '2022-08-24 19:42:45'),
(3, 2, 1, 1.50, '2022-08-24 19:42:55', '2022-08-24 19:42:55'),
(4, 2, 3, 1.60, '2022-08-24 19:43:02', '2022-08-24 19:43:02'),
(5, 3, 1, 3.50, '2022-08-24 19:43:15', '2022-08-24 19:43:15'),
(6, 3, 2, 3.60, '2022-08-24 19:43:19', '2022-08-24 19:43:19'),
(7, 1, 4, 12.00, '2022-08-27 14:38:42', '2022-08-27 14:38:42');

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `patronymic`, `created_at`, `updated_at`, `id_phone_number`) VALUES
(1, 'Имя', 'Фамиля', 'Отчество', '2022-08-24 19:57:50', '2022-08-24 19:57:50', 8),
(3, 'Имя_2', 'Фамиля_2', 'Отчество_2', '2022-08-24 20:08:19', '2022-08-24 20:08:19', 9),
(4, 'Имя_3', 'Фамиля_3', 'Отчество_3', '2022-08-24 20:08:45', '2022-08-24 20:08:45', 3),
(6, 'sadas', 'saddsa', 'asdasd', '2022-08-27 16:38:32', '2022-08-27 16:38:32', 1),
(9, 'asdasd', 'sadsad', 'dsasad', '2022-08-28 01:52:29', '2022-08-28 01:52:29', 7),
(18, 'saddsa1', 'sadsda1', 'sadsad1', '2022-08-28 15:52:17', '2022-08-28 15:52:17', 5),
(20, 'saasddsadsa11', 'saasddsadsa11', 'saasddsadsa11', '2022-08-28 15:53:28', '2022-08-28 15:53:28', 4),
(24, 'sdasdadsa1', 'sdasdadsa1', 'sdasdadsa1', '2022-08-28 15:54:18', '2022-08-28 15:54:18', 13),
(28, 'dsadsadsa12', 'dsadsadsa12', 'dsadsadsa12', '2022-08-28 15:55:07', '2022-08-28 15:55:07', 16);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
