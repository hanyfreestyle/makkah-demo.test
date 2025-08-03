SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `makkah_project` (`id`, `has_en`, `user_id`, `photo`, `photo_thumbnail`, `video`, `is_active`, `builder_page_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
('1', '1', NULL, 'project/2025-07/img-688a6152879e7.webp', 'project/2025-07/img-688a6152879e7_thumb.webp', NULL, '1', NULL, NULL, '2025-07-28 21:20:46', '2025-07-31 16:11:57'),
('2', '1', NULL, 'project/2025-07/img-688a5e6f371c4.webp', 'project/2025-07/img-688a5e6f371c4_thumb.webp', NULL, '1', '3', NULL, '2025-07-28 21:20:46', '2025-08-02 17:57:13'),
('3', '1', NULL, 'project/2025-07/img-688a655255144.webp', 'project/2025-07/img-688a655255144_thumb.webp', 'C2LutvE6YEo', '1', NULL, NULL, '2025-07-28 21:20:46', '2025-08-02 18:36:02');
COMMIT;
