SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `config_def_photos` (`id`, `cat_id`, `photo`, `photo_thumbnail`, `position`, `created_at`, `updated_at`) VALUES
('1', 'logo_light', 'def-photo/2025-07/img-6880c2b6538fb.webp', NULL, '0', '2025-07-23 13:53:01', '2025-07-23 14:08:38'),
('2', 'logo_dark', 'def-photo/2025-07/img-6880c49e66df1.webp', NULL, '0', '2025-07-23 14:16:20', '2025-07-23 14:16:46');
COMMIT;
