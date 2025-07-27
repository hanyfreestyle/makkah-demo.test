SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `builder_block_template` (`id`, `name`, `type`, `template`, `photo`, `config`, `is_active`) VALUES
('1', '{\"ar\":\"\\u0647\\u064a\\u0631\\u0648 1\",\"en\":\"Hero 1\"}', 'counter', 'makkah', 'builder-template/2025-07/img-6886094c365b5.webp', NULL, '1'),
('2', '{\"ar\":\"\\u0647\\u064a\\u0631\\u0648 2\",\"en\":\"Hero 2\"}', 'hero', 'makkah', NULL, NULL, '1');
COMMIT;
