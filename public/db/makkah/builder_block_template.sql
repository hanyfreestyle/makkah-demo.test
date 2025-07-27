SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `builder_block_template` (`id`, `slug`, `name`, `type`, `template`, `photo`, `config`, `is_active`) VALUES
('1', 'counter-1', '{\"ar\":\"\\u0639\\u062f\\u062f \\u0645\\u0639 \\u0627\\u064a\\u0643\\u0648\\u0646 \",\"en\":\"Counter 1\"}', 'counter', 'makkah', 'builder-template/2025-07/img-68863a8f0329a.webp', NULL, '1'),
('2', 'hero-1', '{\"ar\":\"\\u0647\\u064a\\u0631\\u0648 1\",\"en\":\"Hero 1\"}', 'hero', 'makkah', 'builder-template/2025-07/img-68863acc2ceb6.webp', NULL, '1'),
('4', 'hero-2', '{\"ar\":\"\\u0647\\u064a\\u0631\\u0648 2\",\"en\":\"Hero 2\"}', 'hero', 'makkah', NULL, NULL, '1'),
('5', 'cursor-news', '{\"ar\":\"\\u0633\\u0644\\u064a\\u062f\\u064a\\u0631 \\u0627\\u062e\\u0631 \\u0627\\u0644\\u0627\\u062e\\u0628\\u0627\\u0631\",\"en\":\"Cursor News\"}', 'cursor', 'makkah', 'builder-template/2025-07/img-68863bc02c1cf.webp', NULL, '1');
COMMIT;
