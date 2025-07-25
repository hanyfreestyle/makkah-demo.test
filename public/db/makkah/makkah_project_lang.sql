SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `makkah_project_lang` (`id`, `project_id`, `locale`, `slug`, `name`, `des`, `g_title`, `g_des`) VALUES
('1', '1', 'ar', 'رواق-الشيخ-زايد', 'رواق الشيخ زايد', 'رواق الشيخ زايد', 'رواق الشيخ زايد', 'رواق الشيخ زايد'),
('2', '1', 'en', 'rowaq-sheikh-zayed', 'Rowaq Sheikh Zayed', 'Rowaq Sheikh Zayed', 'Rowaq Sheikh Zayed', 'Rowaq Sheikh Zayed'),
('3', '2', 'ar', 'مشروعات-أكتوبر', 'مشروعات أكتوبر', 'مشروعات أكتوبر', 'مشروعات أكتوبر', 'مشروعات أكتوبر'),
('4', '2', 'en', 'october-projects', 'October Projects', 'October Projects', 'October Projects', 'October Projects'),
('5', '3', 'ar', 'مشروعات-الإسكندرية', 'مشروعات الإسكندرية', 'مشروعات الإسكندرية', 'مشروعات الإسكندرية', 'مشروعات الإسكندرية'),
('6', '3', 'en', 'alexandria-projects', 'Alexandria Projects', 'Alexandria Projects', 'Alexandria Projects', 'Alexandria Projects');
COMMIT;
