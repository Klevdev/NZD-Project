-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 29, 2021 at 01:38 PM
-- Server version: 10.3.22-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nzd`
--

-- --------------------------------------------------------

--
-- Table structure for table `carriages`
--

CREATE TABLE `carriages` (
  `id` int(11) NOT NULL,
  `id_carriage_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carriages`
--

INSERT INTO `carriages` (`id`, `id_carriage_type`) VALUES
(60, 1),
(71, 1),
(72, 1),
(73, 1),
(80, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(107, 1),
(61, 2),
(62, 2),
(74, 2),
(75, 2),
(76, 2),
(81, 2),
(88, 2),
(89, 2),
(90, 2),
(91, 2),
(92, 2),
(104, 2),
(108, 2),
(109, 2),
(63, 3),
(64, 3),
(65, 3),
(77, 3),
(78, 3),
(93, 3),
(94, 3),
(95, 3),
(96, 3),
(97, 3),
(98, 3),
(105, 3),
(110, 3),
(111, 3),
(112, 3),
(66, 4),
(67, 4),
(68, 4),
(69, 4),
(79, 4),
(82, 4),
(99, 4),
(100, 4),
(101, 4),
(102, 4),
(113, 4);

-- --------------------------------------------------------

--
-- Table structure for table `carriage_types`
--

CREATE TABLE `carriage_types` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `seats_count` int(3) NOT NULL,
  `seat_cost` int(5) NOT NULL,
  `beds` tinyint(1) NOT NULL DEFAULT 0,
  `wifi` tinyint(1) NOT NULL DEFAULT 0,
  `conditioner` tinyint(1) NOT NULL DEFAULT 0,
  `smoking` tinyint(1) NOT NULL DEFAULT 0,
  `disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carriage_types`
--

INSERT INTO `carriage_types` (`id`, `name`, `seats_count`, `seat_cost`, `beds`, `wifi`, `conditioner`, `smoking`, `disabled`) VALUES
(1, 'Сидячий', 60, 100, 0, 0, 0, 0, 0),
(2, 'Плацкартный', 50, 150, 1, 0, 1, 1, 0),
(3, 'Купе', 30, 200, 1, 1, 1, 1, 1),
(4, 'Комфорт', 30, 300, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `req_callback` tinyint(1) NOT NULL DEFAULT 0,
  `state` tinyint(4) NOT NULL,
  `text` text NOT NULL,
  `callback_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `phone`, `email`, `req_callback`, `state`, `text`, `callback_time`) VALUES
(1, 'Тестер', '88005553535', 'testing@tests.test', 1, 0, '', NULL),
(2, 'Тестер', '88005553535', 'testing@tests.test', 1, 1, 'Тестовый текст', NULL),
(4, 'Александр', '88005553535', 'a.klev.dev@gmail.com', 1, 0, 'Купил мужик шляпу, а она ему как раз', NULL),
(5, 'Владимир', '83584469847', 'volodya337@mail.ru', 1, 2, 'а у вас сайт поломанный', '14:34:00'),
(6, 'Людмила', '89118135363', 'gorfodolsage@gmail.com', 1, 0, 'Never gonna give you up\nNever gonna let you down\nNever gonna turn around\nAnd desert you\nNever gonna make you cry\nNever gonna say goodbye\nNever gonna lie\nAnd hurt you', '09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `message_states`
--

CREATE TABLE `message_states` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message_states`
--

INSERT INTO `message_states` (`id`, `name`) VALUES
(0, 'Новая'),
(1, 'Просмотрена'),
(2, 'Перезвонили');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_trip` int(11) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `patronimyc` varchar(30) DEFAULT NULL,
  `order_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders_and_seats`
--

CREATE TABLE `orders_and_seats` (
  `id_order` int(11) NOT NULL,
  `id_carriage` int(11) NOT NULL,
  `seat_num` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `name`, `is_active`) VALUES
(1, 'Санкт-Петербург - Уфа', 1),
(2, 'Санкт-Петербург - Москва', 1),
(3, 'Уфа - Екатеринбург', 1),
(4, 'Псков - Калининград', 1);

-- --------------------------------------------------------

--
-- Table structure for table `routes_and_stations`
--

CREATE TABLE `routes_and_stations` (
  `id_route` int(11) NOT NULL,
  `id_station` int(11) NOT NULL,
  `stop_duration` int(4) NOT NULL,
  `stop_index` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routes_and_stations`
--

INSERT INTO `routes_and_stations` (`id_route`, `id_station`, `stop_duration`, `stop_index`) VALUES
(1, 1, 0, 1),
(1, 3, 10, 2),
(1, 4, 15, 3),
(1, 5, 15, 4),
(1, 6, 0, 5),
(2, 1, 0, 1),
(2, 7, 20, 2),
(2, 8, 10, 3),
(2, 9, 0, 4),
(3, 6, 0, 1),
(3, 13, 15, 2),
(3, 14, 0, 3),
(4, 2, 0, 1),
(4, 15, 20, 2),
(4, 16, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `id_carriage_type` int(11) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `city` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`id`, `name`, `city`) VALUES
(1, 'Московский вокзал', 'Санкт-Петербург'),
(2, 'Финляндский вокзал', 'Санкт-Петербург'),
(3, 'Ярославль', NULL),
(4, 'Нижний Новгород', NULL),
(5, 'Казань', NULL),
(6, 'Уфа', NULL),
(7, 'Великий Новгород', NULL),
(8, 'Тверь', NULL),
(9, 'Ленинградский вокзал', 'Москва'),
(10, '2 вокзал', 'Москва'),
(11, '3 вокзал', 'Москва'),
(12, '4 вокзал', 'Москва'),
(13, 'Пермь', NULL),
(14, 'Екатеринбург', NULL),
(15, 'Псков', NULL),
(16, 'Калининград', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `station_joins`
--

CREATE TABLE `station_joins` (
  `id_station_start` int(11) NOT NULL,
  `id_station_end` int(11) NOT NULL,
  `distance` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `station_joins`
--

INSERT INTO `station_joins` (`id_station_start`, `id_station_end`, `distance`) VALUES
(1, 3, 500),
(1, 7, 200),
(2, 15, 300),
(3, 4, 100),
(4, 5, 150),
(5, 6, 150),
(6, 13, 100),
(7, 8, 180),
(8, 9, 150),
(13, 14, 100),
(15, 16, 300);

-- --------------------------------------------------------

--
-- Table structure for table `trains`
--

CREATE TABLE `trains` (
  `id` int(11) NOT NULL,
  `id_train_type` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trains`
--

INSERT INTO `trains` (`id`, `id_train_type`, `is_active`) VALUES
(4, 1, 1),
(6, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trains_and_carriages`
--

CREATE TABLE `trains_and_carriages` (
  `id_train` int(11) NOT NULL,
  `id_carriage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trains_and_carriages`
--

INSERT INTO `trains_and_carriages` (`id_train`, `id_carriage`) VALUES
(4, 60),
(4, 61),
(4, 62),
(4, 63),
(4, 64),
(4, 65),
(4, 66),
(4, 67),
(4, 68),
(4, 69),
(6, 80),
(6, 81),
(6, 82);

-- --------------------------------------------------------

--
-- Table structure for table `train_comments`
--

CREATE TABLE `train_comments` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_train` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `train_types`
--

CREATE TABLE `train_types` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `speed` int(4) NOT NULL,
  `cost_per_km` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `train_types`
--

INSERT INTO `train_types` (`id`, `name`, `speed`, `cost_per_km`) VALUES
(1, 'Ибрагим', 140, 1),
(2, 'Жан', 160, 2),
(3, 'Николя', 200, 2),
(4, 'Навуходоносор', 180, 2);

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` int(11) NOT NULL,
  `id_route` int(11) NOT NULL,
  `id_train` int(11) NOT NULL,
  `start_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `id_route`, `id_train`, `start_time`) VALUES
(1, 2, 4, '2021-05-13 14:00:00'),
(2, 1, 4, '2021-06-01 16:20:00'),
(3, 4, 4, '2021-06-01 13:27:00'),
(4, 3, 6, '2021-05-31 03:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `password` varchar(60) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `patronimyc` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `password`, `email`, `phone`, `name`, `surname`, `patronimyc`) VALUES
(1, 1, '4d99a8c805aedb57890b8c76e7aab262', 'test@test.test', '88005553535', 'Test', 'Test', NULL),
(2, 1, 'b4dc94ff9d05b029b08327bfbfc80239', '', '', '', '', NULL),
(3, 1, 'b4dc94ff9d05b029b08327bfbfc80239', '', '', '', '', NULL),
(4, 1, 'b4dc94ff9d05b029b08327bfbfc80239', '', '', '', '', NULL),
(5, 1, '4d99a8c805aedb57890b8c76e7aab262', 'test', 'test', 'Test', 'test', 'test'),
(6, 2, 'd6c8a33cc90300ce906feb58c6db7a1c', 'admin@admin.admin', '88005553535', 'Администратор', 'Администратор', NULL),
(7, 1, 'b4dc94ff9d05b029b08327bfbfc80239', '', '', '', '', NULL),
(8, 1, 'b4dc94ff9d05b029b08327bfbfc80239', '', '', '', '', NULL),
(9, 1, 'b4dc94ff9d05b029b08327bfbfc80239', '', '', '', '', NULL),
(10, 1, 'b4dc94ff9d05b029b08327bfbfc80239', '', '', '', '', NULL),
(11, 1, 'b4dc94ff9d05b029b08327bfbfc80239', '', '', '', '', NULL),
(12, 1, '689597dba0051f65b06bad0749d6b490', 'a.klev.dev@gmail.com', '88005553535', 'Корнишин', 'Александр', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carriages`
--
ALTER TABLE `carriages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_carriage_type` (`id_carriage_type`);

--
-- Indexes for table `carriage_types`
--
ALTER TABLE `carriage_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state` (`state`);

--
-- Indexes for table `message_states`
--
ALTER TABLE `message_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_trip` (`id_trip`);

--
-- Indexes for table `orders_and_seats`
--
ALTER TABLE `orders_and_seats`
  ADD PRIMARY KEY (`id_order`,`id_carriage`,`seat_num`),
  ADD KEY `id_carriage` (`id_carriage`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes_and_stations`
--
ALTER TABLE `routes_and_stations`
  ADD PRIMARY KEY (`id_route`,`id_station`) USING BTREE,
  ADD KEY `id_station` (`id_station`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_carriage_type` (`id_carriage_type`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `station_joins`
--
ALTER TABLE `station_joins`
  ADD PRIMARY KEY (`id_station_start`,`id_station_end`),
  ADD KEY `id_station_end` (`id_station_end`);

--
-- Indexes for table `trains`
--
ALTER TABLE `trains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_train_type` (`id_train_type`);

--
-- Indexes for table `trains_and_carriages`
--
ALTER TABLE `trains_and_carriages`
  ADD PRIMARY KEY (`id_train`,`id_carriage`),
  ADD KEY `id_carriage` (`id_carriage`);

--
-- Indexes for table `train_comments`
--
ALTER TABLE `train_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_train` (`id_train`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `train_types`
--
ALTER TABLE `train_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_route` (`id_route`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carriages`
--
ALTER TABLE `carriages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `carriage_types`
--
ALTER TABLE `carriage_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trains`
--
ALTER TABLE `trains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `train_comments`
--
ALTER TABLE `train_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `train_types`
--
ALTER TABLE `train_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carriages`
--
ALTER TABLE `carriages`
  ADD CONSTRAINT `carriages_ibfk_1` FOREIGN KEY (`id_carriage_type`) REFERENCES `carriage_types` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`state`) REFERENCES `message_states` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_trip`) REFERENCES `trips` (`id`);

--
-- Constraints for table `orders_and_seats`
--
ALTER TABLE `orders_and_seats`
  ADD CONSTRAINT `orders_and_seats_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orders_and_seats_ibfk_2` FOREIGN KEY (`id_carriage`) REFERENCES `carriages` (`id`);

--
-- Constraints for table `routes_and_stations`
--
ALTER TABLE `routes_and_stations`
  ADD CONSTRAINT `routes_and_stations_ibfk_1` FOREIGN KEY (`id_station`) REFERENCES `stations` (`id`),
  ADD CONSTRAINT `routes_and_stations_ibfk_2` FOREIGN KEY (`id_route`) REFERENCES `routes` (`id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`id_carriage_type`) REFERENCES `carriage_types` (`id`);

--
-- Constraints for table `station_joins`
--
ALTER TABLE `station_joins`
  ADD CONSTRAINT `station_joins_ibfk_1` FOREIGN KEY (`id_station_start`) REFERENCES `stations` (`id`),
  ADD CONSTRAINT `station_joins_ibfk_2` FOREIGN KEY (`id_station_end`) REFERENCES `stations` (`id`);

--
-- Constraints for table `trains`
--
ALTER TABLE `trains`
  ADD CONSTRAINT `trains_ibfk_1` FOREIGN KEY (`id_train_type`) REFERENCES `train_types` (`id`),
  ADD CONSTRAINT `trains_ibfk_2` FOREIGN KEY (`id_train_type`) REFERENCES `train_types` (`id`);

--
-- Constraints for table `trains_and_carriages`
--
ALTER TABLE `trains_and_carriages`
  ADD CONSTRAINT `trains_and_carriages_ibfk_1` FOREIGN KEY (`id_train`) REFERENCES `trains` (`id`),
  ADD CONSTRAINT `trains_and_carriages_ibfk_2` FOREIGN KEY (`id_train`) REFERENCES `trains` (`id`),
  ADD CONSTRAINT `trains_and_carriages_ibfk_3` FOREIGN KEY (`id_train`) REFERENCES `trains` (`id`),
  ADD CONSTRAINT `trains_and_carriages_ibfk_4` FOREIGN KEY (`id_carriage`) REFERENCES `carriages` (`id`);

--
-- Constraints for table `train_comments`
--
ALTER TABLE `train_comments`
  ADD CONSTRAINT `train_comments_ibfk_1` FOREIGN KEY (`id_train`) REFERENCES `trains` (`id`),
  ADD CONSTRAINT `train_comments_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `trips_ibfk_1` FOREIGN KEY (`id_route`) REFERENCES `routes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
