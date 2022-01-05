-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 05 Jan 2022 pada 16.48
-- Versi server: 5.7.33
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doaibucoffee`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(128) NOT NULL,
  `quotes` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `about`
--

INSERT INTO `about` (`id`, `title`, `description`, `image`, `quotes`, `author`, `updated`) VALUES
(0, 'About Doa Ibu Coffee', 'Phasellus egestas nisi nisi, lobortis ultricies risus semper nec. Vestibulum pharetra ac ante ut pellentesque. Curabitur fringilla dolor quis lorem accumsan, vitae molestie urna dapibus. Pellentesque porta est ac neque bibendum viverra. Vivamus lobortis magna ut interdum laoreet. Donec gravida lorem elit, quis condimentum ex semper sit amet. Fusce eget ligula magna. Aliquam aliquam imperdiet sodales. Ut fringilla turpis in vehicula vehicula. Pellentesque congue ac orci ut gravida. Aliquam erat volutpat. Donec iaculis lectus a arcu facilisis, eu sodales lectus sagittis. Etiam pellentesque, magna vel dictum rutrum, neque justo eleifend elit, vel tincidunt erat arcu ut sem. Sed rutrum, turpis ut commodo efficitur, quam velit convallis ipsum, et maximus enim ligula ac ligula. Vivamus tristique vulputate ultricies. Sed vitae ultrices orci.', 'doaibucoffee-___CDVqKpEJc1c___-2.jpg', 'Creativity is just connecting things. When you ask creative people how they did something, they feel a little guilty because they didn\'t really do it, they just saw something. It seemed obvious to them after a while.', 'Steve Job’s', '2021-04-18 14:06:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `background_settings`
--

CREATE TABLE `background_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `background_settings`
--

INSERT INTO `background_settings` (`id`, `name`, `image`, `updated`) VALUES
(1, 'Bg-Shop', 'bg-shop.jpg', '2021-03-10 11:48:38'),
(2, 'Bg-about', 'bg-about.jpg', '2021-03-10 11:48:38'),
(3, 'Bg-offers', 'doaibucoffee-___CDVqKpEJc1c___-2.jpg', '2021-03-10 11:51:15'),
(4, 'Bg-Contact', 'kopiparti-___B7QjfGIJg8d___-7.jpg', '2021-03-10 11:51:43'),
(5, 'Bg-Cart', 'pricelist_kuliner-___B8-dsmKBq9X___-2.jpg', '2021-03-10 11:52:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `category_name` varchar(128) NOT NULL,
  `sorting` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `category_slug`, `category_name`, `sorting`, `created`) VALUES
(1, 'basic', 'Basic', 1, '2021-01-15 11:07:00'),
(2, 'kopi-susu', 'Kopi Susu', 2, '2021-01-15 11:10:04'),
(3, 'powder-based', 'Powder Based', 3, '2021-01-15 11:10:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `configuration`
--

CREATE TABLE `configuration` (
  `id_config` int(11) NOT NULL,
  `website_name` varchar(128) NOT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `keywords` text,
  `metatext` text,
  `email` varchar(128) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `facebook` varchar(128) DEFAULT NULL,
  `instagram` varchar(128) DEFAULT NULL,
  `description` text,
  `logo` varchar(255) DEFAULT NULL,
  `icon` varchar(128) DEFAULT NULL,
  `payment_account` varchar(255) DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `configuration`
--

INSERT INTO `configuration` (`id_config`, `website_name`, `tagline`, `website`, `keywords`, `metatext`, `email`, `telephone`, `address`, `facebook`, `instagram`, `description`, `logo`, `icon`, `payment_account`, `updated`) VALUES
(0, 'Doa Ibu Coffee', 'CALM - Doa Ibu memberkati', '', '', '', 'doaibucoffee@gmail.com', '+6287848879337', 'Jl.kaliurang km 9.6, Sleman', 'https://id-id.facebook.com/', 'https://www.instagram.com/doaibucoffee/', '', 'logo-2.png', 'ico2.png', '', '2021-01-17 08:23:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer_table`
--

CREATE TABLE `customer_table` (
  `id` int(11) NOT NULL,
  `table_code` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `table_name` varchar(128) CHARACTER SET utf8mb4 NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `last_visit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `customer_table`
--

INSERT INTO `customer_table` (`id`, `table_code`, `table_name`, `status`, `last_visit`) VALUES
(2, 'TAB001', 'Table 1', 'active', '2021-08-05 21:32:03'),
(3, 'TAB002', 'Table 2', 'leave', '2021-11-22 13:05:58'),
(4, 'TAB003', 'Table 3', 'active', '2021-11-22 12:52:04'),
(5, 'TAB004', 'Table 4', 'leave', '2021-08-05 21:29:16'),
(6, 'TAB005', 'Table 5', 'leave', '2021-08-05 21:29:23'),
(7, 'TAB006', 'Table 6', 'leave', '2021-08-05 21:29:24'),
(8, 'TAB007', 'Table 7', 'leave', '2021-08-05 21:29:26'),
(9, 'TAB008', 'Table 8', 'leave', '2021-08-05 21:29:28'),
(10, 'TAB009', 'Table 9', 'leave', '2021-08-05 21:29:20'),
(11, 'TAB010', 'Table 10', 'leave', '2021-08-05 21:29:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `image` varchar(255) NOT NULL,
  `captions` text NOT NULL,
  `likegallery` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gallery`
--

INSERT INTO `gallery` (`id`, `name`, `image`, `captions`, `likegallery`, `status`, `date`) VALUES
(1, 'doaibucoffee 1', 'doaibucoffee-___CDVqKpEJc1c___-22.jpg', '\"Your coffee delicioused by our bullshit instagram\'s feed\"\r\nBukan kah seringkali kita \"kedai kopi\" mendapat kan pelanggan karena feed Ig yang bagus atau menu* kopi terlihat enak di visual Ig. Sebaliknya,\r\nBeberapa customer datang, memesan menu kopi , men-story tanpa menghabiskanya bahkan sesekali tanpa meminumnya.\r\nAhh.. sudah lah. Bisajadi ini perbedebatan lintas lini antara user (penikmat) vs marketer.\r\n.\r\n.\r\nGimana dabs! Sudah terbakar habis belum jatah daging dari masjid sekitarmu ?\r\nJika sudah, malam yuk ramaikan lagi ...', 98, 'displayed', '2021-04-20 14:18:18'),
(2, 'doaibucoffee 2', 'doaibucoffee-___B8dkQK1JE5J___-1.jpg', 'Jika intensitas laki-laki berpomade datang terus meningkat. Selain menjual kekopian, kami berencana menjual pomade heu .\r\nAda usul kami harus menjual apa gitu Ndak, dabs!', 101, 'displayed', '2021-04-20 14:16:59'),
(3, 'doaibucoffee 3', 'doaibucoffee-___B8Ofvu6JCYe___-1.jpg', 'Team hot or team ice ? .\r\n.\r\n.\r\n.\r\n#doaibucoffeeyk\r\n#dailycaffeinedosepartner\r\n#coffeespace #coffeeshop #ngopisrawung #nongkrong\r\n#ngopidijogja', 120, 'displayed', '2021-04-20 14:19:13'),
(4, 'doaibucoffee 4', 'doaibucoffee-___B5o7-hgJSF8___-1.jpg', '\"Berkumpul lima sampai enam orang,\r\nBahasan yang tak kunjung usai\r\nHappy happy\r\nKenapa bisa Happy ? \"sisitipsi\r\n#doaibucoffeeyk\r\n#dailycaffeinedosepartner', 100, 'displayed', '2021-04-20 14:18:50'),
(5, 'doaibucoffee 5', 'doaibucoffee-___B6Ygdkfpm_C___-1.jpg', 'Persiapkan siasat untuk 2020 lebih banyak kaum harum masuk ke kedai.\r\n\r\nAda usul ndak, ndan! .\r\n.\r\n.\r\n.\r\n#doaibucoffeeyk\r\n#dailycaffeinedosepartner\r\n#coffee#coffeeshop\r\n#doaibumemanggil', 112, 'displayed', '2021-04-20 14:18:00'),
(6, 'doaibucoffee 6', 'doaibucoffee-___B52kzpmJok5___-1.jpg', 'FYI- Menurut beberapa literatur, Indonesia masuk lima negara penghasil kopi terbanyak, hm.. ini anugrah!\r\npatut disyukuri bukan ?\r\n.\r\n.\r\n.\r\nMenurut beberapa pemuka agama, punya istri dua dan keduanya akur juga anugrah..\r\nHmmm ... .\r\n.\r\n#doaibucoffeeyk\r\n#dailycaffeinedosepartner', 126, 'displayed', '2021-04-20 14:17:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `unit` varchar(20) NOT NULL,
  `stock` int(11) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ingredients`
--

INSERT INTO `ingredients` (`id`, `code`, `name`, `description`, `unit`, `stock`, `created`) VALUES
(1, 'ING001', 'Powder Red Velvet', 'Powder for red velvet drinks', 'gram', 100, '2021-04-29'),
(2, 'ING002', 'Powder Green Tea', 'Powder for green tea drinks', 'gram', 100, '2021-04-29'),
(3, 'ING003', 'Powder Taro', 'Powder for taro drinks', 'gram', 100, '2021-04-29'),
(4, 'ING004', 'Flavour Vanilla', 'Vanilla', 'liter', 1, '2021-04-29'),
(5, 'ING005', 'Flavour Brown  Sugar', 'Brown  Sugar', 'liter', 1, '2021-04-29'),
(6, 'ING006', 'Flavour Caramel', 'Caramel', 'liter', 1, '2021-04-29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `id_invoice` int(11) NOT NULL,
  `cashier` varchar(20) DEFAULT NULL,
  `table_number` varchar(10) NOT NULL,
  `order_type` varchar(20) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `transaction_code` varchar(255) NOT NULL,
  `qrcode` varchar(128) DEFAULT NULL,
  `transaction_date` datetime NOT NULL,
  `total_transaction` varchar(128) NOT NULL,
  `total_bursttime` int(11) DEFAULT NULL,
  `payment_status` varchar(20) NOT NULL,
  `order_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `invoice`
--

INSERT INTO `invoice` (`id_invoice`, `cashier`, `table_number`, `order_type`, `customer_name`, `transaction_code`, `qrcode`, `transaction_date`, `total_transaction`, `total_bursttime`, `payment_status`, `order_status`) VALUES
(20, 'Ibrohims', 'TAB001', 'Dine In', 'A', '17052021AP5TSOGFNW', NULL, '2021-05-17 19:45:02', '56000', 12, 'Complete', 'Complete'),
(21, 'Ibrohims', 'TAB002', 'Dine In', 'B', '17052021LW1U637OG0', NULL, '2021-05-17 19:45:22', '50000', 10, 'Complete', 'Waiting'),
(22, 'Ibrohims', 'TAB003', 'Dine In', 'C', '17052021GF1V8AE9LU', NULL, '2021-05-17 19:45:54', '57000', 13, 'Complete', 'Waiting'),
(23, 'Ibrohims', 'TAB004', 'Dine In', 'D', '170520218QAGHGOEUS', NULL, '2021-05-17 19:50:03', '78000', 18, 'Complete', 'Waiting'),
(24, 'Ibrohims', 'TAB005', 'Dine In', 'E', '17052021BQ5P6ZFYFR', NULL, '2021-05-17 19:50:23', '69000', 13, 'Complete', 'Waiting'),
(25, 'Ibrohims', 'TAB006', 'Dine In', 'F', '17052021LGC9RBFCTO', NULL, '2021-05-17 19:50:46', '75000', 17, 'Complete', 'Waiting'),
(26, 'Ibrohims', 'TAB007', 'Dine In', 'G', '17052021REJVOGGEY6', NULL, '2021-05-17 19:50:58', '74000', 16, 'Complete', 'Waiting'),
(27, 'Ibrohims', 'TAB008', 'Dine In', 'H', '17052021YV6SPQUDRT', NULL, '2021-05-17 20:25:06', '68000', 14, 'Complete', 'Waiting'),
(28, 'Ibrohims', 'TAB009', 'Dine In', 'I', '1705202110DQCLTVUK', NULL, '2021-05-17 20:25:16', '75000', 17, 'Complete', 'Waiting'),
(29, 'Ibrohims', 'TAB010', 'Dine In', 'J', '170520217TFHDRXWGK', NULL, '2021-05-17 20:25:35', '74000', 16, 'Complete', 'Waiting'),
(34, NULL, 'TAB004', 'Dine In', 'Customer', '18072021EQO4SDBPIF', '18072021EQO4SDBPIF.png', '2021-10-18 16:40:23', '35000', NULL, 'Pending', 'Waiting'),
(35, NULL, 'TAB005', 'Dine In', 'Hims', '24072021YKIJX56VRZ', '24072021YKIJX56VRZ.png', '2021-10-24 15:00:14', '17000', NULL, 'Pending', 'Waiting'),
(38, 'Ibrohims', 'TAB001', 'Dine In', 'Customer', '06082021VLLQBTODJW', '06082021VLLQBTODJW.png', '2021-10-06 04:32:03', '18000', 4, 'Complete', 'Waiting'),
(39, NULL, 'TAB003', 'Dine In', 'Hims', '22112021VS1DHNCGEE', '22112021VS1DHNCGEE.png', '2021-10-22 19:52:04', '35000', NULL, 'Pending', 'Waiting');

-- --------------------------------------------------------

--
-- Struktur dari tabel `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `offers_code` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `information` varchar(255) DEFAULT NULL,
  `expired` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `created` date NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `offers`
--

INSERT INTO `offers` (`id`, `offers_code`, `name`, `image`, `description`, `information`, `expired`, `status`, `created`, `updated`) VALUES
(1, 'OFF001', 'Free Pizza', 'pizzaa1.jpeg', 'Free pizza for all products', 'Limited Quota', '2021-12-22', 'activated', '2021-04-24', '2021-07-29 20:58:30'),
(2, 'OFF002', 'Free Brownies', 'bronis.jpeg', 'Free brownies for all products', 'Limited Quota', '2021-12-22', 'activated', '2021-04-24', '2021-07-29 20:58:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `product_code` varchar(32) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `product_image` varchar(128) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `stock_product` varchar(15) NOT NULL,
  `size` varchar(32) DEFAULT NULL,
  `current_discount` decimal(10,0) DEFAULT NULL,
  `description` text NOT NULL,
  `status_product` varchar(20) NOT NULL,
  `bursttime` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `id_category`, `product_code`, `product_name`, `product_image`, `price`, `stock_product`, `size`, `current_discount`, `description`, `status_product`, `bursttime`, `created`, `updated`) VALUES
(1, 1, 'DOI001', 'Americano', 'americano.jpg', '17000', 'Sold-Out', '', '10', 'Espresso + Water', 'displayed', 4, '2021-03-16 22:51:46', '2021-03-27 11:18:47'),
(2, 1, 'DOI002', 'Espresso', 'espresso.jpg', '15000', 'Ready-Stock', '', '10', 'Espresso is made by forcing very hot water under high pressure through finely ground compacted coffee.', 'displayed', 3, '2021-03-16 22:59:58', '2021-04-23 09:16:31'),
(3, 1, 'DOI003', 'Caffe Latte', 'latte.jpg', '22000', 'Ready-Stock', '', '5', 'Espresso + Steamed milk.', 'displayed', 6, '2021-03-16 23:03:31', '2021-03-27 10:57:51'),
(4, 2, 'DOI004', 'Kopi Susu Klasik', 'kopi-susu-klasik.jpg', '17000', 'Ready-Stock', '', '0', 'Double shoot espresso + Condensed milk + Fresh milk', 'displayed', 3, '2021-03-16 23:08:03', '2021-03-27 10:57:54'),
(5, 2, 'DOI005', 'Kopi Susu Spesial', 'kopi-susu-spesial.jpg', '18000', 'Sold-Out', '', '0', 'Single shoot espresso + Salted caramel + Sugar + Fresh milk', 'displayed', 3, '2021-03-16 23:11:01', '2021-03-27 11:18:36'),
(6, 2, 'DOI006', 'Kopi Susu Aren', 'kopi-susu-aren.jpg', '17000', 'Ready-Stock', '', '0', 'Double shoot espresso + Brown sugar + Creamer + Fresh milk', 'displayed', 3, '2021-03-16 23:12:44', '2021-03-27 10:57:59'),
(7, 3, 'DOI007', 'Dark Choco Latte', 'choco-latte.jpg', '18000', 'Ready-Stock', '', '0', 'Chocolate powder + Sugar + Creamer + Fresh milk', 'displayed', 4, '2021-03-16 23:15:36', '2021-03-27 10:58:02'),
(8, 3, 'DOI008', 'Red Velvet Latte', 'redvelvet.jpg', '18000', 'Ready-Stock', '', '0', 'Red velvet powder + Sugar + Creamer + Fresh milk', 'displayed', 4, '2021-03-16 23:16:56', '2021-04-23 09:16:11'),
(9, 3, 'DOI009', 'Taro Latte', 'taro-late.jpg', '18000', 'Sold-Out', '', '0', 'Taro powder + Sugar + Creamer + Fresh milk', 'displayed', 4, '2021-03-16 23:17:33', '2021-07-18 08:52:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_images`
--

CREATE TABLE `product_images` (
  `id_image` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `image_name` varchar(128) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product_images`
--

INSERT INTO `product_images` (`id_image`, `id_product`, `image_name`, `image`, `updated`) VALUES
(14, 14, '1', 'doaibucoffee-___B6Ygdkfpm_C___-.jpg', '2021-02-13 10:24:45'),
(15, 14, '1', 'doaibucoffee-___CDVqKpEJc1c___-2.jpg', '2021-02-13 10:25:19'),
(16, 9, 'Taro Latte', 'taro-late-1.jpg', '2021-03-16 16:18:11'),
(17, 9, 'Taro Latte', 'taro-late-2.jpg', '2021-03-16 16:18:28'),
(18, 7, 'Dark Choco Latte', 'choco-latte-1.jpg', '2021-03-16 16:19:03'),
(19, 7, 'Dark Choco Latte', 'choco-latte-2.jpg', '2021-03-16 16:19:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `service`
--

INSERT INTO `service` (`id`, `title`, `description`, `status`, `date`) VALUES
(1, 'Free Delivery Worldwide', 'Click here for more info', 'displayed', '2021-04-20 14:58:07'),
(2, '30 Days Return', 'Simply return it within 30 days for an exchange.', 'displayed', '2021-04-20 23:06:50'),
(3, 'Store Opening', 'Shop open from Monday to Sunday', 'displayed', '2021-04-20 23:08:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sidebar_menu`
--

CREATE TABLE `sidebar_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `url_menu` varchar(50) DEFAULT NULL,
  `icon` varchar(128) NOT NULL,
  `sorting` int(11) NOT NULL,
  `submenu` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sidebar_menu`
--

INSERT INTO `sidebar_menu` (`id`, `menu`, `url_menu`, `icon`, `sorting`, `submenu`) VALUES
(2, 'User Profile', '', 'fas fa-fw fa-user-cog', 5, 'YES'),
(12, 'User Management', '', 'fas fa-fw fa-users-cog', 5, 'YES'),
(21, 'Website Settings', '', 'fas fa-fw fa-cogs', 7, 'YES'),
(26, 'Dashboard Admin', 'admin/admin', 'fas fa-fw fa-home', 1, 'NO'),
(27, 'Monitoring Cafe', 'admin/monitoring', 'fas fa-fw fa-newspaper', 2, 'NO'),
(31, 'Cafe Transactions', '', 'fas fa-fw fa-file-invoice-dollar', 3, 'YES'),
(33, 'Master Data Management', '', 'fas fa-fw fa-database', 4, 'YES'),
(34, 'Front-end Settings', '', 'fas fa-fw fa-chalkboard', 8, 'YES'),
(35, 'Reports & Statistics', '', 'fas fa-fw fa-chart-line', 6, 'YES'),
(36, 'Order List', 'barista/orderlist', 'fas fa-fw fa-clipboard-list', 3, 'NO'),
(39, 'Dashboard Barista', 'barista/barista', 'fas fa-fw fa-home', 1, 'NO'),
(40, 'FAQ Website', 'website/faq', 'fas fa-fw fa-info-circle', 9, 'NO'),
(41, 'About Website', 'website/about', 'fas fa-fw fa-heart', 10, 'NO'),
(42, 'Sign Out', 'auth/logout', 'fas fa-fw fa-sign-out-alt', 11, 'NO'),
(43, 'Order Queues', 'barista/orderqueues', 'fas fa-fw fa-list-alt', 4, 'NO');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sidebar_submenu`
--

CREATE TABLE `sidebar_submenu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sidebar_submenu`
--

INSERT INTO `sidebar_submenu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(2, 2, 'My Profile', 'user/user', 'fas fa-fw fa-id-card', 1),
(16, 21, 'Sidebar Menu', 'configuration/sidebar', 'fa fa-fw fa-folder', 1),
(17, 21, 'Sidebar SubMenu', 'configuration/sidebar/submenu', 'fa fa-fw fa-folder-open', 1),
(18, 12, 'Management Role', 'admin/manageuser', 'fas fa-fw fa-user-tag', 1),
(23, 12, 'Management User', 'admin/manageuser/manageuser', 'fas fa-fw  fa-users-cog', 1),
(29, 33, 'Menu Categories', 'admin/products/categories', 'fa fa-fw fa-tags', 1),
(30, 33, 'Menu List', 'admin/products', 'fas fa-fw fa-list-alt', 1),
(32, 2, 'Change Password', 'user/user/changepass', 'fas fa-fw fa-key', 1),
(38, 21, 'Configuration', 'configuration/config', 'fas fa-fw fa-cog', 1),
(39, 21, 'Config Logo', 'configuration/config/configlogo', 'far fa-fw fa-images', 1),
(41, 34, 'Slider Settings', 'configuration/slider', 'fas fa-fw fa-sliders-h', 1),
(71, 33, 'Ingredients', 'admin/ingredients', 'fas fa-fw fa-shopping-basket', 1),
(72, 33, 'Customer Table', 'admin/table', 'fas fa-fw fa-chair', 1),
(73, 33, 'Suppliers', 'admin/supplier', 'fa fa-fw fa-truck', 1),
(74, 34, 'Background Frontend', 'configuration/background', 'far fa-fw fa-image', 1),
(75, 35, 'Sales Report', 'admin/reportsstatistics', 'fas fa-fw fa-file-invoice', 1),
(76, 34, 'About Settings', 'configuration/about', 'fas fa-fw fa-address-card', 1),
(77, 31, 'Scan Transaction', 'admin/transactions', 'fas fa-fw fa-qrcode', 1),
(78, 31, 'Sales Transactions', 'admin/transactions/sales', 'fas fa-fw fa-money-check-alt', 1),
(79, 31, 'List Transactions', 'admin/transactions/listtransactions', 'fas fa-fw fa-clipboard', 1),
(80, 34, 'Gallery Settings', 'configuration/gallery', 'fas fa-fw fa-camera-retro', 1),
(81, 34, 'Service Settings', 'configuration/service', 'fas fa-fw fa-toolbox', 1),
(82, 33, 'Special Offers', 'admin/offers', 'fas fa-fw fa-percent', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider_settings`
--

CREATE TABLE `slider_settings` (
  `id_slider` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(128) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `link` varchar(128) NOT NULL,
  `text_link` varchar(50) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `slider_settings`
--

INSERT INTO `slider_settings` (`id_slider`, `name`, `image`, `title`, `caption`, `link`, `text_link`, `is_active`, `created`) VALUES
(2, 'Slider 2', 'kopiparti-___B7QjfGIJg8d___-11.jpg', 'Doa Ibu Coffee', 'Best coffee shop in indonesia', 'homepage', 'Shop Now', 1, '2021-01-20 17:26:24'),
(4, 'Slider 3', 'kopiparti-___B7QjfGIJg8d___-5.jpg', 'Doa Ibu Coffee', 'Best coffee shop in indonesia', 'products', 'Shop Now', 1, '2021-02-10 01:40:05'),
(5, 'Slider 3', 'doaibucoffee-___B6Ygdkfpm_C___-.jpg', 'Doa Ibu Coffee', 'Daily Caffeine Partner', 'products', 'Shop Now', 1, '2021-03-10 15:26:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `supplier_code` varchar(128) NOT NULL,
  `supplier_name` varchar(128) NOT NULL,
  `supplier_phone` varchar(50) NOT NULL,
  `supplier_address` text NOT NULL,
  `description` text,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `supplier_code`, `supplier_name`, `supplier_phone`, `supplier_address`, `description`, `created`, `updated`) VALUES
(3, 'SUP001', 'Hims', '087848879337', 'skjshkhks', 'hkjhkkj', '2021-02-01 16:37:05', '2021-02-01 09:37:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `id_transaction` int(11) NOT NULL,
  `transaction_code` varchar(255) NOT NULL,
  `id_product` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `bursttime_product` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `status_queue` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`id_transaction`, `transaction_code`, `id_product`, `price`, `quantity`, `total_price`, `bursttime_product`, `transaction_date`, `status_queue`) VALUES
(78, '17052021AP5TSOGFNW', 3, 22000, 1, 22000, 6, '2021-05-17 19:45:02', 'Waiting'),
(79, '17052021AP5TSOGFNW', 6, 17000, 1, 17000, 3, '2021-05-17 19:45:02', 'Waiting'),
(80, '17052021AP5TSOGFNW', 4, 17000, 1, 17000, 3, '2021-05-17 19:45:02', 'Waiting'),
(81, '17052021LW1U637OG0', 2, 15000, 1, 15000, 3, '2021-05-17 19:45:22', 'Waiting'),
(82, '17052021LW1U637OG0', 4, 17000, 1, 17000, 3, '2021-05-17 19:45:22', 'Waiting'),
(83, '17052021LW1U637OG0', 8, 18000, 1, 18000, 4, '2021-05-17 19:45:22', 'Waiting'),
(84, '17052021GF1V8AE9LU', 3, 22000, 1, 22000, 6, '2021-05-17 19:45:54', 'Waiting'),
(85, '17052021GF1V8AE9LU', 7, 18000, 1, 18000, 4, '2021-05-17 19:45:54', 'Waiting'),
(86, '17052021GF1V8AE9LU', 4, 17000, 1, 17000, 3, '2021-05-17 19:45:54', 'Waiting'),
(87, '170520218QAGHGOEUS', 3, 22000, 2, 44000, 12, '2021-05-17 19:50:03', 'Waiting'),
(88, '170520218QAGHGOEUS', 6, 17000, 2, 34000, 6, '2021-05-17 19:50:03', 'Waiting'),
(89, '17052021BQ5P6ZFYFR', 6, 17000, 2, 34000, 6, '2021-05-17 19:50:23', 'Waiting'),
(90, '17052021BQ5P6ZFYFR', 8, 18000, 1, 18000, 4, '2021-05-17 19:50:23', 'Waiting'),
(91, '17052021BQ5P6ZFYFR', 4, 17000, 1, 17000, 3, '2021-05-17 19:50:23', 'Waiting'),
(92, '17052021LGC9RBFCTO', 3, 22000, 1, 22000, 6, '2021-05-17 19:50:46', 'Waiting'),
(93, '17052021LGC9RBFCTO', 6, 17000, 1, 17000, 3, '2021-05-17 19:50:46', 'Waiting'),
(94, '17052021LGC9RBFCTO', 8, 18000, 2, 36000, 8, '2021-05-17 19:50:46', 'Waiting'),
(95, '17052021REJVOGGEY6', 3, 22000, 1, 22000, 6, '2021-05-17 19:50:58', 'Waiting'),
(96, '17052021REJVOGGEY6', 6, 17000, 2, 34000, 6, '2021-05-17 19:50:58', 'Waiting'),
(97, '17052021REJVOGGEY6', 7, 18000, 1, 18000, 4, '2021-05-17 19:50:58', 'Waiting'),
(98, '17052021YV6SPQUDRT', 2, 15000, 1, 15000, 3, '2021-05-17 20:25:06', 'Waiting'),
(99, '17052021YV6SPQUDRT', 8, 18000, 2, 36000, 8, '2021-05-17 20:25:06', 'Waiting'),
(100, '17052021YV6SPQUDRT', 4, 17000, 1, 17000, 3, '2021-05-17 20:25:06', 'Waiting'),
(101, '1705202110DQCLTVUK', 3, 22000, 1, 22000, 6, '2021-05-17 20:25:16', 'Waiting'),
(102, '1705202110DQCLTVUK', 7, 18000, 2, 36000, 8, '2021-05-17 20:25:16', 'Waiting'),
(103, '1705202110DQCLTVUK', 6, 17000, 1, 17000, 3, '2021-05-17 20:25:16', 'Waiting'),
(104, '170520217TFHDRXWGK', 3, 22000, 1, 22000, 6, '2021-05-17 20:25:35', 'Waiting'),
(105, '170520217TFHDRXWGK', 6, 17000, 1, 17000, 3, '2021-05-17 20:25:35', 'Waiting'),
(106, '170520217TFHDRXWGK', 4, 17000, 1, 17000, 3, '2021-05-17 20:25:35', 'Waiting'),
(107, '170520217TFHDRXWGK', 7, 18000, 1, 18000, 4, '2021-05-17 20:25:35', 'Waiting'),
(115, '18072021EQO4SDBPIF', 8, 18000, 1, 18000, 4, '2021-10-18 16:40:23', 'Waiting'),
(116, '18072021EQO4SDBPIF', 6, 17000, 1, 17000, 3, '2021-10-18 16:40:23', 'Waiting'),
(117, '24072021YKIJX56VRZ', 4, 17000, 1, 17000, 3, '2021-10-24 15:00:14', 'Waiting'),
(118, '05082021RDXFBK1E6L', 3, 19855, 1, 19855, 6, '2021-10-05 21:07:53', 'Waiting'),
(119, '05082021RDXFBK1E6L', 6, 17000, 1, 17000, 3, '2021-10-05 21:07:53', 'Waiting'),
(120, '06082021VLLQBTODJW', 7, 18000, 1, 18000, 4, '2021-10-06 04:32:03', 'Waiting'),
(121, '22112021VS1DHNCGEE', 8, 18000, 1, 18000, 4, '2021-10-22 19:52:04', 'Waiting'),
(122, '22112021VS1DHNCGEE', 6, 17000, 1, 17000, 3, '2021-10-22 19:52:04', 'Waiting');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `created_at`) VALUES
(1, 'Ibrohims', 'admin@gmail.com', 'images.png', '$2y$10$4SE54c3edXJgOJJy3NfgSeJuCwucXAlciEMWDK0YBE1fGyDBDqf06', 1, 1, '2020-12-27 18:48:48'),
(5, 'Hims', 'member@gmail.com', 'dindamaulinaaa_3-___B3b7vCRgkvb___-.jpg', '$2y$10$qo12hdbQX8ecIpfHpLWtvOZS4XIXaCPPabuUNaDNCdlBOsQt9jBmm', 2, 1, '2021-01-02 00:00:00'),
(8, 'Barista', 'barista@gmail.com', 'default-barista.png', '$2y$10$9EwYS94gMhcNuWD9WGYmeeZaQQxtqHq6ujTsWYdZ21s.5fKV0bKXK', 3, 1, '2021-02-24 16:57:08'),
(9, 'Abroham', 'abroham@gmail.com', 'default.png', '$2y$10$0MT0tiOQXMLe4EqbIC8LhOTOtsGIuendcYW0Nrusrqed78uaHrxO.', 15, 1, '2021-08-02 00:26:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(4, 1, 3),
(21, 1, 12),
(26, 1, 13),
(32, 1, 15),
(33, 1, 21),
(35, 1, 22),
(36, 1, 26),
(38, 1, 28),
(39, 1, 29),
(40, 1, 31),
(41, 1, 32),
(42, 1, 33),
(43, 1, 34),
(44, 1, 35),
(45, 3, 2),
(46, 3, 27),
(47, 3, 36),
(49, 3, 39),
(50, 1, 42),
(51, 1, 41),
(52, 1, 40),
(53, 2, 42),
(54, 2, 41),
(55, 2, 40),
(56, 3, 42),
(57, 3, 41),
(58, 3, 40),
(59, 3, 43),
(60, 1, 2),
(61, 1, 27),
(62, 1, 36);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member'),
(3, 'Barista'),
(15, 'Owner');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `background_settings`
--
ALTER TABLE `background_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id_config`);

--
-- Indeks untuk tabel `customer_table`
--
ALTER TABLE `customer_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `table_code` (`table_code`);

--
-- Indeks untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indeks untuk tabel `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`),
  ADD KEY `id_category` (`id_category`);

--
-- Indeks untuk tabel `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id_image`);

--
-- Indeks untuk tabel `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sidebar_menu`
--
ALTER TABLE `sidebar_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sidebar_submenu`
--
ALTER TABLE `sidebar_submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slider_settings`
--
ALTER TABLE `slider_settings`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`),
  ADD UNIQUE KEY `supplier_code` (`supplier_code`);

--
-- Indeks untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `transaction_code` (`transaction_code`),
  ADD KEY `id_product` (`id_product`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `background_settings`
--
ALTER TABLE `background_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id_config` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `customer_table`
--
ALTER TABLE `customer_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sidebar_menu`
--
ALTER TABLE `sidebar_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `sidebar_submenu`
--
ALTER TABLE `sidebar_submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT untuk tabel `slider_settings`
--
ALTER TABLE `slider_settings`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
