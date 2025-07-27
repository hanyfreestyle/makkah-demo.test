SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `config_meta_tag` (`id`, `cat_id`, `photo`, `photo_thumbnail`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
('1', 'home', NULL, NULL, '1', '2023-08-18 00:18:40', '2023-08-18 00:18:40', NULL),
('2', 'about', NULL, NULL, '1', '2023-08-18 02:16:16', '2024-04-12 01:29:43', NULL),
('3', 'trems', NULL, NULL, '1', '2023-10-30 10:05:33', '2024-04-12 01:26:17', NULL),
('4', 'err_404', NULL, NULL, '1', '2024-01-26 15:35:18', '2024-01-26 15:35:18', NULL),
('5', 'contact_us', NULL, NULL, '1', '2025-01-06 06:59:26', '2025-01-06 06:59:26', NULL),
('6', 'latest_news', NULL, NULL, '1', '2025-01-13 14:32:00', '2025-07-26 07:16:10', NULL),
('7', 'our_project', NULL, NULL, '1', '2025-01-14 10:48:24', '2025-07-26 10:09:03', NULL),
('8', 'clasess_list', NULL, NULL, '1', '2025-01-14 11:37:33', '2025-01-14 11:37:33', NULL);
COMMIT;
