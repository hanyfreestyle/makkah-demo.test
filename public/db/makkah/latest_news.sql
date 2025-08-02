SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `latest_news` (`id`, `has_en`, `user_id`, `photo`, `photo_thumbnail`, `published_at`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
('1', NULL, NULL, 'latest-news/2025-07/img-6889e38864a35.webp', 'latest-news/2025-07/img-6889e38864a35_thumb.webp', '2022-09-15', '1', NULL, '2025-07-31 11:32:49', '2025-07-31 06:19:04'),
('2', NULL, NULL, 'latest-news/2025-07/img-6889e72491ab9.webp', 'latest-news/2025-07/img-6889e72491ab9_thumb.webp', '2021-01-12', '1', NULL, '2025-07-31 05:53:01', '2025-07-31 06:34:29'),
('3', NULL, NULL, 'latest-news/2025-07/img-6889e5f0505d3.webp', 'latest-news/2025-07/img-6889e5f0505d3_thumb.webp', '2024-05-14', '1', NULL, '2025-07-31 05:58:07', '2025-07-31 06:29:20'),
('4', NULL, NULL, 'latest-news/2025-07/img-6889e805f3e98.webp', 'latest-news/2025-07/img-6889e805f3e98_thumb.webp', '2025-03-21', '1', NULL, '2025-07-31 06:01:22', '2025-07-31 06:38:15'),
('5', NULL, NULL, 'latest-news/2025-07/img-6889e907a5f36.webp', 'latest-news/2025-07/img-6889e907a5f36_thumb.webp', '2025-07-19', '1', NULL, '2025-07-31 06:03:34', '2025-07-31 06:42:33');
COMMIT;
