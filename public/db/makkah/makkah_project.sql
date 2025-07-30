SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `makkah_project` (`id`, `has_en`, `user_id`, `photo`, `photo_thumbnail`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
('1', '1', NULL, 'project/2025-07/img-6883a4d5f1001.webp', 'project/2025-07/img-6883a4d5f1001_thumb.webp', '1', NULL, '2025-07-28 00:20:46', '2025-07-30 15:54:38'),
('2', '1', NULL, 'project/2025-07/img-6883a500d2c69.webp', 'project/2025-07/img-6883a500d2c69_thumb.webp', '1', NULL, '2025-07-28 00:20:46', '2025-07-30 15:53:09'),
('3', '1', NULL, 'project/2025-07/img-6883a51f551c8.webp', 'project/2025-07/img-6883a51f551c8_thumb.webp', '1', NULL, '2025-07-28 00:20:46', '2025-07-30 15:52:02');
COMMIT;
