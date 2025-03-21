-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2025 at 02:15 PM
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
-- Database: `farmer_mart`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(512) NOT NULL,
  `description` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`sr_no`, `image`, `description`) VALUES
(1, '../uploads/banner/pic1.jpg', 'Description for First Banner Image.'),
(2, '../uploads/banner/pic2.jpg', 'Description for Second Banner Image.'),
(3, '../uploads/banner/pic3.jpg', 'Description for Third Banner Image.'),
(4, '../uploads/banner/pic4.jpg', 'Description for Fourth Banner Image.');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(512) NOT NULL,
  `description` text NOT NULL,
  `publish_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `image`, `description`, `publish_date`) VALUES
(1, 'Best Way to Do Eco and Agriculture', 'view/uploads/blogs/blog-1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus malesuada turpis nec diam lacinia, non vulputate ex dignissim. Integer dapibus facilisis mauris, nec dignissim enim scelerisque a. Suspendisse potenti. In venenatis, eros sed commodo feugiat, justo sapien malesuada orci, sit amet feugiat velit nisi non odio.\r\n    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus malesuada turpis nec diam lacinia, non vulputate ex dignissim. Integer dapibus facilisis mauris, nec dignissim enim scelerisque a. Suspendisse potenti. In venenatis, eros sed commodo feugiat, justo sapien malesuada orci, sit amet feugiat velit nisi non odio.', '2024-10-08 15:37:52'),
(2, 'Leverage agile frameworks to provide', 'view/uploads/blogs/blog-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus malesuada turpis nec diam lacinia, non vulputate ex dignissim. Integer dapibus facilisis mauris, nec dignissim enim scelerisque a. Suspendisse potenti. In venenatis, eros sed commodo feugiat, justo sapien malesuada orci, sit amet feugiat velit nisi non odio.', '2024-10-09 15:37:52'),
(3, 'Organically grow the holistic world view', 'view/uploads/blogs/blog-3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus malesuada turpis nec diam lacinia, non vulputate ex dignissim. Integer dapibus facilisis mauris, nec dignissim enim scelerisque a. Suspendisse potenti. In venenatis, eros sed commodo feugiat, justo sapien malesuada orci, sit amet feugiat velit nisi non odio.', '2024-10-09 20:37:52'),
(4, 'Bring to the table win-win survival', 'view/uploads/blogs/blog-4.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus malesuada turpis nec diam lacinia, non vulputate ex dignissim. Integer dapibus facilisis mauris, nec dignissim enim scelerisque a. Suspendisse potenti. In venenatis, eros sed commodo feugiat, justo sapien malesuada orci, sit amet feugiat velit nisi non odio.', '2024-10-05 20:37:52'),
(5, 'At the end of the day, going forward', 'view/uploads/blogs/blog-5.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus malesuada turpis nec diam lacinia, non vulputate ex dignissim. Integer dapibus facilisis mauris, nec dignissim enim scelerisque a. Suspendisse potenti. In venenatis, eros sed commodo feugiat, justo sapien malesuada orci, sit amet feugiat velit nisi non odio.', '2024-10-04 14:16:52'),
(6, 'User generated content in real-time', 'view/uploads/blogs/blog-6.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus malesuada turpis nec diam lacinia, non vulputate ex dignissim. Integer dapibus facilisis mauris, nec dignissim enim scelerisque a. Suspendisse potenti. In venenatis, eros sed commodo feugiat, justo sapien malesuada orci, sit amet feugiat velit nisi non odio.', '2024-10-03 14:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `community`
--

CREATE TABLE `community` (
  `sr_no` int(11) NOT NULL,
  `customer_name` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` varchar(512) NOT NULL,
  `image` varchar(512) NOT NULL,
  `video` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `community`
--

INSERT INTO `community` (`sr_no`, `customer_name`, `title`, `description`, `image`, `video`, `status`) VALUES
(1, 'John Doe', 'Pest Control Advice', 'How to manage pests in organic farming?', '../View/uploads/community/images/pic1.jpg', '../View/uploads/community/videos/video1.mp4', 'Active'),
(2, 'Jane Smith', 'Watering Tips', 'Best practices for watering crops efficiently.', '', '../View/uploads/community/videos/video1.mp4', 'Block'),
(3, 'Raj Patel', 'Soil Health', 'Improving soil health for better yields.', '../View/uploads/community/images/pic2.jpg', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `company_contact_details`
--

CREATE TABLE `company_contact_details` (
  `id` int(44) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `email_id` varchar(60) NOT NULL,
  `address` varchar(255) NOT NULL,
  `copyrights` varchar(255) NOT NULL,
  `contents` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_contact_details`
--

INSERT INTO `company_contact_details` (`id`, `phone`, `email_id`, `address`, `copyrights`, `contents`) VALUES
(1, '9028155454', 'info@cmssoftware.in', 'Office No 101, Dudhane Complex, above Omkar Store, Karve Nagar, Pune, Maharashtra 411052', '© Copyright 2020 by Cybermate Software Technology PVT.LTD', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`id`, `image`, `content`) VALUES
(1, 'view\\uploads\\contact\\ai-generated-indian-female-farmer-working-in-her-field-bokeh-style-background-with-generative-ai-photo.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.');

-- --------------------------------------------------------

--
-- Table structure for table `contact_review`
--

CREATE TABLE `contact_review` (
  `id` int(50) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `message` varchar(60) NOT NULL,
  `phone` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_review`
--

INSERT INTO `contact_review` (`id`, `name`, `email_id`, `message`, `phone`) VALUES
(1, 'John Doe', 'john.doe@example.com', 'Hello, I have a query.', '1234567890'),
(2, 'Johny ', 'johny.doe@example.com', 'Hello, I have a query.', '123488890'),
(3, 'renuka', 'johny.doe@example.com', 'Hello, I have a query.', '123488890'),
(4, 'Ashwini', 'ashwinikhatape140920@gmail.com', 'Lorem ipsum dolor sit amet, consectetur notted adipisicing e', '8974664414'),
(5, 'komal', 'komaldeore09@gmail.com', 'Donec at ligula lacus dignissim mi quis simply neque.', '7986467879'),
(6, 'nikita', 'nikita@gmail.com', 'Lorem ipsum dolor sit amet, consectetur notted adipisicing e', '9796546467'),
(7, '', '', '', ''),
(8, '', '', '', ''),
(9, '', '', '', ''),
(10, '', '', '', ''),
(11, '', '', '', ''),
(12, '', '', '', ''),
(13, '', '', '', ''),
(14, '', '', '', ''),
(15, 'default_name', 'default_email@example.com', 'default_message', 'default_phone'),
(16, 'gauri khune', 'gaurikhune15@gmail.com', 'hiii', '96587456982'),
(17, 'sanjana kasurde', 'sanjana12@gmail.com', 'done', '96587452145');

-- --------------------------------------------------------

--
-- Table structure for table `cropdaywise`
--

CREATE TABLE `cropdaywise` (
  `id` int(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `day_no` varchar(250) NOT NULL,
  `day_description` varchar(250) NOT NULL,
  `notes` varchar(250) NOT NULL,
  `vanaspati_stage` varchar(250) NOT NULL,
  `work` varchar(250) NOT NULL,
  `spray_drenching` varchar(250) NOT NULL,
  `worker_count` varchar(250) NOT NULL,
  `photos` varchar(50) NOT NULL,
  `video_urls` varchar(50) NOT NULL,
  `crop_name` varchar(250) NOT NULL,
  `crop_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cropdaywise`
--

INSERT INTO `cropdaywise` (`id`, `duration`, `day_no`, `day_description`, `notes`, `vanaspati_stage`, `work`, `spray_drenching`, `worker_count`, `photos`, `video_urls`, `crop_name`, `crop_id`) VALUES
(1, 'monthly', '1', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through drenches to address deficiencies.\n', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through drenches to address deficiencies.\r', 'Germination Stage', 'Drenching is a valuable technique in modern agriculture for delivering nutrients, controlling pests, and managing diseases effectively. By following best practices and applying drenches thoughtfully, farmers can enhance plant health and improve crop ', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through drenches to address deficiencies. ', '3', '../uploads/daywise/download-3.jpg', 'https://www.youtube.com/watch?v=a50k3V9Igfg', 'Wheat', 1),
(2, 'weekly', '2', 'Physical Changes: The seed swells as it absorbs water, and the metabolic processes within the seed become activated.', 'Physical Changes: The seed swells as it absorbs water, and the metabolic processes within the seed become activated.', 'Physical Changes: The seed swells as it absorbs water, and the metabolic processes within the seed become activated.', 'Physical Changes: The seed swells as it absorbs water, and the metabolic processes within the seed become activated.', 'Physical Changes: The seed swells as it absorbs water, and the metabolic processes within the seed become activated.', '3', '../uploads/daywise/download-3.jpg', 'https://www.youtube.com/watch?v=I8c9qYYXpQ8', 'Wheat', 1),
(3, 'monthly', '3', 'Physical Changes: The seed swells as it absorbs water, and the metabolic processes within the seed become activated.', 'Physical Changes: The seed swells as it absorbs water, and the metabolic processes within the seed become activated.', 'Physical Changes: The seed swells as it absorbs water, and the metabolic processes within the seed become activated.', 'Physical Changes: The seed swells as it absorbs water, and the metabolic processes within the seed become activated.', 'Physical Changes: The seed swells as it absorbs water, and the metabolic processes within the seed become activated.', '4', '../uploads/daywise/download-1.jpg', 'https://www.youtube.com/watch?v=wuliRJxCS4Y', 'Wheat', 1),
(4, 'monthly', '1', 'Use of Floral Preservatives: Add floral preservatives to the water to provide nutrients and inhibit bacterial growth. These solutions can help extend the vase life of roses.\r\n3. Storage Practices', 'Use of Floral Preservatives: Add floral preservatives to the water to provide nutrients and inhibit bacterial growth. These solutions can help extend the vase life of roses.\r\n3. Storage Practices', 'Germination Stage', 'Use of Floral Preservatives: Add floral preservatives to the water to provide nutrients and inhibit bacterial growth. These solutions can help extend the vase life of roses. 3. Storage Practices', 'Use of Floral Preservatives: Add floral preservatives to the water to provide nutrients and inhibit bacterial growth. These solutions can help extend the vase life of roses. 3. Storage Practices', '2', '../uploads/daywise/rose-4.jpeg', 'https://www.youtube.com/watch?v=gchxa5aoHxU', 'Rose', 2),
(5, 'weekly', '2', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through drenches to address deficiencies. ', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through drenches to address deficiencies. ', 'Germination Stage', 'Drenching is a valuable technique in modern agriculture for delivering nutrients, controlling pests, and managing diseases effectively. By following best practices and applying drenches thoughtfully, farmers can enhance plant health and improve crop ', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through drenches to address deficiencies. ', '2', '../uploads/daywise/rose-1.jpg', 'https://www.youtube.com/watch?v=B5l-oOvqLVI', 'Rose', 2),
(6, 'monthly', '2', 'Drenching is a valuable technique in modern agriculture for delivering nutrients, controlling pests, and managing diseases effectively. By following best practices and applying drenches thoughtfully, farmers can enhance plant health and improve crop ', 'Drenching is a valuable technique in modern agriculture for delivering nutrients, controlling pests, and managing diseases effectively. By following best practices and applying drenches thoughtfully, farmers can enhance plant health and improve crop ', 'Germination Stage', 'Drenching is a valuable technique in modern agriculture for delivering nutrients, controlling pests, and managing diseases effectively. By following best practices and applying drenches thoughtfully, farmers can enhance plant health and improve crop ', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through drenches to address deficiencies. ', '2', '../uploads/daywise/spinach-2.jpg', 'https://www.youtube.com/watch?v=PlJe0gcXiVo', 'Spinach', 6),
(7, 'monthly', '2', 'Drenching is a valuable technique in modern agriculture for delivering nutrients, controlling pests, and managing diseases effectively. By following best practices and applying drenches thoughtfully, farmers can enhance plant health and improve crop ', 'Drenching is a valuable technique in modern agriculture for delivering nutrients, controlling pests, and managing diseases effectively. By following best practices and applying drenches thoughtfully, farmers can enhance plant health and improve crop ', 'Germination Stage', 'Drenching is a valuable technique in modern agriculture for delivering nutrients, controlling pests, and managing diseases effectively. By following best practices and applying drenches thoughtfully, farmers can enhance plant health and improve crop ', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through drenches to address deficiencies. ', '2', '../uploads/daywise/download (1).jpg', 'https://www.youtube.com/watch?v=spTvur2Pvqg', 'Jowar', 10),
(8, 'monthly', '3', 'Germination Stage', 'Germination Stage', 'Germination Stage', 'Germination Stage', 'Germination Stage', '3', '../uploads/daywise/download-2.jpg', 'https://www.youtube.com/watch?v=I8c9qYYXpQ8', 'Rice', 9),
(9, 'weekly', '4', 'Drenching is a valuable technique in modern agriculture for delivering nutrients, controlling pests, and managing diseases effectively. By following best practices and applying drenches thoughtfully, farmers can enhance plant health and improve crop ', 'Drenching is a valuable technique in modern agriculture for delivering nutrients, controlling pests, and managing diseases effectively. By following best practices and applying drenches thoughtfully, farmers can enhance plant health and improve crop ', 'Germination Stage', 'Drenching is a valuable technique in modern agriculture for delivering nutrients, controlling pests, and managing diseases effectively. By following best practices and applying drenches thoughtfully, farmers can enhance plant health and improve crop ', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through drenches to address deficiencies. ', '3', '../uploads/daywise/download-3.jpg', 'https://www.youtube.com/watch?v=wuliRJxCS4Y', 'wheat', 3),
(10, 'monthly', '4', 'Germination StageGermination Stage', 'Germination StageGermination Stage', 'Germination Stage', 'Germination Stage', 'Germination Stage', '3', '../uploads/daywise/pic-3.jpg', 'https://www.youtube.com/watch?v=gchxa5aoHxU', 'Carrots', 7),
(11, 'monthly', '5', 'Drenching is a valuable technique in modern agriculture for delivering nutrients, controlling pests, and managing diseases effectively. By following best practices and applying drenches thoughtfully, farmers can enhance plant health and improve crop ', 'Drenching is a valuable technique in modern agriculture for delivering nutrients, controlling pests, and managing diseases effectively. By following best practices and applying drenches thoughtfully, farmers can enhance plant health and improve crop ', '5', 'Drenching is a valuable technique in modern agriculture for delivering nutrients, controlling pests, and managing diseases effectively. By following best practices and applying drenches thoughtfully, farmers can enhance plant health and improve crop ', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through drenches to address deficiencies. ', '3', '../uploads/daywise/spinach-1.jpg', 'https://www.youtube.com/watch?v=wuliRJxCS4Y', 'Spinach', 6),
(12, 'monthly', '2', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through drenches to address deficiencies. ', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through drenches to address deficiencies. ', 'Germination Stage', 'Drenching is a valuable technique in modern agriculture for delivering nutrients, controlling pests, and managing diseases effectively. By following best practices and applying drenches thoughtfully, farmers can enhance plant health and improve crop ', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through drenches to address deficiencies. ', '3', '../uploads/daywise/download (5).jpg,../uploads/day', 'https://www.youtube.com/watch?v=Xr_QTp2J9Ek', 'onions', 8),
(13, 'weekly', '3', 'Slightly Acidic to Neutral: The optimal pH range for sugarcane is between 6.0 to 7.5. Soils that are too acidic or too alkaline can negatively affect growth and yield.\r\n', 'Slightly Acidic to Neutral: The optimal pH range for sugarcane is between 6.0 to 7.5. Soils that are too acidic or too alkaline can negatively affect growth and yield.\r\n', 'Germination Stage', 'Drenching is a valuable technique in modern agriculture for delivering nutrients, controlling pests, and managing diseases effectively. By following best practices and applying drenches thoughtfully, farmers can enhance plant health and improve crop ', 'Slightly Acidic to Neutral: The optimal pH range for sugarcane is between 6.0 to 7.5. Soils that are too acidic or too alkaline can negatively affect growth and yield.', '3', '../uploads/daywise/download (10).jpg', 'https://www.youtube.com/watch?v=1FwYhAF7mf0', 'Sugarcane', 13),
(14, 'weekly', '1', 'Solution Mixing: Mix the drenching solution according to the recommended concentration provided by the manufacturer (for fertilizers, pesticides, or fungicides).\r\nEquipment: Use a watering can, sprayer, or specialized drenching equipment for applicat', 'Solution Mixing: Mix the drenching solution according to the recommended concentration provided by the manufacturer (for fertilizers, pesticides, or fungicides).\r\nEquipment: Use a watering can, sprayer, or specialized drenching equipment for applicat', 'Soil Testing: Conduct a soil test to determine pH, nutrient levels, and soil type.', ' Perform secondary tillage to create a fine seedbed. This can include harrowing or rotary tilling.', 'Liquid fertilizers can be applied through drenching to quickly deliver nutrients directly to the root zone. This method enhances nutrient absorption compared to granular fertilizers, especially when the soil is compacted or lacks moisture.', '2', '../uploads/daywise/maize-1.jpg,../uploads/daywise/', 'https://www.youtube.com/watch?app=desktop&v=TfPt1f', 'maize', 11),
(15, 'weekly', '2', 'Solution Mixing: Mix the drenching solution according to the recommended concentration provided by the manufacturer (for fertilizers, pesticides, or fungicides).\r\nEquipment: Use a watering can, sprayer, or specialized drenching equipment for applicat', 'Solution Mixing: Mix the drenching solution according to the recommended concentration provided by the manufacturer (for fertilizers, pesticides, or fungicides).\r\nEquipment: Use a watering can, sprayer, or specialized drenching equipment for applicat', 'Soil Testing: Conduct a soil test to determine pH, nutrient levels, and soil type.', ' Perform secondary tillage to create a fine seedbed. This can include harrowing or rotary tilling.', 'Liquid fertilizers can be applied through drenching to quickly deliver nutrients directly to the root zone. This method enhances nutrient absorption compared to granular fertilizers, especially when the soil is compacted or lacks moisture.', '3', '../uploads/daywise/maize-3.jpg', 'https://www.youtube.com/watch?app=desktop&v=TfPt1f', 'maize', 11),
(16, 'weekly', '1', 'Soil Testing: Conduct a soil test to determine pH and nutrient levels.\r\nPlowing: Plow the field to a depth of 15-20 cm to aerate the soil.', 'Soil Testing: Conduct a soil test to determine pH and nutrient levels.\r\nPlowing: Plow the field to a depth of 15-20 cm to aerate the soil.', 'Planting Date: Ideally, plant cotton seeds at the onset of the rainy season (late spring to early summer).', 'Tillage: Follow up with harrowing or rotary tilling to create a fine seedbed.', 'Weed Control: Remove existing weeds through mechanical means or herbicides.', '3', '../uploads/daywise/download (9).jpg,../uploads/day', 'https://www.youtube.com/watch?v=2tuSifDu8Mo', 'Cotton', 12),
(17, 'weekly', '4', 'Soil Testing: Conduct a soil test to determine pH and nutrient levels.\r\nPlowing: Plow the field to a depth of 15-20 cm to aerate the soil.', 'Soil Testing: Conduct a soil test to determine pH and nutrient levels.\r\nPlowing: Plow the field to a depth of 15-20 cm to aerate the soil.', 'Planting Date: Ideally, plant cotton seeds at the onset of the rainy season (late spring to early summer).', 'Tillage: Follow up with harrowing or rotary tilling to create a fine seedbed.', 'Weed Control: Remove existing weeds through mechanical means or herbicides.', '3', '../uploads/daywise/download (7).jpg', 'https://www.youtube.com/watch?v=2tuSifDu8Mo', 'Cotton', 12),
(18, 'daily', '1', 'Turmeric (Curcuma longa) has several varieties that are cultivated for different purposes, such as spice, medicinal uses, and extraction of curcumin (the primary active compound). Here are some of the popular varieties of turmeric:', 'Turmeric (Curcuma longa) has several varieties that are cultivated for different purposes, such as spice, medicinal uses, and extraction of curcumin (the primary active compound). Here are some of the popular varieties of turmeric:', 'Planting Date: Ideally, plant cotton seeds at the onset of the rainy season (late spring to early summer).', 'General Use: Widely used as a spice in culinary dishes, traditional medicine, and for curcumin extraction.', 'General Use: Widely used as a spice in culinary dishes, traditional medicine, and for curcumin extraction.', '3', '../uploads/daywise/download (1).jpg', 'https://www.youtube.com/watch?v=XHC91DXxykg', 'Turmeric ', 24),
(19, 'daily', '2', 'Lotus (Nelumbo nucifera) is an aquatic plant known for its beautiful flowers and edible roots (tubers). It is cultivated primarily in water bodies and is valued for its ornamental appeal, medicinal properties, and culinary uses.', 'Lotus (Nelumbo nucifera) is an aquatic plant known for its beautiful flowers and edible roots (tubers). It is cultivated primarily in water bodies and is valued for its ornamental appeal, medicinal properties, and culinary uses.', 'Planting Time: The best time for planting lotus is during the spring season when temperatures rise.', 'Water Management: Maintain adequate water levels, ensuring the plant\'s root zone is submerged but not too deep.', 'ermination: Takes about 1-2 weeks. Seeds sprout and develop into small plants. Vegetative Growth: Leaves develop on the surface of the water. This stage lasts several weeks, during which the plant establishes itself.', '3', '../uploads/daywise/download.jpg', 'https://www.youtube.com/watch?v=AQ-z8vCvI5w', 'Lotus', 21),
(20, 'weekly', '3', 'Monitoring: Regularly check for pests like aphids and leafhoppers. Implement integrated pest management (IPM) strategies', 'Weed Management: Regularly monitor for weeds and remove them manually or with herbicides.', 'Site Selection: Choose a well-drained area with partial shade. Black pepper grows best in regions with warm, humid climates (20°C to 30°C). ', 'Land Preparation: Clear the area of weeds, debris, and other vegetation. Plow the land to a depth of 30-40 cm and incorporate organic matter (compost or well-rotted manure).', 'If using seeds, soak them in water for 24 hours before planting. If using cuttings, select healthy, mature stems and plant them in a nursery bed.', '3', '../uploads/daywise/download (2).jpg', 'https://www.youtube.com/watch?v=XOoBqQmz8jc,https:', 'Black pepper', 15),
(21, 'daily', '3', ' Perform secondary tillage to create a fine seedbed. This can include harrowing or rotary tilling.', 'Liquid fertilizers can be applied through drenching to quickly deliver nutrients directly to the root zone. This method enhances nutrient absorption compared to granular fertilizers, especially when the soil is compacted or lacks moisture.', 'Planting Date: Ideally, plant cotton seeds at the onset of the rainy season (late spring to early summer).', ' Perform secondary tillage to create a fine seedbed. This can include harrowing or rotary tilling.', 'Liquid fertilizers can be applied through drenching to quickly deliver nutrients directly to the root zone. This method enhances nutrient absorption compared to granular fertilizers, especially when the soil is compacted or lacks moisture.', '3', '../uploads/daywise/maize-2.jpg', 'https://www.youtube.com/watch?v=PppZfqXbQV0', 'Corn', 20),
(22, 'daily', '5', ' Perform secondary tillage to create a fine seedbed. This can include harrowing or rotary tilling.', 'Liquid fertilizers can be applied through drenching to quickly deliver nutrients directly to the root zone. This method enhances nutrient absorption compared to granular fertilizers, especially when the soil is compacted or lacks moisture.', 'Planting Date: Ideally, plant cotton seeds at the onset of the rainy season (late spring to early summer).', ' Perform secondary tillage to create a fine seedbed. This can include harrowing or rotary tilling.', 'Liquid fertilizers can be applied through drenching to quickly deliver nutrients directly to the root zone. This method enhances nutrient absorption compared to granular fertilizers, especially when the soil is compacted or lacks moisture.', '3', '../uploads/daywise/maize-3.jpg', 'https://www.youtube.com/watch?v=PppZfqXbQV0', 'Corn', 20),
(23, 'monthly', '3', 'Methods: Hand-picking is the preferred method for quality, while mechanical harvesting is used in large-scale farms.', 'Methods: Hand-picking is the preferred method for quality, while mechanical harvesting is used in large-scale farms.', 'Methods: Drip irrigation or furrow irrigation can be used to conserve water.', 'Methods: Hand-picking is the preferred method for quality, while mechanical harvesting is used in large-scale farms.', 'Methods: Hand-picking is the preferred method for quality, while mechanical harvesting is used in large-scale farms.', '5', '../uploads/daywise/images (3).jpg', 'https://www.youtube.com/watch?v=wuIiy5c_iHw', 'Coffee', 25),
(24, 'monthly', '2', 'Liquid fertilizers can be applied through drenching to quickly deliver nutrients directly to the root zone. This method enhances nutrient absorption compared to granular fertilizers, especially when the soil is compacted or lacks moisture.', 'Liquid fertilizers can be applied through drenching to quickly deliver nutrients directly to the root zone. This method enhances nutrient absorption compared to granular fertilizers, especially when the soil is compacted or lacks moisture.', 'Planting Date: Ideally, plant cotton seeds at the onset of the rainy season (late spring to early summer).', ' Perform secondary tillage to create a fine seedbed. This can include harrowing or rotary tilling.', 'Liquid fertilizers can be applied through drenching to quickly deliver nutrients directly to the root zone. This method enhances nutrient absorption compared to granular fertilizers, especially when the soil is compacted or lacks moisture.', '2', '../uploads/daywise/images (1).jpg', 'https://www.youtube.com/watch?v=uRNci2lywmg', 'Cocoa', 26);

-- --------------------------------------------------------

--
-- Table structure for table `crop_category`
--

CREATE TABLE `crop_category` (
  `sr.no` int(11) NOT NULL,
  `category_name` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL,
  `description` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crop_category`
--

INSERT INTO `crop_category` (`sr.no`, `category_name`, `status`, `image`, `description`) VALUES
(5, ' Grains', 'Active', '../uploads/category/download (16).jpg', 'grains category.'),
(6, 'Vegetables', 'Inactive', '../uploads/category/vegetable category.jpg', 'vegetables category'),
(13, 'Pulses', 'Active', '../uploads/category/download (5).jpg', 'These are leguminous crops and are a significant source of protein. Examples include lentils, chickpeas, beans, and peas.'),
(16, 'Cereal Crops', 'Active', '../uploads/category/download (8).jpg', 'These are the staple food crops and include grains like rice, wheat, maize, barley, oats, and millet.'),
(17, 'Oilseeds', 'Active', '../uploads/category/download (10).jpg', 'These crops are grown primarily for oil extraction. Examples include soybeans, sunflower, mustard, groundnut, and sesame.\r\n\r\n'),
(18, 'Spices and Condiments', 'Active', '../uploads/category/images (9).jpg', 'These crops are used to add flavor to food. Examples include pepper, turmeric, ginger, and cloves.'),
(19, 'Sugar Crops', 'Active', '../uploads/category/images (10).jpg', 'These are grown for the production of sugar. Examples include sugarcane and sugar beet.'),
(20, 'Stem Vegetables', 'Active', '../uploads/category/download (11).jpg', 'These include plants where the edible part is the stem.\r\n\r\nExamples: Asparagus, celery, and bamboo shoots.'),
(21, 'Flowering Vegetables', 'Active', '../uploads/category/download (12).jpg', 'These are plants where the flowers are edible and consumed.\r\n\r\nExamples: Broccoli, cauliflower, and artichokes.'),
(22, 'Cut Flowers', 'Active', '../uploads/category/cut_flowers.jpg', 'These flowers are grown specifically for floral arrangements, bouquets, and decorations. They have long stems and a vase life suitable for display.\r\nExamples: Roses, carnations, lilies, gerbera daisies, and tulips.'),
(23, 'Flowering Potted Plants', 'Active', '../uploads/category/flower_potted_plants.jpg', 'These plants are grown in pots for indoor or outdoor decoration and are often used as gifts.'),
(24, 'Bulbous Flowers', 'Active', '../uploads/category/bulbus_flowers.jpg', 'These flowers grow from bulbs, corms, rhizomes, or tubers, often planted in the fall or spring.\r\nExamples: Tulips, daffodils, gladiolus, and lilies.');

-- --------------------------------------------------------

--
-- Table structure for table `crop_management`
--

CREATE TABLE `crop_management` (
  `id` int(100) NOT NULL,
  `crop_name` varchar(500) NOT NULL,
  `crop_type` varchar(500) NOT NULL,
  `category` varchar(500) NOT NULL,
  `season` varchar(500) NOT NULL,
  `category2` varchar(500) NOT NULL,
  `videolinks` varchar(400) NOT NULL,
  `photos` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `statuss` varchar(500) NOT NULL,
  `intro` varchar(220) NOT NULL,
  `climate` varchar(220) NOT NULL,
  `soil` varchar(220) NOT NULL,
  `land` varchar(220) NOT NULL,
  `fertilizer` varchar(220) NOT NULL,
  `irrigation` varchar(220) NOT NULL,
  `weed_control` varchar(220) NOT NULL,
  `harvesting` varchar(220) NOT NULL,
  `post_harvest` varchar(220) NOT NULL,
  `varieties_recommended` varchar(220) NOT NULL,
  `duration` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crop_management`
--

INSERT INTO `crop_management` (`id`, `crop_name`, `crop_type`, `category`, `season`, `category2`, `videolinks`, `photos`, `date`, `statuss`, `intro`, `climate`, `soil`, `land`, `fertilizer`, `irrigation`, `weed_control`, `harvesting`, `post_harvest`, `varieties_recommended`, `duration`) VALUES
(1, 'Rose', 'food crop', ' Grains', 'season1', 'weekly', 'https://www.youtube.com/watch?v=lViANjSoeCY', '../uploads/crops/rose.jpg', '0000-00-00', 'active', 'Roses are known for their beauty.', 'temperate', 'loamy', 'prepared', 'balanced fertilizer', 'drip irrigation', 'manual weeding', 'manual harvesting', 'cool storage', 'Hybrid Tea, Floribunda', 'weekly'),
(2, 'Rose', 'flower crop', 'Cut Flowers', 'season1', 'weekly', 'https://www.youtube.com/watch?v=lViANjSoeCY', '../uploads/crops/rose-3.webp', '0000-00-00', 'active', 'Roses are known for their beauty.', 'temperate', 'loamy', 'prepared', 'balanced fertilizer', 'drip irrigation', 'manual weeding', 'manual harvesting', 'cool storage', 'Hybrid Tea, Floribunda', 'monthly'),
(3, 'wheat', 'food crop', 'Cereal Crops', 'season1', 'weekly', 'https://www.youtube.com/watch?v=3RWvvamG5Js', '../uploads/crops/download-2.jpg', '0000-00-00', 'active', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through dren', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through dren', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through dren', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through dren', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through dren', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through dren', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through dren', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through dren', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through dren', 'Nutrient Application: Drenching is often used to supply essential nutrients, particularly in cases where soil application may not be effective. Nutrients like microelements (e.g., zinc, iron) can be provided through dren', 'weekly'),
(6, 'Spinach', 'Vegetable crop', 'Flowering Vegetables', 'Winter', 'weekly', 'https://www.youtube.com/watch?v=ZeXLytdeO-c,https://www.youtube.com/watch?v=PlJe0gcXiVo\"', '../uploads/crops/spinach-1.jpg', '0000-00-00', 'active', 'commonly known as spinach, is a leafy green vegetable that is rich in vitamins and minerals. It is a cool-season crop and can be grown in various climates. Below are the details on cultivation, soil requirements, climate', 'Temperature:\r\nIdeal germination temperature: 15°C to 20°C (59°F to 68°F).\r\nOptimal growing temperature: 15°C to 20°C (59°F to 68°F).\r\nCan tolerate frost but avoid heat stress; bolting may occur above 25°C (77°F).', 'Soil Type: Well-drained, loamy soil with good organic matter.\r\npH Level: Preferably between 6.0 and 7.0.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Nutrient Requirements:\r\nNitrogen: Essential for leaf growth; apply a nitrogen-rich fertilizer (like urea) during early growth.\r\nPhosphorus: Promote root development; apply a balanced fertilizer at planting.\r\nPotassium: I', 'Watering Frequency: Keep soil consistently moist but not waterlogged.\r\nIrrigation Method: Drip or furrow irrigation is ideal. Avoid overhead watering to prevent fungal diseases.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Common Varieties:\r\nGiant Noble: Known for its large leaves and high yield.\r\nNew Zealand Spinach: Tolerant to heat and produces thick, succulent leaves.\r\nButterflay: Fast-growing with tender leaves, suitable for salads.\r\n', 'monthly'),
(7, 'Carrots', 'Vegetable crop', 'Flowering Vegetables', 'Winter', 'weekly', 'https://www.youtube.com/watch?v=ZeXLytdeO-c,https://www.youtube.com/watch?v=PlJe0gcXiVo\"', '../uploads/crops/pic-2.jpg', '0000-00-00', 'active', 'commonly known as spinach, is a leafy green vegetable that is rich in vitamins and minerals. It is a cool-season crop and can be grown in various climates. Below are the details on cultivation, soil requirements, climate', 'Temperature:\r\nIdeal germination temperature: 15°C to 20°C (59°F to 68°F).\r\nOptimal growing temperature: 15°C to 20°C (59°F to 68°F).\r\nCan tolerate frost but avoid heat stress; bolting may occur above 25°C (77°F).', 'Soil Type: Well-drained, loamy soil with good organic matter.\r\npH Level: Preferably between 6.0 and 7.0.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Nutrient Requirements:\r\nNitrogen: Essential for leaf growth; apply a nitrogen-rich fertilizer (like urea) during early growth.\r\nPhosphorus: Promote root development; apply a balanced fertilizer at planting.\r\nPotassium: I', 'Watering Frequency: Keep soil consistently moist but not waterlogged.\r\nIrrigation Method: Drip or furrow irrigation is ideal. Avoid overhead watering to prevent fungal diseases.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Common Varieties:\r\nGiant Noble: Known for its large leaves and high yield.\r\nNew Zealand Spinach: Tolerant to heat and produces thick, succulent leaves.\r\nButterflay: Fast-growing with tender leaves, suitable for salads.\r\n', 'monthly'),
(8, 'onions', 'Vegetable crop', 'Flowering Vegetables', 'Winter', 'weekly', 'https://www.youtube.com/watch?v=ZeXLytdeO-c,https://www.youtube.com/watch?v=PlJe0gcXiVo\"', '../uploads/crops/img-1.jpg', '0000-00-00', 'active', 'commonly known as spinach, is a leafy green vegetable that is rich in vitamins and minerals. It is a cool-season crop and can be grown in various climates. Below are the details on cultivation, soil requirements, climate', 'Temperature:\r\nIdeal germination temperature: 15°C to 20°C (59°F to 68°F).\r\nOptimal growing temperature: 15°C to 20°C (59°F to 68°F).\r\nCan tolerate frost but avoid heat stress; bolting may occur above 25°C (77°F).', 'Soil Type: Well-drained, loamy soil with good organic matter.\r\npH Level: Preferably between 6.0 and 7.0.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Nutrient Requirements:\r\nNitrogen: Essential for leaf growth; apply a nitrogen-rich fertilizer (like urea) during early growth.\r\nPhosphorus: Promote root development; apply a balanced fertilizer at planting.\r\nPotassium: I', 'Watering Frequency: Keep soil consistently moist but not waterlogged.\r\nIrrigation Method: Drip or furrow irrigation is ideal. Avoid overhead watering to prevent fungal diseases.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Common Varieties:\r\nGiant Noble: Known for its large leaves and high yield.\r\nNew Zealand Spinach: Tolerant to heat and produces thick, succulent leaves.\r\nButterflay: Fast-growing with tender leaves, suitable for salads.\r\n', 'monthly'),
(9, 'Rice', 'food crop', 'Cereal Crops', 'Winter', 'weekly', 'https://www.youtube.com/watch?v=kxAEiHCErSA\"', '../uploads/crops/download-1.jpg', '0000-00-00', 'active', 'commonly known as spinach, is a leafy green vegetable that is rich in vitamins and minerals. It is a cool-season crop and can be grown in various climates. Below are the details on cultivation, soil requirements, climate', 'Temperature:\r\nIdeal germination temperature: 15°C to 20°C (59°F to 68°F).\r\nOptimal growing temperature: 15°C to 20°C (59°F to 68°F).\r\nCan tolerate frost but avoid heat stress; bolting may occur above 25°C (77°F).', 'Soil Type: Well-drained, loamy soil with good organic matter.\r\npH Level: Preferably between 6.0 and 7.0.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Nutrient Requirements:\r\nNitrogen: Essential for leaf growth; apply a nitrogen-rich fertilizer (like urea) during early growth.\r\nPhosphorus: Promote root development; apply a balanced fertilizer at planting.\r\nPotassium: I', 'Watering Frequency: Keep soil consistently moist but not waterlogged.\r\nIrrigation Method: Drip or furrow irrigation is ideal. Avoid overhead watering to prevent fungal diseases.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Oryza sativa: Commonly grown worldwide, includes varieties like:\r\nLong-grain rice: Basmati, Jasmine.\r\nMedium-grain rice: Arborio, Calrose.\r\nShort-grain rice: Sushi rice, sticky rice.\r\nOryza glaberrima: Grown primarily in', 'monthly'),
(10, 'Jowar', 'food crop', 'Cereal Crops', 'Winter', 'weekly', 'https://www.youtube.com/watch?v=U4odgvVCblc\"', '../uploads/crops/download (3).jpg, ../uploads/crops/download (2).jpg', '0000-00-00', 'active', 'commonly known as spinach, is a leafy green vegetable that is rich in vitamins and minerals. It is a cool-season crop and can be grown in various climates. Below are the details on cultivation, soil requirements, climate', 'Temperature:\r\nIdeal germination temperature: 15°C to 20°C (59°F to 68°F).\r\nOptimal growing temperature: 15°C to 20°C (59°F to 68°F).\r\nCan tolerate frost but avoid heat stress; bolting may occur above 25°C (77°F).', 'Soil Type: Well-drained, loamy soil with good organic matter.\r\npH Level: Preferably between 6.0 and 7.0.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Nutrient Requirements:\r\nNitrogen: Essential for leaf growth; apply a nitrogen-rich fertilizer (like urea) during early growth.\r\nPhosphorus: Promote root development; apply a balanced fertilizer at planting.\r\nPotassium: I', 'Watering Frequency: Keep soil consistently moist but not waterlogged.\r\nIrrigation Method: Drip or furrow irrigation is ideal. Avoid overhead watering to prevent fungal diseases.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Downy Mildew: Prevent by ensuring good air circulation; use resistant varieties.\r\nPowdery Mildew: Avoid overhead watering and crowded plantings.\r\nFusarium Wilt: Rotate crops to prevent soilborne diseases.', 'Oryza sativa: Commonly grown worldwide, includes varieties like:\r\nLong-grain rice: Basmati, Jasmine.\r\nMedium-grain rice: Arborio, Calrose.\r\nShort-grain rice: Sushi rice, sticky rice.\r\nOryza glaberrima: Grown primarily in', 'monthly'),
(11, 'maize', 'plant crop', 'Cereal Crops', 'Winter', 'weekly', 'https://www.youtube.com/watch?v=DCQEEYNGBWQ,https://www.youtube.com/watch?v=fz3JwTU82uA\"', '../uploads/crops/maize-2.jpg', '0000-00-00', 'active', 'Maize, commonly known as corn, is one of the most important cereal crops in the world. It is a versatile and widely cultivated plant that plays a crucial role in food security, livestock feed, and industrial products.', 'Climate: Maize thrives in warm temperatures (20°C to 30°C) and requires full sunlight.', 'Soil: Prefers well-drained, fertile soils with a pH of 5.8 to 7.0.', 'Cultural Significance: Maize holds cultural importance in many societies, especially in indigenous communities, where it is often featured in traditional ceremonies and dishes.', 'Phosphorus Fertilizers,Potassium Fertilizers,Secondary Nutrients and Micronutrients,Nitrogen Fertilizers', 'Surface Irrigation\r\n\r\nDescription: Water is applied directly to the soil surface and allowed to flow over the field.,Drip Irrigation\r\n\r\nDescription: Water is delivered directly to the root zone through a network of tubes', 'Economic Factors: The cost of irrigation systems, water usage, and maintenance should be considered in the overall budget for maize production.', 'Economic Factors: The cost of irrigation systems, water usage, and maintenance should be considered in the overall budget for maize production.', 'Economic Factors: The cost of irrigation systems, water usage, and maintenance should be considered in the overall budget for maize production.', 'Dent Corn: Commonly used for animal feed and processed products.\r\nSweet Corn: Consumed as a vegetable, often eaten fresh or canned.\r\nFlint Corn: Used for making cornmeal and as animal feed.\r\nPopcorn: A special variety th', 'weekly'),
(12, 'Cotton', 'food crop', ' Grains', 'season1', 'weekly', 'https://www.youtube.com/watch?app=desktop&v=IEdePj_vw6Q\"', '../uploads/crops/download (9).jpg, ../uploads/crops/download (7).jpg', '0000-00-00', 'active', 'Maize, commonly known as corn, is one of the most important cereal crops in the world. It is a versatile and widely cultivated plant that plays a crucial role in food security, livestock feed, and industrial products.', 'Climate: Maize thrives in warm temperatures (20°C to 30°C) and requires full sunlight.', 'Soil: Prefers well-drained, fertile soils with a pH of 5.8 to 7.0.', 'Cultural Significance: Maize holds cultural importance in many societies, especially in indigenous communities, where it is often featured in traditional ceremonies and dishes.', 'Phosphorus Fertilizers,Potassium Fertilizers,Secondary Nutrients and Micronutrients,Nitrogen Fertilizers', 'Surface Irrigation\r\n\r\nDescription: Water is applied directly to the soil surface and allowed to flow over the field.,Drip Irrigation\r\n\r\nDescription: Water is delivered directly to the root zone through a network of tubes', 'Economic Factors: The cost of irrigation systems, water usage, and maintenance should be considered in the overall budget for maize production.', 'Economic Factors: The cost of irrigation systems, water usage, and maintenance should be considered in the overall budget for maize production.', 'Economic Factors: The cost of irrigation systems, water usage, and maintenance should be considered in the overall budget for maize production.', 'Dent Corn: Commonly used for animal feed and processed products.\r\nSweet Corn: Consumed as a vegetable, often eaten fresh or canned.\r\nFlint Corn: Used for making cornmeal and as animal feed.\r\nPopcorn: A special variety th', 'weekly'),
(13, 'Sugarcane', 'cashed crop', 'Sugar Crops', 'season1', 'weekly', 'https://www.youtube.com/watch?v=ZfTIyrGQ8Fc', '../uploads/crops/istockphoto-182159812-612x612.jpg', '0000-00-00', 'active', 'Sugarcane is classified as a cash crop due to its significant economic value and the revenue it generates for farmers and economies. Here are some specific categories and details related to sugarcane as a cash crop:', 'Temperature\r\n\r\nWarm Climate: Sugarcane requires a warm climate with temperatures ideally between 20°C to 32°C (68°F to 90°F) for optimal growth.\r\nHeat Tolerance: It is tolerant of high temperatures, but extreme heat (>38', 'Loamy Soil: Sugarcane thrives best in loamy soils, which have a good balance of sand, silt, and clay. Loamy soils provide excellent drainage and moisture retention.\r\nAlluvial Soil: This type of soil, often found in river', 'Cultural Significance: Maize holds cultural importance in many societies, especially in indigenous communities, where it is often featured in traditional ceremonies and dishes.', 'Phosphorus Fertilizers,Potassium Fertilizers,Secondary Nutrients and Micronutrients,Nitrogen Fertilizers', 'Irrigation: It requires adequate water supply, making irrigation common in many growing regions to ensure optimal growth and yield.', 'Economic Factors: The cost of irrigation systems, water usage, and maintenance should be considered in the overall budget for maize production.', 'Harvesting and Processing\r\n\r\nMechanical Harvesting: In many regions, sugarcane is harvested using machinery to reduce labor costs and increase efficiency.\r\nSugar Mill Proximity: Farmers often choose to grow sugarcane nea', 'Temperature\r\n\r\nWarm Climate: Sugarcane requires a warm climate with temperatures ideally between 20°C to 32°C (68°F to 90°F) for optimal growth.\r\nHeat Tolerance: It is tolerant of high temperatures, but extreme heat (>38', 'Varieties\r\n\r\nHigh-Yield Varieties: Farmers cultivate specific high-yield varieties of sugarcane that are bred for better sugar content and disease resistance.\r\nDiverse Uses: Different varieties may be grown for specific ', 'weekly'),
(15, 'Black pepper', 'horiculture crop', 'Spices and Condiments', 'Summer', 'weekly', 'https://www.youtube.com/watch?v=kXOTs4an5Ms', '../uploads/crops/istockphoto-178793183-612x612.jpg', '0000-00-00', 'active', 'Sugarcane is classified as a cash crop due to its significant economic value and the revenue it generates for farmers and economies. Here are some specific categories and details related to sugarcane as a cash crop:', 'Temperature\r\n\r\nWarm Climate: Sugarcane requires a warm climate with temperatures ideally between 20°C to 32°C (68°F to 90°F) for optimal growth.\r\nHeat Tolerance: It is tolerant of high temperatures, but extreme heat (>38', 'Loamy Soil: Sugarcane thrives best in loamy soils, which have a good balance of sand, silt, and clay. Loamy soils provide excellent drainage and moisture retention.\r\nAlluvial Soil: This type of soil, often found in river', 'Cultural Significance: Maize holds cultural importance in many societies, especially in indigenous communities, where it is often featured in traditional ceremonies and dishes.', 'Phosphorus Fertilizers,Potassium Fertilizers,Secondary Nutrients and Micronutrients,Nitrogen Fertilizers', 'Irrigation: It requires adequate water supply, making irrigation common in many growing regions to ensure optimal growth and yield.', 'Economic Factors: The cost of irrigation systems, water usage, and maintenance should be considered in the overall budget for maize production.', 'Harvesting and Processing\r\n\r\nMechanical Harvesting: In many regions, sugarcane is harvested using machinery to reduce labor costs and increase efficiency.\r\nSugar Mill Proximity: Farmers often choose to grow sugarcane nea', 'Temperature\r\n\r\nWarm Climate: Sugarcane requires a warm climate with temperatures ideally between 20°C to 32°C (68°F to 90°F) for optimal growth.\r\nHeat Tolerance: It is tolerant of high temperatures, but extreme heat (>38', 'Varieties\r\n\r\nHigh-Yield Varieties: Farmers cultivate specific high-yield varieties of sugarcane that are bred for better sugar content and disease resistance.\r\nDiverse Uses: Different varieties may be grown for specific ', 'weekly'),
(20, 'Corn', 'plant crop', 'Cereal Crops', 'Summer', 'daily', ' https://www.youtube.com/watch?v=P2C9vtAEnkA', '../uploads/crops/istockphoto-1467817613-612x612.webp, ../uploads/crops/istockphoto-2056049643-1024x1024.jpg, ../uploads/crops/maize-1.jpg', '0000-00-00', 'active', 'Cereals are grasses cultivated for their edible grains, which include crops like wheat, rice, oats, barley, and maize (corn). They are a primary source of carbohydrates in diets around the world. Corn, being a member of ', 'Optimal Temperature: Corn grows best in warm climates with daytime temperatures between 60°F and 95°F (15°C to 35°C).\r\nSunlight: Corn requires full sun to thrive, needing at least 6-8 hours of direct sunlight per day.', 'Select a well-draining location with full sun.\r\nTill the soil to a depth of about 6-8 inches and remove weeds.\r\nTest soil pH and nutrient levels. Corn thrives in soil with a pH of 5.8 to 7.0.\r\nAdd compost or organic matt', 'Land preparation is a crucial step for successful corn cultivation, as it ensures that the soil is suitable for planting, supports good root development, and helps control weeds. Here’s how to prepare the land for growin', 'Apply a balanced fertilizer (such as 10-10-10) when planting.\r\nSide-dress with nitrogen-rich fertilizer when the plants are about 6 inches tall and again when they reach knee height.', 'Method: Common irrigation methods for corn include drip irrigation, sprinkler systems, and furrow irrigation, depending on the field size and water availability.', 'Weed Management:\r\n\r\nKeep the field free of weeds, especially during the early stages of growth.\r\nMulching around the base can help suppress weeds and retain moisture.', 'Corn is typically ready for harvest 60-100 days after planting, depending on the variety.\r\nHarvest when the kernels are plump and the silk has turned brown.', 'Pre-Irrigation (if dry): If the soil is dry, consider light irrigation before planting to ensure sufficient moisture for seed germination.\r\nThese steps ensure that the soil is well-prepared to ', 'Sweet Corn,Popcorn,Flint Corn (Indian Corn),Field Corn (Dent Corn),Flour Corn,Waxy Corn', 'daily'),
(21, 'Lotus', 'Flower crop', 'Flowering Potted Plants', 'Summer', 'daily', ' https://www.youtube.com/watch?app=desktop&v=aXDi_yXKhxA', '../uploads/crops/download.jpg', '0000-00-00', 'active', 'Cereals are grasses cultivated for their edible grains, which include crops like wheat, rice, oats, barley, and maize (corn). They are a primary source of carbohydrates in diets around the world. Corn, being a member of ', 'Optimal Temperature: Corn grows best in warm climates with daytime temperatures between 60°F and 95°F (15°C to 35°C).\r\nSunlight: Corn requires full sun to thrive, needing at least 6-8 hours of direct sunlight per day.', 'Select a well-draining location with full sun.\r\nTill the soil to a depth of about 6-8 inches and remove weeds.\r\nTest soil pH and nutrient levels. Corn thrives in soil with a pH of 5.8 to 7.0.\r\nAdd compost or organic matt', 'Land preparation is a crucial step for successful corn cultivation, as it ensures that the soil is suitable for planting, supports good root development, and helps control weeds. Here’s how to prepare the land for growin', 'Apply a balanced fertilizer (such as 10-10-10) when planting.\r\nSide-dress with nitrogen-rich fertilizer when the plants are about 6 inches tall and again when they reach knee height.', 'Method: Common irrigation methods for corn include drip irrigation, sprinkler systems, and furrow irrigation, depending on the field size and water availability.', 'Weed Management:\r\n\r\nKeep the field free of weeds, especially during the early stages of growth.\r\nMulching around the base can help suppress weeds and retain moisture.', 'Corn is typically ready for harvest 60-100 days after planting, depending on the variety.\r\nHarvest when the kernels are plump and the silk has turned brown.', 'Pre-Irrigation (if dry): If the soil is dry, consider light irrigation before planting to ensure sufficient moisture for seed germination.\r\nThese steps ensure that the soil is well-prepared to ', 'Sweet Corn,Popcorn,Flint Corn (Indian Corn),Field Corn (Dent Corn),Flour Corn,Waxy Corn', 'daily'),
(24, 'Turmeric ', 'horiculture crop', 'Spices and Condiments', 'Summer', 'weekly', ' https://www.youtube.com/watch?v=ikNVzf6GUWo,https://www.youtube.com/watch?v=6M4xR6UXHIw', '../uploads/crops/240_F_203569714_KsGJLn7MNYauT6cejZYTn9OOWymVmrQw.jpg, ../uploads/crops/240_F_447523688_n2HXtkivmSNHQXcjed7yl9Zgvyy8r8v6.jpg, ../uploads/crops/download (1).jpg', '0000-00-00', 'active', 'Turmeric (Curcuma longa) requires proper fertilization for optimal growth, yield, and quality. Here’s a breakdown of fertilizer recommendations for turmeric cultivation:', 'Optimal Temperature: 25-35°C (77-95°F)\r\nRainfall: Requires 1500-3000 mm of annual rainfall, well-distributed throughout the growing season.', 'Type: Well-drained loamy or sandy loam soils rich in organic matter.\r\npH Range: 5.5 to 6.5 (slightly acidic).\r\nPreparation: Soil should be plowed and well-tilled to a fine tilth, and organic manure (like farmyard manure ', 'Clear the field of weeds and debris.\r\nPlow the land 3-4 times to loosen the soil.\r\nIncorporate organic manure (about 25-30 tons per hectare).\r\nCreate raised beds or ridges for better drainage and aeration.', 'Nitrogen (N): Essential for vegetative growth. A recommended dosage is 50-80 kg/ha.\r\nPhosphorus (P): Important for root development and overall growth. A dosage of 30-50 kg/ha is typically recommended.\r\nPotassium (K): En', 'Initial Phase: Frequent irrigation is required during the early stages of growth, especially in dry conditions.\r\nGrowth Phase: Regular watering is needed, but avoid waterlogging as it can cause rhizome rot.\r\nRainfed Regi', 'Mulching with organic materials like straw or dry leaves helps suppress weeds, retain moisture, and promote healthy growth.\r\nApply mulch immediately after planting and again 45-60 days later.', 'Maturity Period: 8-10 months after planting.\r\nSigns of Maturity: Yellowing of leaves and drying of stems.', 'Cleaning: Wash the harvested rhizomes to remove soil and other impurities.\r\nCuring: Dry the rhizomes in the shade for a day to reduce moisture content.\r\nStorage: Store rhizomes in well-ventilated and dry conditions to pr', 'Rajapuri,Erode Local,Alleppey Finger (AFT),Salem Turmeric,Prathibha,Suguna, Kasturi Turmeric (Curcuma aromatica)', 'daily'),
(25, 'Coffee', 'cashed crop', 'Sugar Crops', 'Summer', 'weekly', ' https://www.youtube.com/watch?v=1qfjLCOXMMg,https://www.youtube.com/watch?v=PkBQi62J_k4', '../uploads/crops/images (4).jpg, ../uploads/crops/images (5).jpg', '0000-00-00', 'active', 'Coffee is one of the most popular beverages worldwide, derived from the seeds of the Coffea plant. It is cultivated mainly in tropical and subtropical regions and has significant economic importance.', 'Temperature: Coffee grows best in temperatures between 15°C and 24°C (59°F to 75°F).\r\nRainfall: Requires 1000 mm to 2500 mm (39 to 98 inches) of rainfall annually, distributed evenly throughout the year, with a drier per', 'Type: Well-drained, fertile soils rich in organic matter are ideal.', 'Site Selection: Choose a location with adequate sunlight, protection from wind, and good drainage.\r\nTilling: The land should be tilled and cleared of weeds and debris.\r\nFertilization: Incorporate organic matter (like com', 'Organic Fertilizers: Compost, manure, and green manure can be used to improve soil structure and fertility.\r\nChemical Fertilizers: A balanced NPK (nitrogen, phosphorus, potassium) fertilizer can be applied based on soil ', 'Watering Needs: Regular watering is essential, especially during dry spells.\r\nMethods: Drip irrigation or furrow irrigation can be used to conserve water.\r\n', 'Common Pests: Coffee borer beetle, leaf rust, and aphids are significant pests.\r\nManagement: Integrated pest management (IPM) strategies, including biological control, organic pesticides, and proper sanitation, should be', 'Processing: After harvesting, cherries must be processed quickly to prevent spoilage, typically through wet or dry methods', 'Timing: Coffee cherries are typically harvested when they are ripe, which can vary based on the region and variety.', 'Arabica (Coffea arabica),Robusta (Coffea canephora):Liberica and Excelsa: Less common, these varieties have unique flavors and are grown in specific regions.', 'monthly'),
(26, 'Cocoa', 'cashed crop', 'Sugar Crops', 'Summer', 'weekly', ' https://www.youtube.com/watch?v=P2C9vtAEnkA', '../uploads/crops/images (1).jpg, ../uploads/crops/images (2).jpg', '0000-00-00', 'active', 'Used in chocolate production and various confections.', 'Grows in humid tropical climates ', 'Prefers rich, well-drained soils.', ' Trinitario Trinitario', 'Forastero: Strong, earthy, and less aromatic.\r\nCriollo: Fruity, floral, nutty, and sweet with a complex aftertaste.', 'Forastero: Strong, earthy, and less aromatic.\r\nCriollo: Fruity, floral, nutty, and sweet with a complex aftertaste.', 'Forastero: Strong, earthy, and less aromatic.\r\nCriollo: Fruity, floral, nutty, and sweet with a complex aftertaste.Forastero: Strong, earthy, and less aromatic.\r\nCriollo: Fruity, floral, nutty, and sweet with a complex a', 'Forastero: Strong, earthy, and less aromatic.\r\nCriollo: Fruity, floral, nutty, and sweet with a complex aftertaste.', 'Forastero: Strong, earthy, and less aromatic.\r\nCriollo: Fruity, floral, nutty, and sweet with a complex aftertaste.', 'Criollo, Trinitario', 'monthly'),
(27, 'Apple', 'food crop', 'Vegetables', 'season1', 'weekly', 'http://fhjghksd', '../uploads/crops/onion.jpg', '0000-00-00', 'active', 'sssffre', 'sssffre', 'sssffre', 'sssffre', 'sssffre', 'sssffre', 'sssffre', 'sssffre', 'sssffre', 'sssffre', 'monthly'),
(28, 'Applesss', 'food crop', ' Grains', 'season1', 'weekly', 'http://fhjghksd', '../uploads/crops/wheat.jpg', '0000-00-00', 'active', 'sssffre', 'sssffre', 'sssffre', 'sssffre', 'sssffre', 'sssffre', 'sssffre', 'sssffre', 'sssffre', 'sssffre', 'monthly');

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy`
--

CREATE TABLE `privacy_policy` (
  `id` int(11) NOT NULL,
  `policies` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `privacy_policy`
--

INSERT INTO `privacy_policy` (`id`, `policies`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Curabitur pretium tincidunt lacus. Nulla gravida orci a odio varius faucibus. Proin ut ligula vitae.');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `photos` varchar(500) NOT NULL,
  `app_name` varchar(500) NOT NULL,
  `contact_no` varchar(500) NOT NULL,
  `email_id` varchar(500) NOT NULL,
  `website` varchar(500) NOT NULL,
  `copyrights` varchar(500) NOT NULL,
  `facebook_link` varchar(100) NOT NULL,
  `whatsapp_link` varchar(100) NOT NULL,
  `twitter_link` varchar(100) NOT NULL,
  `linkedin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `photos`, `app_name`, `contact_no`, `email_id`, `website`, `copyrights`, `facebook_link`, `whatsapp_link`, `twitter_link`, `linkedin`) VALUES
(7, '../view/uploads/police_lobo.png', 'crop app', '98777666666', 'ashwini@gmail.com', 'http://localhost/CropManageSystem/View/setting.php', 'nbbbbbbbbbbbb', 'http://localhost/CropManageSystem/View/setting.php', 'http://localhost/CropManageSystem/View/setting.php', 'http://localhost/CropManageSystem/View/setting.php', 'http://localhost/CropManageSystem/View/setting.php');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_about`
--

CREATE TABLE `tbl_about` (
  `id` int(10) NOT NULL,
  `about` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_about`
--

INSERT INTO `tbl_about` (`id`, `about`) VALUES
(3, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faq`
--

CREATE TABLE `tbl_faq` (
  `id` int(10) NOT NULL,
  `question` varchar(100) NOT NULL,
  `answer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_faq`
--

INSERT INTO `tbl_faq` (`id`, `question`, `answer`) VALUES
(1, 'What is your return policy. what is i', 'Our return policy allows for returns within'),
(2, 'qwwwww', 'qqwe'),
(3, 'zsdfbbbbbbbb', 'sdfbbbbbbbbb'),
(4, 'ghfrrrrQAEDds', 'jhvrrrrASDsad'),
(5, 'cdgg\'ffffg', 'fgg fh'),
(6, 'asdAS', 'DSFASDF'),
(7, 'What is your return policy. what is it', 'Our return policy allows for returns within.'),
(8, 'What is your return policy. what is it', 'Our return policy allows for returns within'),
(9, 'What is your return policy. what is it', 'Our return policy allows for returns within'),
(10, 'What is your return policy. what is it', 'Our return policy allows for returns within'),
(11, 'What is your return policy. what is it', 'Our return policy allows for returns within'),
(12, 'What is your return policy. what is it', 'Our return policy allows for returns within.....'),
(13, 'What is your return policy. what is it', 'Our return policy allows for returns within');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_terms`
--

CREATE TABLE `tbl_terms` (
  `id` int(10) NOT NULL,
  `terms` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_terms`
--

INSERT INTO `tbl_terms` (`id`, `terms`) VALUES
(1, 'We are constantly developing new technologies and features to improve our services. For example, we use artificial intelligence and machine learning to provide you with simultaneous translations, and to better detect and block spam and malware.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `testimonial_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(512) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`testimonial_id`, `customer_name`, `rating`, `comment`, `image`) VALUES
(1, 'John Doe', 5, 'Great Service', 'view/uploads/testimonials/about-3-1.png\r\n'),
(2, 'mayuri ', 5, 'Good Quality', 'view/uploads/testimonials/testimonials-1-1.jpg'),
(3, 'Komal', 5, 'Well Service', 'view/uploads/testimonials/testimonials-1-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `customer_name` varchar(256) NOT NULL,
  `assign_to` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `due_date` date NOT NULL,
  `status` varchar(256) NOT NULL,
  `priority` varchar(256) NOT NULL,
  `description` varchar(33) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `title`, `customer_name`, `assign_to`, `created_at`, `due_date`, `status`, `priority`, `description`) VALUES
(6, 'Website Down', 'John Doe', '', '2024-10-01 17:51:16', '2024-09-20', 'Inprogress', 'Medium', ''),
(7, 'Email Issue', 'Jane Smith', 'Support Team', '2024-09-17 18:30:00', '2024-09-21', 'Inprogress', 'Medium', ''),
(8, 'Payment Gateway Error', 'Acme Corp', 'Finance Team', '2024-09-19 07:29:46', '2024-09-22', 'Closed', 'Low', ''),
(9, 'Unable to Login', 'Mark Brown', 'Tech Support', '2024-09-19 07:30:21', '2024-09-19', 'New', 'High', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `full_name` varchar(500) NOT NULL,
  `designation` varchar(500) NOT NULL,
  `mobileNo` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `designation`, `mobileNo`, `email`, `password`) VALUES
(6, 'Ashwini Satyavan Rauts', 'managing director', '8778767676', 'komaldeore09@gmail.com', '$2y$10$M/0MgNkzrkWTW1isPwnfWejMeUGaLzK/fbNG39LUgkxFb1i217LfG'),
(20, 'Gauri Khune', 'Developer', '9845467874', 'gauri@gmail.com', '$2y$10$PGeUIdTvPFflo.O.spezUe1utCOknqFT8NNCf3xu2zk0l4ec0rjLu'),
(23, 'gauri khune', 'React Developer', '9078563412', 'gaurikhune15@gmail.com', '$2y$10$Zk/hpPZzIhWzoDWICzNEhubMT6eCDaNq1ZkObddFZw8vXN8bIBtzG'),
(24, 'Nikita Dimble', 'Manager', '9756412388', 'ashwinikhatape140920@gmail.com', '$2y$10$WkjW325pC5bTz/jMlKZjt.IXka6.loRnL/rrPxnuI5.h61zYlRhty'),
(26, 'mayuri thorat', 'developer', '9078563412', 'mayuthorat6247@gmail.com', '$2y$10$u5oyvpjDYGoWwHVVeGQwHeN9ZXlqF9gVSLRoslpDBDO8JLmtbZdlm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `community`
--
ALTER TABLE `community`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `company_contact_details`
--
ALTER TABLE `company_contact_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_review`
--
ALTER TABLE `contact_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cropdaywise`
--
ALTER TABLE `cropdaywise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crop_id` (`crop_id`);

--
-- Indexes for table `crop_category`
--
ALTER TABLE `crop_category`
  ADD PRIMARY KEY (`sr.no`);

--
-- Indexes for table `crop_management`
--
ALTER TABLE `crop_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_about`
--
ALTER TABLE `tbl_about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_terms`
--
ALTER TABLE `tbl_terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`testimonial_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `community`
--
ALTER TABLE `community`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company_contact_details`
--
ALTER TABLE `company_contact_details`
  MODIFY `id` int(44) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_review`
--
ALTER TABLE `contact_review`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cropdaywise`
--
ALTER TABLE `cropdaywise`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `crop_category`
--
ALTER TABLE `crop_category`
  MODIFY `sr.no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `crop_management`
--
ALTER TABLE `crop_management`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_about`
--
ALTER TABLE `tbl_about`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_terms`
--
ALTER TABLE `tbl_terms`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `testimonial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
