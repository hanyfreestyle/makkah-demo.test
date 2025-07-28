SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `builder_page_pivot` (`id`, `block_id`, `page_id`, `position`, `is_active`, `created_at`, `updated_at`) VALUES
('1', '1', '1', '3', '1', NULL, NULL),
('2', '2', '1', '1', '1', NULL, NULL),
('3', '4', '1', '4', '1', NULL, NULL),
('4', '5', '1', '2', '1', NULL, NULL);
COMMIT;
