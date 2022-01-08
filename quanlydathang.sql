-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 26, 2021 lúc 03:21 PM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlydathang`
--
CREATE DATABASE IF NOT EXISTS `quanlydathang` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `quanlydathang`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdathang`
--

CREATE TABLE `chitietdathang` (
  `SoDonDH` int(11) NOT NULL,
  `MSHH` int(5) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `GiaDatHang` int(11) NOT NULL,
  `GiamGia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chitietdathang`
--

INSERT INTO `chitietdathang` (`SoDonDH`, `MSHH`, `SoLuong`, `GiaDatHang`, `GiamGia`) VALUES
(19, 13, 2, 100, 10),
(20, 12, 1, 60, 6),
(21, 20, 1, 150, 15);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dathang`
--

CREATE TABLE `dathang` (
  `SoDonDH` int(11) NOT NULL,
  `MSKH` int(5) NOT NULL,
  `MSNV` int(5) DEFAULT NULL,
  `NgayDH` datetime NOT NULL,
  `NgayGH` datetime NOT NULL,
  `TrangThaiDH` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `dathang`
--

INSERT INTO `dathang` (`SoDonDH`, `MSKH`, `MSNV`, `NgayDH`, `NgayGH`, `TrangThaiDH`) VALUES
(19, 23, 1, '2021-11-26 21:15:27', '0000-00-00 00:00:00', 'Đã giao hàng'),
(20, 23, 1, '2021-11-26 21:15:27', '0000-00-00 00:00:00', 'Đã xác nhận'),
(21, 23, NULL, '2021-11-26 21:16:12', '0000-00-00 00:00:00', 'Chưa xác nhận');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diachikh`
--

CREATE TABLE `diachikh` (
  `MaDC` int(5) NOT NULL,
  `DiaChi` varchar(200) NOT NULL,
  `MSKH` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `diachikh`
--

INSERT INTO `diachikh` (`MaDC`, `DiaChi`, `MSKH`) VALUES
(30, 'Ninh Kiều, Cần Thơ', 23),
(31, 'Ninh Kiều, Cần Thơ', 23),
(32, 'Ninh Kiều, Cần Thơ', 23),
(33, 'Ninh Kiều, Cần Thơ', 23),
(34, 'Ninh Kiều, Cần Thơ', 23);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanghoa`
--

CREATE TABLE `hanghoa` (
  `MSHH` int(5) NOT NULL,
  `TenHH` varchar(200) NOT NULL,
  `QuyCach` varchar(500) NOT NULL,
  `Gia` int(11) NOT NULL,
  `SoLuongHang` int(11) NOT NULL,
  `MaLoaiHang` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hanghoa`
--

INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`) VALUES
(12, 'Lót chuột One Piece', '✔️Giúp di chuyển chuột dễ dàng hơn\r\n✔️Làm đẹp cho gốc học tập của bạn!', 60, 89, 13),
(13, 'Miếng lót chuột IN HÌNH Nhất quỷ nhì ma, thứ ba Takagi anime chibi tiện lợi xinh xắn', '✔️ Miếng lót chuột IN HÌNH Nhất quỷ nhì ma, thứ\r\n✔️ ba Takagi anime chibi tiện lợi xinh xắn\r\n✔️ Kích thước: 20x24cm\r\n✔️ Sản phẩm cập nhật theo mốt mới và update thường xuyên', 50, 39, 13),
(14, 'Miếng lót chuột Takagi', '✔️ Quà tặng đặc biệt dành cho Fan\r\n✔️ Thích hợp làm quà tặng, quà lưu niệm\r\n✔️ Độ bền cao\r\n✔️ Giá tốt bất ngờ\r\n✔️ Chất lượng kiểu dáng mới phong phú', 55, 23, 13),
(15, 'Miếng di chuột in hình GAME GENSHIN IMPACT', 'Miếng di chuột in hình GAME GENSHIN IMPACT chibi anime miếng kê chuột miếng lót chuột mẫu mới\r\nKích thước: 20x24cm\r\nBàn di chuột cho việc điều khiển chuột nhanh nhạy và chính xác\r\nThích hợp làm quà tặng cho bạn bè và người thân', 50, 109, 13),
(16, 'Lót chuột máy tính Anime', '✔️ Lót chuột kích thước 20x24cm độ dầy 2mm nhỏ ngọn. Có thể mang theo đi mọi nơi để học tập, làm việc hoặc dùng làm món quà sinh nhật, quà tặng ý nghĩa cho người thân, bạn bè, nhân viên...\r\n✔️ Mặt lót chuột bằng vải, in chuyển nhiệt, chống phai màu, có thể giặt bằng nước lạnh sau 1 thời gian sử dụng.\r\n✔️ Mặt đế lót chuột bằng cao su tự nhiên, giúp chống trượt và tăng độ êm ái khi đặt tay lên rê chuột.', 60, 100, 13),
(17, 'Oyster♥Tấm lót chuột cỡ lớn in hình nhân vật Anime độc đáo', '✔️Độ dày 3mm của miếng lót chuột, mang lại cảm\r\n✔️ giác êm ái hơn hẳn các loại lót chuột bình thường.\r\n✔️ Mặt sản phẩm bằng vải, in chuyển nhiệt, chống phai màu, có thể giặt bằng nước lạnh sau 1 thời gian sử dụng.\r\n✔️ Mặt đế bằng cao su tự nhiên, giúp chống trượt và tăng độ êm ái khi đặt tay lên rê chuột.', 150, 98, 13),
(18, 'Tấm Lót Chuột In Hình Anime Your Name', 'Tính năng\r\n◆ Kích thước mở rộng và phù hợp: Bàn di chuột mở rộng này sẽ phù hợp với cả bàn phím và chuột, và các mục bàn làm việc khác. Cung cấp không gian di chuyển hoàn hảo để chơi game hoặc văn phòng.\r\n◆ Bề mặt vải siêu mịn: Được tối ưu hóa để di chuyển nhanh khi duy trì tốc độ và kiểm soát tuyệt vời trong quá trình chơi game hoặc làm việc. Đảm bảo chuyển động chuột dễ nhất và thời gian phản hồi tốt nhất.', 160, 99, 13),
(19, 'Mô hình Kimetsu No Yaiba', '📌 MÔ HÌNH KIMETSU NO YAIBA của shop là những sản phẩm chất lượng cao nhất \r\n📌 MÔ HÌNH KIMETSU NO YAIBA của shop có giá thành cạnh tranh nhất \r\n📌 Bảo Hành tất cả FIGURE, MÔ HÌNH cả gẫy vỡ trong quá trình vận chuyển', 120, 59, 14),
(20, 'Mô hình nhân vật anime Yukino Yukinoshita', '✔️ Chiều cao: 14 cm\r\n✔️ Bộ sản phẩm đầy đủ ghế, gấu, nhân vật... như hình\r\n✔️ Đóng hộp đẹp', 150, 38, 14),
(21, 'Mô hình Ram - Rem anime : Re:Rezo', '✔️ Tên nhân vật: Ram - Rem\r\n✔️ Kích thước : 19cm\r\n✔️ Thành phần: Mô hình nhân vật, chân đế\r\n✔️ Kiểu dáng: Mô hình tĩnh, không thể cử động\r\n✔️ Cách sử dụng: Trang trí, trưng bày, sưu tập', 150, 30, 14),
(22, 'Móc khóa hình nhân vật Naruto Sasuke 3d bằng cao su độc đáo', ' Tên sản phẩm: móc chìa khóa hình Naruto\r\n Dành cho: Tiệc / Sinh nhật / Hàng ngày / Quà tặng\r\n Kích thước: Khoảng 7,5 * 3 cm\r\n Chất liệu: Nhựa, Hợp kim\r\n Màu sắc: Như hình\r\n Chiều dài chuỗi: Khoảng 10 cm\r\n Gói hàng bao gồm: 1 * Móc khóa', 60, 99, 15),
(23, 'Móc Khóa Acrylic Hình Nhân Vật Shinobu Genya Muichiro Trong Anime Kimetsu No Yaiba', ' Chất liệu sản phẩm: Acrylic\r\n Màu sắc: Như hình ảnh hiển thị\r\n Sản phẩm hoàn toàn mới 100% và chất lượng cao \r\n Kích thước: 9 * 7 * 1 CM', 20, 45, 15);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhhanghoa`
--

CREATE TABLE `hinhhanghoa` (
  `MaHinh` int(11) NOT NULL,
  `TenHinh` varchar(255) NOT NULL,
  `MSHH` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hinhhanghoa`
--

INSERT INTO `hinhhanghoa` (`MaHinh`, `TenHinh`, `MSHH`) VALUES
(1, 'sp1.jpg', 12),
(2, 'sp2.jpg', 13),
(3, 'sp3.jpg', 14),
(4, 'sp4.jpg', 15),
(5, 'sp5.jpg', 16),
(6, 'sp6.jpg', 17),
(7, 'sp7.jpg', 18),
(8, 'sp8.jpg', 19),
(9, 'sp9.jpg', 20),
(10, 'sp10.jpg', 21),
(11, 'sp11.jpg', 22),
(12, 'sp12.jpg', 23);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `MSKH` int(5) NOT NULL,
  `HoTenKH` varchar(50) NOT NULL,
  `TenCongTy` varchar(200) NOT NULL,
  `SoDienThoai` varchar(12) NOT NULL,
  `SoFax` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`MSKH`, `HoTenKH`, `TenCongTy`, `SoDienThoai`, `SoFax`, `password`) VALUES
(23, 'Trần Phi Long', 'ABCXYZ', '0123545343', '123456789', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaihanghoa`
--

CREATE TABLE `loaihanghoa` (
  `MaLoaiHang` int(5) NOT NULL,
  `TenLoaiHang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loaihanghoa`
--

INSERT INTO `loaihanghoa` (`MaLoaiHang`, `TenLoaiHang`) VALUES
(13, 'Lót chuột'),
(14, 'Mô Hình'),
(15, 'Móc khóa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MSNV` int(5) NOT NULL,
  `HoTenNV` varchar(50) NOT NULL,
  `ChucVu` varchar(50) NOT NULL,
  `DiaChi` varchar(200) NOT NULL,
  `SoDienThoai` varchar(12) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MSNV`, `HoTenNV`, `ChucVu`, `DiaChi`, `SoDienThoai`, `password`) VALUES
(1, 'Long', 'Giám Đốc', 'Cái Răng, Cần Thơ', '023456787', '123');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD PRIMARY KEY (`SoDonDH`,`MSHH`),
  ADD KEY `MSHH` (`MSHH`);

--
-- Chỉ mục cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`SoDonDH`),
  ADD KEY `MSNV` (`MSNV`),
  ADD KEY `MSKH` (`MSKH`);

--
-- Chỉ mục cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  ADD PRIMARY KEY (`MaDC`),
  ADD KEY `MSKH` (`MSKH`);

--
-- Chỉ mục cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`MSHH`),
  ADD KEY `MaLoaiHang` (`MaLoaiHang`);

--
-- Chỉ mục cho bảng `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  ADD PRIMARY KEY (`MaHinh`),
  ADD UNIQUE KEY `MSHH` (`MSHH`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MSKH`);

--
-- Chỉ mục cho bảng `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  ADD PRIMARY KEY (`MaLoaiHang`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MSNV`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  MODIFY `SoDonDH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `dathang`
--
ALTER TABLE `dathang`
  MODIFY `SoDonDH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  MODIFY `MaDC` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `MSHH` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  MODIFY `MaHinh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MSKH` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  MODIFY `MaLoaiHang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MSNV` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD CONSTRAINT `chitietdathang_ibfk_2` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`) ON DELETE CASCADE,
  ADD CONSTRAINT `chitietdathang_ibfk_3` FOREIGN KEY (`SoDonDH`) REFERENCES `dathang` (`SoDonDH`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD CONSTRAINT `dathang_ibfk_2` FOREIGN KEY (`MSNV`) REFERENCES `nhanvien` (`MSNV`),
  ADD CONSTRAINT `dathang_ibfk_3` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  ADD CONSTRAINT `diachikh_ibfk_1` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `hanghoa_ibfk_1` FOREIGN KEY (`MaLoaiHang`) REFERENCES `loaihanghoa` (`MaLoaiHang`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  ADD CONSTRAINT `hinhhanghoa_ibfk_1` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
