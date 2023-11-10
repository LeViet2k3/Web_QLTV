-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 10, 2023 lúc 03:04 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

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
('TG01', 'Paulo Coelho'),
('TG02', 'Dale Carnegie'),
('TG03', 'Napoleon Hill'),
('TG04', 'Mario Puzo'),
('TG05', 'Nick Vujicic'),
('TG06', 'levanviet'),
('TG07', 'uruku');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book`
--

CREATE TABLE `book` (
  `Book_id` varchar(50) NOT NULL,
  `Book_name` varchar(500) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `Genre_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `book`
--

INSERT INTO `book` (`Book_id`, `Book_name`, `quantity`, `Genre_id`) VALUES
('MB01', 'Dại Thì Chết', 10, 'TL01'),
('MB02', 'Nghệ Thuật Nói Trước Công Chúng', 10, 'TL01'),
('MB03', 'Cuộc Sống Không Giới Hạn', 10, 'TL02'),
('MB04', 'Nhà Giả Kim', 10, 'TL02'),
('MB05', 'Đắc Nhân Tâm', 10, 'TL02'),
('MB06', 'Cách Nghĩ Để Thành Công', 10, 'TL03'),
('MB07', 'Bố Già', 10, 'TL03'),
('MB08', 'Ngoại Tình', 10, 'TL04'),
('MB09', 'Chiến Thắng Con Quỷ Trong Bạn', 10, 'TL01'),
('MB10', 'Quyền Năng Làm Giàu', 10, 'TL02'),
('MB11', 'levanviet', 15, 'TL05'),
('MB12', 'levanviet', 3, 'TL05'),
('MB13', 'levanviet123', 23, 'TL06'),
('MB14', 'leviet', 12, 'TL06'),
('MB15', 'vanviet', 233, 'TL07');

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
('MB01', 'TG04'),
('MB02', 'TG02'),
('MB03', 'TG05'),
('MB04', 'TG01'),
('MB05', 'TG02'),
('MB06', 'TG03'),
('MB07', 'TG04'),
('MB08', 'TG01'),
('MB09', 'TG03'),
('MB10', 'TG03'),
('MB11', 'TG06'),
('MB12', 'TG01'),
('MB13', 'TG07'),
('MB14', 'TG07'),
('MB15', 'TG01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `expense`
--

CREATE TABLE `expense` (
  `Expense_id` varchar(50) NOT NULL,
  `Charges` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `expense`
--

INSERT INTO `expense` (`Expense_id`, `Charges`) VALUES
('MP01', 10000),
('MP02', 12333),
('MP03', 40000),
('MP04', 20000),
('MP05', 12333),
('MP06', 20000),
('MP07', 40000),
('MP08', 20000);

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
('TL01', 'Truyện'),
('TL02', 'Sách'),
('TL03', 'Tiểu Thuyết'),
('TL04', 'Viễn Tưởng'),
('TL05', 'Kí Sự'),
('TL06', 'Nhật Kí'),
('TL07', 'Kịch');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `library_records`
--

CREATE TABLE `library_records` (
  `Id` int(11) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Book_id` varchar(50) DEFAULT NULL,
  `Book_borrowed_day` timestamp NULL DEFAULT current_timestamp(),
  `Book_return_day` varchar(100) DEFAULT NULL,
  `Charges` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `library_records`
--

INSERT INTO `library_records` (`Id`, `Email`, `Book_id`, `Book_borrowed_day`, `Book_return_day`, `Charges`) VALUES
(304, 'th10lop10.3levanviet@gmail.com', 'MB02', '2023-11-10 01:41:45', '5 ngày', 12333),
(305, 'th10lop10.3levanviet@gmail.com', 'MB01', '2023-11-10 01:41:58', '3 ngày', 15000),
(307, 'th10lop10.3levanviet@gmail.com', 'MB02', '2023-11-10 01:43:13', '3 ngày', 10000);

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
('th10lop10.3levanviet@gmail.com', 'Lê Văn Việt', 'nam', 'levanviet', 'Bình Trung Thăng Bình Quảng Nam', '0867548549', 'Đang hoạt động'),
('th11lop10.3levanviet@gmail.com', 'Lê Văn Việt', 'Nữ', 'levanviet123', 'Bình Trung Thăng Bình Quảng Nam', '123456789', 'Đang hoạt động'),
('viet.2k3.gm@gmail.com', 'Lê Văn Việt', 'Nam', 'levanviet', 'Bình Trung Thăng Bình Quảng Nam', '0935123556', 'Đang hoạt động'),
('viet.gm.2k3@gmail.com', 'Lê Việt', 'Nam', 'levanviet', 'Binh Trung Thang Binh Quang Nam', '0192839818', 'Đang hoạt động');

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
-- Chỉ mục cho bảng `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`Expense_id`);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

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
