-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 05:54 PM
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
-- Database: `photoedit`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Wedding/Reception', 1, 'weddingreception', '2025-04-25 02:15:13', '2025-04-26 08:10:50'),
(2, 'Akdh/Engagement', 1, 'akdhengagement', '2025-04-25 02:15:13', '2025-04-26 08:11:02'),
(3, 'Haldi/Mehendi', 1, 'haldimehendi', '2025-04-25 02:15:13', '2025-04-26 08:11:14'),
(4, 'Hindu', 1, 'hindu', '2025-04-25 02:15:13', '2025-04-26 08:11:24'),
(5, 'Wedding Birthday', 1, 'wedding-birthday', '2025-04-25 02:15:13', '2025-04-26 08:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `cinematographies`
--

CREATE TABLE `cinematographies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `youtube_url` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `slug` varchar(255) NOT NULL,
  `credit` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cinematographies`
--

INSERT INTO `cinematographies` (`id`, `title`, `youtube_url`, `status`, `slug`, `credit`, `created_at`, `updated_at`) VALUES
(1, 'Quia cum harum conse', 'https://www.youtube.com/embed/zE04Ua6E52U', 1, 'quia-cum-harum-conse', 'Et exercitationem ut', '2025-04-25 08:34:25', '2025-04-25 08:34:25'),
(2, 'Aliquam vitae assume', 'https://www.youtube.com/embed/zE04Ua6E52U', 1, 'aliquam-vitae-assume', 'Ipsum sapiente et m', '2025-04-25 08:34:32', '2025-04-25 08:34:32'),
(3, 'Recusandae Sit solu', 'https://www.youtube.com/embed/zE04Ua6E52U', 1, 'recusandae-sit-solu', 'Molestias ex repelle', '2025-04-25 08:34:39', '2025-04-25 08:35:10');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Fazle Rabbi Zidan', 'zidankhan718@gmail.com', 'Omnis aut voluptatib', 'uyu', '2025-04-25 09:09:16', '2025-04-25 09:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `custom_pages`
--

CREATE TABLE `custom_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `body` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_pages`
--

INSERT INTO `custom_pages` (`id`, `title`, `slug`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `body`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'about-us', 'About Our Real Estate Company', 'Learn more about our real estate agency, providing top-quality services in buying, selling, and renting properties.', 'real estate, property, homes, apartments, buy, sell, rent', 1, '<div class=\"row\">\r\n            <div class=\"col-lg-6 mb-4 mb-lg-0\">\r\n                <div class=\"about_bx\">\r\n                    <img src=\"frontend/assets/img/project-7.jpg\" class=\"w-100 rounded shape-md\" alt=\"\">\r\n                </div>\r\n            </div>\r\n            <div class=\"col-lg-6\">\r\n                <div class=\"h-100\">\r\n                    <p class=\"text-primary text-uppercase sub_title mb-2\">About Us</p>\r\n                    <h1 class=\"title mb-4\">Premium Class Photography & Cinematography Services</h1>\r\n                    <p>\r\n                        Bridal Harmony is a premium wedding photography and cinematography company based in\r\n                        Bangladesh, specializing in capturing the unforgettable moments of your big day. Established\r\n                        in 2013, our team of experienced photographers and cinematographers have been capturing the\r\n                        essence of love, joy, and celebration through our lens. At Bridal Harmony, we understand\r\n                        that every couple is unique, and so are their wedding stories. Our mission is to immortalize\r\n                        your special day with our artistic flair and expertise. We strive to capture the\r\n                        authenticity of your love, the beauty of the event, and the emotions that make your day\r\n                        unforgettable. © Bridal Harmony Bangladesh. Contact us for Booking : +88 01742 22 55 84, +88\r\n                        01772 22 55 65 Premium Class Wedding Photography &amp; Cinematography. Since 2013. Follow us\r\n                        on Instagram : bridalharmony.bangladesh Package Details : www.bridalharmonybd.com/packages\r\n                        Facebook : bridalharmonybd\r\n                    </p>\r\n                </div>\r\n            </div>\r\n        </div>', '2025-04-25 02:15:13', '2025-04-25 23:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `slug`, `status`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Chittagong', 'chittagong', '1', 'uploads/slider/dhaka.jpg', '2025-04-26 06:53:27', '2025-04-26 07:17:07'),
(3, 'Dhaka', 'dhaka', '1', 'uploads/slider/chittagong.jpg', '2025-04-26 06:56:59', '2025-04-26 07:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_page_contents`
--

CREATE TABLE `home_page_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `homepage_title` varchar(255) DEFAULT NULL,
  `homepage_content` text DEFAULT NULL,
  `about_title` varchar(255) DEFAULT NULL,
  `about_content` text DEFAULT NULL,
  `home_btn` varchar(255) DEFAULT NULL,
  `about_btn` varchar(255) DEFAULT NULL,
  `footer_title` varchar(255) DEFAULT NULL,
  `footer_btn` varchar(255) DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_page_contents`
--

INSERT INTO `home_page_contents` (`id`, `homepage_title`, `homepage_content`, `about_title`, `about_content`, `home_btn`, `about_btn`, `footer_title`, `footer_btn`, `youtube_link`, `facebook_link`, `linkedin_link`, `twitter_link`, `phone`, `instagram_link`, `email`, `created_at`, `updated_at`, `address`, `image`) VALUES
(1, 'More Than 2000+ Customers Trusted Us', NULL, 'Premium Class Photography & Cinematography Services', 'Bridal Harmony is a team of experienced professional photographers, cinematographers and photo-book experts who are dedicated to creating stunning, authentic stories of people\'s live.\r\n\r\nLorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi quaerat animi asperiores illo. Quaerat, deserunt natus. Minima sit numquam dolorum.', NULL, 'Read More', 'memorylick.com', NULL, 'https://www.youtube.com/embed/zE04Ua6E52U', 'https://www.youtube.com/embed/zE04Ua6E52U', NULL, 'https://www.youtube.com/embed/zE04Ua6E52U', '01232548', 'https://www.youtube.com/embed/zE04Ua6E52U', 'test@gmail.com', NULL, '2025-04-27 13:00:14', 'test', 'uploads/logo/1745780414_680e7ebe04368.png');

-- --------------------------------------------------------

--
-- Table structure for table `image_galleries`
--

CREATE TABLE `image_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `images` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_10_26_060427_create_categories_table', 1),
(7, '2023_11_03_090500_create_products_table', 1),
(8, '2025_01_22_170350_create_custom_pages_table', 1),
(9, '2025_01_24_095250_create_image_galleries_table', 1),
(10, '2025_01_28_165811_create_permission_tables', 1),
(11, '2025_02_15_050728_create_properties_table', 1),
(13, '2025_04_24_183934_create_sliders_table', 1),
(14, '2025_04_25_031357_create_our_services_table', 1),
(16, '2025_04_25_041104_create_recent_works_table', 1),
(18, '2025_04_25_085142_create_photographies_table', 2),
(20, '2025_04_25_033653_create_testimonials_table', 4),
(21, '2025_04_25_093330_create_cinematographies_table', 5),
(22, '2025_02_18_180117_create_home_page_contents_table', 6),
(23, '2023_10_26_060244_create_contacts_table', 7),
(24, '2025_04_25_160219_create_package_categories_table', 8),
(25, '2025_04_26_040149_create_teams_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `our_services`
--

CREATE TABLE `our_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `our_services`
--

INSERT INTO `our_services` (`id`, `title`, `image`, `description`, `status`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Maternity Photography', 'uploads/services/1745588781_1.jpg', 'Make your special day last a lifetime with Bridal Harmony\'s exceptional wedding\r\n                            photography services. Our talented team is dedicated to capturing the magic of your', 1, 'maternity-photography', '2025-04-25 07:46:21', '2025-04-25 07:46:21'),
(3, 'Wedding Cinematography', 'uploads/services/1745588821_3.jpg', 'Elevate your wedding day memories with the enchanting storytelling of Bridal Harmony\'s\r\n                            wedding cinematography services. We specialize in capturing the essence of your love\r\n                            story', 1, 'wedding-cinematography', '2025-04-25 07:47:01', '2025-04-25 07:47:01'),
(4, 'Birthday Photography', 'uploads/services/1745588843_4.jpg', 'Celebrate your special day with Bridal Harmony\'s birthday photography services. We\r\n                            specialize in capturing the joy, laughter, and unforgettable moments of your birthday\r\n                            celebration.', 1, 'birthday-photography', '2025-04-25 07:47:23', '2025-04-25 07:47:23'),
(5, 'Maternity Photography', 'uploads/services/1745588781_1.jpg', 'Make your special day last a lifetime with Bridal Harmony\'s exceptional wedding\r\n                            photography services. Our talented team is dedicated to capturing the magic of your', 1, 'maternity-photogragphy', '2025-04-25 07:46:21', '2025-04-25 07:46:21'),
(6, 'Wedding Cinematography', 'uploads/services/1745588821_3.jpg', 'Elevate your wedding day memories with the enchanting storytelling of Bridal Harmony\'s\r\n                            wedding cinematography services. We specialize in capturing the essence of your love\r\n                            story', 1, 'wedding-cinematogrgfgaphy', '2025-04-25 07:47:01', '2025-04-25 07:47:01'),
(7, 'Birthday Photography', 'uploads/services/1745588843_4.jpg', 'Celebrate your special day with Bridal Harmony\'s birthday photography services. We\r\n                            specialize in capturing the joy, laughter, and unforgettable moments of your birthday\r\n                            celebration.', 1, 'birthday-photogragfgphy', '2025-04-25 07:47:23', '2025-04-25 07:47:23');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `photographer` varchar(255) DEFAULT NULL,
  `cinematographer` varchar(255) DEFAULT NULL,
  `number_of_photos` varchar(100) DEFAULT NULL,
  `chief` varchar(255) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `division_id`, `category_id`, `package_name`, `slug`, `price`, `photographer`, `cinematographer`, `number_of_photos`, `chief`, `status`, `image`, `created_at`, `updated_at`) VALUES
(5, 2, 2, 'Economy Series', 'economy-series', 9999.00, 'One Top Photographer', NULL, 'unlimited', NULL, '1', 'uploads/slider/4.jpg', '2025-04-26 07:46:41', '2025-04-26 15:34:49'),
(6, 2, 5, 'Signature Series', 'signature-series', 27999.00, '1 Senior Photographer', NULL, 'Unlimited number of Photos.', 'Chief Photographer (Riazul Islam Shawon)', '1', 'uploads/slider/3.jpg', '2025-04-26 08:36:31', '2025-04-26 10:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `package_categories`
--

CREATE TABLE `package_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_categories`
--

INSERT INTO `package_categories` (`id`, `name`, `status`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'HD', 1, 'hd', '2025-04-25 10:16:34', '2025-04-25 10:16:34'),
(4, 'HDd', 1, 'hdd', '2025-04-25 10:18:25', '2025-04-25 10:18:25'),
(5, 'sds', 1, 'sds', '2025-04-25 11:05:31', '2025-04-25 11:05:31');

-- --------------------------------------------------------

--
-- Table structure for table `package_features`
--

CREATE TABLE `package_features` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_features`
--

INSERT INTO `package_features` (`id`, `package_id`, `name`, `created_at`, `updated_at`) VALUES
(57, 5, '1 Top Photographer.', '2025-04-26 09:21:47', '2025-04-26 09:21:47'),
(58, 5, 'Unlimited Photoshoot.', '2025-04-26 09:21:47', '2025-04-26 09:21:47'),
(59, 5, 'All Photos will be Edited.', '2025-04-26 09:21:47', '2025-04-26 09:21:47'),
(60, 5, 'All Photos (RAW+Edited) will be Delivered in Client’s Pen drive / Portable Hard Drive.', '2025-04-26 09:21:47', '2025-04-26 09:21:47'),
(61, 5, '4.5-5 Hours shoot.', '2025-04-26 09:21:47', '2025-04-26 09:21:47'),
(62, 5, 'All Necessary Light setup for Photography (Full Frame Camera, Necessary all Lenses, Soft Box etc).', '2025-04-26 09:21:47', '2025-04-26 09:21:47'),
(70, 6, 'Hours Portrait Session With our Chief Photographer Riazul Islam Shawon.', '2025-04-26 10:41:02', '2025-04-26 10:41:02'),
(71, 6, '1 Senior Photographer for Group, Guest, Family & other photos.', '2025-04-26 10:41:02', '2025-04-26 10:41:02'),
(72, 6, 'Total 4.5-5 hours Shift.', '2025-04-26 10:41:02', '2025-04-26 10:41:02'),
(73, 6, '100 (4R Size) & 2 (12L Size) Printed Hard copy.', '2025-04-26 10:41:02', '2025-04-26 10:41:02'),
(74, 6, 'All Photos will be Edited.', '2025-04-26 10:41:02', '2025-04-26 10:41:02'),
(75, 6, 'All Necessary Light setup for Photography (Full Frame Camera, Necessary all Lenses, Soft Box etc).', '2025-04-26 10:41:02', '2025-04-26 10:41:02'),
(76, 6, '1 Photo Album.', '2025-04-26 10:41:02', '2025-04-26 10:41:02');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view users', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(2, 'create users', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(3, 'edit users', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(4, 'delete users', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(5, 'view roles', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(6, 'create roles', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(7, 'edit roles', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(8, 'delete roles', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(9, 'view permissions', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(10, 'create permissions', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(11, 'edit permissions', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(12, 'delete permissions', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(13, 'view dashboard', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(14, ' view properties', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(15, 'view Service', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(16, ' view users', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(17, 'view roles permissions', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(18, ' view home page content', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(19, ' view custom page', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13'),
(20, '  view faq', 'web', '2025-04-25 02:15:13', '2025-04-25 02:15:13');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photographies`
--

CREATE TABLE `photographies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `images` text DEFAULT NULL,
  `package_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photographies`
--

INSERT INTO `photographies` (`id`, `title`, `image`, `client_name`, `status`, `slug`, `category_id`, `created_at`, `updated_at`, `images`, `package_name`) VALUES
(4, 'Labono ~ Apu', 'uploads/photography/1745676810_2.jpg', 'Labono ~ Apu', 1, 'labono-apu', 1, '2025-04-25 09:48:10', '2025-04-26 09:01:41', '[\"uploads\\/photography\\/1745596090_680baebac11da_3.jpg\",\"uploads\\/photography\\/1745596090_680baebac1559_5.jpg\",\"uploads\\/photography\\/1745596090_680baebac1878_about.jpg\",\"uploads\\/photography\\/1745596090_680baebac1bc6_about-1.jpg\"]', 'Signature Series'),
(5, 'Wedding', 'uploads/photography/1745677611_3.jpg', 'Simona ~ Badhon', 1, 'wedding', 2, '2025-04-25 10:48:26', '2025-04-26 09:01:53', '[\"uploads\\/photography\\/1745599706_680bbcda2257a_2.jpg\",\"uploads\\/photography\\/1745599706_680bbcda229c3_3.jpg\",\"uploads\\/photography\\/1745599706_680bbcda22e05_4.jpg\",\"uploads\\/photography\\/1745599706_680bbcda2323a_5.jpg\",\"uploads\\/photography\\/1745599706_680bbcda23532_about.jpg\",\"uploads\\/photography\\/1745599706_680bbcda2399b_about-1.jpg\"]', 'Signature Series'),
(6, 'Wedding Reception || Bridal Harmony', 'uploads/photography/1745677701_4.jpg', 'Wedding || Bridal Harmony', 1, 'wedding-reception-bridal-harmony', 4, '2025-04-25 23:41:18', '2025-04-26 09:08:27', '[\"uploads\\/photography\\/1745680107_680cf6eb563e8_2.jpg\",\"uploads\\/photography\\/1745680107_680cf6eb5680a_3.jpg\",\"uploads\\/photography\\/1745680107_680cf6eb56b30_4.jpg\",\"uploads\\/photography\\/1745680107_680cf6eb56e05_5.jpg\",\"uploads\\/photography\\/1745680107_680cf6eb5713d_about.jpg\"]', 'Premium Series'),
(7, 'Tulika & Pradip || Wedding', 'uploads/photography/1745677761_5.jpg', 'ulika & Pradip', 1, 'tulika-pradip-wedding-7761', 1, '2025-04-26 08:29:21', '2025-04-26 08:29:21', '[\"uploads\\/photography\\/1745677761_680cedc149a4c_2.jpg\",\"uploads\\/photography\\/1745677761_680cedc149fba_3.jpg\",\"uploads\\/photography\\/1745677761_680cedc14a49e_4.jpg\",\"uploads\\/photography\\/1745677761_680cedc14a9e2_5.jpg\"]', ''),
(8, 'Sed sit in ullam nec', 'uploads/photography/1745679562_5.jpg', 'Miranda Tyson', 1, 'sed-sit-in-ullam-nec-9562', 4, '2025-04-26 08:59:22', '2025-04-26 08:59:22', '[\"uploads\\/photography\\/1745679562_680cf4ca3e614_5.jpg\"]', 'Tucker Carroll');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `steps` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `before_image` varchar(255) DEFAULT NULL,
  `after_image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recent_works`
--

CREATE TABLE `recent_works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `social_media_name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `images` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recent_works`
--

INSERT INTO `recent_works` (`id`, `name`, `package_name`, `image`, `social_media_name`, `status`, `images`, `created_at`, `updated_at`) VALUES
(1, 'Fazle Rabbi Zidan', 'ss', 'uploads/recent-work/1745590492_2.jpg', 'ss', 1, '[\"uploads\\/recent-work\\/1745569950_680b489ee2e7a_ninmdnlfv6glh9tqsnmsdpd1oyw2tl290840.jpg\"]', '2025-04-25 02:32:30', '2025-04-25 08:14:52'),
(2, 'Brianna England', 'Luke Orr', 'uploads/recent-work/1745590481_about.jpg', 'Rama Tillman', 1, '[\"uploads\\/recent-work\\/1745590481_680b98d17e861_5.jpg\"]', '2025-04-25 08:14:41', '2025-04-25 08:16:12'),
(3, 'Fazle Rabbi Zidan', 'ss', 'uploads/recent-work/1745590492_2.jpg', 'ss', 1, '[\"uploads\\/recent-work\\/1745569950_680b489ee2e7a_ninmdnlfv6glh9tqsnmsdpd1oyw2tl290840.jpg\"]', '2025-04-25 02:32:30', '2025-04-25 08:14:52'),
(4, 'Brianna England', 'Luke Orr', 'uploads/recent-work/1745590481_about.jpg', 'Rama Tillman', 1, '[\"uploads\\/recent-work\\/1745590481_680b98d17e861_5.jpg\"]', '2025-04-25 08:14:41', '2025-04-25 08:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_number` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `sort_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 'uploads/slider/1.jpg', '8', 1, '2025-04-25 02:34:35', '2025-04-25 07:19:42'),
(3, 'uploads/slider/2.jpg', '2', 1, '2025-04-25 07:19:54', '2025-04-25 07:19:54'),
(4, 'uploads/slider/3.jpg', '3', 1, '2025-04-25 07:20:03', '2025-04-25 07:20:03');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `designation`, `image`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Amelia Clarke', 'Lead Photographer', 'uploads/team/680ce8c727dc1.png', NULL, '2025-04-25 22:28:18', '2025-04-26 08:08:07'),
(3, 'Ethan Reynolds', 'Cinematography Director', 'uploads/team/680ce8d6552ed.png', NULL, '2025-04-25 22:28:28', '2025-04-26 08:08:22'),
(4, 'Charlotte Bennett', 'Creative Director', 'uploads/team/680ce901f1209.png', NULL, '2025-04-25 22:28:41', '2025-04-26 08:09:05'),
(5, 'Mason Carter', 'Senior Editor', 'uploads/team/680ce9121112b.png', NULL, '2025-04-25 22:54:07', '2025-04-26 08:09:22'),
(6, 'Test', 'test', 'uploads/team/680e48c3f06aa.png', NULL, '2025-04-27 09:09:55', '2025-04-27 09:09:55');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `designation`, `image`, `rating`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sophia Wilson', 'Wedding Client', 'uploads/testimonial/5.jpg', '4', 'Amazing experience! Highly recommend their service.', 1, '2025-04-25 08:05:01', '2025-04-25 08:08:18'),
(2, 'Raju', 'Organizer', 'uploads/testimonial/5.jpg', '3', 'Good service but there is room for improvement.', 1, '2025-04-25 08:05:09', '2025-04-26 08:04:49'),
(3, 'Mehedi Hasan', 'Photo Planner', 'uploads/testimonial/5.jpg', '5', 'They truly made my day special. Thank you!', 1, '2025-04-25 08:05:01', '2025-04-26 08:04:41'),
(4, 'Disha', 'Photo Planner', 'uploads/testimonial/5.jpg', '3', 'They truly made my day special. Thank you!', 1, '2025-04-25 08:05:09', '2025-04-26 08:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `role`, `image`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '01711111111', 'admin', '1745686957.png', 'admin@gmail.com', NULL, '$2y$10$6JAvUWmVMnd09qfHk2mBNe9cMEH5oTqdoeFxTKcSy8oTCc2e22Cuq', NULL, '2025-04-25 02:15:13', '2025-04-26 11:02:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `cinematographies`
--
ALTER TABLE `cinematographies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cinematographies_slug_unique` (`slug`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_pages`
--
ALTER TABLE `custom_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `home_page_contents`
--
ALTER TABLE `home_page_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_galleries`
--
ALTER TABLE `image_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `our_services`
--
ALTER TABLE `our_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `our_services_slug_unique` (`slug`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_categories`
--
ALTER TABLE `package_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `package_categories_slug_unique` (`slug`);

--
-- Indexes for table `package_features`
--
ALTER TABLE `package_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `photographies`
--
ALTER TABLE `photographies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `photographies_slug_unique` (`slug`),
  ADD KEY `photographies_category_id_foreign` (`category_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recent_works`
--
ALTER TABLE `recent_works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cinematographies`
--
ALTER TABLE `cinematographies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `custom_pages`
--
ALTER TABLE `custom_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_page_contents`
--
ALTER TABLE `home_page_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `image_galleries`
--
ALTER TABLE `image_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `our_services`
--
ALTER TABLE `our_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `package_categories`
--
ALTER TABLE `package_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `package_features`
--
ALTER TABLE `package_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photographies`
--
ALTER TABLE `photographies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recent_works`
--
ALTER TABLE `recent_works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `photographies`
--
ALTER TABLE `photographies`
  ADD CONSTRAINT `photographies_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
