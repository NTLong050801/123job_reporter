-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th6 16, 2021 lúc 07:16 AM
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
-- Cấu trúc bảng cho bảng `careers`
--

CREATE TABLE `careers` (
  `id` int(10) UNSIGNED NOT NULL,
  `ca_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `ca_slug` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ca_hit_job` int(11) NOT NULL DEFAULT '0',
  `ca_status` int(11) NOT NULL DEFAULT '1',
  `ca_avatar` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ca_home` int(11) NOT NULL DEFAULT '0',
  `ca_icon` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ca_sitemap_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `careers`
--

INSERT INTO `careers` (`id`, `ca_name`, `ca_slug`, `ca_hit_job`, `ca_status`, `ca_avatar`, `ca_home`, `ca_icon`, `ca_sitemap_status`, `created_at`, `updated_at`) VALUES
(1, 'Bán hàng', 'ban-hang', 0, 1, '2018_04_22______eca9770022deb9d11b81e74658c13998.png', 1, NULL, 0, NULL, '2018-11-30 06:18:20'),
(2, 'Biên tập/ Báo chí/ Truyền hình', 'bien-tap-bao-chi-truyen-hinh', 0, 1, '2018_04_01______aab886e64ccf3b5522d96d6bff880960.jpg', 0, '', 0, NULL, '2018-11-30 06:18:20'),
(3, 'Bảo hiểm/ Tư vấn bảo hiểm', 'bao-hiem-tu-van-bao-hiem', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(4, 'Bảo vệ/ An ninh/ Vệ sỹ', 'bao-ve-an-ninh-ve-sy', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(5, 'Phiên dịch/ Ngoại ngữ', 'phien-dich-ngoai-ngu', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(6, 'Bưu chính', 'buu-chinh', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(7, 'Chứng khoán - Vàng', 'chung-khoan-vang', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(8, 'Cơ khí - Chế tạo', 'co-khi-che-tao', 0, 1, '2018_04_22______4228de9c71ffc869e8b99bd99ff35116.png', 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(9, 'Công chức - Viên chức', 'cong-chuc-vien-chuc', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(10, 'Công nghệ cao', 'cong-nghe-cao', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(11, 'Công nghiệp', 'cong-nghiep', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(12, 'Dầu khí - Hóa chất', 'dau-khi-hoa-chat', 0, 1, '2018_04_22______3273ac0032f84e8390a2e1c182e0a25e.png', 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(13, 'Dệt may - Da giày', 'det-may-da-giay', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(14, 'Dịch vụ', 'dich-vu', 0, 1, '2018_04_22______37ca63c0d18611c66f926bacc17cb76a.png', 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(15, 'Du lịch', 'du-lich', 0, 1, '2018_04_22______ef2c10d96af49e0a822560c7dd16ae76.png', 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(16, 'Đầu tư', 'dau-tu', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(17, 'Điện - Điện tử - Điện lạnh', 'dien-dien-tu-dien-lanh', 0, 1, '2018_04_22______1f15031ae01eb7a2fa0547dec4fde570.png', 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(18, 'Điện tử viễn thông', 'dien-tu-vien-thong', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(19, 'Freelance', 'freelance', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(20, 'Games', 'games', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(21, 'Giáo dục - Đào tạo', 'giao-duc-dao-tao', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(22, 'Giao nhận/ Vận chuyển/ Kho bãi', 'giao-nhan-van-chuyen-kho-bai', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(23, 'Hàng gia dụng', 'hang-gia-dung', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(24, 'Hàng hải', 'hang-hai', 0, 1, '2018_04_19______feaa5174c14051a7f2b4c788f369aeb0.jpg', 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(25, 'Hàng không', 'hang-khong', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(26, 'Hành chính - Văn phòng', 'hanh-chinh-van-phong', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(27, 'Hóa học - Sinh học', 'hoa-hoc-sinh-hoc', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(28, 'Hoạch định - Dự án', 'hoach-dinh-du-an', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(29, 'IT phần cứng/mạng', 'it-phan-cung-mang', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(30, 'IT phần mềm', 'it-phan-mem', 0, 1, '2018_04_22______6c39ecb98e5ed95ed2e5d326cd034e93.png', 1, NULL, 0, NULL, '2018-11-30 06:18:20'),
(31, 'In ấn - Xuất bản', 'in-an-xuat-ban', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(32, 'Kế toán - Kiểm toán', 'ke-toan-kiem-toan', 0, 1, '2018_04_22______783d7c39565b14bf0b0eb434231cf15b.png', 1, NULL, 0, NULL, '2018-11-30 06:18:20'),
(33, 'Khách sạn - Nhà hàng', 'khach-san-nha-hang', 0, 1, '2018_04_22______44c39aff58c68f72a112f318d8e14ed9.png', 1, NULL, 0, NULL, '2018-11-30 06:18:20'),
(34, 'Kiến trúc - Thiết kế nội thất', 'kien-truc-thiet-ke-noi-that', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(35, 'Bất động sản', 'bat-dong-san', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(36, 'Kỹ thuật', 'ky-thuat', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(37, 'Kỹ thuật ứng dụng', 'ky-thuat-ung-dung', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(38, 'Làm bán thời gian', 'lam-ban-thoi-gian', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(39, 'Làm đẹp/ Thể lực/ Spa', 'lam-dep-the-luc-spa', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(40, 'Lao động phổ thông', 'lao-dong-pho-thong', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(41, 'Lương cao', 'luong-cao', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(42, 'Marketing - PR', 'marketing-pr', 0, 1, '2018_04_22______f76d4563655e4e2b3be49dd62c299519.png', 1, NULL, 0, NULL, '2018-11-30 06:18:20'),
(43, 'Môi trường', 'moi-truong', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(44, 'Mỹ phẩm - Trang sức', 'my-pham-trang-suc', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(45, 'Phi chính phủ/ Phi lợi nhuận', 'phi-chinh-phu-phi-loi-nhuan', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(46, 'Ngân hàng/ Tài Chính', 'ngan-hang-tai-chinh', 0, 1, '2018_04_22______0dbf45b41fe9689a38df9e870f3f10ad.png', 1, NULL, 0, NULL, '2018-11-30 06:18:20'),
(47, 'Ngành nghề khác', 'nganh-nghe-khac', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(48, 'Nghệ thuật - Điện ảnh', 'nghe-thuat-dien-anh', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(49, 'Người giúp việc/ Phục vụ/ Tạp vụ', 'nguoi-giup-viec-phuc-vu-tap-vu', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(50, 'Nhân sự', 'nhan-su', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(51, 'Nhân viên kinh doanh', 'nhan-vien-kinh-doanh', 0, 1, '2018_04_22______dbfa77abffafa9506c5526611fcef3c4.png', 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(52, 'Nông - Lâm - Ngư nghiệp', 'nong-lam-ngu-nghiep', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(53, 'Ô tô - Xe máy', 'o-to-xe-may', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:20'),
(54, 'Pháp luật/ Pháp lý', 'phap-luat-phap-ly', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(55, 'Phát triển thị trường', 'phat-trien-thi-truong', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(56, 'Promotion Girl/ Boy (PG-PB)', 'promotion-girl-boy-pg-pb', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(57, 'QA-QC/ Thẩm định/ Giám định', 'qa-qc-tham-dinh-giam-dinh', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(58, 'Quan hệ đối ngoại', 'quan-he-doi-ngoai', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(59, 'Quản trị kinh doanh', 'quan-tri-kinh-doanh', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(60, 'Sinh viên làm thêm', 'sinh-vien-lam-them', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(61, 'Startup', 'startup', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(62, 'Thể dục/ Thể thao', 'the-duc-the-thao', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(63, 'Thiết kế - Mỹ thuật', 'thiet-ke-my-thuat', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(64, 'Thiết kế đồ họa - Web', 'thiet-ke-do-hoa-web', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(65, 'Thời trang', 'thoi-trang', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(66, 'Thủ công mỹ nghệ', 'thu-cong-my-nghe', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(67, 'Thư ký - Trợ lý', 'thu-ky-tro-ly', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(68, 'Thực phẩm - Đồ uống', 'thuc-pham-do-uong', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(69, 'Thực tập', 'thuc-tap', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(70, 'Thương mại điện tử', 'thuong-mai-dien-tu', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(71, 'Tiếp thị - Quảng cáo', 'tiep-thi-quang-cao', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(72, 'Tổ chức sự kiện - Quà tặng', 'to-chuc-su-kien-qua-tang', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(73, 'Tư vấn/ Chăm sóc khách hàng', 'tu-van-cham-soc-khach-hang', 0, 1, '2018_04_22______5e83476b829c9395360cd64c04f82395.png', 1, NULL, 0, NULL, '2018-11-30 06:18:21'),
(74, 'Vận tải - Lái xe/ Tài xế', 'van-tai-lai-xe-tai-xe', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(75, 'Nhân viên trông quán internet', 'nhan-vien-trong-quan-internet', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(76, 'Vật tư/Thiết bị/Mua hàng', 'vat-tu-thiet-bi-mua-hang', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(77, 'Việc làm cấp cao', 'viec-lam-cap-cao', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(78, 'Việc làm Tết', 'viec-lam-tet', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(79, 'Xây dựng', 'xay-dung', 0, 1, '2018_04_22______c2d46bd1dcda134dfa370e54614e4502.png', 1, NULL, 0, NULL, '2018-11-30 06:18:21'),
(80, 'Xuất - Nhập khẩu', 'xuat-nhap-khau', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(81, 'Xuất khẩu lao động', 'xuat-khau-lao-dong', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(82, 'Y tế - Dược', 'y-te-duoc', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(83, 'Trắc Địa / Địa Chất', 'trac-dia-dia-chat', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(84, 'Người Nước Ngoài/Việt Kiều', 'nguoi-nuoc-ngoai-viet-kieu', 0, 1, NULL, 0, NULL, 0, NULL, '2018-11-30 06:18:21'),
(85, 'Biên dịch/Phiên dịch', 'bien-dich-phien-dich', 0, 1, NULL, 0, NULL, 0, '2018-07-31 07:22:17', '2018-11-30 06:18:21'),
(86, 'Tài xế/Lái xe/Giao nhận', 'tai-xe-lai-xe-giao-nhan', 0, 1, NULL, 0, NULL, 0, '2018-07-31 07:22:22', '2018-11-30 06:18:21'),
(87, 'Giáo dục/Đào tạo/Thư viện', 'giao-duc-dao-tao-thu-vien', 0, 1, NULL, 0, NULL, 0, '2018-07-31 07:22:23', '2018-11-30 06:18:21');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `careers_ca_name_unique` (`ca_name`),
  ADD KEY `careers_ca_slug_index` (`ca_slug`),
  ADD KEY `careers_ca_home_index` (`ca_home`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `careers`
--
ALTER TABLE `careers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
