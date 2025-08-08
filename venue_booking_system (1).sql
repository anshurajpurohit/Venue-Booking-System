-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 19, 2024 at 04:55 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `venue_booking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'admin123\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `venue_id` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `status` enum('pending','approved','canceled') DEFAULT 'pending',
  `order_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `user_id` (`user_id`),
  KEY `venue_id` (`venue_id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `venue_id`, `booking_date`, `status`, `order_id`) VALUES
(1, 1, 2, '2024-10-24', 'canceled', NULL),


-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Hall'),
(2, 'Party plot'),
(3, 'Banquet'),
(4, 'Resorts');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'anshu', 'anshu@gmail.com', 'Hello, I want to book a hall for 50 people at Ahemdabad', '2024-10-11 16:07:26'),
(2, 'ayaan', 'ayaan@gmail.com', 'hello i want to book party plot for 150 people at ahemadabad', '2024-10-11 16:10:39');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `venue_id` int(11) DEFAULT NULL,
  `feedback` text,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`feedback_id`),
  KEY `user_id` (`user_id`),
  KEY `venue_id` (`venue_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `venue_id`, `feedback`, `date_added`) VALUES
(1, 1, NULL, 'Venue provided by this website are awesome', '2024-10-20 17:27:38'),
(2, 1, NULL, 'venues are good', '2024-10-21 18:21:44'),
(3, 3, NULL, 'good venues', '2024-10-23 04:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) DEFAULT NULL,
  `payment_method` enum('card','upi','scanner') DEFAULT NULL,
  `payment_status` enum('paid','unpaid') DEFAULT 'unpaid',
  `payment_date` datetime DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `booking_id` (`booking_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `booking_id`, `payment_method`, `payment_status`, `payment_date`, `amount`) VALUES
(1, 4, NULL, 'unpaid', '2024-10-15 00:38:08', '0.00'),

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `amount` int(255) DEFAULT NULL,
  `pay_to` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `phone`, `address`) VALUES
(1, 'admin', 'anshadminu@gmail.com', '$2y$10$rlTs1gLCOoqpfNqo1xyFr.yO1aG9LjiTMC6g4hLRrRP6qt0dpDUOe', '1234567892', 'valsad'),


-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

DROP TABLE IF EXISTS `venues`;
CREATE TABLE IF NOT EXISTS `venues` (
  `venue_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`venue_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`venue_id`, `name`, `capacity`, `price`, `category_id`, `description`, `image`) VALUES
(1, 'Infinity Hall', 50, '1.00', 1, 'Infinity Hall\r\nInfinity Hall is a modern, versatile venue perfect for a variety of events, including weddings, corporate meetings, exhibitions, and private parties. With its spacious design, state-of-the-art lighting, and customizable layout, Infinity Hall can accommodate up to 500 guests comfortably. The hall features elegant dÃ©cor, high ceilings, and a large stage area ideal for performances or presentations.\r\n\r\nAmenities include:\r\n\r\nFully air-conditioned environment\r\nHigh-speed Wi-Fi access\r\nAdvanced audiovisual equipment\r\nAmple parking space\r\nOn-site catering services available', 'venue1.jpg'),
(2, 'Blissful Banquet Hall', 100, '80000.00', 3, 'Blissful Banquet Hall is the perfect venue for hosting grand events, offering an elegant and spacious setting for weddings, corporate gatherings, and special celebrations. Designed with modern architecture and luxurious interiors, Blissful Banquet Hall features state-of-the-art facilities, including advanced lighting and sound systems to enhance the ambiance of any occasion.\r\n\r\nWith a seating capacity of up to 500 guests, this hall ensures comfort and flexibility in event arrangements, while the in-house catering team offers a variety of delectable menus to suit every taste. The dedicated staff at Blissful Banquet Hall is committed to providing exceptional service, ensuring that every event is a success. Ample parking space, climate control, and customizable dÃ©cor options make this venue a top choice for those looking to create unforgettable memories in a stunning setting.', 'venue2.jpg'),
(3, 'Nirav Party Plot', 250, '100000.00', 2, 'Nirav Party Plot is an expansive outdoor venue ideal for large-scale events, from weddings and receptions to corporate functions and cultural celebrations. Set amidst lush greenery, this beautiful party plot offers a serene and picturesque backdrop, perfect for creating magical memories under the open sky. The spacious layout can accommodate a wide variety of event setups, with the flexibility to host up to 1000 guests comfortably.\r\n\r\nNirav Party Plot is equipped with all essential amenities, including modern lighting systems, ample parking, and premium event support services. Whether you\'re planning a traditional wedding, an elegant gala, or a lively celebration, Nirav Party Plot provides the ideal setting for a truly memorable occasion. With its natural beauty and spacious design, it offers the perfect blend of elegance and comfort for your next big event.\r\n\r\n', 'venue3.jpg'),
(4, 'Elite Crown Hall', 150, '50000.00', 1, 'Elite Crown Hall is a premier event venue designed to provide an unforgettable experience for all types of occasions. With its elegant architecture and modern interiors, the hall offers a perfect blend of luxury and comfort. Ideal for weddings, corporate events, receptions, and social gatherings, Elite Crown Hall boasts a spacious layout, state-of-the-art lighting, and high-quality sound systems to ensure that every event runs smoothly.', 'venue6.jpg'),
(5, 'Imperial Banquet', 300, '90000.00', 3, 'Imperial Banquet is a luxurious venue that elevates every event into a regal experience. Designed with a touch of grandeur and sophistication, this banquet hall is perfect for weddings, corporate functions, gala dinners, and large social gatherings. Featuring opulent interiors, shimmering chandeliers, and refined dÃ©cor, Imperial Banquet exudes elegance and offers a majestic atmosphere for memorable celebrations.', 'venue5.jpg'),
(6, 'Crystal Greens Party Plot', 500, '100000.00', 2, 'Crystal Greens Party Plot is a scenic outdoor venue that offers a perfect blend of natural beauty and modern amenities, ideal for hosting weddings, receptions, parties, and large-scale events. Nestled amidst lush greenery, this spacious party plot provides a serene and refreshing environment, making it an excellent choice for those seeking an open-air venue with a tranquil atmosphere.', 'venue4.jpg'),
(7, 'Prestige Palace Hall', 100, '80000.00', 1, 'Prestige Palace Hall is an exquisite venue that combines regal charm with modern convenience, making it the perfect choice for weddings, receptions, corporate events, and upscale social gatherings. Inspired by the grandeur of classic palaces, this hall features majestic architecture, opulent chandeliers, and tasteful dÃ©cor that create an atmosphere of luxury and elegance.\r\n\r\nThe spacious layout of Prestige Palace Hall allows for versatile seating and event arrangements, accommodating both intimate gatherings and large-scale celebrations. The venue is equipped with state-of-the-art lighting, sound systems, and a grand stage that adds an element of sophistication to any event.\r\n\r\nGuests will be treated to top-tier amenities and a welcoming environment, complemented by professional event staff dedicated to ensuring a seamless experience from start to finish. Whether youâ€™re hosting a traditional ceremony or a modern event, Prestige Palace Hall promises a memorable setting that leaves a lasting impression.', 'venue7.jpg'),
(8, 'Regal Blossom Hall', 50, '50000.00', 1, 'Regal Blossom Hall is a refined event space where elegance meets sophistication. Perfect for weddings, receptions, corporate gatherings, and special celebrations, this hall is designed to create unforgettable experiences. The name itself evokes an image of blooming luxury, and the venue delivers on that promise with its stylish interiors, adorned with floral-inspired accents and grand chandeliers that exude warmth and charm.\r\n\r\nRegal Blossom Hall features a spacious, flexible layout that can be tailored to meet the needs of any event, from intimate family functions to grand receptions. With state-of-the-art audio-visual technology and customizable lighting, your event will have the perfect ambiance, whether itâ€™s a romantic wedding or a corporate gala.\r\n\r\nIn addition to its aesthetic appeal, Regal Blossom Hall offers premium amenities and services, including professional event coordination, exquisite catering options, and ample parking facilities. The dedicated staff is committed to providing seamless support, ensuring that every detail of your event is handled with care and precision. Celebrate your most cherished moments at Regal Blossom Hall and enjoy a truly regal experience that blossoms with elegance.', 'venue8.jpg'),
(9, 'Celestial Banquet', 150, '80000.00', 3, 'Celestial Banquet is an exclusive event venue that promises to elevate your gatherings to new heights. Designed with a touch of celestial elegance, this banquet hall offers a truly enchanting setting for weddings, receptions, corporate events, and grand celebrations. With its star-like lighting, high ceilings, and luxurious dÃ©cor, Celestial Banquet creates an atmosphere that feels both sophisticated and out-of-this-world.\r\n\r\nThe venue boasts a spacious layout that can accommodate both intimate gatherings and large-scale events. Its state-of-the-art sound system, customizable lighting, and premium seating arrangements ensure that every event is tailored to perfection. Celestial Banquet also features a grand stage and a dedicated dance floor, making it the ideal space for lively celebrations and performances.\r\n\r\nGuests will appreciate the impeccable service provided by the experienced staff, who are dedicated to bringing your vision to life. From catering options that delight the palate to seamless event planning assistance, every detail at Celestial Banquet is designed to create an unforgettable experience. Step into a world where elegance meets the extraordinary and let your events shine at Celestial Banquet.', 'venue9.jpg'),
(10, 'Golden Horizon Banquet', 200, '100000.00', 3, 'Golden Horizon Banquet is a luxurious venue where elegance and warmth blend seamlessly to create the perfect setting for lifeâ€™s most memorable celebrations. Ideal for weddings, receptions, corporate events, and social gatherings, this banquet hall exudes sophistication with its golden-hued dÃ©cor, grand chandeliers, and expansive space that offers panoramic views of the eventâ€™s grandeur.\r\n\r\nWith its spacious and flexible layout, Golden Horizon Banquet can accommodate both intimate gatherings and larger events with ease. The venue is equipped with cutting-edge lighting and audio systems, ensuring that every detail of your event is highlighted and every moment is celebrated. The hallâ€™s premium design features rich accents and a polished aesthetic, making it a timeless choice for events that call for elegance.\r\n\r\nGolden Horizon Banquet also offers top-tier amenities, including customizable seating arrangements, a grand stage for performances or speeches, and dedicated dining areas that can cater to a variety of culinary preferences. The venueâ€™s experienced team is committed to providing seamless event planning and support, ensuring that your occasion is executed flawlessly. At Golden Horizon Banquet, your special moments will be elevated to golden memories that last a lifetime.', 'venue10.jpg'),
(11, 'Zenith Party Plot', 200, '100000.00', 2, 'Zenith Party Plot is an exceptional outdoor venue designed for those seeking a unique and grand space for their celebrations. With sprawling, manicured lawns and elegant landscaping, Zenith Party Plot sets the stage for weddings, receptions, festivals, and large social gatherings under the open sky. The venueâ€™s name, symbolizing the highest point, reflects its commitment to providing a top-tier experience where each event reaches its pinnacle of success.\r\n\r\nThe plot boasts ample space to accommodate both intimate ceremonies and large-scale festivities, ensuring flexibility in arrangements and creative event setups. With features like customizable seating plans, scenic lighting options, and high-quality sound systems, Zenith Party Plot can be tailored to suit any theme or occasion.\r\n\r\nGuests can enjoy a picturesque setting, complete with well-maintained gardens and open-air ambiance that provides a refreshing and luxurious backdrop for events. The venue also offers essential facilities such as parking, event coordination, and catering options to enhance your planning experience. Trust Zenith Party Plot to make your special day an unforgettable celebration under the stars, where memories are created at the peak of elegance and festivity.', 'venue11.jpg'),
(12, 'Radiant Garden Plot', 250, '80000.00', 2, 'Radiant Garden Plot is an enchanting open-air venue that brings natureâ€™s beauty and event sophistication together in perfect harmony. Ideal for weddings, receptions, birthday parties, and community gatherings, this lush party plot boasts verdant gardens and radiant floral arrangements that create an inviting and vibrant atmosphere. The venueâ€™s name speaks to its ability to illuminate every occasion, making it shine with elegance and warmth.\r\n\r\nSpread across a spacious landscape, Radiant Garden Plot offers the flexibility to host both intimate events and larger celebrations. The venue features stunning landscaping, elegant pathways, and ambient lighting that enhances the natural beauty of the space, making day and night events equally captivating.\r\n\r\nEquipped with modern amenities such as customizable seating, a central stage for ceremonies or performances, and quality audio-visual support, Radiant Garden Plot ensures your event will be seamless and memorable. Professional event coordination services and catering options are also available to help bring your vision to life.\r\n\r\nWhether youâ€™re looking for a romantic garden wedding or a lively outdoor party, Radiant Garden Plot provides a breathtaking setting that radiates charm and joy, creating lasting memories for you and your guests.', 'venue12.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
