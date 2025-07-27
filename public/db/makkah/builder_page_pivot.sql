SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `builder_page_pivot` (`id`, `block_id`, `page_id`, `position`, `created_at`, `updated_at`) VALUES
('1', '1', '1', '0', NULL, NULL),
('3', '2', '1', '0', NULL, NULL);
COMMIT;
