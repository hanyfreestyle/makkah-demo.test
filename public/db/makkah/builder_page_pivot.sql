SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `builder_page_pivot` (`id`, `block_id`, `page_id`, `position`, `is_active`, `created_at`, `updated_at`) VALUES
('1', '1', '1', '4', '1', NULL, NULL),
('2', '2', '1', '1', '1', NULL, NULL),
('3', '4', '1', '5', '1', NULL, NULL),
('5', '6', '1', '6', '1', NULL, NULL),
('6', '8', '1', '2', '1', NULL, NULL),
('7', '6', '2', '6', '1', NULL, NULL),
('8', '9', '2', '4', '1', NULL, NULL),
('9', '10', '2', '5', '1', NULL, NULL),
('10', '11', '2', '2', '1', NULL, NULL),
('11', '12', '2', '3', '1', NULL, NULL),
('12', '13', '2', '1', '1', NULL, NULL),
('13', '5', '3', '0', '1', NULL, NULL);
COMMIT;
