-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2026 at 04:56 PM
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
-- Database: `solevault`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--



-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--
-- --------------------------------------------------------
--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--
-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `category` varchar(100) DEFAULT NULL,
  `sizes` varchar(100) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `brand`, `description`, `price`, `image`, `stock`, `category`, `sizes`, `featured`, `created_at`) VALUES
(1, 'Asian Men\'s Wonder-13 Running Shoes', 'Sports', 'Lightweight & Breathable : Exclusive design and durable materials every step feels light and breezy. Breathable, free-moving fabrics which adjust according to your foot and creates an astoundingly easy-going experience.\r\n\r\nNon Slip & Shockproof : Great engineering strikes a balance in style, made in the potent design and latest fashion trends.\r\nMade for long-term wear, with extra emphasis on providing cushion to the feet, removing heel strain.\r\n\r\nComfort Sole & Flexible Walk : The outsoles are made by an air cushion, doubling the effect of shock absorption. Besides, these shoes perform excellent in durability and are also slip resistant. \r\n\r\nIt provides push cushioning comfort for foot pain relief and helps relieve pressure while conforming to your every step', 599.00, 'shoe2.png', 6, 'Road Running Shoes', '6,7,8,9', 1, '2026-06-26 05:17:40'),
(2, 'Nike Women Perforated Court Vision Low Basketball Shoes ', 'Nike', 'Special Technology\r\nRetro Hoops Inspiration: With a combination of real and synthetic leather, the construction uses materials that echo mid-1980s basketball shoes.\r\n\r\nSleek and Simple Details: The thick laces, original pivot circles on the sole and retro Swoosh design keep it sleek and simple so you can wear them anywhere.\r\n\r\nTried and True:  The vulcanised construction fuses the outsole to midsole for a streamlined look that\'s durable and comfortable.\r\n\r\nProduct Details\r\nA pair of round toe white sneakers, has regular styling,\r\nLace-ups detail\r\nSynthetic leather upper\r\nStitched-down Swoosh design\r\nPerforations on the toe and sides\r\n\"NIKE\" debossed on the heel\r\nWarranty: 6 months against manufacturing defects (not valid on products with more than 20% discount)\r\nWarranty provided by brand/manufacturer\r\nAbout the shoe\r\n\r\nFRESH OFF THE COURT:  So you\'re in love with the classic look of \'80s basketball, but you\'ve got a thing for the fast-paced culture of today\'s game. Meet the Nike Court Vision Low. Made with at least 20% recycled materials by weight, its crisp upper and stitched overlays are inspired by the hook-shot look of old school b-ball. The super plush, low-cut collar keeps it sleek and comfortable for today\'s fast-paced world.\r\n\r\nMaterial & Care\r\nSynthetic leather\r\nWipe with clean dry cloth\r\n\r\nSpecifications\r\nType\r\nSneakers\r\nToe Shape\r\nRound Toe\r\nFastening\r\nLace-Ups\r\nShoe Width\r\nRegular\r\nAnkle Height\r\nRegular\r\nInsole\r\nComfort Insole\r\nSole Material\r\nRubber\r\nWarranty\r\n6 months\r\nNumber of Items\r\n2', 4995.00, 'shoe3.png', 8, 'Women shoe', '5,6,7,9', 1, '2026-06-26 05:23:47'),
(3, 'Trace Black & Grey Signature Sneakers', 'Sneakers', 'Clean lines. Sharp contrast. Everyday confidence.\r\nSubtle. Structured. Striking.\r\n\r\nTRACE is a modern essential designed for men who prefer clean style with quiet impact. The dark black overlay gliding across the soft grey panel creates a tracing effect that feels intentional, refined, and effortlessly cool.\r\n\r\nCrafted from premium vegan leather, TRACE balances sharp structure with everyday comfort. The breathable mesh lining keeps wear fresh throughout the day, while the high-grip rubber outsole ensures stability and durability across different surfaces.\r\n\r\nWhether styled with denims, joggers, cargos, or office-casual fits, TRACE adapts seamlessly — minimal without being basic, confident without trying too hard.\r\n\r\nNew drop. Limited stock.\r\nMove with color. Move with TRACE.\r\n\r\nKEY BENEFITS:\r\n✔ Premium vegan leather with sharp black & grey contrast\r\n✔ Clean, structured silhouette for versatile styling\r\n✔ Breathable mesh lining for all-day comfort\r\n✔ Durable high-grip rubber outsole for steady movement\r\n✔ Monochrome design that pairs with every outfit\r\n\r\nSPECIFICATIONS:\r\nUPPER: Premium Vegan Leather in Black & Grey\r\nLINING: Breathable Mesh\r\nSOLE: Durable High-Grip Rubber Outsole\r\nFIT: Regular Fit (True to Size)\r\nTYPE: Casual / Lifestyle Sneakers for Men\r\nOCCASION: Daily wear, office-casual, travel\r\n\r\nNet Quantity: 1 Pair', 2199.00, 'shoe4.png', 15, 'Road Running Shoes', '6,7,8,9', 0, '2026-06-26 05:26:01'),
(4, 'Court Vision Low Next Nature Men\'s Shoes', 'Sports', 'In love with the classic look of \'80s basketball but have a thing for the fast-paced culture of today\'s game? Meet the Nike Court Vision Low. A classic remixed with at least 20% recycled materials by weight, its crisp upper and stitched overlays keep the soul of the original style. The plush, low-cut collar keeps it sleek and comfortable for your world.\r\n\r\n\r\nMaterial & Care\r\nUpper material: Synthetic Leather\r\nOuter material: PU\r\nWipe with a clean, dry cloth to remove the dust\r\n\r\n\r\nSpecifications\r\nType\r\nSneakers\r\nToe Shape\r\nRound Toe\r\nFastening\r\nLace-Ups\r\nShoe Width\r\nRegular\r\nAnkle Height\r\nRegular\r\nInsole\r\nPadded\r\nSole Material\r\nPU\r\nNumber of Items\r\n2', 4995.00, 'shoe5.png', 7, 'Men shoe', '7,8,9', 0, '2026-06-26 06:09:29'),
(5, 'Campus Women Annie Walking Shoes', 'Campus', 'Top highlights\r\nMaterial typeMesh: Closure typePull-On\r\nHeel typeFlat\r\nWater resistance levelNot Water Resistant\r\nSole materialThermoplastic Elastomers\r\nStyleSneaker\r\n\r\nCountry of OriginIndia\r\nAdditional Information\r\nManufacturerCampus, Campus, Campus Shoes,D-1, Rohtak Road, Udyog Nagar, Opp. Peera Garhi Metro Station Gate No 2, New Delhi, Delhi 110041,ph no- 01143272500\r\nPackerCampus Shoes,D-1, Rohtak Road, Udyog Nagar, Opp. Peera Garhi Metro Station Gate No 2, New Delhi, Delhi 110041,ph no- 01143272500\r\nItem Weight510 g\r\nItem Dimensions LxWxH30.5 x 21.5 x 11.2 Centimeters\r\nNet Quantity1.00 Pack\r\nGeneric NameWalking Shoes', 799.00, 'shoe6.png', 2, 'Women shoe', '9', 0, '2026-06-26 06:11:21'),
(6, 'HotStyle Trendy and Stylish Running Shoes for Men', 'Sports', 'Top highlights\r\nMaterial typeCanvas\r\nClosure typeLace-Up\r\nHeel typeNo Heel\r\nWater resistance levelNot Water Resistant\r\nStyleSneaker\r\nOuter materialCanvas\r\nCountry of OriginIndia\r\nManufacturerHOTSTYLE PRODUCTS, Hotstyle Products\r\nPackerHotstyle Products, A Block DSIDC Industrial Area Delhi-110040, India, Contact: +91-965-461-2408, hotstyleproducts@gmail.com\r\nItem Weight960 g\r\nItem Dimensions LxWxH26 x 13 x 11 Centimeters\r\nNet Quantity1.0 Count\r\nGeneric NameLoafer', 299.00, 'shoe7.png', 45, 'Men shoe', '8,9', 0, '2026-06-26 06:13:10'),
(7, 'Women Mojaris Flats shoe', 'Flats', 'A pair of Cream-Coloured Mojaris\r\nUpper Material: Fabric\r\nCushioned footbed\r\nTextured and patterned outsole\r\n\r\nSize & Fit\r\nSize-3\r\n\r\n\r\nMaterial & Care\r\nClean with mild soap and water, air dry away from direct heat, and avoid harsh chemicals to preserve material and shape.\r\n\r\n\r\nSpecifications\r\nType\r\nMojaris\r\nToe Shape\r\nPointed Toe\r\nFastening and Back Detail\r\nSlip-On\r\nAnkle Height\r\nRegular\r\nSole Material\r\nTPR\r\nNet Quantity\r\n1\r\n', 572.00, 'flatshoe.png', 40, 'Fancy shoe', '7,8,9', 0, '2026-06-26 06:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('customer','admin') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--
-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
