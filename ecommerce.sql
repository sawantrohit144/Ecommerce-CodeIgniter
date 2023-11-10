-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2023 at 01:58 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'Rohit', 'Rohit'),
(2, 'Admin', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories` varchar(250) NOT NULL,
  `status` tinyint(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`, `status`) VALUES
(1, 'Books', 0),
(2, 'Electronic', 0),
(3, 'Clothes', 0),
(4, 'Toys', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `comment`, `added_on`) VALUES
(1, 'Kunal', 'kunal@gmail.com', '1234567890', 'My order is shipped.', '2023-10-31 12:47:34');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` int(11) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `total_price` float NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `order_status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `address`, `city`, `pincode`, `payment_type`, `total_price`, `payment_status`, `order_status`, `added_on`) VALUES
(1, 1, '31/1, 38, Nirgudi Road, Lohagaon', 'Pune, Maharashtra', 411047, 'COD', 3600, 'success', 3, '2023-10-31 12:41:17'),
(2, 1, '31/1, 38, Nirgudi Road, Lohagaon', 'Pune, Maharashtra', 411047, 'COD', 100, 'success', 1, '2023-11-01 12:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `qty`, `price`, `added_on`) VALUES
(1, 1, 1, 3, 100, '2023-10-31 12:41:17'),
(2, 1, 3, 3, 1000, '2023-10-31 12:41:17'),
(3, 1, 5, 1, 200, '2023-10-31 12:41:17'),
(4, 1, 7, 1, 100, '2023-10-31 12:41:17'),
(5, 2, 8, 1, 100, '2023-11-01 12:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Canceled'),
(5, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(2000) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(2000) NOT NULL,
  `meta_desc` varchar(2000) NOT NULL,
  `meta_keyword` varchar(2000) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_id`, `name`, `mrp`, `price`, `qty`, `image`, `short_desc`, `description`, `meta_title`, `meta_desc`, `meta_keyword`, `status`) VALUES
(1, 1, 'Book 1', 100, 100, 5, '1698755003_63d7a9ae2df79390abde.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem dolor sed viverra ipsum. Id neque aliquam vestibulum morbi blandit cursus risus. Nullam vehicula ipsum a arcu cursus. Eget gravida cum sociis natoque penatibus. Mattis pellentesque id nibh tortor id aliquet lectus proin nibh. Vitae elementum curabitur vitae nunc. Gravida neque convallis a cras semper auctor neque. Etiam non quam lacus suspendisse. Urna condimentum mattis pellentesque id. Commodo nulla facilisi nullam vehicula ipsum. Nunc sed id semper risus in hendrerit. Viverra justo nec ultrices dui sapien eget mi proin. Duis tristique sollicitudin nibh sit amet. Magna sit amet purus gravida quis blandit turpis cursus. Sagittis eu volutpat odio facilisis mauris sit amet massa vitae.', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet', 0),
(2, 1, 'Book 2', 1000, 900, 5, '1698755135_0090bef1e12e94321734.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem dolor sed viverra ipsum. Id neque aliquam vestibulum morbi blandit cursus risus. Nullam vehicula ipsum a arcu cursus. Eget gravida cum sociis natoque penatibus. Mattis pellentesque id nibh tortor id aliquet lectus proin nibh. Vitae elementum curabitur vitae nunc. Gravida neque convallis a cras semper auctor neque. Etiam non quam lacus suspendisse. Urna condimentum mattis pellentesque id. Commodo nulla facilisi nullam vehicula ipsum. Nunc sed id semper risus in hendrerit. Viverra justo nec ultrices dui sapien eget mi proin. Duis tristique sollicitudin nibh sit amet. Magna sit amet purus gravida quis blandit turpis cursus. Sagittis eu volutpat odio facilisis mauris sit amet massa vitae.', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet', 0),
(3, 2, 'Electronic 1', 1000, 1000, 5, '1698755241_f8cfcd3f9ca82e12c137.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem dolor sed viverra ipsum. Id neque aliquam vestibulum morbi blandit cursus risus. Nullam vehicula ipsum a arcu cursus. Eget gravida cum sociis natoque penatibus. Mattis pellentesque id nibh tortor id aliquet lectus proin nibh. Vitae elementum curabitur vitae nunc. Gravida neque convallis a cras semper auctor neque. Etiam non quam lacus suspendisse. Urna condimentum mattis pellentesque id. Commodo nulla facilisi nullam vehicula ipsum. Nunc sed id semper risus in hendrerit. Viverra justo nec ultrices dui sapien eget mi proin. Duis tristique sollicitudin nibh sit amet. Magna sit amet purus gravida quis blandit turpis cursus. Sagittis eu volutpat odio facilisis mauris sit amet massa vitae.', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet', 0),
(4, 2, 'Electronic 2', 1000, 700, 5, '1698755307_56ac876d19a1a88266a0.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem dolor sed viverra ipsum. Id neque aliquam vestibulum morbi blandit cursus risus. Nullam vehicula ipsum a arcu cursus. Eget gravida cum sociis natoque penatibus. Mattis pellentesque id nibh tortor id aliquet lectus proin nibh. Vitae elementum curabitur vitae nunc. Gravida neque convallis a cras semper auctor neque. Etiam non quam lacus suspendisse. Urna condimentum mattis pellentesque id. Commodo nulla facilisi nullam vehicula ipsum. Nunc sed id semper risus in hendrerit. Viverra justo nec ultrices dui sapien eget mi proin. Duis tristique sollicitudin nibh sit amet. Magna sit amet purus gravida quis blandit turpis cursus. Sagittis eu volutpat odio facilisis mauris sit amet massa vitae.', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet', 0),
(5, 3, 'Cloth 1', 500, 200, 5, '1698755395_895c3526df68dc0d17ea.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem dolor sed viverra ipsum. Id neque aliquam vestibulum morbi blandit cursus risus. Nullam vehicula ipsum a arcu cursus. Eget gravida cum sociis natoque penatibus. Mattis pellentesque id nibh tortor id aliquet lectus proin nibh. Vitae elementum curabitur vitae nunc. Gravida neque convallis a cras semper auctor neque. Etiam non quam lacus suspendisse. Urna condimentum mattis pellentesque id. Commodo nulla facilisi nullam vehicula ipsum. Nunc sed id semper risus in hendrerit. Viverra justo nec ultrices dui sapien eget mi proin. Duis tristique sollicitudin nibh sit amet. Magna sit amet purus gravida quis blandit turpis cursus. Sagittis eu volutpat odio facilisis mauris sit amet massa vitae.', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet', 0),
(6, 3, 'Cloth 2', 100, 100, 5, '1698755460_69bba1ed2fa09de273e8.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem dolor sed viverra ipsum. Id neque aliquam vestibulum morbi blandit cursus risus. Nullam vehicula ipsum a arcu cursus. Eget gravida cum sociis natoque penatibus. Mattis pellentesque id nibh tortor id aliquet lectus proin nibh. Vitae elementum curabitur vitae nunc. Gravida neque convallis a cras semper auctor neque. Etiam non quam lacus suspendisse. Urna condimentum mattis pellentesque id. Commodo nulla facilisi nullam vehicula ipsum. Nunc sed id semper risus in hendrerit. Viverra justo nec ultrices dui sapien eget mi proin. Duis tristique sollicitudin nibh sit amet. Magna sit amet purus gravida quis blandit turpis cursus. Sagittis eu volutpat odio facilisis mauris sit amet massa vitae.', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet', 0),
(7, 4, 'Toy 1', 100, 100, 5, '1698755537_ec942b6dbfe638c68cbc.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem dolor sed viverra ipsum. Id neque aliquam vestibulum morbi blandit cursus risus. Nullam vehicula ipsum a arcu cursus. Eget gravida cum sociis natoque penatibus. Mattis pellentesque id nibh tortor id aliquet lectus proin nibh. Vitae elementum curabitur vitae nunc. Gravida neque convallis a cras semper auctor neque. Etiam non quam lacus suspendisse. Urna condimentum mattis pellentesque id. Commodo nulla facilisi nullam vehicula ipsum. Nunc sed id semper risus in hendrerit. Viverra justo nec ultrices dui sapien eget mi proin. Duis tristique sollicitudin nibh sit amet. Magna sit amet purus gravida quis blandit turpis cursus. Sagittis eu volutpat odio facilisis mauris sit amet massa vitae.', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet', 0),
(8, 4, 'Toy 2', 100, 100, 5, '1698824542_e83c3c6eddcf894f53e3.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem dolor sed viverra ipsum. Id neque aliquam vestibulum morbi blandit cursus risus. Nullam vehicula ipsum a arcu cursus. Eget gravida cum sociis natoque penatibus. Mattis pellentesque id nibh tortor id aliquet lectus proin nibh. Vitae elementum curabitur vitae nunc. Gravida neque convallis a cras semper auctor neque. Etiam non quam lacus suspendisse. Urna condimentum mattis pellentesque id. Commodo nulla facilisi nullam vehicula ipsum. Nunc sed id semper risus in hendrerit. Viverra justo nec ultrices dui sapien eget mi proin. Duis tristique sollicitudin nibh sit amet. Magna sit amet purus gravida quis blandit turpis cursus. Sagittis eu volutpat odio facilisis mauris sit amet massa vitae.', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `password`, `added_on`) VALUES
(1, 'Kunal', 'kunal@gmail.com', '1234567890', '1234', '2023-10-31 12:35:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
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
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
