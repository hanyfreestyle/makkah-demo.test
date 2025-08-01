SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `builder_block_template` (`id`, `slug`, `name`, `type`, `template`, `photo`, `config`, `is_active`) VALUES
('1', 'counter-1', '{\"ar\":\"\\u0639\\u062f\\u062f \\u0645\\u0639 \\u0627\\u064a\\u0643\\u0648\\u0646 \",\"en\":\"Counter 1\"}', 'counter', 'makkah', 'builder-template/2025-07/img-68863a8f0329a.webp', NULL, '1'),
('2', 'hero-1', '{\"ar\":\"\\u0647\\u064a\\u0631\\u0648 1\",\"en\":\"Hero 1\"}', 'hero', 'makkah', 'builder-template/2025-07/img-68863acc2ceb6.webp', NULL, '1'),
('4', 'hero-2', '{\"ar\":\"\\u0647\\u064a\\u0631\\u0648 2\",\"en\":\"Hero 2\"}', 'hero', 'makkah', NULL, NULL, '1'),
('5', 'cursor-news-1', '{\"ar\":\"\\u0633\\u0644\\u064a\\u062f\\u064a\\u0631 \\u0627\\u062e\\u0631 \\u0627\\u0644\\u0627\\u062e\\u0628\\u0627\\u0631\",\"en\":\"Cursor News\"}', 'cursor', 'makkah', 'builder-template/2025-07/img-68863bc02c1cf.webp', NULL, '1'),
('6', 'cursor-project-1', '{\"ar\":\"\\u0633\\u0644\\u064a\\u062f\\u064a\\u0631 \\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u064a\\u0639 \\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\\u0629\",\"en\":\"Cursor  Project\"}', 'cursor', 'makkah', 'builder-template/2025-07/img-6887b78110f7b.webp', NULL, '1'),
('7', 'cta-1', '{\"ar\":\"\\u0643\\u0648\\u0644 \\u062a\\u0648 \\u0627\\u0643\\u0634\\u0646 \",\"en\":\"Call To Action\"}', 'cta', 'makkah', 'builder-template/2025-07/img-6889d199c5aab.webp', NULL, '1'),
('8', 'gallery-1', '{\"ar\":\"\\u0627\\u0644\\u0628\\u0648\\u0645 \\u0635\\u0648\\u0631 1\",\"en\":\" \\u0627\\u0644\\u0628\\u0648\\u0645 \\u0635\\u0648\\u0631 1\"}', 'gallery', 'makkah', NULL, NULL, '1'),
('9', 'cursor-project-2', '{\"ar\":\"\\u0633\\u0644\\u064a\\u062f\\u064a\\u0631 \\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u064a\\u0639 2\",\"en\":\"\\u0633\\u0644\\u064a\\u062f\\u064a\\u0631 \\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u064a\\u0639 2\"}', 'cursor', 'makkah', 'builder-template/2025-07/img-688b2cca911c2.webp', NULL, '1'),
('10', 'cursor-project-3', '{\"ar\":\"\\u0633\\u0644\\u064a\\u062f\\u064a\\u0631 \\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u064a\\u0639 3\",\"en\":\"Project Slider 3\"}', 'cursor', 'makkah', 'builder-template/2025-07/img-688b41a45c995.webp', NULL, '1'),
('11', 'cursor-project-4', '{\"ar\":\"\\u0633\\u0644\\u064a\\u062f\\u064a\\u0631 \\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u064a\\u0639 4\",\"en\":\"\\u0633\\u0644\\u064a\\u062f\\u064a\\u0631 \\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u064a\\u0639 4\"}', 'cursor', 'makkah', 'builder-template/2025-07/img-688b41daea378.webp', NULL, '1'),
('12', 'text-block-1', '{\"ar\":\"\\u0646\\u0635 1\",\"en\":\"Text 1\"}', 'text', 'makkah', 'builder-template/2025-07/img-688b428c4517f.webp', NULL, '1'),
('13', 'text-block-2', '{\"ar\":\"\\u0646\\u0635 2\",\"en\":\"Text 2\"}', 'text', 'makkah', 'builder-template/2025-07/img-688b42b47b7fc.webp', NULL, '1'),
('14', 'amenities-1', '{\"ar\":\"\\u0627\\u0644\\u062e\\u0635\\u0627\\u0626\\u0635 1\",\"en\":\"Amenities 1 \"}', 'amenities', 'makkah', 'builder-template/2025-07/img-688b440c0bcc3.webp', NULL, '1');
COMMIT;
