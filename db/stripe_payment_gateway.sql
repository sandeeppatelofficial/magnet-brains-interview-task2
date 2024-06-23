-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 02:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stripe_payment_gateway`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_total` varchar(255) DEFAULT NULL,
  `product_ids` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `trans_id` text DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT 'Unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `user_id`, `cart_total`, `product_ids`, `created_at`, `updated_at`, `trans_id`, `payment_status`) VALUES
(26, '202406225867', 29, '100', '[\"1\"]', '2024-06-22 12:04:29', '2024-06-22 12:04:29', 'txn_3PUSgk02bHdCTCSn0rniNCce', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `image`, `description`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Canon R100 Mirrorless Camera RF-S 18-45mm f/4.5-6.3 IS STM  (Black)', 'https://rukminim2.flixcart.com/image/312/312/xif0q/dslr-camera/i/o/c/eos-r100-24-1-eos-r100-kit-canon-original-imagqeydhsxgacxp.jpeg?q=70', '\r\nThis Canon R100 Mirrorless Camera features a RF-S 18-45 mm lens, which provides a wide range of focal lengths for capturing everything from landscapes to portraits. With its mirrorless design, this camera offers fast and accurate autofocus, as well as the ability to shoot in low-light conditions. With Creative Assist Mode, Hybrid Auto Mode, and Silent Mode for Quiet Operation, this camera is sure to impress with its performance and image quality.\r\n', 100, '2024-06-22 06:40:22', '2024-06-22 12:10:22'),
(2, 'SONY Alpha ILCE-6400 APS-C Mirrorless Camera Body Only Featuring Eye AF and 4K movie recording  (Black)', 'https://rukminim2.flixcart.com/image/312/312/kw9krrk0/dslr-camera/6/j/k/-original-imag8z5wzzcgkzva.jpeg?q=70', '\r\nBoasting a 24.2-megapixel Exmor CMOS Sensor, this Sony camera delivers low-noise images with picture-perfect clarity. And, since, this camera also boasts an automatic subject motion tracker, it helps you maintain a constant focus on your subjects so that you can capture crystal-clear images/videos of them, even when they’re in motion.', 200, '2024-06-22 06:41:29', '2024-06-22 12:11:29'),
(3, 'Mivi DuoPods i2 TWS,13mm Bass,45H Playtime,Dual Mic AI ENC,Low Latency,Type C,5.3 Bluetooth Headset  (Black, True Wireless)', 'https://rukminim2.flixcart.com/image/612/612/xif0q/headphone/l/a/7/-original-imagx8s5etjezqym.jpeg?q=70', '\r\nMivi DuoPods I2 TWS are carefully engineered to provide you with a 13mm bass with custom amplifiers offering deep, rich bass along with loud and crisp beats delivering unmatched audio quality. The TWS earbuds offer a massive 45 Hrs combined playtime on a single charge. Type C charging enables blazing-fast charging so that you never miss anything important on the go. A 10-minute charge can provide you with a playtime of up to 500 minutes of playtime. The ear buds are powered by AI-ENC to cut you off from the ambient noise and delve deep into crisp and clear conversations with people. The IPX 4.0 rating ensures an uninterrupted rigorous workout session without breaking apart. DuoPods I2 are designed, engineered and crafted in India. Own the Indian-made and say with pride, Mivi Apna Hai.', 300, '2024-06-22 06:42:22', '2024-06-22 12:12:22'),
(4, 'realme Buds T110 with AI ENC for calls, upto 38 hours of Playback and Fast Charging Bluetooth Headset  (Punk Black, True Wireless)', 'https://rukminim2.flixcart.com/image/612/612/xif0q/headphone/f/y/f/-original-imahy3uqgtzmdsge.jpeg?q=70', '\r\nIntroducing the realme Buds T110, designed to provide an immersive music and gaming experience,with 10 MM Dynamic Boost Drivers to deliver powerful and dynamic sound to enhance your listening experience & low latency of 88ms for smooth and lag-free audio while gaming or watching videos.Equipped with The Environmental Noise Cancellation (ENC) feature helps in reducing background noise during calls, ensuring clearer and better call quality, Bluetooth version 5.4 ensures stable and reliable connectivity with your devices. The IPX5 rating makes the realme Buds T110 resistant to water and sweat, making them suitable for workouts and outdoor activities. Super Fast 10 Min Charge for 120 Min Play Time: With just a 10-minute charge, you can enjoy up to 120 minutes of playback time, ensuring you have music whenever you need it. Together all these features make the realme Buds T110 a great choice for those looking for a versatile and high-performance pair of earbuds for both music and gaming', 400, '2024-06-22 06:43:11', '2024-06-22 12:13:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(29, 'sadeepgh', 'test@gmail.com', '2024-06-22 12:04:29', '2024-06-22 12:04:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
