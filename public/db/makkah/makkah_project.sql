SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `makkah_project` (`id`, `has_en`, `user_id`, `photo`, `photo_thumbnail`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
('1', '1', NULL, 'project/2025-07/img-688a6152879e7.webp', 'project/2025-07/img-688a6152879e7_thumb.webp', '1', NULL, '2025-07-28 00:20:46', '2025-07-30 21:44:47'),
('2', '1', NULL, 'project/2025-07/img-688a5e6f371c4.webp', 'project/2025-07/img-688a5e6f371c4_thumb.webp', '1', NULL, '2025-07-28 00:20:46', '2025-07-30 21:03:27'),
('3', '1', NULL, 'project/2025-07/img-688a655255144.webp', 'project/2025-07/img-688a655255144_thumb.webp', '1', NULL, '2025-07-28 00:20:46', '2025-07-30 21:32:51');
COMMIT;
