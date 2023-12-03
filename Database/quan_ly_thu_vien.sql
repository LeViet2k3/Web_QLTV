-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 27, 2023 lúc 01:35 AM
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
('TG08', 'levanviet'),
('TG09', 'uruku');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book`
--

CREATE TABLE `book` (
  `Book_id` varchar(50) NOT NULL,
  `Book_name` varchar(500) DEFAULT NULL,
  `File_pdf` varchar(255) NOT NULL,
  `Genre_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `book`
--

INSERT INTO `book` (`Book_id`, `Book_name`, `File_pdf`, `Genre_id`) VALUES
('MB01', 'Sao Chúng Ta Lại Ngủ', 'Sao chúng ta lại ngủ.pdf', 'TL01'),
('MB02', 'Data Analysis Using Sql And Excel', 'Data Analysis Using SQL and Excel.pdf', 'TL02'),
('MB03', 'Excel Power Pirot And Power Query For Dummies', 'Excel Power Pivot Power Query For Dummies.pdf', 'TL03'),
('MB04', 'Python Programming', 'Python Programing.pdf', 'TL04'),
('MB05', 'Python For Data Analysis', 'Python For Data Analysis.pdf', 'TL05'),
('MB06', 'Computer Vision Algorithms And Applications', 'Computer Vision Algorithms And Applications.pdf', 'TL06'),
('MB07', 'Atomic Habits', 'Atomic Babits.pdf', 'TL07');

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
('MB07', 'TG07');

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
('TL01', 'Short Story'),
('TL02', 'Book'),
('TL03', 'Novel'),
('TL04', 'Science Fiction'),
('TL05', 'Memoir'),
('TL06', 'Diary'),
('TL07', 'Comment'),
('TL08', 'Tiểu Thuyết');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `library_records`
--

CREATE TABLE `library_records` (
  `Id` int(11) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Book_id` varchar(50) DEFAULT NULL,
  `Book_borrowed_day` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `Users_status` varchar(50) NOT NULL,
  `Roles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`Email`, `UserName`, `Gender`, `Passwords`, `Place_of_origin`, `A_phone_number`, `Users_status`, `Roles`) VALUES
('bao@gmail.com', 'Nguyễn Gia Bảo', 'Nam', '123456', 'Quảng Nam', '123456789', 'Đang hoạt động', 1),
('hoang@gmail.com', 'Nguyễn Trọng Hoàng', 'Nam', '123456', 'Đà Nẵng', '09873562', 'Đang hoạt động', 1),
('lehang@gmail.com', 'Trần Thị Lệ Hằng', 'Nữ', '123456', 'Quảng Bình', '09873562', 'Đang hoạt động', 1),
('nam.gm.2k5@gmail.com', 'Anh 5', 'Nam', '1234567', 'Bình Trung Thăng Bình Quảng Nam', '09873562', 'Đang hoạt động', 1),
('quocviet@gmail.com', 'Huỳnh Quốc Việt', 'Nam', '123456', 'Quảng Nam', '0978635237', 'Đang hoạt động', 1),
('th10lop10.3levanviet@gmail.com', 'Lê Văn Việt', 'Nam', '123456', 'Quảng Nam', '0867548542', 'Đang hoạt động', 1),
('viet.gm.2k33@gmail.com', 'Lê Văn Việt', 'Nam', 'levanviet', 'Bình Trung Thăng Bình Quảng Nam', '1234567', 'Đang hoạt động', 1),
('viet.gm.2k3@gmail.com', 'Lê Việt', 'Nam', 'levanviet', 'Binh Trung Thang Binh Quang Nam', '01928398', 'Đang hoạt động', 2);

--
-- Chỉ mục cho các bảng đã đổ
--

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=383;

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
