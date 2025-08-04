SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `config_meta_tag` (`id`, `cat_id`, `photo`, `photo_thumbnail`, `is_active`, `builder_page_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('1', 'home', NULL, NULL, '1', '1', '2023-08-19 21:18:40', '2025-08-01 04:39:43', NULL),
('2', 'about_us', NULL, NULL, '1', '2', '2023-08-19 23:16:16', '2025-08-01 05:12:16', NULL),
('3', 'trems', NULL, NULL, '1', NULL, '2023-10-31 16:05:33', '2024-04-13 07:26:17', NULL),
('4', 'err_404', NULL, NULL, '1', NULL, '2024-01-27 21:35:18', '2024-01-27 21:35:18', NULL),
('5', 'contact_us', NULL, NULL, '1', NULL, '2025-01-07 12:59:26', '2025-01-07 12:59:26', NULL),
('6', 'latest_news', NULL, NULL, '1', NULL, '2025-01-14 20:32:00', '2025-07-28 04:16:10', NULL),
('7', 'our_project', NULL, NULL, '1', NULL, '2025-01-15 16:48:24', '2025-07-28 07:09:03', NULL);
COMMIT;
