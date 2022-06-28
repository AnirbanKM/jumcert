-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2022 at 04:59 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jumcertdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `phone_no`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jumcert', 'admin@gmail.com', '$2y$10$4x410cK7Z7DDDG0uHGoPKeW.rb0Oksh6CLm7mt.iMqdPFPRDSpcAi', '123456789', 'US 705788', 'vNohO6Avg6', '2022-06-14 06:30:41', '2022-06-14 06:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `admin_commissions`
--

CREATE TABLE `admin_commissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acommission` int(11) NOT NULL,
  `ucommission` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_commissions`
--

INSERT INTO `admin_commissions` (`id`, `role`, `acommission`, `ucommission`, `created_at`, `updated_at`) VALUES
(1, 'Pro', 20, 80, NULL, '2022-06-14 13:14:12'),
(2, 'Business', 30, 70, NULL, '2022-06-14 13:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `desc`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Music', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 'public/admin_category/z6j62kBcrMjv0eWawUQeHu6n95zlyV45RcOleK9M.png', '2022-06-14 06:34:40', '2022-06-14 06:34:40'),
(2, 'Sports', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 'public/admin_category/ADpoqnopGKv5rkw39pC8gHDswltC5E8hLnkVFvjN.png', '2022-06-14 06:34:59', '2022-06-14 06:34:59'),
(3, 'News', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 'public/admin_category/94GqAEZQqJxCYdE7UyMNmppk6qmHTkDUZPhBHv9a.png', '2022-06-14 06:36:42', '2022-06-14 06:41:08'),
(4, 'Learning', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 'public/admin_category/6yFKdyD54Df5JOEk09NwGidHWaogzF4eZkeoEnw0.png', '2022-06-14 06:41:36', '2022-06-14 06:41:36');

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE `channels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) NOT NULL,
  `playlist_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`id`, `name`, `image`, `slug`, `desc`, `user_id`, `playlist_id`, `created_at`, `updated_at`) VALUES
(1, 'kids world', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655210653kids.jpg', 'kids_world', 'Officia repudiandae', 2, '1,2', '2022-06-14 07:14:15', '2022-06-14 07:20:51'),
(2, 'technical', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/165521208924701-nature-natural-beauty.jpg', '62a88839effd5', 'Ut perspiciatis ips', 3, '3', '2022-06-14 07:38:12', '2022-06-14 07:42:04'),
(3, 'Test user', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655883619Hopetoun_falls.jpg', '62b2c7630d7bf', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 5, '4', '2022-06-22 02:10:31', '2022-06-22 02:11:22');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video_id` int(11) NOT NULL,
  `channel_id` int(11) DEFAULT '0',
  `owner_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `msg` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `chat_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive',
  `first_time` int(11) NOT NULL DEFAULT '0',
  `seen` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `video_id`, `channel_id`, `owner_id`, `sender_id`, `receiver_id`, `msg`, `chat_id`, `status`, `first_time`, `seen`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 2, 1, 2, 'hello', '670074', 'Active', 0, 1, '2022-06-21 00:55:08', '2022-06-22 03:54:11'),
(4, 1, 0, 2, 1, 2, 'hi', '692016', 'Inactive', 0, 1, '2022-06-21 02:19:58', '2022-06-22 03:54:11'),
(5, 6, 0, 3, 1, 3, 'check', '752564', 'Inactive', 0, 1, '2022-06-21 03:56:48', '2022-06-21 08:34:35'),
(6, 1, 0, 2, 2, 1, '123', '122964', 'Inactive', 0, 1, '2022-06-21 04:00:19', '2022-06-23 03:30:44'),
(7, 1, 0, 2, 1, 2, 'uuu', '736380', 'Inactive', 0, 1, '2022-06-21 04:02:41', '2022-06-22 03:54:11'),
(8, 6, 0, 3, 6, 3, 'n', '735249', 'Active', 0, 0, '2022-06-21 08:26:57', '2022-06-21 08:28:35'),
(9, 6, 0, 3, 3, 6, 'juyyu', '242327', 'Inactive', 0, 1, '2022-06-21 08:28:52', '2022-06-21 10:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `live_streams`
--

CREATE TABLE `live_streams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `streamDateTime` datetime NOT NULL,
  `topic` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel_id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  `stream_token` bigint(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream_type` enum('Public','Private') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Public',
  `price` double(12,2) DEFAULT '0.00',
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Completed','Pending','Streaming','Cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `total_views` int(11) NOT NULL DEFAULT '0',
  `stream_buyer_limit` int(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `live_streams`
--

INSERT INTO `live_streams` (`id`, `streamDateTime`, `topic`, `role`, `channel_id`, `playlist_id`, `stream_token`, `user_id`, `description`, `stream_type`, `price`, `thumbnail`, `status`, `total_views`, `stream_buyer_limit`, `created_at`, `updated_at`) VALUES
(1, '2022-07-20 19:10:00', 'Nesciunt pariatur', 'host', 1, 1, NULL, 2, 'Eaque minima aut vel', 'Public', 0.00, 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655211651download.jpg', 'Pending', 1, 0, '2022-06-14 07:30:52', '2022-06-22 00:28:33'),
(2, '2022-07-31 14:26:00', 'Corporis voluptas mo', 'host', 1, 1, 2266498241, 2, 'Aut qui amet dolore', 'Public', 0.00, 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655211796download2.jpg', 'Pending', 0, 0, '2022-06-14 07:33:17', '2022-06-20 07:48:52'),
(3, '2022-07-31 11:33:00', 'Ea iusto quam aliqua', 'host', 1, 1, 2773620968, 2, 'Itaque non maiores l', 'Private', 100.00, 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655211834download3.jpg', 'Pending', 0, 0, '2022-06-14 07:33:55', '2022-06-21 06:15:44'),
(4, '2022-07-31 19:24:00', 'Iste non et cum magn', 'host', 2, 3, 2710673702, 3, 'Eius et non accusant', 'Public', 0.00, 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/16552759175081.webp', 'Pending', 0, 0, '2022-06-15 01:22:02', '2022-06-15 08:57:47'),
(5, '2022-06-23 07:08:00', 'dfhgdfh', 'host', 3, 4, NULL, 5, 'fgjxfgyjkfgjgfyjgyjytg', 'Private', 70.00, 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/165588407724701-nature-natural-beauty.jpg', 'Pending', 0, 0, '2022-06-22 02:18:00', '2022-06-22 02:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_03_30_072813_create_admins_table', 1),
(5, '2022_03_30_092436_create_categories_table', 1),
(6, '2022_04_01_080420_create_tests_table', 1),
(7, '2022_04_06_061608_create_user_profile_infos_table', 1),
(8, '2022_04_11_052358_create_playlists_table', 1),
(9, '2022_04_11_073459_create_video_uploads_table', 1),
(10, '2022_04_11_110310_create_playlistvideouploads_table', 1),
(11, '2022_04_12_130615_create_channels_table', 1),
(12, '2022_04_18_070955_create_payments_table', 1),
(13, '2022_04_18_071036_create_orders_table', 1),
(14, '2022_04_25_105852_create_live_streams_table', 1),
(15, '2022_04_27_120906_create_stream_records_table', 1),
(16, '2022_05_12_071037_create_private_videos_table', 1),
(17, '2022_05_19_061737_create_private_streams_table', 1),
(18, '2022_05_24_091820_create_chats_table', 1),
(19, '2022_06_01_093537_create_admin_commissions_table', 1),
(20, '2022_06_01_114855_create_user_accounts_table', 1),
(21, '2022_06_14_093622_create_wallets_table', 1),
(22, '2022_06_20_103602_create_stream_recorders_table', 2),
(23, '2022_06_27_111528_create_supports_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(12,2) DEFAULT '0.00',
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `plan_name`, `price`, `payment_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Business', 50.00, 1, 2, '2022-06-14 06:53:34', '2022-06-14 06:53:34'),
(2, 'Pro', 19.00, 2, 3, '2022-06-14 06:59:39', '2022-06-14 06:59:39'),
(3, 'Pro', 19.00, 3, 3, '2022-06-15 23:32:24', '2022-06-15 23:32:24'),
(4, 'Business', 50.00, 4, 2, '2022-06-15 23:34:20', '2022-06-15 23:34:20'),
(5, 'Pro', 19.00, 5, 5, '2022-06-22 00:28:31', '2022-06-22 00:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_secret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','Failed','Success') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_id`, `user_id`, `client_secret`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(1, 'pi_3LAYm9G6d8NW7tSt0zm1Dka9', '2', 'pi_3LAYm9G6d8NW7tSt0zm1Dka9_secret_CkjDY2oywSURzA1Wq69jm0jmX', 'pm_1LAYmNG6d8NW7tStQUUub13Z', 'Success', '2022-06-14 06:53:34', '2022-06-14 06:53:34'),
(2, 'pi_3LAYrxG6d8NW7tSt15PBQE40', '3', 'pi_3LAYrxG6d8NW7tSt15PBQE40_secret_cecLbPtwrgM6dmplgGnzdT3r9', 'pm_1LAYsGG6d8NW7tStb7ZmNli2', 'Success', '2022-06-14 06:59:39', '2022-06-14 06:59:39'),
(3, 'pi_3LBAqHG6d8NW7tSt128UlOrX', '3', 'pi_3LBAqHG6d8NW7tSt128UlOrX_secret_Iq4nLLAD5OiRUgEAYTjNpmvNj', 'pm_1LBAqWG6d8NW7tStYDUc2pGA', 'Success', '2022-06-15 23:32:24', '2022-06-15 23:32:24'),
(4, 'pi_3LBAsDG6d8NW7tSt0GX6Hndu', '2', 'pi_3LBAsDG6d8NW7tSt0GX6Hndu_secret_2q8pkdHqx9J0GPMJSTbUC4YZR', 'pm_1LBAsPG6d8NW7tSt6a6m48JI', 'Success', '2022-06-15 23:34:20', '2022-06-15 23:34:20'),
(5, 'pi_3LDMZyG6d8NW7tSt0Q97abCW', '5', 'pi_3LDMZyG6d8NW7tSt0Q97abCW_secret_UrtgdPwctP4t1AMqCJ2Vla2Tz', 'pm_1LDMa9G6d8NW7tStSwbDMgmA', 'Success', '2022-06-22 00:28:31', '2022-06-22 00:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `title`, `user_id`, `image`, `desc`, `status`, `created_at`, `updated_at`) VALUES
(1, 'playlist 1', 2, 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/16552106974429.webp', 'Et dignissimos conse', 'Inactive', '2022-06-14 07:14:58', '2022-06-14 07:14:58'),
(2, 'playlist 2', 2, 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655210717download3.jpg', 'Animi deserunt ipsu', 'Inactive', '2022-06-14 07:15:18', '2022-06-14 07:15:18'),
(3, 'Playlist 3', 3, 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655212127Hopetoun_falls.jpg', 'Itaque amet dolor s', 'Inactive', '2022-06-14 07:38:51', '2022-06-14 07:38:51'),
(4, 'test playlist', 5, 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655883670support-technical-support.jpg', 'asdsaDFasDfsafasGFESAGFGegr', 'Inactive', '2022-06-22 02:11:12', '2022-06-22 02:11:12');

-- --------------------------------------------------------

--
-- Table structure for table `playlist_videouploads`
--

CREATE TABLE `playlist_videouploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `playlist_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `videoupload_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `playlist_videouploads`
--

INSERT INTO `playlist_videouploads` (`id`, `playlist_id`, `videoupload_id`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '2022-06-14 07:15:59', '2022-06-14 07:15:59'),
(2, '1', '2', '2022-06-14 07:16:58', '2022-06-14 07:16:58'),
(3, '2', '3', '2022-06-14 07:18:56', '2022-06-14 07:18:56'),
(4, '1', '4', '2022-06-14 07:20:14', '2022-06-14 07:20:14'),
(5, '3', '5', '2022-06-14 07:40:13', '2022-06-14 07:40:13'),
(6, '3', '6', '2022-06-14 07:40:50', '2022-06-14 07:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `private_streams`
--

CREATE TABLE `private_streams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stream_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `playlist_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(12,2) DEFAULT '0.00',
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_secret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','Failed','Success') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `private_streams`
--

INSERT INTO `private_streams` (`id`, `stream_id`, `stream_token`, `channel_id`, `playlist_id`, `buyer_id`, `price`, `payment_id`, `client_secret`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(1, '3', NULL, '1', '1', '6', 100.00, 'pi_3LDNo0G6d8NW7tSt0wU0pHtV', 'pi_3LDNo0G6d8NW7tSt0wU0pHtV_secret_t7UVBsaj1H181Mc9jjXzJDw95', 'pm_1LDNoZG6d8NW7tStvciqRqPX', 'Success', '2022-06-22 01:47:28', '2022-06-22 01:47:28');

-- --------------------------------------------------------

--
-- Table structure for table `private_videos`
--

CREATE TABLE `private_videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(12,2) DEFAULT '0.00',
  `client_secret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','Failed','Success') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `private_videos`
--

INSERT INTO `private_videos` (`id`, `payment_id`, `user_id`, `video_id`, `price`, `client_secret`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(1, 'pi_3LDiMjG6d8NW7tSt1URuzvnY', '1', '6', 100.00, 'pi_3LDiMjG6d8NW7tSt1URuzvnY_secret_UqFtbTNcnVeKFUnhnOZcjULkz', 'pm_1LDiN1G6d8NW7tStT8G4aIes', 'Success', '2022-06-22 23:44:27', '2022-06-22 23:44:27');

-- --------------------------------------------------------

--
-- Table structure for table `stream_recorders`
--

CREATE TABLE `stream_recorders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `channel_owner_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `video_path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stream_recorders`
--

INSERT INTO `stream_recorders` (`id`, `channel_owner_id`, `buyer_id`, `video_path`, `stream_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'https://jumcertstorage.s3.amazonaws.com/jumcert/72b6d4816f457acf209ed08574c4d384_kids_world_0.mp4', 3, '2022-06-21 06:17:55', '2022-06-21 06:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `stream_records`
--

CREATE TABLE `stream_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guest_id` tinyint(4) NOT NULL,
  `guest_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stream_records`
--

INSERT INTO `stream_records` (`id`, `guest_id`, `guest_ip_address`, `event_id`, `created_at`, `updated_at`) VALUES
(1, 2, '127.0.0.1', 1, '2022-06-14 06:51:32', '2022-06-14 06:51:32'),
(2, 3, '127.0.0.1', 1, '2022-06-14 06:59:43', '2022-06-14 06:59:43'),
(3, 5, '127.0.0.1', 1, '2022-06-22 00:28:33', '2022-06-22 00:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `supports`
--

CREATE TABLE `supports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supports`
--

INSERT INTO `supports` (`id`, `name`, `email`, `phone`, `country`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'Mechelle Hodges', 'gukor@mailinator.com', '+1 (392) 146-7033', 'Dolor aperiam accusa', 'Inventore minim nisi', '2022-06-27 06:51:39', '2022-06-27 06:51:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role` int(11) NOT NULL,
  `upgradationDate` int(255) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `user_role`, `upgradationDate`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'super', 'user@gmail.com', '2022-06-14 06:30:41', '$2y$10$yrtnGhUBWmnW7Q.ojXv83.ulVxpvVMb0VP8sVgI/ej8E3Gft0HTRi', 0, NULL, 'I9YOYoaLDNL1KiqQg7QnK7gPhsR9CoUl7fsZiGP5p3dV6iV1cP9oB5Uja4ic', '2022-06-14 06:30:41', '2022-06-27 05:20:32'),
(2, 'Simone Cherry', 'king@gmail.com', NULL, '$2y$10$e/HBlSRrVKPX2.ACvqITvunubQhNLa/bOp3aa1YbK6OaUnpv6m/QW', 2, 1655355860, NULL, '2022-06-14 06:42:36', '2022-06-15 23:34:20'),
(3, 'Xenos Patton', 'techinfo@gmail.com', NULL, '$2y$10$ErXfqTmodbbLty5ASGb89.ttGfJQrRx0e/CxR2yi7KhpdwWrVGS1.', 1, 1655355744, NULL, '2022-06-14 06:57:12', '2022-06-15 23:32:24'),
(4, 'Test user 2', 'user2@gmail.com', NULL, '$2y$10$4QgCKk3Qgwg73zMr7scYyeg./TNgzxYsAzD5IxjQtRNgKhbSQmJBa', 0, NULL, NULL, '2022-06-14 13:53:26', '2022-06-14 13:53:26'),
(5, 'Indrajit Ghosh', 'hoto@mailinator.com', NULL, '$2y$10$/ML074fDVwAmgwSumuy4B.nAgS5Uuh9TqUPt0dtmTkawVoMx4g2uy', 1, 1655877511, NULL, '2022-06-21 08:13:53', '2022-06-22 00:57:44'),
(6, 'Sayak', 'vocisu@mailinator.com', NULL, '$2y$10$c5Ri22kPQA5yACsehfgMkuwYrgwyGbB5f.V/z3C8O6HFZVT0v.MO6', 0, NULL, NULL, '2022-06-21 08:14:36', '2022-06-21 08:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resp_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resp_object` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_account_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_account_object` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_holder_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_holder_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fingerprint` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `routing_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `livemode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `used` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `user_id`, `resp_id`, `resp_object`, `bank_account_id`, `bank_account_object`, `account_holder_name`, `account_holder_type`, `account_type`, `bank_name`, `country`, `currency`, `fingerprint`, `last4`, `routing_number`, `status`, `client_ip`, `created`, `livemode`, `type`, `used`, `created_at`, `updated_at`) VALUES
(1, '2', 'btok_1LAZ0nG6d8NW7tStPmRAANzd', 'token', 'ba_1LAZ0nG6d8NW7tSt4z1gvvlt', 'bank_account', 'Jenny Rosen', 'individual', NULL, 'STRIPE TEST BANK', 'US', 'usd', 'hQfpcf7tFTvNQAw3', '6789', '110000000', 'new', '115.187.43.131', '1655210305', '0', 'bank_account', '0', '2022-06-14 07:08:25', '2022-06-14 07:08:25'),
(2, '3', 'btok_1LAZT3G6d8NW7tSt70lN3fh8', 'token', 'ba_1LAZT3G6d8NW7tSt8xpth0nh', 'bank_account', 'Jenny Rosen', 'individual', NULL, 'STRIPE TEST BANK', 'US', 'usd', 'hQfpcf7tFTvNQAw3', '6789', '110000000', 'new', '115.187.43.131', '1655212057', '0', 'bank_account', '0', '2022-06-14 07:37:37', '2022-06-14 07:37:37'),
(4, '5', 'btok_1LDOHTG6d8NW7tStFeZ79G39', 'token', 'ba_1LDOHTG6d8NW7tStVi4b9YFU', 'bank_account', 'Indrajit Ghosh', 'company', NULL, 'STRIPE TEST BANK', 'US', 'usd', 'hQfpcf7tFTvNQAw3', '6789', '110000000', 'new', '115.187.43.227', '1655884039', '0', 'bank_account', '0', '2022-06-22 02:17:19', '2022-06-22 02:17:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile_infos`
--

CREATE TABLE `user_profile_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `birthday` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profile_infos`
--

INSERT INTO `user_profile_infos` (`id`, `user_id`, `birthday`, `gender`, `secondary_email`, `phone`, `image`, `address`, `created_at`, `updated_at`) VALUES
(1, 2, '1997-02-27', 'Female', 'nunu2022@mailinator.com', '+1 (551) 434-4795', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655794822woman.jpg', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.', '2022-06-14 06:43:58', '2022-06-21 01:30:23'),
(2, 3, '2015-09-10', 'Female', 'wuxefokeg@mailinator.com', '+1 (254) 713-7036', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655209734woman.jpg', 'Tempora commodi enim', '2022-06-14 06:58:55', '2022-06-14 06:58:55'),
(3, 1, '1991-05-07', 'Female', 'user01@gmail.com', '1234567890', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/16563270276fde85b86c86526af5e99ce85f57432e.jpg', 'address', '2022-06-14 07:47:03', '2022-06-27 05:20:32'),
(6, 5, '1975-05-07', 'Male', 'Indrajit@gmail.com', '9804806598', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655879262man.jpg', 'Some info may be visible to other people using Jumcert portal', '2022-06-22 00:57:44', '2022-06-22 00:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `video_uploads`
--

CREATE TABLE `video_uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci,
  `price` double(12,2) DEFAULT '0.00',
  `user_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive',
  `video_type` enum('Public','Private') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Public',
  `videoname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `playlist_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `countlike` int(255) NOT NULL DEFAULT '0',
  `checkLikeByUser` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_uploads`
--

INSERT INTO `video_uploads` (`id`, `title`, `category_id`, `subcategory`, `desc`, `price`, `user_id`, `status`, `video_type`, `videoname`, `thumbnail`, `video_id`, `playlist_id`, `countlike`, `checkLikeByUser`, `created_at`, `updated_at`) VALUES
(1, 'Animi deserunt numq', 2, 'Porro dolore nemo au', 'Non culpa illo vel e', 0.00, 2, 'Active', 'Public', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655210754kids238968.mp4', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655210758Grandjete830688.jpg', '655233', '1', 2, '0,6,1', '2022-06-14 07:15:59', '2022-06-23 03:47:43'),
(2, 'Adipisci explicabo', 2, 'Commodo reprehenderi', 'Qui eu enim et debit', 100.00, 2, 'Active', 'Private', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655210813videoplayback125353.mp4', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655210817download653106.jpg', '637517', '1', 2, '0,6,1', '2022-06-14 07:16:58', '2022-06-23 03:47:49'),
(3, 'Soluta praesentium a', 2, 'Accusantium eiusmod', 'Architecto enim veli', 100.00, 2, 'Active', 'Private', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/16552109321649034484202656464.mp4', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655210936getty_624206636_200013332000928034_376810448750.jpg', '273894', '2', 2, '0,6,1', '2022-06-14 07:18:56', '2022-06-23 03:47:48'),
(4, 'Voluptatum assumenda', 4, 'Consequuntur molesti', 'Corporis autem adipi', 0.00, 2, 'Active', 'Public', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655211011home461935.mp4', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655211014download2501312.jpg', '949736', '1', 3, '0,3,1,6', '2022-06-14 07:20:14', '2022-06-21 10:40:48'),
(5, 'Enim consequatur Ea', 4, 'Mollitia non consequ', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 0.00, 3, 'Active', 'Public', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/16552122091649034484202349672.mp4', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655212213photo-1547153760-18fc86324498686055.jpg', '533638', '3', 3, '0,3,1,6', '2022-06-14 07:40:13', '2022-06-21 10:40:47'),
(6, 'Reprehenderit incidu', 4, 'Delectus rerum at f', 'Molestiae quis volup', 100.00, 3, 'Active', 'Private', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655212247home490978.mp4', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655212250tom-jerry-movie-tom-1605689120597008.png', '990050', '3', 3, '0,3,6,1', '2022-06-14 07:40:50', '2022-06-23 03:57:20'),
(7, 'Reprehenderit incidu', 1, 'Delectus rerum at f', 'Molestiae quis volup', 100.00, 3, 'Active', 'Private', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655212247home490978.mp4', 'https://jumcertstorage.s3.us-east-1.amazonaws.com/jumcert/1655212250tom-jerry-movie-tom-1605689120597008.png', '990050', '3', 3, '0,3,6,1', '2022-06-14 07:40:50', '2022-06-23 03:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `channel_owner_id` int(11) NOT NULL,
  `admin_commission` double(12,2) DEFAULT '0.00',
  `user_commission` double(12,2) DEFAULT '0.00',
  `buyer_id` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `channel_owner_id`, `admin_commission`, `user_commission`, `buyer_id`, `created_at`, `updated_at`) VALUES
(1, 3, 10.00, 90.00, 1, '2022-06-14 13:39:51', '2022-06-21 04:43:02'),
(7, 2, 30.00, 70.00, 1, '2022-06-21 07:39:41', '2022-06-21 07:39:41'),
(8, 3, 20.00, 80.00, 6, '2022-06-22 01:30:22', '2022-06-22 01:30:22'),
(9, 2, 30.00, 70.00, 6, '2022-06-22 01:47:28', '2022-06-22 01:47:28'),
(10, 3, 20.00, 80.00, 2, '2022-06-22 07:51:55', '2022-06-22 07:51:55'),
(11, 3, 20.00, 80.00, 1, '2022-06-22 23:34:27', '2022-06-22 23:34:27'),
(12, 3, 20.00, 80.00, 1, '2022-06-22 23:44:26', '2022-06-22 23:44:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_commissions`
--
ALTER TABLE `admin_commissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `channels_name_unique` (`name`),
  ADD UNIQUE KEY `channels_slug_unique` (`slug`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `live_streams`
--
ALTER TABLE `live_streams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_payment_id_foreign` (`payment_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `playlists_user_id_foreign` (`user_id`);

--
-- Indexes for table `playlist_videouploads`
--
ALTER TABLE `playlist_videouploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `private_streams`
--
ALTER TABLE `private_streams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `private_videos`
--
ALTER TABLE `private_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stream_recorders`
--
ALTER TABLE `stream_recorders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stream_records`
--
ALTER TABLE `stream_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profile_infos`
--
ALTER TABLE `user_profile_infos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_profile_infos_secondary_email_unique` (`secondary_email`),
  ADD KEY `user_profile_infos_user_id_foreign` (`user_id`);

--
-- Indexes for table `video_uploads`
--
ALTER TABLE `video_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_commissions`
--
ALTER TABLE `admin_commissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `channels`
--
ALTER TABLE `channels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live_streams`
--
ALTER TABLE `live_streams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `playlist_videouploads`
--
ALTER TABLE `playlist_videouploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `private_streams`
--
ALTER TABLE `private_streams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `private_videos`
--
ALTER TABLE `private_videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stream_recorders`
--
ALTER TABLE `stream_recorders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stream_records`
--
ALTER TABLE `stream_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supports`
--
ALTER TABLE `supports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_profile_infos`
--
ALTER TABLE `user_profile_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `video_uploads`
--
ALTER TABLE `video_uploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `playlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_profile_infos`
--
ALTER TABLE `user_profile_infos`
  ADD CONSTRAINT `user_profile_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
