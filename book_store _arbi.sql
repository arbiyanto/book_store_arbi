-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2017 at 05:42 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `noisbn` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publisher` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` int(10) UNSIGNED NOT NULL,
  `stock` int(11) NOT NULL,
  `baseprice` int(11) NOT NULL,
  `sellprice` int(11) NOT NULL,
  `tax` int(4) UNSIGNED DEFAULT NULL,
  `discount` int(4) UNSIGNED DEFAULT NULL,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `category_id`, `title`, `author`, `description`, `noisbn`, `publisher`, `date`, `stock`, `baseprice`, `sellprice`, `tax`, `discount`, `picture`, `status`, `updated_by`) VALUES
(8, 6, 'Bikin Framework PHP Sendiri Dengan Teknik OOP dan MVC', 'David Naista', '<p>Didalam buku ini, penulis akan membahas bagaimana cara membuat Framework PHP Sendiri dengan teknik OOP dan MVC serta membuat Library-Library. Bahkan setelah bisa membuat Framework PHP Sendiri,&nbsp;<b>Anda akan lebih mudah memahami dan menguasai Framework PHP lainnya seperti Codeigniter, Yii, dan Laravel</b>.</p><p>Studi kasus yang dibahas adalah Proyek Membuat Website Sekolah, baik itu halaman pengunjung (Front-End) maupun halaman administratornya (Back-End), semuanya dibuat berdasarkan Framework PHP yang telah kita buat sendiri. Mulai dari Modul Login, Modul Tentang Sekolah, Modul Siswa, Modul Alumni, Modul Guru, Modul Jurusan, Modul User, Modul Artikel, dan Modul-Modul lainnya.</p>', '978-602-62310-0-0', 'Lokomedia', 1460566800, 35, 35000, 55000, 10, 15, '148760711312978.jpg', 0, 16),
(9, 19, 'Zero To One', 'Peter Thiel', '<p>Apa perusahaan bernilai bisnis tinggi yang belum dibangun oleh siapa pun? Penerus Bill Gates tidak akan membuat sistem operasi. Penerus Larry Page atau Sergey Brin tidak akan membuat mesin pencari. Jika Anda meniru tokoh-tokoh itu, Anda tidak memetik pelajaran dari mereka.<br /><br />Tentu saja, meniru itu lebih mudah daripada membuat sesuatu yang baru. Mengerjakan sesuatu yang sudah kita ketahui caranya sama saja membawa dunia ini dari 1 ke n, hanya menambahkan sesuatu yang memang sudah ada dan biasa. Namun, setiap kali kita menciptakan sesuatu yang baru, kita berangkat dari 0 ke 1. Buku ini akan memberi tahu bagaimana caranya.<br /><br />â€œPeter Thiel telah mendirikan banyak perusahaan pelopor, dan Zero to One akan<br />mengajarkan caranya.â€ -ELON MUSK,- CEO SpaceX dan Tesla<br /><br />â€œBuku ini membawa ide-ide baru yang menyegarkan tentang cara menciptakan nilai di dunia.â€ -MARK ZUCKERBERG,- CEO Facebook<br /><br />â€œJika ada buku yang ditulis oleh seorang pengambil risiko, bacalah. Khusus untuk buku Peter Thiel, bacalah dua kali. Atau, supaya aman, bacalah tiga kali. Ini buku klasik.â€ -NASSIM NICHOLAS TALEB,- penulis The Black Swan<br /><br />PETER THIEL adalah salah satu pendiri PayPal dan Palantir, salah seorang investor luar pertama Facebook, pemodal bagi perusahaan-perusahaan seperti SpaceX dan LinkedIn, serta pendiri Thiel Fellowship yang mendorong kaum muda untuk memprioritaskan belajar ketimbang menempuh pendidikan formal.&nbsp;</p>', '9786020321486', 'Gramedia Pustaka Utama', 1446397200, 100, 50000, 72000, NULL, 15, '148777621022333.jpg', 0, 16),
(10, 18, 'The Lean Startup', 'Eric Ries', '', '9786022911340', 'Mizan', 1487696400, 15, 40000, 79000, NULL, 15, '14877778687797.png', 0, 16),
(11, 7, 'Majapahit 2 :Bala Sanggrama', 'Langit Kresna Hariadi', '', '0088676', 'BENTANG PUSTAKA', 1383843600, 0, 70000, 84000, NULL, 15, '148777814019842.jpg', 0, 16),
(12, 18, 'Startuppedia: Panduan Membangun Startup Ala Silicon Valley', 'Anis Uzzaman', '<p>Gerakan startup di Singapura,Indonesia,Malaysia,Vietnam, Filipina, Taiwan, Thailand, dan Myanmar yang terus Berkembang benar-benar menciptakan iklim kompetisi yang menarik.Tak heran jika wilayah ini menjadi harapan baru bagi munculnya Google atau Facebook generasi baru di masa depan</p>', '9786022910923', 'BENTANG PUSTAKA', 1430672400, 0, 30000, 54000, 1, 15, '14877785464227.jpg', 0, 16),
(13, 13, 'Damai Bersama Gus Dur', 'Kump Naskah', '', '9789797094690', 'Penerbit Buku Kompas', 1265216400, 0, 15500, 30000, NULL, 15, '148777888919978.jpg', 0, 16),
(14, 7, 'Berjuta Rasanya', 'Tere Liye', '<p>"Kalian akan merasakan remuk seketika tepat di dada saat membaca buku ini."<br />â€“Fatimah Ratna Wijayanthi, Karyawan.<br /><br />"Cinta adalah sekumpulan paradoks yang membingungkan. Maka meskipun menyakitkan, cinta tetaplah membahagiakan. Bacaan yang tepat, bagi mereka yang ingin mengeja makna cinta, patah, dan hati."&nbsp;<br />â€“Galih Hidayatullah, Mahasiswa.<br /><br />"Saya bahkan sampai 5 kali membacanya tanpa bosan. Sebuah karya yang patut dinikmati lagi, lagi, dan lagi."&nbsp;<br />â€“Sulistyowati, Ibu Rumah Tangga.<br /><br />"Saya memang menyelesaikan membaca bukunya dalam waktu singkat. Tetapi setelah saya baca, membutuhkan waktu yang lama sekali merenungkan isi ceritanya."&nbsp;<br />â€“Rian Mantasa SP, Mahasiswa.<br /><br />"Buku galau, yang mengobati galau."&nbsp;<br />â€“Hanif Khoiriyah, Mahasiswi.</p>', '0000000', 'MAHAKA', 1335805200, 0, 30000, 40000, 1, 10, '14877918857962.jpg', 0, 16),
(15, 23, 'Your Lie in April', 'Naoshi Arakawa', '<p>ousei Arima(9 tahun), anak ajaib!<br /><br />Di usia muda, ia sudah menjuarai berbagai kompetisi piano.<br />Namun, saat usianya 11 tahun, ibunya yang juga pelatih pianonya, meninggal. Sejak saat itu, ia menjadi tak lagi mampu mendengar suara piano. Karir pianonya hancur berantakan.<br /><br />Dua tahun lamanya, Arima tak menyentuh piano.<br /><br />Sampai suatu hari,<br />seorang gadis bernama Kaori Miyazono mengubah segalanya</p>', '9786023394210', 'KODANSHA', 1439917200, 0, 18000, 25000, 1, 10, '148779218527849.jpg', 0, 16),
(17, 23, 'Nisekoi: False Love 4', 'Naoshi Komi', '', '9786020299563', 'Elex Media Komputindo', 1486314000, 0, 17000, 23000, NULL, 10, '148779242522145.jpg', 0, 16),
(18, 7, 'Critical Eleven', 'Ika Natassa', '<p>"Membaca Critical Eleven? Tiga menit pertama yang menyenangkan, delapan menit terakhir yang mengesankan, dan hanya butuh kurang dari 11 detik untuk memutuskan bahwa ini adalah karya favorit saya dari Ika Natassa. Ika sebagai pilot, mengendalikan segalanya dengan sangat baik dan berakhir dengan super smooth landing. Impressive! I absolutely love this book! Romantic and uplifting. This book will successfully put a smile on your face and also make you think."<br /><br />NINIT YUNITA â€“ PENULIS</p><p><br />"Sebagai pencinta bandara tanpa tempat pulang yang tetap (dan benci terbang, seperti Anya), saya menemukan sekeping â€˜rumahâ€™ di buku ini sejak halaman pertama. Ika bertutur dengan hangat dan memikat (dengan sentuhan yang â€˜Ika bangetâ€™) sehingga pembaca akan merasa dekat dengan sosok Anya dan Aleâ€“â€“sesuatu yang menurut saya sangat penting dalam sebuah cerita. Satu lagi: novel ini harus dibaca sambil minum kopi. Youâ€™ll know why!"<br /><br />JENNY JUSUF â€“ PENULIS &amp; SCRIPTWRITER<br /><br />Dalam dunia penerbangan, dikenal istilah critical eleven, sebelas menit paling kritis di dalam pesawatâ€“â€“tiga menit setelah take off dan delapan menit sebelum landingâ€“â€“karena secara statistik delapan puluh persen kecelakaan pesawat umumnya terjadi dalam rentang waktu sebelas menit itu. It''s when the aircraft is most vulnerable to any danger.<br /><br />In a way, it''s kinda the same with meeting people. Tiga menit pertama kritis sifatnya karena saat itulah kesan pertama terbentuk, lalu ada delapan menit sebelum berpisahâ€“â€“delapan menit ketika senyum, tindak tanduk, dan ekspresi wajah orang tersebut jelas bercerita apakah itu akan jadi awal sesuatu ataukah justru menjadi perpisahan.</p><p><br />Ale dan Anya pertama kali bertemu dalam penerbangan Jakarta-Sydney. Tiga menit pertama Anya terpikat, tujuh jam berikutnya mereka duduk bersebelahan dan saling mengenal lewat percakapan serta tawa, dan delapan menit sebelum berpisah Ale yakin dia menginginkan Anya.<br /><br />Kini, lima tahun setelah perkenalan itu, Ale dan Anya dihadapkan pada satu tragedi besar yang membuat mereka mempertanyakan pilihan-pilihan yang mereka ambil, termasuk keputusan pada sebelas menit paling penting dalam pertemuan pertama mereka.<br /><br />Diceritakan bergantian dari sudut pandang Ale dan Anya, setiap babnya merupakan kepingan puzzle yang membuat kita jatuh cinta atau benci kepada karakter-karakternya, atau justru keduanya</p>', '9786020318929', 'Gramedia Pustaka Utama', 1439226000, 0, 60000, 80000, 1, 20, '148779254221286.jpg', 0, 16),
(19, 7, 'New Edition Laskar Pelangi', 'Andrea Hirata', '', '9786028811361', 'BENTANG PUSTAKA', 1305046800, 0, 50000, 79000, NULL, 20, '14877929337919.jpg', 0, 16),
(20, 23, 'I`M Sakamoto, You Know? 02', 'Nami Sano', '<p>Sakamoto adalah siswa SMA tahun pertama yang tak cuma keren, tapi SANGAT keren! Tak heran jika banyak cewek menyukainya, dan sebaliknya, tak sedikit cowok membencinya. Namun tak peduli dengan rencana jahat yang direncanakan teman cowok sekelasnya, Sakamoto akan selalu bisa mengatasinya dengan cara yang "keren". Meskipun tampak dingin dan penyendiri, Sakamoto tak segan membantu teman.<br /><br />Sebenarnya siapakah dia? Mengapa ia terlihat begitu misterius dan serba bisa?</p>', '9786023395347', 'M&C!', 1487782800, 0, 13000, 23000, 1, 10, '148779306511772.jpg', 0, 16),
(22, 23, 'Soul Eater Not! 04: Lc', 'Atsushi Ohkubo', '', '9786020288581', 'Elex Media Komputindo', 1466528400, 0, 13000, 22000, NULL, 10, '14877932043205.jpg', 0, 16);

-- --------------------------------------------------------

--
-- Table structure for table `book_to_labels`
--

CREATE TABLE `book_to_labels` (
  `id` int(11) NOT NULL,
  `label_id` int(11) UNSIGNED NOT NULL,
  `book_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_to_labels`
--

INSERT INTO `book_to_labels` (`id`, `label_id`, `book_id`) VALUES
(3, 1, 14),
(4, 1, 18),
(5, 1, 15),
(6, 1, 13),
(7, 1, 22),
(8, 1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `book_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `book_id`, `user_id`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 8, 18, 3, 0, '2017-02-16 17:00:00', '2017-02-16 17:00:00'),
(2, 8, 17, 5, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_to_payment`
--

CREATE TABLE `cart_to_payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `cart_id` int(10) UNSIGNED NOT NULL,
  `payment_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_to_payment`
--

INSERT INTO `cart_to_payment` (`id`, `cart_id`, `payment_id`) VALUES
(1, 1, 1),
(3, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(5, 'Filsafat'),
(6, 'Komputer & Internet'),
(7, 'Novel'),
(8, 'Agama'),
(9, 'Majalah'),
(10, 'Masakan'),
(11, 'Hukum'),
(12, 'Kesehatan & Diet'),
(13, 'Pendidikan & Pengajaran'),
(14, 'Psikologi'),
(15, 'Hiburan'),
(16, 'Buku Sekolah'),
(17, 'Buku Anak-anak'),
(18, 'Bisnis'),
(19, 'Pengembangan Diri & Karir'),
(20, 'Kamus'),
(21, 'Seni Rupa & Fotografi'),
(22, 'Petualangan & Olahraga'),
(23, 'Komik');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `commentable_id` int(11) NOT NULL,
  `commentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

CREATE TABLE `distributor` (
  `id` int(11) NOT NULL,
  `distributor_name` varchar(191) NOT NULL,
  `distributor_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distributor`
--

INSERT INTO `distributor` (`id`, `distributor_name`, `distributor_address`) VALUES
(1, 'Lokomedia', 'Jalan Baru No.56 Yogyakarta'),
(3, 'Bhuana Ilmu Populer', 'Jakarta'),
(4, 'Gramedia', 'Jakarta'),
(5, 'Noura Book Publising', ''),
(6, 'Nico Blog', 'Jakrta');

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE `labels` (
  `id` int(11) UNSIGNED NOT NULL,
  `label_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labels`
--

INSERT INTO `labels` (`id`, `label_name`) VALUES
(1, 'Best Seller'),
(4, 'Rekomendasi Publisher');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `payment_number` int(11) NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_holder` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipient` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resi_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `payment_number`, `payment_method`, `card_holder`, `card_number`, `destination`, `recipient`, `resi_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 18, 100001, 'BCA', 'Arbiyanto Wijaya', '19191-1211-1231', 'Komplek Kunciran Mas Permai Blok.M4 No.14 RT.01 RW.02. Pinang, Tangerang', 'Arbiyanto Wijaya', '100-101001011', 2, '2017-02-16 17:00:00', '2017-02-22 05:02:03'),
(2, 18, 1212121, 'BRI', 'Chen Tong', '999514-12311', 'Di timur rumah saya ada sebuah danau besar, disana rumah saya berada.', 'Chen Mong', '', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'member', 'Member', 'Dapat bertransaksi dan membeli buku', NULL, NULL),
(2, 'cashier', 'Kasir', 'Melakukan pengecekan transaksi', NULL, NULL),
(3, 'admin', 'Admin', 'Dapat mengatur segala urusan.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_transaction`
--

CREATE TABLE `stock_transaction` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `distributor_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_transaction`
--

INSERT INTO `stock_transaction` (`id`, `book_id`, `distributor_id`, `amount`, `date`) VALUES
(2, 8, 1, 10, 1487696400),
(3, 8, 1, 15, 1487696400),
(4, 8, 1, 10, 1487696400),
(5, 9, 4, 100, 1460048400),
(6, 10, 4, 15, 1487696400);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('M','F') COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `email`, `password`, `picture`, `fullname`, `gender`, `address`, `phone`, `remember_token`, `created_at`, `updated_at`) VALUES
(16, 3, 'arbiyanto', 'arbiyantowijaya17@gmail.com', '$2y$10$6bpuhDoOoBUtY77uTvIgCu8fHQvk5J8BKgJ/rpcuut1L72Fv1./UC', '', '', 'M', '', '', '$2y$10$/ldHaOSzwtGl9lPR83rFVeenzw3KT6Emk.cCs.fkAJwz8TeX1xL5a', NULL, NULL),
(17, 3, 'chentong', 'chentong17@gmail.com', '$2y$10$WLxWpyLcmzFXZnVS/7D2XeV.2wrDZrlyrR9KDYGTa2F9ZH9lZewu2', '', '', 'M', '', '', '$2y$10$sVX/9dqOKB0fm2hNY4lIgOxDn0q.v0nQbgqtkVkZpFngujxMOCSCa', NULL, NULL),
(18, 1, 'member', 'member@gmail.com', '$2y$10$6bpuhDoOoBUtY77uTvIgCu8fHQvk5J8BKgJ/rpcuut1L72Fv1./UC', 'ar.jpg', 'Arbiyanto Wijaya', 'M', 'Jakarta Utara', '081280827770', NULL, NULL, NULL),
(19, 1, 'chentong321', 'chentong@yahoo.co.id', '$2y$10$1FKBobryxVkSx4hd0.NNyO3rf7cwPIDMjGYc3PHQRe0H.x3UgfVNa', '', '', 'M', '', '', '$2y$10$UBmyOC0SffNHgPMaOc/YjeW0wmvx5A6I5hfZf745X8oPGqnQOOelG', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_updated_by_foreign` (`updated_by`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `book_to_labels`
--
ALTER TABLE `book_to_labels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `label_id` (`label_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_book_id_foreign` (`book_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_to_payment`
--
ALTER TABLE `cart_to_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_to_payment_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_to_payment_payment_id_foreign` (`payment_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `stock_transaction`
--
ALTER TABLE `stock_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `distributor_id` (`distributor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `book_to_labels`
--
ALTER TABLE `book_to_labels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cart_to_payment`
--
ALTER TABLE `cart_to_payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `distributor`
--
ALTER TABLE `distributor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `stock_transaction`
--
ALTER TABLE `stock_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_book_to_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `book_to_labels`
--
ALTER TABLE `book_to_labels`
  ADD CONSTRAINT `fk_book_to_book` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `fk_label_id_to_labels_id` FOREIGN KEY (`label_id`) REFERENCES `labels` (`id`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_to_payment`
--
ALTER TABLE `cart_to_payment`
  ADD CONSTRAINT `cart_to_payment_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_to_payment_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_to_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
