SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `builder_page_pivot` (`id`, `block_id`, `page_id`, `position`, `is_active`, `created_at`, `updated_at`) VALUES
('7', '1', '1', '0', '1', NULL, NULL),
('8', '2', '1', '0', '1', NULL, NULL);
COMMIT;
