SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `config_def_photos` (`id`, `cat_id`, `photo`, `photo_thumbnail`, `position`, `created_at`, `updated_at`) VALUES
('1', 'logo_light', 'def-photo/2025-07/img-6880c2b6538fb.webp', NULL, '0', '2025-07-24 16:53:01', '2025-07-24 17:08:38'),
('2', 'logo_dark', 'def-photo/2025-07/img-6880c49e66df1.webp', NULL, '0', '2025-07-24 17:16:20', '2025-07-24 17:16:46'),
('3', 'home_slider', 'def-photo/2025-07/img-6880c80d2c832.webp', NULL, '0', '2025-07-24 17:30:36', '2025-07-24 17:31:25'),
('4', 'err_404', 'def-photo/2025-07/img-6882303b44d62.webp', NULL, '0', '2025-07-25 16:07:47', '2025-07-25 16:08:11'),
('5', 'news_thumbnail', 'def-photo/2025-07/img-688267fb725e5.webp', NULL, '0', '2025-07-25 14:04:18', '2025-07-25 14:06:03'),
('6', 'news_photo', 'def-photo/2025-07/img-688484994b6bf.webp', NULL, '0', '2025-07-25 14:10:31', '2025-07-26 22:32:41');
COMMIT;
