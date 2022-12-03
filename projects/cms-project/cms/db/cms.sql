-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 03, 2022 at 01:56 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL COMMENT 'ไอดี',
  `comment_content` varchar(255) NOT NULL COMMENT 'คอมเมนต์',
  `post_id` int(11) NOT NULL COMMENT 'ไอดีโพสต์',
  `user_id` int(11) NOT NULL COMMENT 'ไอดีผู้ใช้',
  `comment_timestamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'ประทับเวลา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `post_id`, `user_id`, `comment_timestamp`) VALUES
(31, 'ลอร์ดสเตเดียมสถาปัตย์ ไวอากร้า โคโยตี้ซาร์โพสต์บ็อกซ์ ก่อนหน้าแพนงเชิญกระดี๊กระด๊าฮากกา ﻿กรรมาชนวอลนัต ลีกอิ่มแปร้ฮัม ถ่ายทำ แบรนด์ฟีดอุรังคธาตุ ', 25, 1, '2022-12-01 18:05:39'),
(32, 'ดีมานด์มุมมองบูมล็อตน้องใหม่ แคมป์ยูวีแฟกซ์เฟรมคอนเฟิร์ม', 25, 1, '2022-12-01 18:05:45'),
(33, ' สะบึมเฟอร์รี่ตัวตนฟาสต์ฟู้ด รีพอร์ท', 25, 5, '2022-12-01 18:06:52'),
(35, 'สะบึมส์จ๊าบแคมป์เฟรชบ็อกซ์ โฟนเอ๊าะ', 21, 1, '2022-12-01 18:07:25'),
(36, 'บอมบ์คลาสสิกคาเฟ่แมมโบ้แฟ้บ คอมพ์ฟอร์ม ปัจฉิมนิเทศแมชชีนอีโรติก แต๋วสต็อกอีโรติก น้องใหม่วอลล์เชอร์รี่ซังเต', 26, 1, '2022-12-01 18:07:33'),
(37, 'ก่อนหน้าแพนงเชิญกระดี๊กระด๊าฮากกา ﻿กรรมาชนวอลนัต ลีกอิ่มแปร้ฮัม ถ่ายทำ แบรนด์ฟีดอุรังคธาตุ โชว์รูมเด้อฮัลโลวีน', 26, 5, '2022-12-01 18:07:47');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL COMMENT 'ไอดี',
  `post_title` varchar(255) NOT NULL COMMENT 'หัวข้อ',
  `post_content` text NOT NULL COMMENT 'เนื้อหา',
  `post_category` varchar(50) NOT NULL COMMENT 'หมวดหมู่',
  `post_image` varchar(255) NOT NULL COMMENT 'รูปภาพ',
  `user_id` int(11) NOT NULL COMMENT 'ผู้โพสต์',
  `post_timestamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'ประทับเวลา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_content`, `post_category`, `post_image`, `user_id`, `post_timestamp`) VALUES
(18, 'อพาร์ทเมนท์ล็อต แคชเชียร์แจ๊กเก็ต', 'อพาร์ทเมนท์ล็อต แคชเชียร์แจ๊กเก็ต ยะเยือกร็อคเบอร์เกอร์เมเปิลอุปการคุณ น็อกวีน พาสตาบอยคอตภควัมบดีโอเลี้ยง แคทวอล์คช็อปปัจเจกชนโอเวอร์โฟน พริตตี้เทควันโดคัตเอาต์กับดักสหัสวรรษ เห่ยอันตรกิริยาจิตเภท มินท์รีวิวเชฟเพียว แอร์วีเจฮ็อตด็อกสเตริโอ สามแยก เบนโตะแฟ็กซ์แฟลชซ้อ สตาร์ โปรเจกต์เป็นไงแมนชั่น เทควันโดนายแบบครูเสดเวสต์ เห่ย', 'ทั่วไป', '', 5, '2022-12-01 18:02:48'),
(20, 'เซ็กซ์อัลตรา ฟอยล์อึ๋มแรลลีสป็อต', 'เซ็กซ์อัลตรา ฟอยล์อึ๋มแรลลีสป็อต สตรอเบอรีเอนทรานซ์แอสเตอร์ เมี่ยงคำสโตร์ อัลตรา บาร์บีคิว เฮอร์ริเคนโปรเจคท์ เคลียร์สามแยกมหภาค ซากุระ เบญจมบพิตรบูติกแคร์ สะกอมซิมโฟนี่ ชินบัญชร อ่อนด้อยเอฟเฟ็กต์โหลนพริตตี้ ลาติน เกสต์เฮาส์ ไพลิน', 'คำถาม', '', 5, '2022-12-01 18:03:11'),
(21, 'ไทยแลนด์ เทเลกราฟตื้บเนิร์สเซอรี', 'ไทยแลนด์ เทเลกราฟตื้บเนิร์สเซอรี ฮอตดอกเฟรชชี่บาร์บีคิวน็อกแคนยอน วอล์กห่วยสหรัฐโพสต์เป่ายิ้งฉุบ ตังค์ไทยแลนด์รีทัชโฮป วิทย์แอลมอนด์สไปเดอร์ฮ็อตด็อก ตรวจสอบ เจ๊าะแจ๊ะ ซาร์คลับบ๋อย โดนัทพาสปอร์ตนอร์ทสโตน ลิมิตไพลิน วีไอพีเอาท์โค้ชออโต้แพกเกจ อินเตอร์เซี้ยวอิสรชน เฟรมเปเปอร์เสกสรรค์เบลอ สปอต แก๊สโซฮอล์สเต็ปวาทกรรมป๊อก', 'ทั่วไป', '', 5, '2022-12-01 18:03:25'),
(22, 'สงบสุขเซนเซอร์ฮาลาลเกรดศิรินทร์', 'สงบสุขเซนเซอร์ฮาลาลเกรดศิรินทร์ พิซซ่า เบิร์ดผ้าห่ม มั้งยูโรป๊อปช็อค พูลตรวจทาน โอวัลตินแจ๊กเก็ตโบรชัวร์แชมเปี้ยนตังค์ มั้งอุปัทวเหตุแชเชือน ทับซ้อนสุนทรีย์บูติกแมนชั่น แบตคอนเซปต์ฟาสต์ฟู้ดกับดัก หน่อมแน้ม กราวนด์บร็อคโคลีคำสาป ไฮเทคพาวเวอร์คอปเตอร์วีไอพีซังเต แอสเตอร์แฟรี่ฟรังก์รีพอร์ทพงษ์ ราชบัณฑิตยสถานปัจเจกชนเทคโนสแตนเลสซิ่ง โคโยตีบลูเบอร์รีเซอร์วิสหมั่นโถวเอาท์ดอร์ แพนด้าเอนทรานซ์สตูดิโอ', 'เอกสาร', '', 5, '2022-12-01 18:03:50'),
(23, 'วอล์กวอลนัตกระดี๊กระด๊า', 'วอล์กวอลนัตกระดี๊กระด๊า แคนูแชมเปี้ยนโรแมนติค ต้าอ่วยสะบึมโฮมภควัมปติออทิสติก ซังเตโยเกิร์ตอุปัทวเหตุโบว์เซี้ยว มอนสเตอร์แจ๊กพ็อตแคร็กเกอร์พ่อค้าพลาซ่า แจมแพตเทิร์นเรซินไอซ์ คาเฟ่เช็งเม้งรุสโซเซ็กซ์แชมเปี้ยน แครกเกอร์ฮ่องเต้ แฟ้บเอ๋ไนท์ฮาร์ดอีโรติก ออร์เดอร์ อุด้งชัวร์อพาร์ทเมนต์หมวย ดีพาร์ตเมนท์ทาวน์ นาฏยศาลาคอปเตอร์ โคโยตี้ ต้าอ่วยเช็กฮอตสโรชา พีเรียด', 'ทั่วไป', '', 1, '2022-12-01 18:04:23'),
(24, 'แมมโบ้ชัวร์แอร์อุเทน บ๊อกซ์ต่อยอดซูโม่', 'แมมโบ้ชัวร์แอร์อุเทน บ๊อกซ์ต่อยอดซูโม่ จิตเภทหยวนดิกชันนารีเพรส เวสต์ไนท์ เทรนด์ อาข่า แซ็กโซโฟนนินจาเคส พาวเวอร์ เตี๊ยมแคมเปญ สปิริตเมคอัพ แอพพริคอทลาเต้มาร์ก แบรนด์คาแร็คเตอร์โฮลวีตรูบิค เดบิตเอฟเฟ็กต์หงวนรามาธิบดี หยวนแซนด์วิช หลวงปู่ปิโตรเคมีคาแร็คเตอร์ดยุกพรีเมียม ถูกต้องซัพพลายเออร์ซินโดรมกิมจิคอมเมนต์', 'ทั่วไป', '', 1, '2022-12-01 18:04:36'),
(25, 'จุ๊ย รุสโซเอาต์แตงโมงี้อัลมอนด์', 'จุ๊ย รุสโซเอาต์แตงโมงี้อัลมอนด์ ซิตีถูกต้องยังไง อริยสงฆ์โกลด์จอหงวนเหี่ยวย่นเวิลด์ ราเม็งโบรชัวร์ แฟรนไชส์เซ่นไหว้ ฮิปโป งี้เอ็นจีโอลาตินริกเตอร์ ทอล์คเซ็กซ์คอนเฟิร์มม้งเยลลี่ จุ๊ยซากุระ เมคอัพผ้าห่มโคโยตี้โอเปอเรเตอร์ แดนเซอร์ ครูเสด หมายปองอีโรติกคอมเมนต์ไนท์แจ๊กพ็อต จิตพิสัยเพาเวอร์ เทปแมกกาซีนไนท์บ๊อกซ์ติ่มซำ', 'เอกสาร', '', 1, '2022-12-01 18:04:48'),
(26, 'สต๊อกอริยสงฆ์อุปการคุณแอสเตอร์', 'สต๊อกอริยสงฆ์อุปการคุณแอสเตอร์ โกะไฟลท์น็อกดยุก นาฏยศาลามั้ยคาวบอยแบล็ก โอยัวะแดนเซอร์ซูฮกแครอทวัคค์ วอลนัตสามช่ามุมมองไฮเปอร์ เวสต์สจ๊วตคูลเลอร์ ซามูไร ดีเจโซนฟลอร์ลามะ ทับซ้อนรันเวย์แบล็กวีซ่า เทเลกราฟเตี๊ยมสหัชญาณซิตีรีเสิร์ช แบนเนอร์เสือโคร่ง โมเดิร์น ฮวงจุ้ยแดนเซอร์แจ็กพอตไทยแลนด์แอร์ อึ๋มโมหจริตรูบิคลิมูซีน คองเกรส คันธาระเกมส์ฮิตสไลด์กุมภาพันธ์', 'คำถาม', '', 1, '2022-12-01 18:05:01'),
(29, 'แอร์ก๋ากั่นโลชั่นซีเรียส', 'แอร์ก๋ากั่นโลชั่นซีเรียส แจมโปสเตอร์เอ๋อไตรมาสเท็กซ์ โปรโมชั่นสะบึมเทรลเล่อร์ เลิฟไมค์แฟรนไชส์ไวกิ้งไพลิน เฮียอาร์ติสต์ แอปเปิลคาร์ยากูซ่า ติ๋มชะโนดศากยบุตรโรแมนติกป๊อก จิตพิสัยสี่แยกสตีล มาเฟียปูอัดคอร์รัปชั่น สัมนาแชมป์เอ็นจีโอ เยอบีร่าโอวัลตินเรตติ้งบ๊อกซ์ ติวโชว์รูมเวิร์คคอนเฟิร์ม เซ่นไหว้ โฮสเตสเหมยเอ็นจีโอดิสเครดิตชิฟฟอน เด้อตังค์กราวนด์ซีอีโอ ไฮเปอร์', 'เอกสาร', '2042161592.png', 1, '2022-12-03 08:49:46'),
(30, 'โทร ไวอะกร้าซิ้มลอจิสติกส์', 'โทร ไวอะกร้าซิ้มลอจิสติกส์ เพียบแปร้พาสตาโมเดิร์นมือถือเบนโตะ แรลลี่ ฮันนีมูน รีสอร์ทโปลิศโครนา กุมภาพันธ์เจ๊าะแจ๊ะละตินซังเตแฟร์ คาวบอยแคทวอล์คเบอร์เกอร์หลวงปู่ กระดี๊กระด๊า ออดิทอเรียมมลภาวะเพียวเจ๊าะแจ๊ะตรวจสอบ ป๊อป โฮสเตสเพียบแปร้ ฮิบรูเป่ายิงฉุบแฮนด์ สะกอมฮาร์ด พิซซ่าไฮบริดเยน อึ๋ม', 'คำถาม', '1904756512.jpg', 1, '2022-12-03 08:53:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'ไอดีผู้ใช้',
  `user_email` varchar(100) NOT NULL COMMENT 'อีเมล',
  `user_firstname` varchar(100) NOT NULL COMMENT 'ชื่อ',
  `user_lastname` varchar(100) NOT NULL COMMENT 'นามสกุล',
  `user_password` varchar(20) NOT NULL COMMENT 'รหัสผ่าน',
  `user_role` enum('user','admin') NOT NULL DEFAULT 'user' COMMENT 'บทบาท',
  `user_timestamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'ประทับเวลา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_firstname`, `user_lastname`, `user_password`, `user_role`, `user_timestamp`) VALUES
(1, 'akira.ajeyb@gmail.com', 'Akira', 'Seesanyong', '123456', 'admin', '2022-12-01 12:14:03'),
(5, 'akira.ajeyb2@gmail.com', 'John', 'Doe', '123456', 'user', '2022-12-01 18:02:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดี', AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดี', AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีผู้ใช้', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
