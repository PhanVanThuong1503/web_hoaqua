-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 01, 2022 lúc 02:16 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `website_vanvan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(150) NOT NULL,
  `admin_user` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_user`, `admin_pass`) VALUES
(1, 'Ninh', 'ninh@gmail.com', 'abc', '123'),
(7, 'Hậu', 'hau123@gmaill.com', 'hau123', '123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `session_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `cate_id` int(11) NOT NULL,
  `cate_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`cate_id`, `cate_name`) VALUES
(53, 'Rau củ'),
(54, 'Trái cây'),
(59, 'Đồ khô'),
(60, 'Đồ uống');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feedback`
--

CREATE TABLE `feedback` (
  `fb_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `feedback`
--

INSERT INTO `feedback` (`fb_id`, `name`, `address`, `phone`, `email`, `content`) VALUES
(1, 'Nguyễn Đình Hậu', 'Hà Nội', '12345678', 'hau123@gmail.com', 'akjdf');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ncc`
--

CREATE TABLE `ncc` (
  `ma_ncc` int(11) NOT NULL,
  `ten_ncc` varchar(100) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `sodt` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ncc`
--

INSERT INTO `ncc` (`ma_ncc`, `ten_ncc`, `diachi`, `sodt`) VALUES
(1, 'Nông sản Kim Hằng', 'Nam Từ Liêm-Hà Nội', '3656754764'),
(2, 'Hoa quả Thành Nam', 'Số 14/16, Đường 990, Khu Phố 4, Phường Phú Hữu, Quận 9, Tp. Hồ Chí Minh (TPHCM)', '0123456789'),
(3, 'Nông sản Thái Thịnh', 'Thôn 8, Xã Đắk Ha, Huyện Đắk Glong, Tỉnh Đắk Nông', '0965749966');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `news_name` varchar(255) NOT NULL,
  `news_image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`news_id`, `news_name`, `news_image`, `description`) VALUES
(5, 'Nấm vân chi có tác dụng gì?', '71b9cbbf07.jpg', 'Cách đây hơn 2000 năm, nấm vân chi rừng đã được biết đến và sử dụng...'),
(6, 'Ăn rau có tốt cho sức khỏe không?', '94bd3c050f.jpg', 'Cách đây hơn 2000 năm, rau đã được trồng ở nhiều nơi....'),
(7, 'Chả cốm ăn với gì ngon', '733b517777.jpg', 'Bánh giò là một loại bánh được làm từ bột gạo tẻ, nhân bánh được...'),
(8, 'Cách làm măng tây xào tỏi', '2f8d48061f.jpg', 'Nguyên liệu làm món măng xào tỏi gồm...'),
(9, 'Súp lơ xanh nấu món gì ngon', '5a5a4dc834.jpg', 'Xúp lơ xanh xào gà là đặc sản của tỉnh....'),
(10, 'Yến mạch là gì?', 'cc1502572f.jpg', 'yến mạch là một loại ngũ cốc được trồng ở....');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(81, 72, 84, 1, 50000),
(82, 73, 84, 1, 50000),
(83, 74, 86, 1, 200000),
(84, 75, 84, 1, 50000),
(85, 76, 67, 2, 400000),
(86, 77, 81, 1, 100000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cate_id` int(11) NOT NULL,
  `ma_ncc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_quantity`, `product_image`, `description`, `cate_id`, `ma_ncc`) VALUES
(58, 'Chanh leo', '20000', 10, '2f23fd27cf.jpg', '', 54, 1),
(59, 'Lựu', '10000', 1, '8c02977822.jpg', '', 53, 1),
(61, 'Dừa', '120', 3, 'e303eb184a.jpg', '', 53, 1),
(63, 'Cam', '20000', 0, 'ed939c3d56.jpg', '', 53, 2),
(64, 'Nho xanh', '1000000', 0, 'ac14cdcb76.jpg', '', 54, 1),
(65, 'Ớt', '10000', 0, '90cbc18215.jpg', '', 53, 1),
(67, 'Súp lơ', '200000', 5, '4744d62846.jpg', '', 53, 1),
(72, 'Dứa(Thơm)', '100000', 95, '0dae5811a3.jpg', '', 54, 1),
(73, 'Táo xanh', '200000', 44, 'cbf379975f.jpg', '', 54, 2),
(81, 'Quả óc', '100000', 4, '8efeb31540.jpg', 'Cung cấp nhiều protein', 59, 1),
(83, 'Dâu tây', '200000', 9, '2738bf63bc.jpg', 'Dâu tây đỏ, ngọt ( 100% tự nhiên)', 54, 2),
(84, 'Nhãn', '50000', 18, '4ed4408ea3.jpg', 'Nhãn Hưng Yên', 59, 2),
(85, 'Nước cam ép', '100000', 1, 'cf39bde87e.jpg', 'được làm 100% từ cam', 60, 2),
(86, 'Nước cà chua ép', '200000', 2, '0b46ab2599.jpg', 'Cung cấp nhiều Vitamin C, tăng sức đề kháng trong thời tiết nắng nóng như đổ lửa\r\n', 60, 3),
(88, 'Nho sấy khô', '150000', 14, '68d279a8bc.jpg', 'Các loại hoa quả được sấy khô, khi ăn đem lại cảm giác ngon lạ thường.', 59, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblorder`
--

CREATE TABLE `tblorder` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `payment_method` int(11) NOT NULL DEFAULT 0,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tblorder`
--

INSERT INTO `tblorder` (`order_id`, `user_id`, `date`, `status`, `name`, `address`, `phone`, `payment_method`, `note`) VALUES
(72, 23, '2022-07-01 00:48:01', 2, 'Huy', 'Hà Nội', 123456789, 0, ''),
(73, 23, '2022-07-01 00:48:25', 3, 'Nguyễn Văn Ninh', 'Hà Nội', 123456789, 0, ''),
(74, 23, '2022-07-01 00:49:02', 3, 'Nguyễn Văn Ninh', 'Thái Nguyên', 123456789, 0, ''),
(75, 23, '2022-07-01 00:50:56', 3, 'Thắng', 'Thái Nguyên', 123456789, 1, ''),
(76, 23, '2022-07-01 06:14:13', 0, 'Ninh', 'Thái Nguyên', 123456789, 0, 'Giao vào lúc 1h chiều'),
(77, 16, '2022-07-01 06:16:20', 0, 'Nguyễn Văn Ninh', 'Thái Nguyên', 123456789, 0, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `password`, `name`, `address`, `email`, `phone`) VALUES
(16, '123', 'Nguyễn Văn Ninh', 'Thái Nguyên', 'abc@gmail.com', '0123456789'),
(19, '123', 'Phan Văn Thưởng', 'Thái Bình', 'ninh123@gmail.com', '0123456789'),
(20, 've7cm', 'Nguyễn Đình Hậu', 'BG', 'nguyendinhhau0107@gmail.com', '0123456789'),
(22, '123', 'Nguyễn Văn Huy', 'Thái Nguyên', 'chimchichbong20012008@gmail.com', '0215687654'),
(23, '123', 'Nguyễn Văn Ninh', 'Thái Nguyên', '1612.nvn@gmail.com', '0123456789');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cate_id`);

--
-- Chỉ mục cho bảng `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fb_id`);

--
-- Chỉ mục cho bảng `ncc`
--
ALTER TABLE `ncc`
  ADD PRIMARY KEY (`ma_ncc`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_detail_ibfk_1` (`order_id`),
  ADD KEY `order_detail_ibfk_2` (`product_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `cate_id` (`cate_id`),
  ADD KEY `ma_ncc` (`ma_ncc`);

--
-- Chỉ mục cho bảng `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT cho bảng `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `ncc`
--
ALTER TABLE `ncc`
  MODIFY `ma_ncc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT cho bảng `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tblorder` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_cate_product` FOREIGN KEY (`cate_id`) REFERENCES `category` (`cate_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`ma_ncc`) REFERENCES `ncc` (`ma_ncc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tblorder`
--
ALTER TABLE `tblorder`
  ADD CONSTRAINT `tblorder_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
