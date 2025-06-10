-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 20, 2025 lúc 04:30 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `php_project`
--
CREATE DATABASE IF NOT EXISTS `php_project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `php_project`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on hold',
  `user_id` int(11) NOT NULL,
  `user_phone` varchar(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(1, 9999.99, 'on hold', 1, '0865118827', 'Hà N?i', 'V?n Quán, Hà ?ông', '2025-02-19 20:26:38'),
(2, 9999.99, 'on hold', 1, '32434234', 'Hà N?i', 'V?n Quán, Hà ?ông', '2025-02-19 21:28:43'),
(3, 9999.99, 'on hold', 1, '32434234', 'Hà N?i', 'V?n Quán, Hà ?ông', '2025-02-19 21:29:14'),
(4, 9999.99, 'on hold', 1, '123456876', 'H?i Phòng', 'HP', '2025-02-20 01:05:45'),
(5, 9999.99, 'on hold', 1, '0865118827', 'Hà N?i', 'V?n Quán, Hà ?ông', '2025-02-20 01:07:25'),
(6, 9999.99, 'on hold', 1, '0865118827', 'Hà N?i', 'V?n Quán, Hà ?ông', '2025-02-20 01:08:07'),
(7, 9999.99, 'on hold', 1, '123456788', 'H?i Phòng', 'HP', '2025-02-20 01:10:01'),
(8, 9999.99, 'on hold', 1, '123456788', 'H?i Phòng', 'HP', '2025-02-20 01:12:03'),
(9, 9999.99, 'on hold', 1, '12123123123', 'H?i Phòng', 'HP', '2025-02-20 01:16:49'),
(10, 9999.99, 'on hold', 1, '12312424124', 'HCM', '1232.HCM', '2025-02-20 01:19:31'),
(11, 9999.99, 'on hold', 1, '12312424124', 'HCM', '1232.HCM', '2025-02-20 01:20:34'),
(12, 9999.99, 'on hold', 1, '12312424124', 'HCM', '1232.HCM', '2025-02-20 01:21:17'),
(13, 9999.99, 'on hold', 1, '12312424124', 'HCM', '1232.HCM', '2025-02-20 01:22:43'),
(14, 9999.99, 'on hold', 1, '12312424124', 'HCM', '1232.HCM', '2025-02-20 01:23:23'),
(15, 9999.99, 'on hold', 1, '12312424124', 'HCM', '1232.HCM', '2025-02-20 01:24:10'),
(16, 9999.99, 'on hold', 1, '12312424124', 'HCM', '1232.HCM', '2025-02-20 01:24:47'),
(17, 9999.99, 'on hold', 1, '12312424124', 'HCM', '1232.HCM', '2025-02-20 01:53:55'),
(18, 9999.99, 'on hold', 1, '12312424124', 'HCM', '1232.HCM', '2025-02-20 01:57:23'),
(19, 0.00, 'on hold', 1, '0865118827', 'Hà N?i', 'V?n Quán, Hà ?ông', '2025-02-20 07:39:26'),
(20, 9999.99, 'on hold', 1, '0865118827', 'Hà N?i', 'V?n Quán, Hà ?ông', '2025-02-20 07:40:10'),
(21, 9999.99, 'on hold', 1, '9123892142', 'Hà N?i', 'V?n Quán, Hà ?ông', '2025-02-20 08:34:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(9,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(1, 16, '4', 'Iphone 11 pro max', 'ip11prm.jpg', 400.00, 4, 1, '2025-02-20 01:24:47'),
(2, 16, '5', 'iphone 14 series', 'ip14t.jpg', 9999999.99, 1, 1, '2025-02-20 01:24:47'),
(3, 18, '4', 'Iphone 11 pro max', 'ip11prm.jpg', 400.00, 4, 1, '2025-02-20 01:57:23'),
(4, 18, '5', 'iphone 14 series', 'ip14t.jpg', 9999999.99, 1, 1, '2025-02-20 01:57:23'),
(5, 18, '3', 'iphone 11 pro', 'ip11pr.png', 6210000.00, 1, 1, '2025-02-20 01:57:23'),
(6, 19, '3', 'iphone 11 pro', 'ip11pr.png', 6210000.00, 1, 1, '2025-02-20 07:39:26'),
(7, 20, '3', 'iphone 11 pro', 'ip11pr.png', 6210000.00, 2, 1, '2025-02-20 07:40:10'),
(8, 21, '3', 'iphone 11 pro', 'ip11pr.png', 6210000.00, 1, 1, '2025-02-20 08:34:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(250) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_special_offer` int(2) NOT NULL,
  `product_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
(2, 'iphone 11 ', 'iphone 11 256Gb', 'iphone 11 green', 'iphone11t.JPG', 'ip11t2.JPG', 'iphone11t.JPG', 'iphone11t.JPG', 250, 2, 'xanh'),
(3, 'iphone 11 pro', 'iphone 11 series', 'vàng', 'ip11pr.png', 'ip11pr.png', 'ip11pr.png', 'ip11pr.png', 270, 15, ''),
(4, 'Iphone 11 pro max', 'iphone 11 series', 'white', 'ip11prm.jpg', 'ip11prm.jpg', 'ip11prm.jpg', 'ip11prm.jpg', 400, 20, ''),
(5, 'iphone 14 series', 'iphone14', 'Iphone 14 black', 'ip14t.jpg', 'ip14pro.jpg', 'ip14prm.jpg', '', 500, 15, 'black,white,puple');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'D?ng', 'Dung', '$2y$10$gRl5DgHrTUH5DN0uiOjKb.4N1aFQRMflDPqfqtMSHOVcYn420cOg6'),
(2, 'nam', 'nam213231@gmail.com', '$2y$10$AkU63XO05KW982YTy6iLoejQ6GUm9sK5UBulSix9x3C5CiLsObIfW'),
(3, 'test', 'test12345@gmail.com', '$2y$10$7FougDBn9swp3Q7KvdMPdefS4ao8oK3cJrfVFLMO.YeGzBMeFYeqe'),
(4, 'Dung', 'dung123@gmail.com', '$2y$10$o9zNsGf5V1kxZpIT/CAaiuEeITESTwB0DozZmNlXW5QEmlRKMhcWi'),
(5, 'Dung', 'dung12345@gmail.com', '$2y$10$rg/XCMs4vYroXwzObPcKhuEwUSjEMEf1jh9peuvpZ3i5Tm6H8VAYa');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
