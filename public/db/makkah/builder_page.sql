SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `builder_page` (`id`, `parent_id`, `name`, `is_home`, `is_active`, `position`) VALUES
('1', NULL, '{\"ar\":\"\\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\\u0629\",\"en\":\"Home Page\"}', '0', '1', '0'),
('2', NULL, '{\"ar\":\"\\u0635\\u0641\\u062d\\u0629 \\u0645\\u0646 \\u0646\\u062d\\u0646\",\"en\":\"About Us Page\"}', '0', '1', '0'),
('3', NULL, '{\"ar\":\"\\u0645\\u0634\\u0631\\u0648\\u0639\\u0627\\u062a 6 \\u0627\\u0643\\u062a\\u0648\\u0628\\u0631 \",\"en\":\"\\u0645\\u0634\\u0631\\u0648\\u0639\\u0627\\u062a 6 \\u0627\\u0643\\u062a\\u0648\\u0628\\u0631 \"}', '0', '1', '0');
COMMIT;
