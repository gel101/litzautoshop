-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2024 at 09:15 PM
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
-- Database: `garagedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phoneNum` varchar(13) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `fname`, `lname`, `birthdate`, `address`, `phoneNum`, `email`, `username`, `password`) VALUES
(1, 'Angelo', 'Malano', '2023-04-26', 'Davao City', '09225468943', 'malano.angelo@dnsc.edu.ph', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `carengine`
--

CREATE TABLE `carengine` (
  `id` int(11) NOT NULL,
  `engine` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carengine`
--

INSERT INTO `carengine` (`id`, `engine`) VALUES
(2, '4x4 automatic'),
(3, '4x4 manual'),
(4, '4x2 automatic'),
(5, '4x2 manual');

-- --------------------------------------------------------

--
-- Table structure for table `carmodel`
--

CREATE TABLE `carmodel` (
  `id` int(11) NOT NULL,
  `model` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carmodel`
--

INSERT INTO `carmodel` (`id`, `model`) VALUES
(1, 'DA64V MAZDA'),
(2, 'DA64V'),
(3, 'DA64W');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `car_img` varchar(225) DEFAULT NULL,
  `img1` varchar(225) DEFAULT NULL,
  `img2` varchar(225) DEFAULT NULL,
  `img3` varchar(225) DEFAULT NULL,
  `img4` varchar(225) DEFAULT NULL,
  `car_type` varchar(25) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `model` varchar(25) DEFAULT NULL,
  `engine` varchar(25) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `sold` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `chassis` varchar(50) DEFAULT NULL,
  `tempPlate` varchar(50) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `car_img`, `img1`, `img2`, `img3`, `img4`, `car_type`, `name`, `model`, `engine`, `quantity`, `sold`, `price`, `chassis`, `tempPlate`, `details`, `status`) VALUES
(32, 'img/cars/659bbcbf0ab967.94053874', '', '', '', '', 'Transformer Minivan', 'New Model V.2', 'DA64W', '4x4 automatic', 0, 2, 245000, '', '', 'New chair, New Wheels\r\n- Transformer Minivan\r\n- Surplus\r\n- In a good condition(tuned)\r\n- Free Repaint\r\n- Complete Papers\r\n- 1 week process\r\n- Affordable\r\n- Good for the Family Bonding Vacation', ''),
(35, 'img/cars/659bbc9aef7676.88161786', '', '', '', '', 'Transformer Minivan', 'Classic Minivan', 'DA64V', '4x2 manual', 1, 2, 210000, '', '', 'Old Tire, Engine Tuned!\r\n- Transformer Minivan\r\n- Surplus\r\n- In a good condition(tuned)\r\n- Free Repaint\r\n- Complete Papers\r\n- 1 week process\r\n- Affordable\r\n- Good for the Family Bonding Vacation', ''),
(36, 'img/cars/659bbc7e899e91.88844739', 'img/cars/659bbc7ea037a6.73198311', 'img/cars/659bbc7ed60e45.17504402', 'img/cars/659bbc7f005e19.72069907', '', 'Transformer Minivan', 'Minivan 2022 Model', 'DA64V', '4x2 manual', 1, 0, 200000, '', '', 'Cleaned Air Conditioner\r\n- Transformer Minivan\r\n- Surplus\r\n- In a good condition(tuned)\r\n- Free Repaint\r\n- Complete Papers\r\n- 1 week process\r\n- Affordable\r\n- Good for the Family Bonding Vacation', ''),
(37, 'img/cars/659bbc4769fd56.60367771', 'img/cars/659bbc477a50a8.97526115', '', '', '', 'Transformer Minivan', 'Minivan 2021 Model', 'DA64V MAZDA', '4x4 automatic', 1, 1, 240000, '', '', '- Transformer Minivan\r\n- Surplus\r\n- In a good condition(tuned)\r\n- Free Repaint\r\n- Complete Papers\r\n- 1 week process\r\n- Affordable\r\n- Good for the Family Bonding Vacation', ''),
(38, 'img/cars/659bbce2d86c02.26420763', 'img/cars/659bba4b6af4a5.31187075', '', '', '', 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64W', '4x2 automatic', 1, 0, 230000, '', '', 'Free Carrier, Hood', ''),
(39, 'img/cars/659bb8aa3b9559.12530570', 'img/cars/659bb8aa4f2953.28682105', '', '', '', 'Transformer Minivan', 'New Painted Mazda Minivan', 'DA64V MAZDA', '4x4 manual', 1, 5, 225000, '', '', 'New paint, New brake!\r\n- Transformer Minivan\r\n- Surplus\r\n- In a good condition(tuned)\r\n- Free Repaint\r\n- Complete Papers\r\n- 1 week process\r\n- Affordable\r\n- Good for the Family Bonding Vacation', ''),
(40, 'img/cars/659bb85772c647.41990050', 'img/cars/659bb857850a25.91731450', 'img/cars/659bb8579475b5.47702123', 'img/cars/659bb857a20b18.93477192', 'img/cars/659bb857aafb02.47253467', 'Transformer Minivan', 'Brand New Minivan Surplus', 'DA64V', '4x2 automatic', 1, 2, 260000, '', '', 'DA64V 4×2 Matic\r\nLoaded ( Black )\r\nGas and Go\r\nNew All!', ''),
(41, 'img/cars/659bb8022b5157.20865171', 'img/cars/659bb802409cb6.54698481', 'img/cars/659bb802908dd1.79827492', 'img/cars/659bb8029e1c51.07531029', 'img/cars/659bb802aca8b0.27298285', 'Transformer Minivan', 'New Arrival Minivan', 'DA64V', '4x2 manual', 1, 5, 230000, '', '', 'New tires, Cleaned Airconditioner !!\r\n- Transformer Minivan\r\n- Surplus\r\n- In a good condition(tuned)\r\n- Free Repaint\r\n- Complete Papers\r\n- 1 week process\r\n- Affordable\r\n- Good for the Family Bonding Vacation', ''),
(42, 'img/cars/659bb6bd0cdae6.59530669', 'img/cars/659bb6bd731229.34700791', 'img/cars/659bb6bd9e7ba8.16100981', 'img/cars/659bb6bdefdd69.44756854', 'img/cars/659bb6be860f08.45889463', 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x4 automatic', 1, 12, 200000, '', '', '- Transformer Minivan\r\n- Surplus\r\n- In a good condition(tuned)\r\n- Free Repaint\r\n- Complete Papers\r\n- 1 week process\r\n- Affordable\r\n- Good for the Family Bonding Vacation', ''),
(43, 'img/cars/6506982ae42759.60397276', '', '', '', '', 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x2 manual', 127, 0, 200000, NULL, NULL, 'New tires, New Hood masong', 'archived'),
(44, 'img/cars/651b8ec5929ea5.68261917', '', '', '', '', 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x2 manual', 127, 0, 200000, NULL, NULL, 'New tires, New Hood masong', 'archived'),
(45, 'img/cars/651b90ad73a4b5.62717131', '', '', '', '', 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x2 manual', 127, 0, 200000, NULL, NULL, 'New tires, New Hood masong', 'archived'),
(46, 'img/cars/651b918097d5b2.11205384', '', '', '', '', 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x2 manual', 127, 0, 200000, NULL, NULL, 'New tires, New Hood masong', 'archived'),
(47, 'img/cars/6554ae4a148ce2.09372765', '', '', '', '', 'Transformer Minivan', 'Transformer Minivan Wagon', 'DA64W', '4x4 manual', 12, 0, 123445, NULL, NULL, 'new all', 'archived'),
(48, 'img/cars/6554aef8c26477.73776115', '', '', '', '', 'Transformer Minivan', 'Transformer Minivan Wagon', 'DA64V MAZDA', '4x2 automatic', 12, 0, 232, NULL, NULL, 'asfsad', 'archived'),
(49, 'img/cars/6555c13256dcb0.18257472', '', '', '', '', 'Transformer Minivan', 'sample12312', 'DA64V MAZDA', '4x2 automatic', 123, 0, 123, NULL, NULL, '123', 'archived'),
(50, 'img/cars/65564bcb1fd770.05820573', '', '', '', '', 'Transformer Minivan', 'sample', 'DA64V MAZDA', '4x2 automatic', 8, 0, 432, NULL, NULL, 'asfsf', 'archived'),
(51, 'img/cars/655afb5e214b97.25815412', '', '', '', '', 'Transformer Minivan', 'asfsaf', 'DA64V', '4x2 automatic', 23, 0, 42343, NULL, NULL, '-asfsadfsad\r\nasfsaf\r\n-asfds', 'archived'),
(52, 'img/cars/656c2276b73940.85298524', '', '', '', '', 'Transformer Minivan', 'sample12312', 'DA64V', '4x2 automatic', 1, 0, 23213, NULL, NULL, 'asfsad', 'archived'),
(53, 'img/cars/656c22f086de63.51155349', 'img/cars/656c2a76eadb12.92121632', 'img/cars/656c2a770948d5.98749655', 'img/cars/656c269b1aead7.86318809', 'img/cars/656c475e75c544.85880898', 'Transformer Minivan', '1231231', 'DA64V', '4x2 automatic', 1, 0, 233, NULL, NULL, 'asdfsdaasfsd', 'archived'),
(54, 'img/cars/65732f69acdf34.10554785', 'img/cars/65732f69d781d5.25810370', 'img/cars/65732f6a2429f3.32842979', 'img/cars/65732f6a359fd8.83172173', 'img/cars/65732f6a4a21f3.84054093', 'Transformer Minivan', 'Transformer Minivan Wagon', 'DA64V', '4x4 manual', 1, 1, 32321, '2211222', 'AMA 5633', '', 'archived'),
(55, 'img/cars/65af8417beacb4.03954879', '', '', '', '', 'Transformer Minivan', 'samplwer123', 'DA64W', '4x2 manual', 1, NULL, 1231231, '', '', '', 'archived');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `img` varchar(225) DEFAULT NULL,
  `tran_id` varchar(30) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `sparepart_id` int(11) DEFAULT NULL,
  `product` varchar(30) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `model` varchar(30) DEFAULT NULL,
  `engine` varchar(30) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `leftQuantity` int(11) NOT NULL,
  `details` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `cust_id`, `img`, `tran_id`, `car_id`, `sparepart_id`, `product`, `name`, `model`, `engine`, `price`, `color`, `quantity`, `leftQuantity`, `details`, `date`, `status`) VALUES
(1, 41, 'img/cars/656b37bd944168.13265376', NULL, 42, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x4 automatic', 200000, 'orange', 1, 71, 'New tires, New Hood mason\n-ASDFSAF\nASFS', NULL, 'archived'),
(2, 41, 'img/cars/65069773092563.58085892', NULL, 40, NULL, 'Transformer Minivan', 'Brand New Minivan Surplus', 'DA64V', '4x2 automatic', 260000, 'red', 1, 173, 'New All!', NULL, 'archived'),
(3, 41, 'img/products/650698ac211163.92438333', NULL, NULL, 10, 'Gas Filter', NULL, NULL, NULL, 30000, '', 2, 128, 'New arrived Stock, clean Gas filter', NULL, 'archived'),
(4, 41, 'img/products/65069a2cbf1f50.24457059', NULL, NULL, 16, 'Backlight', NULL, NULL, NULL, 2500, NULL, 5, 97, 'Second Hand Backlight for Minivan Surplus ', NULL, 'archived'),
(5, 41, 'img/products/6506992903e830.94235676', NULL, NULL, 14, 'Ignition Coil ', NULL, NULL, NULL, 5000, NULL, 1, 124, 'Brand New, New stock', NULL, 'archived'),
(6, 41, 'img/products/650698ac211163.92438333', '656d842708f5b', NULL, 10, 'Gas Filter', NULL, NULL, NULL, 30000, NULL, 2, 128, 'New arrived Stock, clean Gas filter', NULL, 'Completed'),
(7, 41, 'img/cars/656b37bd944168.13265376', '656d855d3d8ce', 42, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x4 automatic', 200000, 'ash white', 1, 71, 'New tires, New Hood mason\n-ASDFSAF\nASFS', NULL, 'Accepted'),
(8, 41, 'img/cars/656b37bd944168.13265376', '656d855d84d4f', 42, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x4 automatic', 208250, 'orange', 1, 71, 'New tires, New Hood mason\n-ASDFSAF\nASFS', NULL, 'Requirements Complete'),
(9, 41, 'img/cars/656b37bd944168.13265376', NULL, 42, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x4 automatic', 200000, 'red', 1, 71, 'New tires, New Hood mason\n-ASDFSAF\nASFS', NULL, 'archived'),
(10, 41, 'img/cars/656b37bd944168.13265376', NULL, 42, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x4 automatic', 200000, 'ash white', 1, 71, 'New tires, New Hood mason\n-ASDFSAF\nASFS', NULL, 'archived'),
(11, 41, 'img/cars/656b37bd944168.13265376', NULL, 42, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x4 automatic', 200000, 'blue', 1, 71, 'New tires, New Hood mason\n-ASDFSAF\nASFS', NULL, 'archived'),
(12, 41, 'img/products/651b91db9ecd92.18998293', NULL, NULL, 18, 'Carrier', NULL, NULL, NULL, 5000, NULL, 1, 206, 'Good Quality, Affordable, Lowest Pricee \nasfsd\nasdf\nasdfsafs\n', NULL, 'archived'),
(13, 41, 'img/products/6506a198b9dfc2.04244946', '656d842708f5b', NULL, 17, 'Universal Full Body Car Cover', NULL, NULL, NULL, 1000, NULL, 5, 88, 'Good Quality,\nBrand New', NULL, 'Completed'),
(14, 41, 'img/cars/656b37bd944168.13265376', NULL, 42, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x4 automatic', 200000, 'violet', 1, 71, 'New tires, New Hood mason\n-ASDFSAF\nASFS', NULL, 'archived'),
(15, 41, 'img/cars/65069713390895.76535660', '657364d39d532', 39, NULL, 'Transformer Minivan', 'New Painted Mazda Minivan', 'DA64V MAZDA', '4x4 manual', 225000, 'green', 1, 101, 'New paint, New brake, free headlight', NULL, 'Pending'),
(16, 41, 'img/products/650698ac211163.92438333', '656d8bc095b10', NULL, 10, 'Gas Filter', NULL, NULL, NULL, 30000, NULL, 2, 128, 'New arrived Stock, clean Gas filter', NULL, 'Declined'),
(17, 41, 'img/products/6506992903e830.94235676', '656d8bc095b10', NULL, 14, 'Ignition Coil ', NULL, NULL, NULL, 5000, NULL, 1, 124, 'Brand New, New stock', NULL, 'Declined'),
(18, 41, 'img/products/6506992903e830.94235676', '656d909ecbe32', NULL, 14, 'Ignition Coil ', NULL, NULL, NULL, 5000, NULL, 1, 124, 'Brand New, New stock', NULL, 'Requirements Complete'),
(19, 41, 'img/products/65069a2cbf1f50.24457059', '656d909ecbe32', NULL, 16, 'Backlight', NULL, NULL, NULL, 2500, NULL, 5, 97, 'Second Hand Backlight for Minivan Surplus ', NULL, 'Requirements Complete'),
(20, 41, 'img/products/650698ac211163.92438333', '656dd2c7d7427', NULL, 10, 'Gas Filter', NULL, NULL, NULL, 30000, NULL, 2, 125, 'New arrived Stock, clean Gas filter', NULL, 'Completed'),
(21, 41, 'img/products/650699c7cf1fd7.42068771', '656dd2c7d7427', NULL, 15, 'Minivan Back Chair', NULL, NULL, NULL, 1000, NULL, 3, 134, 'New, Good, Soft, Good for all', NULL, 'Completed'),
(22, 41, 'img/cars/656ef815e53bb0.39967571', '657364d3ed424', 54, NULL, 'Transformer Minivan', 'Transformer Minivan Wagon', 'DA64V', '4x4 manual', 32321, 'ash white', 1, 1, '', NULL, 'Pending'),
(23, 41, 'img/cars/650697c0d845c0.46060242', '2023-6573e8', 41, NULL, 'Transformer Minivan', 'New Arrival Minivan', 'DA64V', '4x2 manual', 230000, 'red', 1, 104, 'New tires, New Hood, NEW ALL!!', NULL, 'Pending'),
(24, 41, 'img/cars/6533c54e2a7109.28759968', '2023-6573e8', 37, NULL, 'Transformer Minivan', 'Minivan 2021 Model', 'DA64V MAZDA', '4x4 automatic', 240000, 'ash white', 1, 198, 'New All!', NULL, 'Pending'),
(25, 41, 'img/products/6506992903e830.94235676', '2023-6573e8', NULL, 14, 'Ignition Coil ', NULL, NULL, NULL, 5000, NULL, 1, 119, 'Brand New, New stock', NULL, 'Pending'),
(26, 41, 'img/products/650698ac211163.92438333', '2023-6573e8', NULL, 10, 'Gas Filter', NULL, NULL, NULL, 30000, NULL, 2, 123, 'New arrived Stock, clean Gas filter', NULL, 'Pending'),
(27, 41, 'img/cars/6533c54e2a7109.28759968', '2023-6573f0', 37, NULL, 'Transformer Minivan', 'Minivan 2021 Model', 'DA64V MAZDA', '4x4 automatic', 240000, 'ash white', 1, 198, 'New All!', NULL, 'Pending'),
(28, 41, 'img/products/650698ac211163.92438333', '2023-6573f1', NULL, 10, 'Gas Filter', NULL, NULL, NULL, 30000, NULL, 2, 123, 'New arrived Stock, clean Gas filter', NULL, 'Pending'),
(29, 41, 'img/cars/650696d1241360.37477686', '2023-6573f1', 38, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64W', '4x2 automatic', 230000, 'violet', 1, 166, 'Free Carrier, Hood', NULL, 'Pending'),
(30, 41, 'img/products/6506992903e830.94235676', '2023-6573f1', NULL, 14, 'Ignition Coil ', NULL, NULL, NULL, 5000, NULL, 1, 119, 'Brand New, New stock', NULL, 'Pending'),
(31, 41, 'img/cars/650696d1241360.37477686', '2023-6573f1', 38, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64W', '4x2 automatic', 230000, 'red', 1, 166, 'Free Carrier, Hood', NULL, 'Pending'),
(32, 41, 'img/products/650699c7cf1fd7.42068771', '2023-6573f1', NULL, 15, 'Minivan Back Chair', NULL, NULL, NULL, 1000, NULL, 2, 131, 'New, Good, Soft, Good for all', NULL, 'Pending'),
(33, 41, 'img/cars/65069773092563.58085892', '2023-6573f2', 40, NULL, 'Transformer Minivan', 'Brand New Minivan Surplus', 'DA64V', '4x2 automatic', 260000, 'blue', 1, 173, 'New All!', NULL, 'Pending'),
(34, 41, 'img/products/65069a2cbf1f50.24457059', '2023-6573f2', NULL, 16, 'Backlight', NULL, NULL, NULL, 2500, NULL, 5, 94, 'Second Hand Backlight for Minivan Surplus ', NULL, 'Pending'),
(35, 41, 'img/cars/6533c54e2a7109.28759968', '2023-6573f4', 37, NULL, 'Transformer Minivan', 'Minivan 2021 Model', 'DA64V MAZDA', '4x4 automatic', 240000, 'red', 1, 198, 'New All!', NULL, 'Pending'),
(36, 41, 'img/products/650699c7cf1fd7.42068771', '2023-6573f4', NULL, 15, 'Minivan Back Chair', NULL, NULL, NULL, 1000, NULL, 2, 131, 'New, Good, Soft, Good for all', NULL, 'Pending'),
(37, 41, 'img/cars/65069713390895.76535660', '2023-6573f4', 39, NULL, 'Transformer Minivan', 'New Painted Mazda Minivan', 'DA64V MAZDA', '4x4 manual', 225000, 'ash white', 1, 101, 'New paint, New brake, free headlight', NULL, 'Pending'),
(38, 41, 'img/products/6506992903e830.94235676', '2023-6573f4', NULL, 14, 'Ignition Coil ', NULL, NULL, NULL, 5000, NULL, 1, 119, 'Brand New, New stock', NULL, 'Pending'),
(39, 41, 'img/cars/65069713390895.76535660', '2023-6573f5', 39, NULL, 'Transformer Minivan', 'New Painted Mazda Minivan', 'DA64V MAZDA', '4x4 manual', 225000, 'blue', 1, 101, 'New paint, New brake, free headlight', NULL, 'Accepted'),
(40, 41, 'img/products/650699c7cf1fd7.42068771', '2023-6573f5', NULL, 15, 'Minivan Back Chair', NULL, NULL, NULL, 1000, NULL, 2, 131, 'New, Good, Soft, Good for all', NULL, 'Accepted'),
(41, 41, 'img/cars/650696dcbf1b89.07645031', '2023-6573f58133302', 35, NULL, 'Transformer Minivan', 'Classic Minivan', 'DA64V', '4x2 manual', 218250, 'ash white', 1, 149, 'Old Tire, New Paint', NULL, 'Completed'),
(42, 41, 'img/products/6506992903e830.94235676', '2023-6573f57dd5305', NULL, 14, 'Ignition Coil ', NULL, NULL, NULL, 5000, NULL, 1, 119, 'Brand New, New stock', NULL, 'Completed'),
(43, 41, 'img/products/6506a198b9dfc2.04244946', '2023-6576c572c17d0', NULL, 17, 'Universal Full Body Car Cover', NULL, NULL, NULL, 1000, NULL, 5, 80, 'Good Quality,\nBrand New', NULL, 'Completed'),
(44, 41, 'img/products/65069a2cbf1f50.24457059', NULL, NULL, 16, 'Backlight', NULL, NULL, NULL, 2500, NULL, 5, 94, 'Second Hand Backlight for Minivan Surplus ', NULL, 'archived'),
(45, 41, 'img/cars/65732f69acdf34.10554785', NULL, 54, NULL, 'Transformer Minivan', 'Transformer Minivan Wagon', 'DA64V', '4x4 manual', 32321, 'blue', 1, 1, '', NULL, 'archived'),
(46, NULL, 'img/products/650698ac211163.92438333', '6575acc461eed', NULL, 10, 'Gas Filter', NULL, NULL, NULL, 30000, NULL, 2, 123, 'New arrived Stock, clean Gas filter', NULL, 'Completed'),
(47, 41, 'img/cars/656c22f086de63.51155349', NULL, 53, NULL, 'Transformer Minivan', '1231231', 'DA64V', '4x2 automatic', 23300, 'ash white', 1, 1, 'asdfsdaasfsd', NULL, 'archived'),
(48, 41, 'img/cars/656c22f086de63.51155349', NULL, 53, NULL, 'Transformer Minivan', '1231231', 'DA64V', '4x2 automatic', 233, 'ash white', 1, 1, 'asdfsdaasfsd', NULL, 'archived'),
(49, 41, 'img/cars/656c22f086de63.51155349', NULL, 53, NULL, 'Transformer Minivan', '1231231', 'DA64V', '4x2 automatic', 233, 'yellow', 1, 1, 'asdfsdaasfsd', NULL, 'archived'),
(50, 41, 'img/cars/656b37bd944168.13265376', NULL, 42, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x4 automatic', 200, 'cyan', 1, 70, 'New tires, New Hood mason\n-ASDFSAF\nASFS', NULL, 'archived'),
(51, 41, 'img/cars/650697c0d845c0.46060242', NULL, 41, NULL, 'Transformer Minivan', 'New Arrival Minivan', 'DA64V', '4x2 manual', 23000000, 'blue', 1, 104, 'New tires, New Hood, NEW ALL!!', NULL, 'archived'),
(52, 41, 'img/cars/65732f69acdf34.10554785', NULL, 54, NULL, 'Transformer Minivan', 'Transformer Minivan Wagon', 'DA64V', '4x4 manual', 32, 'red', 1, 1, '', NULL, 'archived'),
(53, 41, 'img/cars/656b37bd944168.13265376', NULL, 42, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x4 automatic', 20000000, 'blue', 1, 70, 'New tires, New Hood mason\n-ASDFSAF\nASFS', NULL, 'archived'),
(54, 41, 'img/cars/65069773092563.58085892', NULL, 40, NULL, 'Transformer Minivan', 'Brand New Minivan Surplus', 'DA64V', '4x2 automatic', 26, 'ash white', 1, 173, 'New All!', NULL, 'archived'),
(55, 41, 'img/cars/656c22f086de63.51155349', NULL, 53, NULL, 'Transformer Minivan', '1231231', 'DA64V', '4x2 automatic', 233, 'blue', 1, 1, 'asdfsdaasfsd', NULL, 'archived'),
(56, 41, 'img/cars/650697c0d845c0.46060242', NULL, 41, NULL, 'Transformer Minivan', 'New Arrival Minivan', 'DA64V', '4x2 manual', 230, 'yellow', 1, 104, 'New tires, New Hood, NEW ALL!!', NULL, 'archived'),
(57, 41, 'img/cars/65069773092563.58085892', NULL, 40, NULL, 'Transformer Minivan', 'Brand New Minivan Surplus', 'DA64V', '4x2 automatic', 260, 'red', 1, 173, 'New All!', NULL, 'archived'),
(58, 41, 'img/cars/65732f69acdf34.10554785', NULL, 54, NULL, 'Transformer Minivan', 'Transformer Minivan Wagon', 'DA64V', '4x4 manual', 32321, 'ash white', 1, 1, '', NULL, 'archived'),
(59, 41, 'img/cars/656c22f086de63.51155349', NULL, 53, NULL, 'Transformer Minivan', '1231231', 'DA64V', '4x2 automatic', 233, 'orange', 1, 1, 'asdfsdaasfsd', NULL, 'archived'),
(60, 41, 'img/cars/65069773092563.58085892', NULL, 40, NULL, 'Transformer Minivan', 'Brand New Minivan Surplus', 'DA64V', '4x2 automatic', 260000, 'blue', 1, 173, 'New All!', NULL, 'archived'),
(61, 41, 'img/products/650698ac211163.92438333', '2023-6576c572c17d0', NULL, 10, 'Gas Filter', NULL, NULL, NULL, 30000, NULL, 2, 121, 'New arrived Stock, clean Gas filter', NULL, 'Completed'),
(62, 41, 'img/cars/656c2276b73940.85298524', NULL, 52, NULL, 'Transformer Minivan', 'sample12312', 'DA64V', '4x2 automatic', 23213, 'ash white', 1, 1, 'asfsad', NULL, 'archived'),
(63, 41, 'img/cars/656b37bd944168.13265376', NULL, 42, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x4 automatic', 200000, 'ash white', 1, 70, 'New tires, New Hood mason\n-ASDFSAF\nASFS', NULL, 'archived'),
(64, 41, 'img/cars/650697c0d845c0.46060242', '2023-6576c5259e48c', 41, NULL, 'Transformer Minivan', 'New Arrival Minivan', 'DA64V', '4x2 manual', 238250, 'violet', 1, 104, 'New tires, New Hood, NEW ALL!!', NULL, 'Completed'),
(65, 41, 'img/cars/65732f69acdf34.10554785', '2023-6576c5259e48c', 54, NULL, 'Transformer Minivan', 'Transformer Minivan Wagon', 'DA64V', '4x4 manual', 40571, 'blue', 1, 1, '', NULL, 'Completed'),
(66, 41, 'img/products/65069a2cbf1f50.24457059', '2023-6576c572c17d0', NULL, 16, 'Backlight', NULL, NULL, NULL, 2500, NULL, 4, 94, 'Second Hand Backlight for Minivan Surplus ', NULL, 'Completed'),
(67, 41, 'img/cars/65069713390895.76535660', '2023-6576cad5ec2e6', 39, NULL, 'Transformer Minivan', 'New Painted Mazda Minivan', 'DA64V MAZDA', '4x4 manual', 225000, 'yellow', 1, 101, 'New paint, New brake, free headlight', NULL, 'Pending'),
(68, 41, 'img/cars/65069773092563.58085892', '2023-6576cad5ec2e6', 40, NULL, 'Transformer Minivan', 'Brand New Minivan Surplus', 'DA64V', '4x2 automatic', 260000, 'violet', 1, 173, 'New All!', NULL, 'Pending'),
(69, 41, 'img/cars/65069773092563.58085892', '2023-6576cc39e8ec5', 40, NULL, 'Transformer Minivan', 'Brand New Minivan Surplus', 'DA64V', '4x2 automatic', 260000, 'blue', 1, 173, 'New All!', NULL, 'Pending'),
(70, 41, 'img/cars/650696d1241360.37477686', '2023-6576cc39e8ec5', 38, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64W', '4x2 automatic', 230000, 'ash white', 1, 166, 'Free Carrier, Hood', NULL, 'Pending'),
(71, 41, 'img/cars/65069713390895.76535660', '2023-6576cdd6be910', 39, NULL, 'Transformer Minivan', 'New Painted Mazda Minivan', 'DA64V MAZDA', '4x4 manual', 225000, 'yellow', 1, 101, 'New paint, New brake, free headlight', NULL, 'Declined'),
(72, 41, 'img/cars/6533c54e2a7109.28759968', '2023-6576cdd715cd3', 37, NULL, 'Transformer Minivan', 'Minivan 2021 Model', 'DA64V MAZDA', '4x4 automatic', 240000, 'ash white', 1, 198, 'New All!', NULL, 'Declined'),
(73, 41, 'img/cars/656b37bd944168.13265376', '2023-6580716b3ec89', 42, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x4 automatic', 208250, 'yellow', 1, 70, 'New tires, New Hood mason\n-ASDFSAF\nASFS', NULL, 'Completed'),
(74, 41, 'img/products/651b91db9ecd92.18998293', '2023-6586cb900c761', NULL, 18, 'Carrier', NULL, NULL, NULL, 5000, NULL, 1, 206, 'Good Quality, Affordable, Lowest Pricee \nasfsd\nasdf\nasdfsafs\n', NULL, 'Declined'),
(75, 41, 'img/cars/656b37bd944168.13265376', '2023-6586cc3bbe5b6', 42, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x4 automatic', 200000, 'yellow', 1, 69, 'New tires, New Hood mason\n-ASDFSAF\nASFS', NULL, 'Declined'),
(76, 41, 'img/cars/65069713390895.76535660', '2023-6586ccdfacad7', 39, NULL, 'Transformer Minivan', 'New Painted Mazda Minivan', 'DA64V MAZDA', '4x4 manual', 225000, 'ash white', 1, 101, 'New paint, New brake, free headlight', NULL, 'Completed'),
(77, 41, 'img/products/65069a2cbf1f50.24457059', '2023-6586cf0b1797c', NULL, 16, 'Backlight', NULL, NULL, NULL, 2500, NULL, 2, 90, 'Second Hand Backlight for Minivan Surplus ', NULL, 'Completed'),
(78, 41, 'img/products/6506a198b9dfc2.04244946', '2023-658d2f2a093d0', NULL, 17, 'Universal Full Body Car Cover', NULL, NULL, NULL, 1000, NULL, 5, 77, 'Good Quality,\nBrand New', NULL, 'Completed'),
(79, 41, 'img/cars/656b37bd944168.13265376', '2023-658eeee7e1f25', 42, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x4 automatic', 224750, 'blue', 1, 69, 'New tires, New Hood mason\n-ASDFSAF\nASFS', NULL, 'Order Preparing'),
(80, 41, 'img/cars/65069713390895.76535660', '2023-658eeee85ca76', 39, NULL, 'Transformer Minivan', 'New Painted Mazda Minivan', 'DA64V MAZDA', '4x4 manual', 249750, 'blue', 1, 100, 'New paint, New brake, free headlight', NULL, 'Requirements Complete'),
(81, 41, 'img/cars/650696d1241360.37477686', NULL, 38, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64W', '4x2 automatic', 230000, 'violet', 1, 166, 'Free Carrier, Hood', NULL, 'archived'),
(82, 41, 'img/products/650698ac211163.92438333', '2023-658d2f2a093d0', NULL, 10, 'Gas Filter', NULL, NULL, NULL, 30000, NULL, 2, 118, 'New arrived Stock, clean Gas filter', NULL, 'Completed'),
(83, 41, 'img/products/6506a198b9dfc2.04244946', '2023-658eef6185e76', NULL, 17, 'Universal Full Body Car Cover', NULL, NULL, NULL, 1000, NULL, 5, 77, 'Good Quality,\nBrand New', NULL, 'Pending'),
(84, 41, 'img/products/65069a2cbf1f50.24457059', '2023-658eef6185e76', NULL, 16, 'Backlight', NULL, NULL, NULL, 2500, NULL, 3, 88, 'Second Hand Backlight for Minivan Surplus ', NULL, 'Pending'),
(85, 41, 'img/products/650698ac211163.92438333', '2024-65a0a137b4c4b', NULL, 10, 'Gas Filter', NULL, NULL, NULL, 30000, NULL, 2, 118, 'New arrived Stock, clean Gas filter', NULL, 'Pending'),
(86, 41, 'img/products/6506992903e830.94235676', '2024-659bf8ffec565', NULL, 14, 'Ignition Coil ', NULL, NULL, NULL, 5000, NULL, 1, 117, 'Brand New, New stock', NULL, 'Declined'),
(87, 41, 'img/cars/656b37bd944168.13265376', NULL, 42, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x4 automatic', 200000, 'yellow', 1, 69, 'New tires, New Hood mason\n-ASDFSAF\nASFS', NULL, 'archived'),
(88, 41, 'img/cars/659bbcbf0ab967.94053874', '2024-659bf8c473827', 32, NULL, 'Transformer Minivan', 'New Model V.2', 'DA64W', '4x4 automatic', 245000, 'cyan', 1, 1, 'New chair, New Wheels\n- Transformer Minivan\n- Surplus\n- In a good condition(tuned)\n- Free Repaint\n- Complete Papers\n- 1 week process\n- Affordable\n- Good for the Family Bonding Vacation', NULL, 'Ready to Pick Up'),
(89, 41, 'img/cars/659bbc9aef7676.88161786', '2024-659c04261bb17', 35, NULL, 'Transformer Minivan', 'Classic Minivan', 'DA64V', '4x2 manual', 210000, 'red', 1, 1, 'Old Tire, Engine Tuned!\n- Transformer Minivan\n- Surplus\n- In a good condition(tuned)\n- Free Repaint\n- Complete Papers\n- 1 week process\n- Affordable\n- Good for the Family Bonding Vacation', NULL, 'Accepted'),
(90, 41, 'img/cars/659bbc4769fd56.60367771', '2024-65a0a12f8adf6', 37, NULL, 'Transformer Minivan', 'Minivan 2021 Model', 'DA64V MAZDA', '4x4 automatic', 240000, 'violet', 1, 1, '- Transformer Minivan\n- Surplus\n- In a good condition(tuned)\n- Free Repaint\n- Complete Papers\n- 1 week process\n- Affordable\n- Good for the Family Bonding Vacation', NULL, 'Accepted'),
(91, 41, 'img/cars/659bb6bd0cdae6.59530669', NULL, 42, NULL, 'Transformer Minivan', 'New Painted Suzuki Minivan', 'DA64V', '4x4 automatic', 200000, 'pink', 1, 1, '- Transformer Minivan\n- Surplus\n- In a good condition(tuned)\n- Free Repaint\n- Complete Papers\n- 1 week process\n- Affordable\n- Good for the Family Bonding Vacation', NULL, 'on cart'),
(92, 41, 'img/products/651b91db9ecd92.18998293', NULL, NULL, 18, 'Carrier', NULL, NULL, NULL, 5000, NULL, 1, 5, 'Made of a strong welded aluminum frame\nExcellent Quality Brand\nOff Road Design\nSize : 50x38 inches\nWeight : 11 kg\nClamp Type Crossbar\nEasy to Install\nScrews, Bolts And Brackets Are Included\nAerorack STICKER included 1PC ONLY\nWe recommend professional installation of the item', NULL, 'on cart');

-- --------------------------------------------------------

--
-- Table structure for table `car_rental`
--

CREATE TABLE `car_rental` (
  `rentalcar_id` int(11) NOT NULL,
  `car_img` varchar(225) DEFAULT NULL,
  `img1` varchar(225) DEFAULT NULL,
  `img2` varchar(225) DEFAULT NULL,
  `img3` varchar(225) DEFAULT NULL,
  `img4` varchar(225) DEFAULT NULL,
  `car_type` varchar(25) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `model` varchar(25) DEFAULT NULL,
  `engine` varchar(25) DEFAULT NULL,
  `used` int(11) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_rental`
--

INSERT INTO `car_rental` (`rentalcar_id`, `car_img`, `img1`, `img2`, `img3`, `img4`, `car_type`, `name`, `model`, `engine`, `used`, `details`, `status`) VALUES
(1, 'img/cars/659bc79edd3190.33365056', '', '', '', '', 'Transformer Minivan', '2022 Model Minivan', 'DA64V MAZDA', '4x4 automatic', 0, '- Transformer Minivan\r\n- Manual Transmission\r\n- Minimal Body Scratch\r\n- In a good condition(tuned)\r\n- Complete Papers\r\n- Good for the Family Bonding Vacation', 'Available'),
(2, 'img/cars/659570cd805654.30715677', '', '', '', '', 'Transformer Minivan', 'sample', 'DA64W', '4x2 manual', 0, 'sample lang\r\nni', 'archived'),
(3, 'img/cars/659bc74c56c6f5.30121141', 'img/cars/659bc74c6b8836.09549558', 'img/cars/659bc74c8c1bb6.25929741', '', '', 'Transformer Minivan', 'Transformer Minivan Wagon', 'DA64W', '4x4 manual', 0, '- Transformer Minivan\r\n- Manual Transmission\r\n- Minimal Body Scratch\r\n- In a good condition(tuned)\r\n- Complete Papers\r\n- Good for the Family Bonding Vacation', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `clientacc`
--

CREATE TABLE `clientacc` (
  `cust_id` int(11) NOT NULL,
  `validID` varchar(225) DEFAULT NULL,
  `fname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `phoneNum` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `pass` varchar(20) DEFAULT NULL,
  `acc_reason` varchar(225) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientacc`
--

INSERT INTO `clientacc` (`cust_id`, `validID`, `fname`, `lname`, `birthdate`, `address`, `phoneNum`, `email`, `username`, `pass`, `acc_reason`, `status`) VALUES
(41, 'img/validID/exampleValidID.jpg', 'Angelo', 'Malano', '2001-08-16', 'Davao Del Norte', '09106556395', 'malano.angelo@dnsc.edu.ph', 'gelo123', 'Admin@123', '', 'Verified'),
(43, 'img/validID/exampleValidID.jpg', 'Darren Kent', 'Tusias', '2023-06-16', 'Purok 3, Salvacion Panabo City', '09106556395', 'tusias.darrenkent@dnsc.edu.ph', 'Dars123', 'Dars123', '', 'Verified'),
(46, 'img/validID/exampleValidID.jpg', 'Brian', 'Caballes', '2023-02-14', 'Laguna, Luzon Street', '09106556395', 'brian_caballes@gmail.com', 'brian123', 'brian', '', 'Verified'),
(56, 'img/validID/exampleValidID.jpg', 'egoisto', 'arc', '2023-06-06', 'Purok 3, Salvacion Panabo City', '09106556395', 'tusias.darrenkent@dnsc.edu.ph', 'egoisto_arc', 'miracle', '', 'Verified'),
(59, 'img/validID/exampleValidID.jpg', 'arki', 'pagas', '2023-11-08', 'New Visayas, Panabo City', '09106556395', 'jovito.bolacoyjr@dnsc.edu.ph', 'arki123', 'admin', '', 'Verified'),
(63, 'img/validID/exampleValidID.jpg', 'The gelo', 'Test', '2023-11-30', 'Purok 3, Salvacion Panabo City', '09106556395', 'malano.angelo@dnsc.edu.ph', 'thesample123', 'admin123', '', 'Verified'),
(82, 'img/validID/exampleValidID.jpg', 'sample1', 'sample1', '3212-12-12', 'Purok 3, Salvacion Panabo City', '09106556395', 'angelo_malano@yahoo.com', 'sample123', 'Admin@123', '', 'Pending'),
(83, 'img/validID/exampleValidID.jpg', '123`', 'asdf', '2023-12-28', '1232', '09106556395', '12321', '123123', '1231232', '', 'Verified'),
(84, 'img/validID/exampleValidID.jpg', 'asdsa', 'asfasfsd', '2023-12-26', 'asd', '09106556395', 'asfasasdfsa@asdfdsaf.com', 'asfsadf', 'asfsad', '', 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `client_documents`
--

CREATE TABLE `client_documents` (
  `docu_id` int(11) NOT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `tran_id` varchar(30) DEFAULT NULL,
  `coe` varchar(225) DEFAULT NULL,
  `payslip_3m` varchar(225) DEFAULT NULL,
  `electric_bill` varchar(225) DEFAULT NULL,
  `brgy_clearance` varchar(225) DEFAULT NULL,
  `validID_1` varchar(225) DEFAULT NULL,
  `validID_2` varchar(225) DEFAULT NULL,
  `marriage_contract` varchar(225) DEFAULT NULL,
  `business_permit` varchar(225) DEFAULT NULL,
  `bankStatement_3m` varchar(225) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_documents`
--

INSERT INTO `client_documents` (`docu_id`, `cust_id`, `tran_id`, `coe`, `payslip_3m`, `electric_bill`, `brgy_clearance`, `validID_1`, `validID_2`, `marriage_contract`, `business_permit`, `bankStatement_3m`, `status`) VALUES
(1, 41, '41-654f17378051e', '', '', '', '', '', '', '', '', '', 'Ready To Pick Up'),
(2, 41, '41-654f2a498fe68', '', '', '', '', '', '', '', '', '', 'Ready To Pick Up'),
(3, 41, '41-654f35e08a579', '', '', '', '', '', '', '', '', '', 'completed'),
(4, 41, '41-654f38b52b594', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(5, 41, '41-654f3a67783fa', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(6, 41, '41-654f3d3229b7c', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(7, 41, '41-654f3e4c4d893', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(8, 41, '41-654f3e90e5f81', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(9, 41, '41-654f4000817fb', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(10, 41, '41-654f6c871018c', '', '', '', '', '', '', '', '', '', 'pending'),
(11, 41, '41-654f766fcbb1c', '', '', '', '', '', '', '', '', '', 'Completed'),
(12, 41, '41-654f78403d049', '', '', '', '', '', '', '', '', '', 'Completed'),
(13, 41, '41-655036e466eaa', '', '', '', '', '', '', '', '', '', 'Completed'),
(14, 41, '41-655229aa30f81', '', '', '', '', '', '', '', '', '', 'Ready to Pick Up'),
(15, 41, '41-65522a5b6bd4b', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(16, 41, '41-65522b03c7a20', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(17, 41, '41-65531a93db888', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(18, 41, '41-655353b59f7ba', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(19, 41, '41-655355e9844d5', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(20, 41, '41-6553567322073', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(21, 41, '41-65535b5229711', '', '', '', '', '', '', '', '', '', 'Accepted'),
(22, 41, '41-65535bce0f76d', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(23, 41, '41-65535c1c44aa9', '', '', '', '', '', '', '', '', '', 'Declined'),
(24, 41, '41-65535c719113b', '', '', '', '', '', '', '', '', '', 'Pending'),
(25, 41, '41-655360a060b1b', '', '', '', '', '', '', '', '', '', 'Accepted'),
(26, 41, '41-6553ae22a0cf1', '', '', '', '', '', '', '', '', '', 'Pending'),
(27, 41, '41-655602a054ed5', '', '', '', '', '', '', '', '', '', 'Pending'),
(28, 41, '41-65561960386f7', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(29, 41, '41-65562a4ca7cdb', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(30, 41, '41-65562c9ec47a1', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(31, 41, '41-65562d664c42d', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(32, 41, '41-65562dd5be841', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(33, 41, '41-65562e8784a73', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(34, 41, '41-65562ecda6383', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(35, 41, '41-65562f7e1d0cd', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(36, 41, '41-6556305d6b22b', '', '', '', '', '', '', '', '', '', 'Completed'),
(37, 41, '41-655631cb72c2f', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(38, 41, '41-6556349bba55d', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(39, 41, '41-6556350d3c88a', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(40, 41, '41-6556352d6af2e', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(41, 41, '41-655636e115ca8', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(42, 41, '41-6556383b98bdb', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(43, 41, '41-655639b7756ca', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(44, 41, '41-65563a4ac9de7', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(45, 41, '41-65563ad002042', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(46, 41, '41-65563b6b4b545', '', '', '', '', '', '', '', '', '', 'Completed'),
(47, 41, '41-65563bd0dee8c', '', '', '', '', '', '', '', '', '', 'Order Preparing'),
(48, 41, '41-65563c5d9558d', '', '', 'img/documents/65564904e347e5.71366823', 'img/documents/65564904e38399.27769325', 'img/documents/65564904e3bf85.09180065', 'img/documents/65564904e433c4.08366664', 'img/documents/65564904e4c714.14662482', 'img/documents/65564904e2bb69.85436572', 'img/documents/65564904e30601.16651107', 'Ready to Pick Up'),
(49, 41, '41-65564759c7088', '', '', '', '', '', '', '', '', '', 'Pending'),
(50, 41, '41-655647c85a036', '', '', '', '', '', '', '', '', '', 'Completed'),
(51, 41, '41-6556484815ff5', '', '', '', '', '', '', '', '', '', 'Declined'),
(52, 41, '41-6556c55420af8', 'img/documents/6556c6731b1cd9.29171070', 'img/documents/6556c6731de6d7.86559271', 'img/documents/6556c6731e2180.08243987', 'img/documents/6556c6731e5672.37123027', 'img/documents/6556c6731e91e4.05877259', 'img/documents/6556c6731f0051.61355104', 'img/documents/6556c6731f8f84.32853944', '', '', 'Completed'),
(53, 41, '41-6556c7c483af3', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(54, 41, '41-655b02165c1b2', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(55, 41, '41-655b3e1999361', '', '', '', '', '', '', '', '', '', 'Ready to Pick Up'),
(56, 41, '41-655cce66d9336', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(57, 41, '41-655ccf1d83483', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(58, 41, '41-655ccf9e1f1be', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(59, 41, '41-655cd0aa316b1', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(60, 41, '41-655cd1a556498', '', '', '', '', '', '', '', '', '', 'Completed'),
(61, 41, '41-655ce0fd205e8', '', '', '', '', '', '', '', '', '', 'Completed'),
(62, 41, '41-655ce978ae174', '', '', '', '', '', '', '', '', '', 'Completed'),
(63, 41, '41-655cead367408', '', '', '', '', '', '', '', '', '', 'Completed'),
(64, 41, '41-655d52bb50ade', '', '', '', '', '', '', '', '', '', 'Pending'),
(65, 41, '41-655d5800d0e4a', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(66, 41, '41-655f356f9c42a', '', '', '', '', '', '', '', '', '', 'Accepted'),
(67, 41, '41-655f59f40597a', '', '', '', '', '', '', '', '', '', 'Accepted'),
(68, 41, '41-655f629fe793e', '', '', '', '', '', '', '', '', '', 'Completed'),
(69, 63, '63-65636f09ba587', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(70, 63, '63-65641610bb096', 'img/documents/6564178101ad84.38680621', 'img/documents/656417810273c4.96221391', 'img/documents/6564178102da74.48359281', 'img/documents/65641781033d70.74062011', 'img/documents/6564178103a751.80923942', '', 'img/documents/65641781047db5.41287861', '', '', 'Requirements Complet'),
(71, 63, '63-65641f7d0bae9', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(72, 63, '63-65644763a67ad', '', '', '', '', '', '', '', '', '', 'Completed'),
(73, 41, '41-6565487c6a749', '', '', '', '', '', '', '', '', '', 'Completed'),
(74, 41, '656c809ab8a02', '', '', '', '', '', '', '', '', '', 'Pending'),
(75, 41, '656c809aef76d', '', '', '', '', '', '', '', '', '', 'Pending'),
(76, 41, '656c816239933', '', '', '', '', '', '', '', '', '', 'Pending'),
(77, 41, '656c81625746a', '', '', '', '', '', '', '', '', '', 'Pending'),
(78, 41, '656c81febffa4', '', '', '', '', '', '', '', '', '', 'Pending'),
(79, 41, '656c81ff04d8f', '', '', '', '', '', '', '', '', '', 'Pending'),
(80, 41, '656c8428b99d6', '', '', '', '', '', '', '', '', '', 'Pending'),
(81, 41, '656c8428deb91', '', '', '', '', '', '', '', '', '', 'Pending'),
(82, 41, '656c85067c4b0', '', '', '', '', '', '', '', '', '', 'Pending'),
(83, 41, '656c888376162', '', '', '', '', '', '', '', '', '', 'Accepted'),
(84, 41, '656c8d7e047f8', '', '', '', '', '', '', '', '', '', 'Accepted'),
(85, 41, '656d34375da3a', '', '', '', '', '', '', '', '', '', 'Pending'),
(86, 41, '656d34379d3b4', '', '', '', '', '', '', '', '', '', 'Pending'),
(87, 41, '656d391fdbd15', '', '', '', '', '', '', '', '', '', 'Pending'),
(88, 41, '656d842708f5b', '', '', '', '', '', '', '', '', '', 'Completed'),
(89, 41, '656d855d3d8ce', '', '', '', '', '', '', '', '', '', 'Accepted'),
(90, 41, '656d855d84d4f', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(91, 41, '656d8bc095b10', '', '', '', '', '', '', '', '', '', 'Declined'),
(92, 41, '656d909ecbe32', '', '', '', '', '', '', '', '', '', 'Requirements Complet'),
(93, 41, '656dd2c7d7427', '', '', '', '', '', '', '', '', '', 'Completed'),
(94, 41, '657364d39d532', '', '', '', '', '', '', '', '', '', 'Pending'),
(95, 41, '657364d3ed424', '', '', '', '', '', '', '', '', '', 'Pending'),
(96, 41, '2023-6573e8', '', '', '', '', '', '', '', '', '', 'Pending'),
(97, 41, '2023-6573e8', '', '', '', '', '', '', '', '', '', 'Pending'),
(98, 41, '2023-6573e8', '', '', '', '', '', '', '', '', '', 'Pending'),
(99, 41, '2023-6573f0', '', '', '', '', '', '', '', '', '', 'Pending'),
(100, 41, '2023-6573f1', '', '', '', '', '', '', '', '', '', 'Pending'),
(101, 41, '2023-6573f1', '', '', '', '', '', '', '', '', '', 'Pending'),
(102, 41, '2023-6573f1', '', '', '', '', '', '', '', '', '', 'Pending'),
(103, 41, '2023-6573f2', '', '', '', '', '', '', '', '', '', 'Pending'),
(104, 41, '2023-6573f4', '', '', '', '', '', '', '', '', '', 'Pending'),
(105, 41, '2023-6573f4', '', '', '', '', '', '', '', '', '', 'Pending'),
(106, 41, '2023-6573f5', '', '', '', '', '', '', '', '', '', 'Accepted'),
(107, 41, '2023-6573f58133302', '', '', '', '', '', '', '', '', '', 'Completed'),
(108, 41, '2023-6576c5259e48c', '', '', '', '', '', '', '', '', '', 'Completed'),
(109, 41, '2023-6576c5259e48c', '', '', '', '', '', '', '', '', '', 'Completed'),
(110, 41, '2023-6576cad5ec2e6', '', '', '', '', '', '', '', '', '', 'Pending'),
(111, 41, '2023-6576cad5ec2e6', '', '', '', '', '', '', '', '', '', 'Pending'),
(112, 41, '2023-6576cc39e8ec5', '', '', '', '', '', '', '', '', '', 'Pending'),
(113, 41, '2023-6576cc39e8ec5', '', '', '', '', '', '', '', '', '', 'Pending'),
(114, 41, '2023-6576cdd6be910', '', '', '', '', '', '', '', '', '', 'Declined'),
(115, 41, '2023-6576cdd715cd3', '', '', '', '', '', '', '', '', '', 'Declined'),
(116, 41, '2023-6580716b3ec89', '', '', '', '', '', '', '', '', '', 'Completed'),
(117, 41, '2023-6586cc3bbe5b6', '', '', '', '', '', '', '', '', '', 'Declined'),
(118, 41, '2023-6586ccdfacad7', '', '', '', '', '', '', '', '', '', 'Completed'),
(119, 41, '2023-658eeee7e1f25', '', '', '', '', '', '', '', '', '', 'Order Preparing'),
(120, 41, '2023-658eeee85ca76', '', '', '', '', '', '', '', '', '', 'Requirements Complete'),
(121, 41, '2024-659bf8c473827', '', '', '', '', '', '', '', '', '', 'Ready to Pick Up'),
(122, 41, '2024-659c04261bb17', '', '', '', '', '', '', '', '', '', 'Accepted'),
(123, 41, '2024-65a0a12f8adf6', '', '', '', '', '', '', '', '', '', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `mechanic`
--

CREATE TABLE `mechanic` (
  `mechanic_id` int(11) NOT NULL,
  `fname` varchar(25) DEFAULT NULL,
  `lname` varchar(25) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `pNum` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `user` varchar(25) DEFAULT NULL,
  `pass` varchar(25) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mechanic`
--

INSERT INTO `mechanic` (`mechanic_id`, `fname`, `lname`, `birthdate`, `pNum`, `email`, `user`, `pass`, `status`) VALUES
(16, 'Andrea', 'Plaza', '2023-07-18', '09120232323', 'angelomalano321@gmail.com', 'mechanic123', 'admin', ''),
(17, 'Angelo', 'Malano', '2023-10-20', '0912351236', 'angelomalano321@gmail.com', 'mechanic11', 'Admin@123', ''),
(18, 'Darren Kent', 'Tusias', '2023-10-10', '0923352334', 'malano.angelo@dnsc.edu.ph', 'mechanic12345', 'admin', 'archived'),
(19, 'asdfasf', 'asdfdsaf', '2023-11-15', '21312', 'malano.angelo@dnsc.edu.ph', 'mechanic123123', 'admin', 'archived'),
(20, 'asf', 'asf', '2023-11-24', '234234', 'malano.angelo@dnsc.edu.ph', 'mechanic22', 'asdfs', 'archived'),
(21, '123', '123', '0232-12-31', '12312321323', '1232', 'mec123123hanic', '123', 'archived'),
(22, 'asdf', 'asfd', '2312-12-31', '123', '12312', 'mechanic123', '123', 'archived');

-- --------------------------------------------------------

--
-- Table structure for table `mechanicdateavailable`
--

CREATE TABLE `mechanicdateavailable` (
  `date_id` int(11) NOT NULL,
  `mechanicName` varchar(25) DEFAULT NULL,
  `dateAvailable` date DEFAULT NULL,
  `sample` varchar(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notif_id` int(11) NOT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `messageTo` varchar(10) DEFAULT NULL,
  `message` varchar(225) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `transaction` varchar(10) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `saw_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notif_id`, `cust_id`, `messageTo`, `message`, `date`, `transaction`, `status`, `saw_status`) VALUES
(1, 41, '', 'The Service Request was claimed as Completed.Service ID : 49', '2023-12-23', 'service', 'Request Completed', 1),
(2, NULL, 'admin', 'The Service Request was claimed as Completed.Service ID : 49', '2023-12-23', 'service', 'Request Completed', 1),
(3, 41, '', 'The Order was Accepted. You can Visit the Shop to see your Desired Order. TXN ID : 2023-6586cf0b1797c', '2023-12-23', 'order', 'Accepted', 1),
(4, 41, '', 'The Order claims that Requirements are Complete, Order Soon to Prepare. TXN ID : 2023-6586cf0b1797c', '2023-12-23', 'order', 'Completed', 1),
(5, 41, '', 'The Order was Accepted. You can Visit the Shop to see your Desired Order. TXN ID : 2023-6586cb900c761', '2023-12-23', 'order', 'Accepted', 1),
(6, 41, '', 'The Order was Unfortunately Declined. Feel free to make a new Order. TXN ID : 2023-6586cc3bbe5b6', '2023-12-28', 'order', 'Declined', 1),
(7, 41, '', 'The Order was Unfortunately Declined. Feel free to make a new Order. TXN ID : 2023-6586cb900c761', '2023-12-28', 'order', 'Declined', 1),
(8, 41, '', 'Your Made a Service Request, Please Wait for the Confirmation.', '2023-12-28', 'service', 'Pending', 1),
(9, NULL, 'admin', 'A New Service Request has been Made.', '2023-12-28', 'service', 'Pending', 1),
(10, 41, '', 'Your Made a Service Request, Please Wait for the Confirmation.', '2023-12-28', 'service', 'Pending', 1),
(11, NULL, 'admin', 'A New Service Request has been Made.', '2023-12-28', 'service', 'Pending', 1),
(12, 41, '', 'Your Made a Service Request, Please Wait for the Confirmation.', '2023-12-28', 'service', 'Pending', 1),
(13, NULL, 'admin', 'A New Service Request has been Made.', '2023-12-28', 'service', 'Pending', 1),
(14, 41, '', 'Your Made a Service Request, Please Wait for the Confirmation.', '2023-12-28', 'service', 'Pending', 1),
(15, NULL, 'admin', 'A New Service Request has been Made.', '2023-12-28', 'service', 'Pending', 1),
(16, NULL, 'admin', 'A New Service Request has been Made', '0000-00-00', 'service', 'Pending', 1),
(17, NULL, 'admin', 'A New Service Request has been Made', '0000-00-00', 'service', 'Pending', 1),
(18, 41, '', 'You Made an Order, Please Wait for the Confirmation.', '2023-12-28', 'order', 'Pending', 1),
(19, NULL, 'admin', 'A New Order has been Made.', '2023-12-28', 'order', 'Pending', 1),
(20, NULL, 'staff', 'A New Order has been Made.', '2023-12-28', 'order', 'Pending', 0),
(21, 41, '', 'The Order was Accepted. You can Visit the Shop to see your Desired Order. TXN ID : 2023-658d2f2a093d0', '2023-12-28', 'order', 'Accepted', 1),
(22, 41, '', 'You Made an Order, Please Wait for the Confirmation.', '2023-12-29', 'order', 'Pending', 1),
(23, NULL, 'admin', 'A New Order has been Made.', '2023-12-29', 'order', 'Pending', 1),
(24, NULL, 'staff', 'A New Order has been Made.', '2023-12-29', 'order', 'Pending', 0),
(25, 41, '', 'You Made an Order, Please Wait for the Confirmation.', '2023-12-29', 'order', 'Pending', 1),
(26, NULL, 'admin', 'A New Order has been Made.', '2023-12-29', 'order', 'Pending', 1),
(27, NULL, 'staff', 'A New Order has been Made.', '2023-12-29', 'order', 'Pending', 0),
(28, 41, '', 'You Made a Car Rent Request, Please Wait for the Confirmation.', '2024-01-05', 'rent', 'Pending', 1),
(29, NULL, 'admin', 'A New Car Rent Request has been Made.', '2024-01-05', 'rent', 'Pending', 1),
(30, NULL, 'staff', 'A New Car Rent Request has been Made.', '2024-01-05', 'rent', 'Pending', 0),
(31, 41, '', 'You Made a Car Rent Request, Please Wait for the Confirmation.', '2024-01-05', 'rent', 'Pending', 1),
(32, NULL, 'admin', 'A New Car Rent Request has been Made.', '2024-01-05', 'rent', 'Pending', 1),
(33, NULL, 'staff', 'A New Car Rent Request has been Made.', '2024-01-05', 'rent', 'Pending', 0),
(34, 41, '', 'You Made a Car Rent Request, Please Wait for the Confirmation.', '2024-01-05', 'rent', 'Pending', 1),
(35, NULL, 'admin', 'A New Car Rent Request has been Made.', '2024-01-05', 'rent', 'Pending', 1),
(36, NULL, 'staff', 'A New Car Rent Request has been Made.', '2024-01-05', 'rent', 'Pending', 0),
(37, 41, '', 'You Made a Car Rent Request, Please Wait for the Confirmation.', '2024-01-05', 'rent', 'Pending', 1),
(38, NULL, 'admin', 'A New Car Rent Request has been Made.', '2024-01-05', 'rent', 'Pending', 1),
(39, NULL, 'staff', 'A New Car Rent Request has been Made.', '2024-01-05', 'rent', 'Pending', 0),
(40, 41, '', 'You Made a Car Rent Request, Please Wait for the Confirmation.', '2024-01-05', 'rent', 'Pending', 1),
(41, NULL, 'admin', 'A New Car Rent Request has been Made.', '2024-01-05', 'rent', 'Pending', 1),
(42, NULL, 'staff', 'A New Car Rent Request has been Made.', '2024-01-05', 'rent', 'Pending', 0),
(43, 41, '', 'The Order was Accepted. You can Visit the Shop to see your Desired Order. TXN ID : 2023-658eeee7e1f25', '2024-01-07', 'order', 'Accepted', 1),
(44, 41, '', 'The Order claims that Requirements are Complete, Order Soon to Prepare. TXN ID : 2023-658eeee7e1f25', '2024-01-07', 'order', 'Requirements Complete', 1),
(45, 41, '', 'The Order claims that Requirements are Complete, Order Soon to Prepare. TXN ID : 2023-658d2f2a093d0', '2024-01-07', 'order', 'Completed', 1),
(46, 41, '', 'The Order was Accepted. You can Visit the Shop to see your Desired Order. TXN ID : 2023-658eeee85ca76', '2024-01-07', 'order', 'Accepted', 1),
(47, 41, '', 'The Order claims that Requirements are Complete, Order Soon to Prepare. TXN ID : 2023-658eeee85ca76', '2024-01-07', 'order', 'Requirements Complete', 1),
(48, 41, '', 'The Order claims that Requirements are Complete, Order Soon to Prepare. TXN ID : 2023-658eeee85ca76', '2024-01-07', 'order', 'Requirements Complete', 1),
(49, 41, '', 'The Order claims that Requirements are Complete, Order Soon to Prepare. TXN ID : 2023-658eeee7e1f25', '2024-01-07', 'order', 'Requirements Complete', 1),
(50, 41, '', 'The Order claims that Requirements are Complete, Order Soon to Prepare. TXN ID : 2023-658eeee7e1f25', '2024-01-07', 'order', 'Requirements Complete', 1),
(51, 41, '', 'The Order claims that Requirements are Complete, Order Soon to Prepare. TXN ID : 2023-658eeee85ca76', '2024-01-07', 'order', 'Requirements Complete', 1),
(52, 41, '', 'You Made an Order, Please Wait for the Confirmation.', '2024-01-08', 'order', 'Pending', 1),
(53, NULL, 'admin', 'A New Order has been Made.', '2024-01-08', 'order', 'Pending', 1),
(54, NULL, 'staff', 'A New Order has been Made.', '2024-01-08', 'order', 'Pending', 0),
(55, 41, '', 'You Made an Order, Please Wait for the Confirmation.', '2024-01-08', 'order', 'Pending', 1),
(56, NULL, 'admin', 'A New Order has been Made.', '2024-01-08', 'order', 'Pending', 1),
(57, NULL, 'staff', 'A New Order has been Made.', '2024-01-08', 'order', 'Pending', 0),
(58, 41, '', 'The Order was Accepted. You can Visit the Shop to see your Desired Order. TXN ID : 2024-659bf8c473827', '2024-01-08', 'order', 'Accepted', 1),
(59, 41, '', 'The Order claims that Requirements are Complete, Order Soon to Prepare. TXN ID : 2024-659bf8c473827', '2024-01-08', 'order', 'Requirements Complete', 1),
(60, 41, '', 'TXN ID : 2024-659bf8c473827. This Order was Preparing.', '2024-01-08', 'order', 'Order Preparing', 1),
(61, 41, '', 'The Order is Ready To Pick Up. Go to the store and get your item. TXN ID : 2024-659bf8c473827', '2024-01-08', 'order', 'Ready to Pick Up', 1),
(62, NULL, 'admin', 'The Order is Ready To Pick Up. The Client was Informed to Get the Order. TXN ID : 2024-659bf8c473827', '2024-01-08', 'order', 'Ready to Pick Up', 1),
(63, NULL, 'staff', 'The Order is Ready To Pick Up. The Client was Informed to Get the Order. TXN ID : 2024-659bf8c473827', '2024-01-08', 'order', 'Ready to Pick Up', 0),
(64, 41, '', 'Your Made a Service Request, Please Wait for the Confirmation.', '2024-01-08', 'service', 'Pending', 1),
(65, NULL, 'admin', 'A New Service Request has been Made.', '2024-01-08', 'service', 'Pending', 1),
(66, 41, '', 'The Order was Unfortunately Declined. Feel free to make a new Order. TXN ID : 2024-659bf8ffec565', '2024-01-08', 'order', 'Declined', 1),
(67, 41, '', 'The Service was Unfortunately Declined. Feel free to make a new Request. Request ID: 67', '2024-01-08', 'service', 'Declined', 1),
(68, 41, '', 'Your Made a Service Request, Please Wait for the Confirmation.', '2024-01-08', 'service', 'Pending', 1),
(69, NULL, 'admin', 'A New Service Request has been Made.', '2024-01-08', 'service', 'Pending', 1),
(70, 41, '', 'The Service was Unfortunately Declined. Feel free to make a new Request. Request ID: 68', '2024-01-08', 'service', 'Declined', 1),
(71, 41, '', 'Your Made a Service Request, Please Wait for the Confirmation.', '2024-01-08', 'service', 'Pending', 1),
(72, NULL, 'admin', 'A New Service Request has been Made.', '2024-01-08', 'service', 'Pending', 1),
(73, 41, '', 'The Service Request Was Approved, You can Go on our Shop At The Date of 01-24-2024 You are Choosen. Request ID : 69', '2024-01-08', 'service', 'Approved', 1),
(74, NULL, 'mechanic', 'A New Approved Service Request has been Made. Request ID : 69', '2024-01-08', 'service', 'Approved', 1),
(75, 41, '', 'The Service Request was claimed as Completed.Service ID : 69', '2024-01-08', 'service', 'Request Completed', 1),
(76, NULL, 'admin', 'The Service Request was claimed as Completed.Service ID : 69', '2024-01-08', 'service', 'Request Completed', 1),
(77, 41, '', 'You Made an Order, Please Wait for the Confirmation.', '2024-01-08', 'order', 'Pending', 1),
(78, NULL, 'admin', 'A New Order has been Made.', '2024-01-08', 'order', 'Pending', 1),
(79, NULL, 'staff', 'A New Order has been Made.', '2024-01-08', 'order', 'Pending', 0),
(80, 41, '', 'The Order was Accepted. You can Visit the Shop to see your Desired Order. TXN ID : 2024-659c04261bb17', '2024-01-08', 'order', 'Accepted', 1),
(81, 41, '', 'The Order was Accepted. You can Visit the Shop to see your Desired Order. TXN ID : 2024-659c04261bb17', '2024-01-08', 'order', 'Accepted', 1),
(82, 41, '', 'The Order was Accepted. You can Visit the Shop to see your Desired Order. TXN ID : 2024-659c04261bb17', '2024-01-09', 'order', 'Accepted', 1),
(83, 41, '', 'The Service Request Was Approved, You can Go on our Shop At The Date of 12-29-2023 You are Choosen. Request ID : 62', '2024-01-09', 'service', 'Approved', 1),
(84, NULL, 'mechanic', 'A New Approved Service Request has been Made. Request ID : 62', '2024-01-09', 'service', 'Approved', 1),
(85, 41, '', 'You Made an Order, Please Wait for the Confirmation.', '2024-01-12', 'order', 'Pending', 1),
(86, NULL, 'admin', 'A New Order has been Made.', '2024-01-12', 'order', 'Pending', 1),
(87, NULL, 'staff', 'A New Order has been Made.', '2024-01-12', 'order', 'Pending', 0),
(88, 41, '', 'You Made an Order, Please Wait for the Confirmation.', '2024-01-12', 'order', 'Pending', 1),
(89, NULL, 'admin', 'A New Order has been Made.', '2024-01-12', 'order', 'Pending', 1),
(90, NULL, 'staff', 'A New Order has been Made.', '2024-01-12', 'order', 'Pending', 0),
(91, 41, '', 'Transaction ID : 2023-658eeee7e1f25. This Order was Preparing.', '2024-01-15', 'order', 'Order Preparing', 1),
(92, 41, '', 'Your Made a Service Request, Please Wait for the Confirmation.', '2024-01-21', 'service', 'Pending', 0),
(93, NULL, 'admin', 'A New Service Request has been Made.', '2024-01-21', 'service', 'Pending', 0),
(94, 41, '', 'Your Made a Service Request, Please Wait for the Confirmation.', '2024-01-21', 'service', 'Pending', 0),
(95, NULL, 'admin', 'A New Service Request has been Made.', '2024-01-21', 'service', 'Pending', 0),
(96, 41, '', 'Your Made a Service Request, Please Wait for the Confirmation.', '2024-01-21', 'service', 'Pending', 0),
(97, NULL, 'admin', 'A New Service Request has been Made.', '2024-01-21', 'service', 'Pending', 0),
(98, 41, '', 'The Order was Accepted. You can Visit the Shop to see your Desired Order. Transaction ID : 2024-65a0a12f8adf6', '2024-01-22', 'order', 'Accepted', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `customerName` varchar(30) DEFAULT NULL,
  `tran_id` varchar(30) DEFAULT NULL,
  `totalprice` double DEFAULT NULL,
  `payment_term` varchar(30) DEFAULT NULL,
  `payment_mode` varchar(20) DEFAULT NULL,
  `reference_number` varchar(20) DEFAULT NULL,
  `screenshot` varchar(225) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `noAccEmail` varchar(30) DEFAULT NULL,
  `transaction_type` varchar(30) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `cust_id`, `customerName`, `tran_id`, `totalprice`, `payment_term`, `payment_mode`, `reference_number`, `screenshot`, `date`, `noAccEmail`, `transaction_type`, `status`) VALUES
(1, 41, 'Angelo Malano', '2023-6580716b3ec89', 208250, 'For Finance', '', '', NULL, '2023-12-19', '', 'car', 'Completed'),
(2, 41, 'Angelo Malano', '2023-6586cb900c761', 15000, NULL, NULL, NULL, NULL, '2023-12-23', '', 'sparepart', 'Declined'),
(3, 41, 'Angelo Malano', '2023-6586cc3bbe5b6', 200000, NULL, NULL, NULL, NULL, '2023-12-23', '', 'car', 'Declined'),
(4, 41, 'Angelo Malano', '2023-6586ccdfacad7', 225000, 'Fully Paid', 'Cash', '', NULL, '2023-12-23', '', 'car', 'Completed'),
(5, 41, 'Angelo Malano', '2023-6586cf0b1797c', 5000, 'Fully Paid', 'Cash', '', NULL, '2023-12-23', '', 'sparepart', 'Completed'),
(6, 41, 'Angelo Malano', '2023-658d2f2a093d0', 91000, 'Fully Paid', 'Cash', '', NULL, '2024-01-08', '', 'sparepart', 'Completed'),
(7, 41, 'Angelo Malano', '2023-658eeee7e1f25', 224750, 'For Finance', '', '', NULL, '2024-01-08', '', 'car', 'Order Preparing'),
(8, 41, 'Angelo Malano', '2023-658eeee85ca76', 249750, 'For Finance', '', '', NULL, '2024-01-08', '', 'car', 'Requirements Complete'),
(9, 41, 'Angelo Malano', '2023-658eef6185e76', 12500, NULL, NULL, NULL, NULL, '2023-12-29', '', 'sparepart', 'Canceled'),
(10, 41, 'Angelo Malano', '2024-659bf8c473827', 245000, 'Fully Paid', 'Gcash', 'RN: 1122334', 'img/screenshots/659bfe2152d4f8.67545978', '2024-01-08', '', 'car', 'Ready to Pick Up'),
(11, 41, 'Angelo Malano', '2024-659bf8ffec565', 5000, NULL, NULL, NULL, NULL, '2024-01-08', '', 'sparepart', 'Declined'),
(12, 41, 'Angelo Malano', '2024-659c04261bb17', 210000, NULL, NULL, NULL, NULL, '2024-01-08', '', 'car', 'Accepted'),
(13, 41, 'Angelo Malano', '2024-65a0a12f8adf6', 240000, NULL, NULL, NULL, NULL, '2024-01-12', '', 'car', 'Accepted'),
(14, 41, 'Angelo Malano', '2024-65a0a137b4c4b', 60000, NULL, NULL, NULL, NULL, '2024-01-12', '', 'sparepart', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `paints`
--

CREATE TABLE `paints` (
  `paint_id` int(11) NOT NULL,
  `img` varchar(225) DEFAULT NULL,
  `paint_color` varchar(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `sold` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paints`
--

INSERT INTO `paints` (`paint_id`, `img`, `paint_color`, `quantity`, `sold`, `status`) VALUES
(1, 'img/paints/655d0ae3492387.07707165', 'gold', 20, 2, ''),
(2, 'img/paints/655d0a7fdb00a5.29104141', 'blue', 20, 17, ''),
(3, 'img/paints/655d0a708f0269.46227479', 'yellow', 20, 7, ''),
(6, 'img/paints/655d0a54d53474.86118883', 'red', 20, 3, ''),
(7, 'img/paints/655d0a47e51375.51451369', 'midnight black', 20, 9, ''),
(8, 'img/paints/655d0a3142fcc9.11564407', 'pearl white', 20, 1, 'archived'),
(14, 'img/paints/653aa122c442e9.42876932', 'sample', 20, 0, 'archived'),
(16, 'img/paints/655d0c1f04fca2.27689067', 'orange', 20, 2, ''),
(17, 'img/paints/655d0b3946dd99.78305070', 'pink', 20, 2, ''),
(18, 'img/paints/655d0b5777ab65.97180308', 'purple', 20, 0, ''),
(19, 'img/paints/655d0b6be0c210.27998834', 'violet', 20, 1, ''),
(20, 'img/paints/655d0b7ddcc9f6.78483708', 'green', 20, 2, ''),
(21, 'img/paints/655d0b8b92e345.47256270', 'cyan', 20, 2, ''),
(22, 'img/paints/655d0baa0bcba6.58074410', 'ash white', 20, 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `rent_transactions`
--

CREATE TABLE `rent_transactions` (
  `rent_id` int(11) NOT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `rentalcar_id` int(11) DEFAULT NULL,
  `rentTimeType` varchar(50) DEFAULT NULL,
  `rentTime` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `driver_license` varchar(225) DEFAULT NULL,
  `government_id` varchar(225) DEFAULT NULL,
  `address_proof` varchar(225) DEFAULT NULL,
  `downpayment` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rent_transactions`
--

INSERT INTO `rent_transactions` (`rent_id`, `cust_id`, `rentalcar_id`, `rentTimeType`, `rentTime`, `price`, `driver_license`, `government_id`, `address_proof`, `downpayment`, `date`, `status`) VALUES
(2, 41, 1, 'Hour', 12, 600, 'img/rent_documents/659c03242de998.37154456', 'img/rent_documents/659c03242e1cc1.46821765', 'img/rent_documents/659c03242e43b6.06309005', 600, '2024-01-08', 'Rent Completed'),
(3, 41, 1, 'Day', 2, 0, '', '', '', 0, '2024-01-05', 'Declined'),
(4, 41, 3, 'Hour/s', 6, 0, '', '', '', 0, '2024-01-05', 'Accepted'),
(5, 41, 1, 'Hour/s', 4, 1000, 'img/documents/65996ec095c2c8.96832558', 'img/documents/65996ec09631a9.77279180', 'img/documents/65996ec096a151.04319380', 500, '2024-01-06', 'Rent Completed'),
(6, 41, 1, 'Hour/s', 1, 0, '', '', '', 0, '2024-01-05', 'Canceled'),
(7, 41, 1, 'Hour/s', 12, 0, '', '', '', 0, '2024-01-05', 'Canceled');

-- --------------------------------------------------------

--
-- Table structure for table `request_services`
--

CREATE TABLE `request_services` (
  `request_id` int(11) NOT NULL,
  `mechanic_id` int(11) DEFAULT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `cust_name` varchar(50) DEFAULT NULL,
  `cust_email` varchar(30) DEFAULT NULL,
  `cust_num` int(11) DEFAULT NULL,
  `request` varchar(255) DEFAULT NULL,
  `vehicleType` varchar(30) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `price_reason` varchar(225) DEFAULT NULL,
  `dateSelected` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `paintColor` varchar(30) DEFAULT NULL,
  `tintColor` varchar(30) DEFAULT NULL,
  `req_groupID` varchar(100) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_services`
--

INSERT INTO `request_services` (`request_id`, `mechanic_id`, `cust_id`, `cust_name`, `cust_email`, `cust_num`, `request`, `vehicleType`, `details`, `price`, `price_reason`, `dateSelected`, `date`, `paintColor`, `tintColor`, `req_groupID`, `status`) VALUES
(1, 17, NULL, 'Gelo Last', 'angelomalano321@gmail.com', 0, 'Maintenance', 'Van', 'wala lang\n- ambot oyy\n- test', 3123, 'asfasdfsad\nasfsad\nasf\nasf\nasdf\n', '2023-11-23', '2023-11-15', NULL, NULL, NULL, 'Request Completed'),
(2, 17, 41, 'Angelo Malano', '', 0, 'Repaint', 'Pick Up Truck', '-test \n-test\n-testpaper', 12312, 'asfsdaf', '2023-10-30', '2023-10-15', NULL, NULL, NULL, 'Request Completed'),
(3, 17, NULL, 'Gelo Last', 'angelomalano321@gmail.com', 0, 'Overhaul', 'Sedan', 'sdfsafsaf\nasfsda', 23123, '1232 asfsda', '2023-11-30', '2023-10-15', NULL, NULL, NULL, 'Request Completed'),
(4, 17, NULL, 'Gelo Malano', 'angelomalano321@gmail.com', 0, 'Repaint', 'Pick Up Truck', 'asfsa\nasf\nasdf\nasfd\nasfd\ntset', 123, 'asfsadfas\nasfas \nasfs', '2023-11-23', '2023-09-15', NULL, NULL, NULL, 'Request Completed'),
(5, 17, 41, 'Angelo Malano', '', 0, 'Maintenance', 'Pick Up Truck', '', 43213, 'asdfs321\n-asfad\nasfs 123', '2023-11-28', '2023-10-15', NULL, NULL, NULL, 'Request Completed'),
(6, 0, 41, 'Angelo Malano', '', 0, 'Repair', 'Coupe', 'asfdsa', 0, '', '2023-11-23', '2023-10-15', NULL, NULL, NULL, 'Pending'),
(7, 0, 41, 'Angelo Malano', '', 0, 'Battery Replacement', 'Sedan', '', 0, '', '2023-11-29', '2023-10-15', NULL, NULL, NULL, 'Pending'),
(8, 0, NULL, 'asfsaf', 'asfsf', 0, 'Overhaul', 'Hatchback', 'asfsa', 0, '', '2023-11-29', '2023-10-15', NULL, NULL, NULL, 'Pending'),
(9, 0, NULL, 'afsda', 'asfas', 0, 'Change Air Filter', 'Motorcycle', 'asfas', 0, '', '2023-11-30', '2023-11-16', NULL, NULL, NULL, 'Pending'),
(10, 0, NULL, 'asf', 'asfafd', 0, 'Overhaul', 'Motorcycle', 'asf', 0, '', '2023-11-25', '2023-11-16', NULL, NULL, NULL, 'Pending'),
(11, 17, NULL, '1231232', 'asfsafsad', 0, 'Change Tire', 'Hatchback', 'asfs\nasfs\n asdf\n as\ndf-\n=asf\n-asfsda\nasf', 131254, 'asfsaf\nasfs\nasdf=\n=asfd\n- asf\n=asdf\ndf', '2023-11-22', '2023-11-16', NULL, NULL, NULL, 'Request Completed'),
(12, 17, NULL, 'asfsadf', 'asfsd', 0, 'Overhaul', 'Coupe', 'asfsdf', 33123, 'asfsd\nsafsd', '2023-11-30', '2023-11-16', NULL, NULL, NULL, 'Request Completed'),
(13, 0, NULL, 'Gelo Last', 'asdf', 0, 'Change Air Filter', 'Motorcycle', 'asf', 0, '', '2023-11-28', '2023-11-16', NULL, NULL, NULL, 'Pending'),
(14, 0, NULL, 'asdf', 'asf', 0, 'Change Tire', 'Motorcycle', 'asfsd', 0, '', '2023-11-28', '2023-11-16', NULL, NULL, NULL, 'Pending'),
(15, 0, NULL, 'asdf', 'asf', 0, 'Change Air Filter', 'Motorcycle', 'asdf', 0, '', '2023-11-18', '2023-11-16', NULL, NULL, NULL, 'Pending'),
(16, 0, NULL, 'asdf', 'asdf', 0, 'Change Air Filter', 'Motorcycle', '', 0, '', '2023-11-18', '2023-11-16', NULL, NULL, NULL, 'Pending'),
(17, 17, NULL, 'asdf', 'asf', 0, 'Change Air Filter', 'Motorcycle', 'asdf', 23213, ' asjfas asjf sdlk\n-af  123\n-34 -asfsa\nasdf', '2023-11-25', '2023-11-16', NULL, NULL, NULL, 'Request Completed'),
(18, 0, NULL, 'asf', 'asfsdf', 0, 'Overhaul', 'Scooter', '', 0, '', '2023-11-30', '2023-11-16', NULL, NULL, NULL, 'Pending'),
(19, 0, NULL, 'asf', 'asfsaf', 0, 'Change Oil', 'Coupe', '', 0, '', '2023-11-23', '2023-11-16', NULL, NULL, NULL, 'Pending'),
(20, 0, 41, 'Angelo Malano', '', 0, 'Change Tire', 'Sedan', '', 0, '', '2023-11-23', '2023-11-16', NULL, NULL, NULL, 'Canceled'),
(21, 0, NULL, 'Gelo sample', 'malano.angelo@dnsc.edu.ph', 0, 'Change Tire', 'Motorcycle', 'guba buslot', 0, '', '2023-11-24', '2023-11-17', NULL, NULL, NULL, 'Declined'),
(22, 17, 41, 'Angelo Malano', '', 0, 'Battery Replacement', 'SUV', 'asfsa saf sf sf sd d\nsaf sfd\n asfd', 3000, '- tire big 2000\n- chain 1000', '2023-11-30', '2023-11-17', NULL, NULL, NULL, 'Request Completed'),
(23, 17, 41, 'Angelo Malano', '', 0, 'Change Air Filter', 'Coupe', '', 21222, '-asfs\n-asdf sa\n-asdf as', '2023-11-23', '2023-11-21', NULL, NULL, NULL, 'Request Completed'),
(24, 17, NULL, 'Gelo Malano', 'angelomalano321@gmail.com', 0, 'Change Air Filter', 'Scooter', '12313', 0, '', '2023-11-30', '2023-11-23', NULL, NULL, NULL, 'Declined'),
(25, 0, 41, 'Angelo Malano', '', 0, 'Battery Replacement', 'Pick Up Truck', '', 0, '', '2023-11-28', '2023-11-26', NULL, NULL, NULL, 'Declined'),
(26, 17, NULL, 'Gelo Malano', 'angelomalano321@gmail.com', 0, 'Change Oil', 'Coupe', '1231', 0, '', '2023-11-29', '2023-11-26', NULL, NULL, NULL, 'Declined'),
(27, 17, NULL, 'Gelo Malano', 'malano.angelo@dnsc.edu.ph', 0, 'Change Oil', 'Coupe', '', 0, '', '2023-12-06', '2023-11-26', NULL, NULL, NULL, 'Declined'),
(28, 0, 41, 'Angelo Malano', '', 0, 'Overhaul', 'Hatchback', '', 0, '', '2023-12-06', '2023-11-26', NULL, NULL, NULL, 'Declined'),
(29, 0, NULL, 'Gelo Malano', 'angelomalano321@gmail.com', 0, 'Change Oil', 'Scooter', '', 0, '', '2023-12-07', '2023-11-26', NULL, NULL, NULL, 'Declined'),
(30, 0, NULL, 'gelo dumb', 'angelomalano321@gmail.com', 0, 'Change Tire', 'Coupe', '', 0, '', '2023-11-30', '2023-11-26', NULL, NULL, NULL, 'Declined'),
(31, 17, NULL, 'Gelo Malano', 'angelomalano321@gmail.com', 0, 'Change Oil', 'Scooter', '', 44323, '- tire 85321', '2023-11-30', '2023-11-27', NULL, NULL, NULL, 'Request Completed'),
(32, 17, 63, 'The Gelo Test', '', 0, 'Change Oil', 'Hatchback', '', 2343, 'asfd asf \nasfd', '2023-11-28', '2023-11-27', NULL, NULL, NULL, 'Request Completed'),
(33, 17, NULL, 'Gelo Malano', 'malano.angelo@dnsc.edu.ph', 0, 'Tint', 'Scooter', 'gubaa oy ', 0, '', '2023-12-01', '2023-11-30', NULL, NULL, NULL, 'Declined'),
(34, 17, NULL, 'Gelo Malano', 'malano.angelo@dnsc.edu.ph', 0, 'Accessories', 'Motorcycle', '', 34122, 'asfdsa\nasdfsadf\nasdf\nsadf\n', '2023-12-08', '2023-11-30', NULL, NULL, NULL, 'Request Completed'),
(35, 0, 41, 'Angelo Malano', '', 0, 'Top Overhaul', 'Motorcycle', '', 0, '', '2023-12-11', '2023-12-07', NULL, NULL, NULL, 'Pending'),
(36, 0, 41, 'Angelo Malano', '', 0, 'Tint', 'Van', '', 0, '', '2023-12-20', '2023-12-07', NULL, NULL, '6571ec1b11d94', 'Pending'),
(37, 0, 41, 'Angelo Malano', '', 0, 'Alarm', 'Minivan', '', 0, '', '2023-12-21', '2023-12-07', NULL, NULL, '6571ec1b11d94', 'Pending'),
(38, 0, 41, 'Angelo Malano', '', 0, 'Tint', 'Scooter', 'sample2', 0, '', '2024-01-02', '2023-12-07', NULL, NULL, '6571f163a9aa9', 'Pending'),
(39, 0, 41, 'Angelo Malano', '', 0, 'Accessories', 'Minivan', 'samle123213\nasfasd\n- guba sir', 0, '', '2024-01-03', '2023-12-07', NULL, NULL, '6571f163a9aa9', 'Pending'),
(40, 0, 41, 'Angelo Malano', '', 0, 'PMS Change Oil', 'SUV', 'asdf', 0, '', '2023-12-29', '2023-12-07', NULL, NULL, '6571f163a9aa9', 'Canceled'),
(41, 0, 41, 'Angelo Malano', '', 0, 'Alarm', 'Hatchback', 'first', 0, '', '2023-12-20', '2023-12-07', NULL, NULL, '6571f81b2c636', 'Pending'),
(42, 0, 41, 'Angelo Malano', '', 0, 'ATF Dialysis', 'Sedan', 'check', 0, '', '2023-12-29', '2023-12-07', NULL, NULL, '6571f81b2c636', 'Pending'),
(43, 0, 41, 'Angelo Malano', '', 0, 'Brakes', 'SUV', 'nayys', 0, '', '2023-12-27', '2023-12-07', NULL, NULL, '6571f81b2c636', 'Pending'),
(44, 17, 41, 'Angelo Malano', '', 0, 'Power Lock', 'Scooter', 'last', 0, '', '2023-12-27', '2023-12-07', NULL, NULL, '6571f81b2c636', 'Approved'),
(45, 17, 41, 'Angelo Malano', '', 0, 'Array', 'Hatchback', '', 0, '', '2023-12-29', '2023-12-08', NULL, NULL, '6572ba483f901', 'Approved'),
(46, 17, 41, 'Angelo Malano', '', 0, 'Array', 'Pick Up Truck', 'sample2', 0, '', '2023-12-30', '2023-12-08', NULL, NULL, '6572ba483f901', 'Approved'),
(47, 17, 41, 'Angelo Malano', '', 0, 'Top Overhaul, Transmissio', 'Pick Up Truck', '', 0, '', '2023-12-27', '2023-12-08', NULL, NULL, '6572bbb1a3137', 'Approved'),
(48, 17, 41, 'Angelo Malano', '', 0, 'ATF Dialysis, PMS Change ', 'Minivan', '', 0, '', '2023-12-31', '2023-12-08', NULL, NULL, '6572bbfc9a833', 'Approved'),
(49, 17, 41, 'Angelo Malano', '', 0, 'PMS Change Oil, Alarm, Accessories, Tint, Aircon, ATF Dialysis', 'Coupe', 'asfsfsa', 122323, 'asfsadf', '2023-12-21', '2022-01-12', NULL, NULL, '6576f278a0e4f', 'Request Completed'),
(50, 17, 41, 'Angelo Malano', '', 0, 'Tint, Aircon, ATF Dialysis', 'SUV', '', 123231, '- daghan kaayo ug guba\n- perti jud', '2023-12-13', '2022-01-12', NULL, NULL, '6576f278a0e4f', 'Request Completed'),
(51, 17, 41, 'Angelo Malano', '', 0, 'ATF Dialysis, Transmission, Repaint, Underchassis, Tint, Accessories', 'Sedan', '', 10000, '- ambot unsay giba ni gana raman siayg kalit', '2023-12-18', '2022-01-12', 'red', '', '657ab2564f797', 'Request Completed'),
(52, 17, 41, 'Angelo Malano', '', 0, 'Underchassis, Tint, Accessories', 'Hatchback', '', 1231223, 'asfsdfa', '2023-12-19', '2022-01-12', '', 'gold', '657ab2564f797', 'Request Completed'),
(53, 0, 41, 'Angelo Malano', '', 0, 'PMS Change Oil, ATF Dialysis, Transmission, Reface', 'Coupe', 'first', 0, '', '2024-01-04', '2023-12-28', '', '', '658cfbd1e6224', 'Pending'),
(54, 0, 41, 'Angelo Malano', '', 0, 'Transmission, Reface', 'Motorcycle', 'second', 0, '', '2024-01-06', '2023-12-28', '', '', '658cfbd1e6224', 'Pending'),
(55, 0, 41, 'Angelo Malano', '', 0, 'PMS Change Oil, Transmission, Underchassis, Wheel Alignment', 'Van', '', 0, '', '2023-12-20', '2023-12-28', '', '', '658cfc5753d3b', 'Pending'),
(56, 0, 41, 'Angelo Malano', '', 0, 'Transmission', 'Motorcycle', '', 0, '', '2023-12-31', '2023-12-28', '', '', '658cfc5753d3b', 'Pending'),
(57, 0, 41, 'Angelo Malano', '', 0, 'Underchassis', 'SUV', '', 0, '', '2024-01-03', '2023-12-28', '', '', '658cfc5753d3b', 'Pending'),
(58, 0, 41, 'Angelo Malano', '', 0, 'Wheel Alignment', 'Sedan', '', 0, '', '2024-01-05', '2023-12-28', '', '', '658cfc5753d3b', 'Pending'),
(59, 0, 41, 'Angelo Malano', '', 0, 'PMS Change Oil, Transmission', 'Coupe', '', 0, '', '2024-01-05', '2023-12-28', '', '', '658cfcf8d2f8d', 'Pending'),
(60, 0, 41, 'Angelo Malano', '', 0, 'Transmission', 'Sedan', '', 0, '', '2024-01-06', '2023-12-28', '', '', '658cfcf8d2f8d', 'Pending'),
(61, 0, 41, 'Angelo Malano', '', 0, 'PMS Change Oil', 'Motorcycle', '', 0, '', '2023-12-29', '2023-12-28', '', '', '658d1423ee5ae', 'Pending'),
(62, 17, 41, 'Angelo Malano', '', 0, 'ATF Dialysis, EGR Cleaning', 'Scooter', '', 0, '', '2023-12-29', '2023-12-28', '', '', '658d1423ee5ae', 'Approved'),
(63, 0, 41, 'Angelo Malano', '', 0, 'Wheel Alignment, Alarm', 'Sedan', '', 0, '', '2023-12-30', '2023-12-28', '', '', '658d1423ee5ae', 'Pending'),
(64, 0, NULL, 'sample Ni', 'malano.angelo@dnsc.edu.ph', 0, 'PMS Change Oil, Top Overhaul, Brakes', 'Scooter', 'wa ragud ', 0, '', '2023-12-29', '0000-00-00', NULL, NULL, NULL, 'Declined'),
(65, 0, NULL, 'sample ikaduha', 'malano.angelo@dnsc.edu.ph', 0, 'Transmission, Aircon', 'Motorcycle', '', 0, '', '2024-01-04', '0000-00-00', NULL, NULL, NULL, 'Declined'),
(66, 0, 41, 'Angelo Malano', '', 0, 'PMS Change Oil, ATF Dialysis', 'Motorcycle', 'None', 0, '', '2024-01-17', '2024-01-08', '', '', '659bfe9b5a92d', 'Canceled'),
(67, 0, 41, 'Angelo Malano', '', 0, 'Tint', 'Scooter', '', 0, '', '2024-01-17', '2024-01-08', '', 'yellow', '659bfe9b5a92d', 'Declined'),
(68, 0, 41, 'Angelo Malano', '', 0, 'Wheel Alignment', 'Hatchback', '', 0, '', '2024-01-11', '2024-01-08', '', '', '659bfffb4d6c4', 'Declined'),
(69, 17, 41, 'Angelo Malano', '', 0, 'Alarm', 'Pick Up Truck', 'None', 6600, '- alarm 5600\n- Battery alarm 1000', '2024-01-24', '2024-01-08', '', '', '659c003d192ed', 'Request Completed'),
(70, 0, 41, 'Angelo Malano', '', 0, 'Repaint', '18', '', 0, '', '2024-01-18', '2024-01-21', 'cyan', '', '65ad19c53b9b7', 'Pending'),
(71, 0, 41, 'Angelo Malano', '', 0, 'Change Oil', '18', '', 0, '', '2024-01-26', '2024-01-21', '', '', '65ad19c53b9b7', 'Pending'),
(72, 0, 41, 'Angelo Malano', '', 0, 'Change Oil', '18', '', 0, '', '2024-01-26', '2024-01-21', '', '', '65ad19c53b9b7', 'Pending'),
(73, 0, 41, 'Angelo Malano', '', 0, 'Overhaul', '13', '', 0, '', '2024-01-25', '2024-01-21', '', '', '65ad19c53b9b7', 'Pending'),
(74, 0, 41, 'Angelo Malano', '', 0, 'Overhaul', '13', '', 0, '', '2024-01-25', '2024-01-21', '', '', '65ad19c53b9b7', 'Pending'),
(75, 0, 41, 'Angelo Malano', '', 0, 'Change Oil, Repaint', '14', '', 0, '', '2024-01-23', '2024-01-21', 'pink', '', '65ad23ff11b7a', 'Pending'),
(76, 0, 41, 'Angelo Malano', '', 0, 'Overhaul', '13', '', 0, '', '2024-01-24', '2024-01-21', '', '', '65ad23ff11b7a', 'Pending'),
(77, 0, 41, 'Angelo Malano', '', 0, 'Repaint, Change Oil, Reface', 'Motorcycle', '', 0, '', '2024-02-02', '2024-01-21', 'ash white', '', '65ad271c0e155', 'Pending'),
(78, 0, 41, 'Angelo Malano', '', 0, 'Change Oil, Aircon', 'Minivan', '', 0, '', '2024-01-18', '2024-01-21', '', '', '65ad271c0e155', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `vehicletype_id` int(11) DEFAULT NULL,
  `service` varchar(30) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `status` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `vehicletype_id`, `service`, `price`, `status`) VALUES
(3, 1, 'Aircon', 0, ''),
(4, 2, 'Reface', 0, ''),
(5, 10, 'Tint', 0, ''),
(7, 18, 'Reface', 0, ''),
(8, 18, 'Change Oil', 0, ''),
(9, 14, 'Repaint', 0, ''),
(10, 10, 'Change Oil', 1000, ''),
(11, 1, 'Change Oil', 0, ''),
(12, 18, 'Repaint', 20000, ''),
(13, 12, 'Overhaul', 0, ''),
(14, 13, 'Overhaul', 0, ''),
(15, 14, 'Change Oil', 0, ''),
(16, 11, 'Overhaul', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `last_activity` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `user_id`, `last_activity`) VALUES
(1, 41, '2023-07-19'),
(2, 41, '2023-07-19');

-- --------------------------------------------------------

--
-- Table structure for table `spareparts_accessories`
--

CREATE TABLE `spareparts_accessories` (
  `sparepart_id` int(11) NOT NULL,
  `img` varchar(225) DEFAULT NULL,
  `product` varchar(225) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `sold` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `details` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spareparts_accessories`
--

INSERT INTO `spareparts_accessories` (`sparepart_id`, `img`, `product`, `quantity`, `sold`, `price`, `details`, `status`) VALUES
(9, 'img/products/650699978f1891.82649014', 'Carrier', 24, 0, 2323.66, '45 inches, fiber, good quality', 'archived'),
(10, 'img/products/650698ac211163.92438333', 'Gas Filter', 115, 18, 30000, '6*124\r\nPlace of Origin:Zhejiang, China\r\nCar Model:DA64V\r\nMOQ:500\r\nFiltration Efficiency:Over 99.7%\r\nStructure:Cartridge\r\nOEM:Acceptable\r\nShipment:On-time\r\nCertificate:ISO9001:2008\r\nPackage:Neutral,Colour Box\r\nBusiness Type:Manufacturer\r\nCertification:ISO/TS16949', 'archived'),
(14, 'img/products/6506992903e830.94235676', 'Ignition Coil ', 117, 13, 5000, 'Iki ignition coil 4k,2e,liteace\r\nWagon R+ (EM) 1.0 (MA61) 996 48 4 MPV 1998-2000', 'archived'),
(15, 'img/products/650699c7cf1fd7.42068771', 'Minivan Back Chair', 20, 7, 1000, 'Dimensions: \r\nHeight - 50.5CM\r\nWidth - 41.0 CM\r\nLength - 55.5 CM', ''),
(16, 'img/products/65a723c06dcd89.78640859', 'Headlight', 10, 31, 1900, 'Japan Surplus Suzuki DA64V Headlight Assembly\r\nOriginal Japan Surplus\r\nWith Bulb & Socket included\r\nDimensions: \r\nHeight - 31.6CM\r\nWidth - 31.5 CM\r\nLength - 38.0 CM ', ''),
(17, 'img/products/65a7214e2c9122.46144001', 'Adjustable Number Plate', 20, 38, 350, 'Brand New\r\nUniversal Plate Holder that fit all cars\r\nMade of metal bracket with ABS plastic frame in carbon fiber look style design, smooth surface and durable.\r\nDouble Adjust or Tilting\r\nSporty Look\r\nPerfect for DIY modification, can be installed in front or rear of your car.\r\nEasy installation, no drilling or welding is required\r\nNO SCREW INCLUDED', ''),
(18, 'img/products/65a720471537f8.26281198', 'Volt Meter', 5, 19, 380, 'Type: Voltmeters\r\nWorking voltage:12-24V\r\nMeasurement range:6-30V\r\nMaterial: ABS\r\nLED Color: Gray\r\nSize:4*4*3CM', ''),
(19, 'img/products/652fbd88e01266.26338931', 'sample', 122, 0, 321322, 'asfsadfasdf', 'archived'),
(20, 'img/products/65564c172392d2.72250467', 'asfd', 22, 0, 2243, 'asf', 'archived'),
(21, 'img/products/65a721b7d4e220.08752183', 'Car Alarm System', 7, 0, 2000, 'Universal CAR REMOTE CONTROL ALARM KEYLESS ENTRY SYSTEM Anti-Theft Door Lock\r\n*Alarming range: 100m\r\n*Metal holder, can be mounted tightly\r\n*Power voltage: 15V\r\n*Alarming response time: 0.01s\r\n*Alarm triggered: Shake\r\n*Suitable for all kinds of cars\r\n*Double remote controls, in case of losing or breaking\r\n*Remote car finding, LED indicator', ''),
(22, 'img/products/65a7224b852d48.81425953', 'South Ocean Dashcam HD', 10, 0, 1500, 'Model: A2\r\nScreen size: 2 inches\r\nPower supply: 5V 2A\r\nAdjustable lens angle: support\r\nFront camera angle: 150 ° Inner camera angle: 120 ° Rear camera angle: 140 °\r\nFront camera resolution: 1440 P Inner camera resolution: 480 P Rear camera resolution: 720 P\r\nFront camera aperture: F2.0 Video resolution: 1440P FDH/720 P/VGA compression: H.264\r\n-High resotution front and rear cameras\r\n-Front camera 150 degrees, rear camera 120 degrees\r\n-2-inch screen\r\n-Thai menu is supported, which is convenient for setting and using functions.', ''),
(23, 'img/products/65a72a18d86595.20477152', 'Mini Driving Light', 5, 0, 350, 'Package includes：20W * 2 driving lights (bulit-in relays) + 1 switch + 2 brackets\r\n● Beam type: spot beam\r\n● Color temperature: 6000K/3000K\r\n● Brightness: 8000LM\r\n● Voltage: DC8V-80V\r\n● Power: 30W * 2\r\n●Model: Universal\r\n●Material: aviation aluminum alloy\r\n●Color: Black\r\n●Light’s color: White + Amber .(Hi / Low)\r\n●Lifetime: >50,000h\r\n●Working temperature: -40~+85 ℃\r\n●No need  cooling fans\r\n●Waterproof rating: IP67\r\n●Quantity: one pair with switch ', ''),
(24, 'img/products/65af5c7b4cf874.96602395', 'Car Alarm System', 123, NULL, 123, '-test\r\n-web', NULL),
(25, 'img/products/65af5ce4363521.48120531', 'Car Alarm System', 123, NULL, 123, '- web Sgwrwe\r\n-asf', NULL),
(26, 'img/products/65af5d369ff576.79428947', 'Car Alarm System', 123, NULL, 123, 'adsfasd\r\nasdfsda', NULL),
(27, 'img/products/65af5d7164b6d5.60181410', 'Car Alarm System', 123, NULL, 123, '123213', NULL),
(28, 'img/products/65af5d79a005c9.96194035', 'Car Alarm System', 123, NULL, 123, '123213', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `fname` varchar(25) DEFAULT NULL,
  `lname` varchar(25) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `pNum` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `user` varchar(25) DEFAULT NULL,
  `pass` varchar(25) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `fname`, `lname`, `birthdate`, `pNum`, `email`, `position`, `user`, `pass`, `status`) VALUES
(10, 'Enteng', 'Kabisote', '2023-06-20', '09128349012', 'malano.angelo@dnsc.edu.ph', 'Staff', 'staff123', 'Admin@123', ''),
(13, 'Darren', 'Tusias', '2023-10-20', '0921342153', 'malano.angelo@dnsc.edu.ph', 'Staff', 'staff12345', 'admin', ''),
(14, 'asdfasdf', 'asdfsda', '2023-11-02', '123124213', 'malano.angelo@dnsc.edu.ph', '', 'staff123123', '123123', 'archived'),
(15, 'asf', 'asfdeeee', '2023-11-16', '901238123', 'malano.angelo@dnsc.edu.ph', '', 'staffasf', 'asfsf', 'archived'),
(16, 'Angelo', 'Malano', '2022-12-14', '09123412352', 'malano.angelo@dnsc.edu.ph', 'Staff', 'staff123', 'admin', ''),
(17, 'Angelo', 'Malano', '2022-12-21', '09193232323', 'malano.angelo@dnsc.edu.ph', 'Mechanic', 'mechanic123', 'admin', ''),
(18, 'asfsadf', 'asdfsadf', '2321-12-31', '12323123213', '123123@123123.com', 'Mechanic', 'staff22', '12312333', 'archived');

-- --------------------------------------------------------

--
-- Table structure for table `vehicletype_sell`
--

CREATE TABLE `vehicletype_sell` (
  `id` int(11) NOT NULL,
  `vehicleType` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicletype_sell`
--

INSERT INTO `vehicletype_sell` (`id`, `vehicleType`) VALUES
(3, 'Transformer Minivan');

-- --------------------------------------------------------

--
-- Table structure for table `vehicletype_service`
--

CREATE TABLE `vehicletype_service` (
  `id` int(11) NOT NULL,
  `vehicleType` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicletype_service`
--

INSERT INTO `vehicletype_service` (`id`, `vehicleType`) VALUES
(1, 'Minivan'),
(2, 'Pick Up Truck'),
(10, 'SUV'),
(11, 'Van'),
(12, 'Sedan'),
(13, 'Hatchback'),
(14, 'Coupe'),
(18, 'Motorcycle');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `carengine`
--
ALTER TABLE `carengine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carmodel`
--
ALTER TABLE `carmodel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `sparepart_id` (`sparepart_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `car_rental`
--
ALTER TABLE `car_rental`
  ADD PRIMARY KEY (`rentalcar_id`);

--
-- Indexes for table `clientacc`
--
ALTER TABLE `clientacc`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `client_documents`
--
ALTER TABLE `client_documents`
  ADD PRIMARY KEY (`docu_id`),
  ADD KEY `fk_client_documents_cust_id` (`cust_id`);

--
-- Indexes for table `mechanic`
--
ALTER TABLE `mechanic`
  ADD PRIMARY KEY (`mechanic_id`);

--
-- Indexes for table `mechanicdateavailable`
--
ALTER TABLE `mechanicdateavailable`
  ADD PRIMARY KEY (`date_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notif_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `paints`
--
ALTER TABLE `paints`
  ADD PRIMARY KEY (`paint_id`);

--
-- Indexes for table `rent_transactions`
--
ALTER TABLE `rent_transactions`
  ADD PRIMARY KEY (`rent_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `rentalcar_id` (`rentalcar_id`);

--
-- Indexes for table `request_services`
--
ALTER TABLE `request_services`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_services_vehicletype` (`vehicletype_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `spareparts_accessories`
--
ALTER TABLE `spareparts_accessories`
  ADD PRIMARY KEY (`sparepart_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `vehicletype_sell`
--
ALTER TABLE `vehicletype_sell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicletype_service`
--
ALTER TABLE `vehicletype_service`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carengine`
--
ALTER TABLE `carengine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `carmodel`
--
ALTER TABLE `carmodel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `car_rental`
--
ALTER TABLE `car_rental`
  MODIFY `rentalcar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clientacc`
--
ALTER TABLE `clientacc`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `client_documents`
--
ALTER TABLE `client_documents`
  MODIFY `docu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `mechanic`
--
ALTER TABLE `mechanic`
  MODIFY `mechanic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `mechanicdateavailable`
--
ALTER TABLE `mechanicdateavailable`
  MODIFY `date_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `paints`
--
ALTER TABLE `paints`
  MODIFY `paint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `rent_transactions`
--
ALTER TABLE `rent_transactions`
  MODIFY `rent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `request_services`
--
ALTER TABLE `request_services`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `spareparts_accessories`
--
ALTER TABLE `spareparts_accessories`
  MODIFY `sparepart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `vehicletype_sell`
--
ALTER TABLE `vehicletype_sell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vehicletype_service`
--
ALTER TABLE `vehicletype_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`sparepart_id`) REFERENCES `spareparts_accessories` (`sparepart_id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`);

--
-- Constraints for table `rent_transactions`
--
ALTER TABLE `rent_transactions`
  ADD CONSTRAINT `rent_transactions_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `clientacc` (`cust_id`),
  ADD CONSTRAINT `rent_transactions_ibfk_2` FOREIGN KEY (`rentalcar_id`) REFERENCES `car_rental` (`rentalcar_id`);

--
-- Constraints for table `request_services`
--
ALTER TABLE `request_services`
  ADD CONSTRAINT `request_services_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `clientacc` (`cust_id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `fk_services_vehicletype` FOREIGN KEY (`vehicletype_id`) REFERENCES `vehicletype_service` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
