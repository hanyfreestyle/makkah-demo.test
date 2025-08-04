SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `config_def_photos` (`id`, `cat_id`, `photo`, `photo_thumbnail`, `position`, `created_at`, `updated_at`) VALUES
('1', 'logo_light', 'def-photo/2025-07/img-6889bddc5f38f.webp', NULL, '0', '2025-07-26 16:53:01', '2025-07-31 18:38:20'),
('2', 'logo_dark', 'def-photo/2025-07/img-6889be442b135.webp', NULL, '0', '2025-07-26 17:16:20', '2025-07-31 18:40:04'),
('4', 'err_404', 'def-photo/2025-07/img-6882303b44d62.webp', NULL, '0', '2025-07-27 16:07:47', '2025-07-27 16:08:11'),
('5', 'news_thumbnail', 'def-photo/2025-07/img-6889c175a521b.webp', NULL, '0', '2025-07-27 14:04:18', '2025-07-31 18:53:41'),
('6', 'news_photo', 'def-photo/2025-07/img-6889c24aefda5.webp', NULL, '0', '2025-07-27 14:10:31', '2025-07-31 18:57:15');
COMMIT;
