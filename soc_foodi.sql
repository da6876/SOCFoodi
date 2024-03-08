-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2024 at 09:35 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soc_foodi`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_info`
--

CREATE TABLE `category_info` (
  `category_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_status` varchar(10) DEFAULT NULL,
  `create_info` varchar(25) DEFAULT NULL,
  `update_info` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_info`
--

INSERT INTO `category_info` (`category_id`, `user_id`, `category_name`, `category_status`, `create_info`, `update_info`) VALUES
(1, 1, 'Category 1', 'A', '04/09/2022', ''),
(2, 1, 'Category 3', 'D', '04/09/2022', '04/09/2022'),
(3, 1, 'Category 2', 'A', '06/09/2022', ''),
(4, 1, 'Category 3', 'A', '06/09/2022', ''),
(5, 1, 'Category 4', 'A', '06/09/2022', ''),
(6, 5, 'Supreme Pizza', 'A', '06/09/2022', ''),
(7, 5, 'Chicken Burger', 'A', '07/09/2022', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

CREATE TABLE `product_info` (
  `product_id` int(10) NOT NULL,
  `product_type_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `sub_category_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_short_desc` varchar(100) NOT NULL DEFAULT 'NA',
  `product_desc` varchar(500) DEFAULT NULL,
  `product_other_info` varchar(300) DEFAULT NULL,
  `product_image` varchar(80) DEFAULT 'NO IMAGE',
  `product_color_id` int(10) NOT NULL DEFAULT 0,
  `current_price` varchar(100) NOT NULL DEFAULT '00',
  `previous_price` varchar(100) NOT NULL DEFAULT '00',
  `product_status` varchar(10) NOT NULL DEFAULT 'I',
  `create_info` varchar(25) DEFAULT NULL,
  `update_info` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`product_id`, `product_type_id`, `category_id`, `sub_category_id`, `user_id`, `product_name`, `product_short_desc`, `product_desc`, `product_other_info`, `product_image`, `product_color_id`, `current_price`, `previous_price`, `product_status`, `create_info`, `update_info`) VALUES
(1, 1, 1, 1, 1, 'Product Name 1', 'Product Short Desc 1', 'Product Desc 1', NULL, 'NO IMAGE', 0, '500', '800', 'D', '05/09/2022', ''),
(2, 1, 1, 1, 1, 'Product Name 2', 'Product Short Desc 2', 'Product Desc 2', NULL, 'NO IMAGE', 0, '150', '200', 'D', '06/09/2022', ''),
(3, 1, 1, 5, 1, 'Product Name 1', 'Product Short Desc 1', 'Product Desc 1', NULL, 'NO IMAGE', 0, '100', '120', 'A', '06/09/2022', ''),
(4, 3, 3, 7, 1, 'Product Name 2', 'Product Short Desc 2', 'Product Desc 2', NULL, 'ALLImages/ProductImages/AgADCDbqOChltG9.png', 0, '500', '505', 'A', '06/09/2022', ''),
(5, 1, 5, 9, 1, 'Product Name 3', 'Product Short Desc 3', 'Product Desc 3', NULL, 'ALLImages/ProductImages/r70SKo5NH8fZsyl.png', 0, '520', '550', 'A', '06/09/2022', ''),
(6, 3, 4, 8, 1, 'Product Name 32', 'Product Short Desc 322', 'Product Desc 322', NULL, 'ALLImages/ProductImages/Q0ct5wyw7eV9jKY.png', 0, '5202', '5502', 'A', '06/09/2022', ''),
(7, 5, 6, 10, 5, 'Chicken Supreme Pizza', 'Topped with chicken, onion, capsicum, black olive & green chili', 'Topped with chicken, onion, capsicum, black olive & green chili', NULL, 'ALLImages/ProductImages/0NMmeqUn1VBufnx.png', 0, '308', '350', 'A', '06/09/2022', ''),
(8, 5, 6, 10, 5, 'Chicken Deluxe Pizza', 'Topped with chicken, sausage, mushroom, capsicum, black olive & green chili', 'Topped with chicken, sausage, mushroom, capsicum, black olive & green chili', NULL, 'ALLImages/ProductImages/HX91fRRLwyzrXUV.png', 0, '352', '400', 'A', '06/09/2022', ''),
(9, 5, 6, 10, 5, 'Sausage Carnival Pizza', 'Topped with sausage, onion, capsicum & black olive', 'Topped with sausage, onion, capsicum & black olive', NULL, 'ALLImages/ProductImages/knb53CFbNcyQDSm.png', 0, '308', '350', 'A', '06/09/2022', ''),
(10, 5, 6, 10, 5, 'Naga Chicken Pizza', 'Topped with chicken, onion, capsicum, black olive & naga sauce', 'Topped with chicken, onion, capsicum, black olive & naga sauce', NULL, 'ALLImages/ProductImages/CKwsIMyxvxluaAC.jpg', 0, '352', '400', 'A', '06/09/2022', ''),
(11, 5, 6, 10, 5, 'Beef Salami Pizza', 'Topped with beef salami, onion, capsicum, black olive, bbq sauce, chili & chili flakes', 'Topped with beef salami, onion, capsicum, black olive, bbq sauce, chili & chili flakes', NULL, 'ALLImages/ProductImages/RzNOWmNn0AE9X3Q.jpg', 0, '352', '400', 'A', '06/09/2022', ''),
(12, 6, 7, 11, 5, 'Chicken Burger', '1 pc', '1 pc', NULL, 'ALLImages/ProductImages/rw7ww9ctjjiupZi.jpg', 0, '70', '80', 'A', '07/09/2022', ''),
(13, 6, 7, 11, 5, 'Naga Chicken Burger', '1 pc', '1 pc', NULL, 'ALLImages/ProductImages/wsMNxON8uZ00zgU.jpg', 0, '79', '90', 'A', '07/09/2022', ''),
(14, 6, 7, 11, 5, 'Naga Chicken Burger', '1 pc', '1 pc', NULL, 'ALLImages/ProductImages/C3RSQJUcUw70uL7.jpg', 0, '79', '90', 'A', '07/09/2022', ''),
(15, 6, 7, 11, 5, 'Sausage Burger', '1 pc', '1 pc', NULL, 'ALLImages/ProductImages/YgNbDGwUDdKwPgd.jpg', 0, '70', '80', 'A', '07/09/2022', ''),
(16, 6, 7, 11, 5, 'Mushroom Burger', '1 pc', '1 pc', NULL, 'ALLImages/ProductImages/uuDhgi7MOXXJQvT.jpg', 0, '70', '90', 'A', '07/09/2022', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `product_type_id` int(10) NOT NULL,
  `product_type_name` varchar(50) NOT NULL,
  `product_type_status` varchar(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `create_info` varchar(25) NOT NULL,
  `update_info` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`product_type_id`, `product_type_name`, `product_type_status`, `user_id`, `create_info`, `update_info`) VALUES
(1, 'Product Type 1', 'A', 1, '04/09/2022', ''),
(2, 'Product Type 22', 'D', 1, '04/09/2022', '04/09/2022'),
(3, 'Product Type 2', 'A', 1, '05/09/2022', '06/09/2022'),
(4, 'Product Type 3', 'D', 1, '05/09/2022', '06/09/2022'),
(5, 'Pizza', 'A', 5, '06/09/2022', ''),
(6, 'Burger', 'A', 5, '07/09/2022', '');

-- --------------------------------------------------------

--
-- Table structure for table `shopinfo`
--

CREATE TABLE `shopinfo` (
  `shop_id` int(10) NOT NULL,
  `shop_name` varchar(50) NOT NULL,
  `shop_address` varchar(500) NOT NULL,
  `shop_trade_licence` varchar(50) NOT NULL,
  `ower_name` varchar(50) NOT NULL,
  `ower_number` varchar(15) NOT NULL,
  `shop_email` varchar(50) NOT NULL,
  `shop_phone` varchar(15) NOT NULL,
  `shop_status` varchar(5) NOT NULL,
  `create_date` varchar(15) NOT NULL,
  `update_date` varchar(15) DEFAULT NULL,
  `create_by` int(10) DEFAULT NULL,
  `update_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopinfo`
--

INSERT INTO `shopinfo` (`shop_id`, `shop_name`, `shop_address`, `shop_trade_licence`, `ower_name`, `ower_number`, `shop_email`, `shop_phone`, `shop_status`, `create_date`, `update_date`, `create_by`, `update_by`) VALUES
(1, 'Test Shop', 'Mirpur,Dhaka,Bangladesh', '11111222200', 'Test Owner', '0123456789', 'testshop@gmail.com', '0147852369', 'D', '03/09/2022', '03/09/2022', 1, 1),
(2, 'SOC FOODI', 'Kollanpur,Mirpur,Dhaka,1216,Bangladesh', '220302100236', 'SOC', '0147852369', 'sosfoodi@gmail.com', '01478233332', 'A', '03/09/2022', '', 1, NULL),
(3, 'Milhans Kitchen', 'Kachukhet Road, Dhaka-1230 1230 Dhaka, Dhaka Division, Bangladesh', '11111', 'Milhans Kitchen', '01760570316', 'milhanskitchen@gmail.com', '01760570316', 'A', '06/09/2022', '07/09/2022', 1, 1),
(4, 'FoodWaGon', 'Dhaka', '11111', 'foodwaGon', '0147852369', 'foodwaGon@gmail.com', '0147852369', 'A', '09/09/2022', '', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_type`
--

CREATE TABLE `shop_type` (
  `shop_type_id` int(10) NOT NULL,
  `shop_type_name` varchar(50) NOT NULL,
  `shop_type_status` varchar(10) NOT NULL DEFAULT 'I',
  `create_info` varchar(25) DEFAULT NULL,
  `update_info` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shop_user_map`
--

CREATE TABLE `shop_user_map` (
  `shopusermap_id` int(10) NOT NULL,
  `shop_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `map_status` varchar(10) NOT NULL,
  `create_info` varchar(25) NOT NULL,
  `update_info` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop_user_map`
--

INSERT INTO `shop_user_map` (`shopusermap_id`, `shop_id`, `user_id`, `map_status`, `create_info`, `update_info`) VALUES
(1, 2, 3, 'A', '03/09/2022, 1', '03/09/2022, 1'),
(2, 2, 1, 'D', '03/09/2022, 1', ''),
(3, 2, 1, 'D', '03/09/2022, 1', ''),
(4, 2, 1, 'D', '03/09/2022, 1', ''),
(5, 3, 5, 'A', '06/09/2022, 1', ''),
(6, 3, 6, 'A', '08/09/2022, 1', ''),
(7, 4, 7, 'A', '09/09/2022, 1', '');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category_info`
--

CREATE TABLE `sub_category_info` (
  `sub_category_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `sub_category_name` varchar(50) NOT NULL,
  `sub_category_status` varchar(10) DEFAULT NULL,
  `create_info` varchar(25) DEFAULT NULL,
  `update_info` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_category_info`
--

INSERT INTO `sub_category_info` (`sub_category_id`, `user_id`, `category_id`, `sub_category_name`, `sub_category_status`, `create_info`, `update_info`) VALUES
(1, 1, 1, 'SubCategory 1', 'D', '04/09/2022', ''),
(2, 1, 1, 'SubCategory 2', 'D', '04/09/2022', ''),
(3, 1, 1, 'SubCategory 32', 'D', '04/09/2022', '04/09/2022'),
(4, 1, 1, 'SubCategory 3', 'D', '06/09/2022', ''),
(5, 1, 1, 'SubCategory 1', 'A', '06/09/2022', ''),
(6, 1, 1, 'SubCategory 1', 'D', '06/09/2022', ''),
(7, 1, 3, 'SubCategory 2', 'A', '06/09/2022', ''),
(8, 1, 4, 'SubCategory 3', 'A', '06/09/2022', ''),
(9, 1, 5, 'SubCategory 4', 'A', '06/09/2022', ''),
(10, 5, 6, 'Supreme Pizza', 'A', '06/09/2022', ''),
(11, 5, 7, 'Chicken Burger', 'A', '07/09/2022', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_info_id` int(10) NOT NULL,
  `user_type_id` int(10) NOT NULL,
  `shop_id` int(10) DEFAULT NULL,
  `user_name` varchar(40) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(60) NOT NULL,
  `status` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `create_date` varchar(15) NOT NULL,
  `update_date` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_info_id`, `user_type_id`, `shop_id`, `user_name`, `phone_no`, `email`, `address`, `status`, `password`, `create_date`, `update_date`) VALUES
(1, 1, NULL, 'Root User', '01684924439', 'socroot@gmail.com', 'Mirpur,Dhaka', 'A', 'mTfetQIr', '03/09/2022', '03/09/2022'),
(2, 1, NULL, 'AAA', '2222', 'aa@fff', 'fff', 'D', 'mTfetQ==', '03/09/2022', ''),
(3, 4, NULL, 'User Seller', '0147852369', 'socseller@gmail.com', 'Mirpur,Dhaka', 'A', 'mTfetQIr', '03/09/2022', ''),
(4, 5, NULL, 'SOC Foodi ADMIN', '0123456789', 'socfoodi@gmail.com', 'Mirpur,Dhaka', 'A', 'mTfetQIr', '03/09/2022', ''),
(5, 5, NULL, 'Milhans Kitchen', '01760570316', 'milhanskitchen@gmail.com', 'Kachukhet Road, Dhaka-1230', 'A', 'mTfetQIr', '06/09/2022', '07/09/2022'),
(6, 4, NULL, 'Milhans Kitchen Seller', '01582369522', 'milhanskitchenseller@gmail.com', 'Dhaka', 'A', 'mTfetQIr', '08/09/2022', ''),
(7, 5, NULL, 'foodwaGon', '014785239', 'foodwaGon@gmail.com', 'Dhaka', 'A', 'mTfetQIr', '09/09/2022', ''),
(8, 5, 2, 'SOC Foodi', '01315007287', 'socfoodiadmin@gmail.com', 'Kollanpur,1 Number Road,Mirpur,Dhaka', 'A', 'mTfetQIr', '27/05/2023', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(10) NOT NULL,
  `user_type_name` varchar(50) NOT NULL,
  `user_type_status` varchar(10) NOT NULL DEFAULT 'I',
  `create_date` varchar(15) NOT NULL,
  `update_date` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type_name`, `user_type_status`, `create_date`, `update_date`) VALUES
(1, 'Root User', 'A', '29/08/2022', '29/08/2022'),
(2, 'Test 111', 'D', '29/08/2022', '29/08/2022'),
(3, 'Test 2', 'D', '29/08/2022', ''),
(4, 'Shop Seller', 'A', '03/09/2022', '24/10/2022'),
(5, 'Shop Admin', 'A', '03/09/2022', ''),
(6, 'Shop Manager', 'A', '03/09/2022', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_info`
--
ALTER TABLE `category_info`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `product_info`
--
ALTER TABLE `product_info`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`product_type_id`);

--
-- Indexes for table `shopinfo`
--
ALTER TABLE `shopinfo`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `shop_type`
--
ALTER TABLE `shop_type`
  ADD PRIMARY KEY (`shop_type_id`);

--
-- Indexes for table `shop_user_map`
--
ALTER TABLE `shop_user_map`
  ADD PRIMARY KEY (`shopusermap_id`);

--
-- Indexes for table `sub_category_info`
--
ALTER TABLE `sub_category_info`
  ADD PRIMARY KEY (`sub_category_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_info_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_info`
--
ALTER TABLE `category_info`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_info`
--
ALTER TABLE `product_info`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `product_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shopinfo`
--
ALTER TABLE `shopinfo`
  MODIFY `shop_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shop_type`
--
ALTER TABLE `shop_type`
  MODIFY `shop_type_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_user_map`
--
ALTER TABLE `shop_user_map`
  MODIFY `shopusermap_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sub_category_info`
--
ALTER TABLE `sub_category_info`
  MODIFY `sub_category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_info_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
