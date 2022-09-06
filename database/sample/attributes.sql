-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th6 16, 2021 lúc 07:14 AM
-- Phiên bản máy phục vụ: 5.7.26
-- Phiên bản PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_123job_reporter`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `type_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `admin_id` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `slug`, `type`, `type_text`, `status`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, '< 1 triệu', '1-trieu', 1, 'Mức lương', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(2, '1 - 3 triệu', '1-3-trieu', 1, 'Mức lương', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(3, '3 - 5 triệu', '3-5-trieu', 1, 'Mức lương', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(4, '5 - 7 triệu', '5-7-trieu', 1, 'Mức lương', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(5, '7 - 10 triệu', '7-10-trieu', 1, 'Mức lương', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(6, '10 - 12 triệu', '10-12-trieu', 1, 'Mức lương', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(7, '12 - 15 triệu', '12-15-trieu', 1, 'Mức lương', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(8, '15 - 20 triệu', '15-20-trieu', 1, 'Mức lương', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(9, '20 - 25 triệu', '20-25-trieu', 1, 'Mức lương', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(10, '25 - 30 triệu', '25-30-trieu', 1, 'Mức lương', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(11, '30 - 40 triệu', '30-40-trieu', 1, 'Mức lương', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(12, '40 - 50 triệu', '40-50-trieu', 1, 'Mức lương', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(13, 'Trên 50 triệu', 'tren-50-trieu', 1, 'Mức lương', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(14, 'Nhân viên', 'nhan-vien', 2, 'Cấp bậc', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(15, 'Cộng tác viên', 'cong-tac-vien', 2, 'Cấp bậc', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(16, 'Thực tập sinh', 'thuc-tap-sinh', 2, 'Cấp bậc', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(17, 'Trưởng nhóm', 'truong-nhom', 2, 'Cấp bậc', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(18, 'Trưởng phòng', 'truong-phong', 2, 'Cấp bậc', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(19, 'Trưởng dự án', 'truong-du-an', 2, 'Cấp bậc', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(20, 'Giám đốc', 'giam-doc', 2, 'Cấp bậc', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(21, 'Phó Giám Đốc', 'pho-giam-doc', 2, 'Cấp bậc', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(22, 'Giám đốc điều hành', 'giam-doc-dieu-hanh', 2, 'Cấp bậc', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(23, 'Giám đốc chiến lược', 'giam-doc-chien-luoc', 2, 'Cấp bậc', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(24, 'Giám đốc nhân sự', 'giam-doc-nhan-su', 2, 'Cấp bậc', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(25, 'Giám đốc kinh doanh', 'giam-doc-kinh-doanh', 2, 'Cấp bậc', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(26, 'Toàn thời gian', 'toan-thoi-gian', 3, 'Hình thức làm việc', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(27, 'Bán thời gian', 'ban-thoi-gian', 3, 'Hình thức làm việc', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(28, 'thời vụ', 'thoi-vu', 3, 'Hình thức làm việc', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(29, 'làm từ xa', 'lam-tu-xa', 3, 'Hình thức làm việc', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(30, 'Đại học', 'dai-hoc', 4, 'Trình độ', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(31, 'Cao đẳng', 'cao-dang', 4, 'Trình độ', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(32, 'Trung cấp', 'trung-cap', 4, 'Trình độ', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(33, 'Cao học', 'cao-hoc', 4, 'Trình độ', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(34, 'Trung học', 'trung-hoc', 4, 'Trình độ', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(35, 'Chứng chỉ', 'chung-chi', 4, 'Trình độ', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(36, 'Lao động phổ thông', 'lao-dong-pho-thong', 4, 'Trình độ', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(37, 'Không yêu cầu', 'khong-yeu-cau', 4, 'Trình độ', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(38, 'Không yêu cầu', 'khong-yeu-cau', 5, 'Kinh nghiệm', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(39, '6 tháng', '6-thang', 5, 'Kinh nghiệm', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(40, '1 năm', '1-nam', 5, 'Kinh nghiệm', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(41, '2 năm', '2-nam', 5, 'Kinh nghiệm', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(42, '3 năm', '3-nam', 5, 'Kinh nghiệm', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(43, '4 năm', '4-nam', 5, 'Kinh nghiệm', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(44, '5 năm', '5-nam', 5, 'Kinh nghiệm', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(45, 'trên 5 năm', 'tren-5-nam', 5, 'Kinh nghiệm', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(46, 'Tiếng anh', 'tieng-anh', 6, 'Ngôn ngữ', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(47, 'Tiếng nhật', 'tieng-nhat', 6, 'Ngôn ngữ', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(48, 'Tiếng Hàn', 'tieng-han', 6, 'Ngôn ngữ', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(49, 'Tiếng Trung', 'tieng-trung', 6, 'Ngôn ngữ', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(50, 'Tiếng nga', 'tieng-nga', 6, 'Ngôn ngữ', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(51, 'Tiếng đức', 'tieng-duc', 6, 'Ngôn ngữ', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(52, 'Tiếng tây ban nhà', 'tieng-tay-ban-nha', 6, 'Ngôn ngữ', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(53, 'Thưởng', 'thuong', 7, 'Phúc lợi', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(54, 'Du lịch', 'du-lich', 7, 'Phúc lợi', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(55, 'Nghỉ phép', 'nghi-phep', 7, 'Phúc lợi', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(56, 'Đào tạo', 'dao-tao', 7, 'Phúc lợi', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(57, 'Khám sức khoẻ', 'kham-suc-khoe', 7, 'Phúc lợi', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(58, 'Thư viện', 'thu-vien', 7, 'Phúc lợi', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(59, 'Laptop', 'laptop', 7, 'Phúc lợi', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(60, 'Điện thoại', 'dien-thoai', 7, 'Phúc lợi', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(61, 'Hoạt động nhóm', 'hoat-dong-nhom', 7, 'Phúc lợi', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(62, 'Trợ cấp đi lại', 'tro-cap-di-lai', 7, 'Phúc lợi', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(63, 'Căng teen', 'cang-teen', 7, 'Phúc lợi', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(64, 'THưởng quà', 'thuong-qua', 7, 'Phúc lợi', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30'),
(65, 'Trông trẻ', 'trong-tre', 7, 'Phúc lợi', 0, 1, '2021-06-08 01:09:30', '2021-06-08 01:09:30');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attributes_slug_type_unique` (`slug`,`type`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
