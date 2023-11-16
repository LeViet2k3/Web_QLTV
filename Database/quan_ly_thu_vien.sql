-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 16, 2023 lúc 04:41 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quan_ly_thu_vien`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `Email` varchar(100) NOT NULL,
  `Admin_name` varchar(200) DEFAULT NULL,
  `Passwords` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`Email`, `Admin_name`, `Passwords`) VALUES
('3120221507@ued.udn.vn', 'Lê Việt', 'levanviet@123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `author`
--

CREATE TABLE `author` (
  `Author_id` varchar(50) NOT NULL,
  `Author_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `author`
--

INSERT INTO `author` (`Author_id`, `Author_name`) VALUES
('TG01', 'Matthew Walke'),
('TG02', 'Gordon S.Linoff'),
('TG03', 'Michael Alexander'),
('TG04', 'Hans Petter Halvorsen'),
('TG05', 'Wes McKinney'),
('TG06', 'Richard Szeliski'),
('TG07', 'James Clear'),
('TG08', 'levanviet');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book`
--

CREATE TABLE `book` (
  `Book_id` varchar(50) NOT NULL,
  `Book_name` varchar(500) DEFAULT NULL,
  `File_pdf` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `Price` bigint(20) NOT NULL,
  `Genre_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `book`
--

INSERT INTO `book` (`Book_id`, `Book_name`, `File_pdf`, `quantity`, `Price`, `Genre_id`) VALUES
('MB01', 'Sao Chúng Ta Lại Ngủ', 'Sao chúng ta lại ngủ.pdf', 3, 340000, 'TL01'),
('MB02', 'Data Analysis Using Sql And Excel', 'Data Analysis Using SQL and Excel.pdf', 3, 250000, 'TL02'),
('MB03', 'Excel Power Pirot And Power Query For Dummies', 'Excel Power Pivot Power Query For Dummies.pdf', 0, 395000, 'TL03'),
('MB04', 'Python Programming', 'Python Programing.pdf', 6, 405000, 'TL04'),
('MB05', 'Python For Data Analysis', 'Python For Data Analysis.pdf', 8, 230000, 'TL05'),
('MB06', 'Computer Vision Algorithms And Applications', 'Computer Vision Algorithms And Applications.pdf', 7, 195000, 'TL06'),
('MB07', 'Atomic Habits', 'Atomic Babits.pdf', 7, 325000, 'TL07'),
('MB09', 'leviet', 'Bai tap Dai so quan he.pdf', 8, 123456, 'TL03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book_has_author`
--

CREATE TABLE `book_has_author` (
  `Book_id` varchar(50) DEFAULT NULL,
  `Author_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `book_has_author`
--

INSERT INTO `book_has_author` (`Book_id`, `Author_id`) VALUES
('MB01', 'TG01'),
('MB02', 'TG02'),
('MB03', 'TG03'),
('MB04', 'TG04'),
('MB05', 'TG05'),
('MB06', 'TG06'),
('MB07', 'TG07'),
('MB09', 'TG01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `genre`
--

CREATE TABLE `genre` (
  `Genre_id` varchar(50) NOT NULL,
  `Genre_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `genre`
--

INSERT INTO `genre` (`Genre_id`, `Genre_name`) VALUES
('TL01', 'Truyện ngắn'),
('TL02', 'Sách'),
('TL03', 'Tiểu Thuyết'),
('TL04', 'Viễn Tưởng'),
('TL05', 'Kí Sự'),
('TL06', 'Nhật Kí'),
('TL07', 'Bình luận');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `library_records`
--

CREATE TABLE `library_records` (
  `Id` int(11) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Book_id` varchar(50) DEFAULT NULL,
  `Price` bigint(20) NOT NULL,
  `Book_borrowed_day` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `library_records`
--

INSERT INTO `library_records` (`Id`, `Email`, `Book_id`, `Price`, `Book_borrowed_day`) VALUES
(366, 'th10lop10.3levanviet@gmail.com', 'MB01', 340000, '2023-11-15 13:29:30'),
(367, 'th10lop10.3levanviet@gmail.com', 'MB02', 250000, '2023-11-15 13:31:21');

--
-- Bẫy `library_records`
--
DELIMITER $$
CREATE TRIGGER `remaining` AFTER INSERT ON `library_records` FOR EACH ROW BEGIN
    UPDATE book 
    SET quantity = quantity - 1
    WHERE Book_id = NEW.Book_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `Email` varchar(50) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `Passwords` varchar(100) DEFAULT NULL,
  `Place_of_origin` varchar(200) DEFAULT NULL,
  `A_phone_number` varchar(50) DEFAULT NULL,
  `Users_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`Email`, `UserName`, `Gender`, `Passwords`, `Place_of_origin`, `A_phone_number`, `Users_status`) VALUES
('nam.gm.2k5@gmail.com', 'Nguyễn Văn Nam', 'Nam', 'levanviet', 'Bình NamThăng Bình Quảng Nam', '0978635237', 'Đang hoạt động'),
('th10lop10.3levanviet@gmail.com', 'Lê Văn Việt', 'Nam', 'levanviet', 'Bình Trung Thăng Bình Quảng Nam', '0867548542', 'Đã xóa'),
('th11lop10.3levanviet@gmail.com', 'Lê Văn Việt', 'Nữ', 'levanviet123', 'Bình Trung Thăng Bình Quảng Nam', '123456789', 'Đang hoạt động'),
('viet.2k3.gm@gmail.com', 'Lê Văn Việt', 'Nam', 'levanviet', 'Bình Trung Thăng Bình Quảng Nam', '09873562', 'Đang hoạt động'),
('viet.gm.2k3@gmail.com', 'Lê Việt', 'Nam', 'levanviet', 'Binh Trung Thang Binh Quang Nam', '01928398', 'Đã xóa');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`Email`);

--
-- Chỉ mục cho bảng `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`Author_id`);

--
-- Chỉ mục cho bảng `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`Book_id`),
  ADD KEY `Genre_id` (`Genre_id`);

--
-- Chỉ mục cho bảng `book_has_author`
--
ALTER TABLE `book_has_author`
  ADD KEY `Book_id` (`Book_id`),
  ADD KEY `Author_id` (`Author_id`);

--
-- Chỉ mục cho bảng `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`Genre_id`);

--
-- Chỉ mục cho bảng `library_records`
--
ALTER TABLE `library_records`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Book_id` (`Book_id`),
  ADD KEY `Email` (`Email`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `library_records`
--
ALTER TABLE `library_records`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=368;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`Genre_id`) REFERENCES `genre` (`Genre_id`);

--
-- Các ràng buộc cho bảng `book_has_author`
--
ALTER TABLE `book_has_author`
  ADD CONSTRAINT `book_has_author_ibfk_1` FOREIGN KEY (`Book_id`) REFERENCES `book` (`Book_id`),
  ADD CONSTRAINT `book_has_author_ibfk_2` FOREIGN KEY (`Author_id`) REFERENCES `author` (`Author_id`);

--
-- Các ràng buộc cho bảng `library_records`
--
ALTER TABLE `library_records`
  ADD CONSTRAINT `library_records_ibfk_1` FOREIGN KEY (`Book_id`) REFERENCES `book` (`Book_id`),
  ADD CONSTRAINT `library_records_ibfk_2` FOREIGN KEY (`Email`) REFERENCES `users` (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
