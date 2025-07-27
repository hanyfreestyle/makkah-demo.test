SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `builder_block` (`id`, `name`, `type`, `slug`, `photo`, `photo_thumbnail`, `config`, `schema`, `is_active`) VALUES
('1', '{\"ar\":\"\\u0647\\u064a\\u0631\\u0648\\u0627 1\",\"en\":\"asdasdas\"}', NULL, 'dddd-kjklj-lk', NULL, NULL, NULL, '{\"items\":[{\"number\":\"3434534\",\"icon\":\"345345\",\"label\":{\"ar\":\"34534534\",\"en\":\"345345\"}}]}', '1'),
('2', '{\"ar\":\"\\u0643\\u0648\\u0646\\u062a\\u0631 \\u0645\\u062a\\u0643\\u0631\\u0631\",\"en\":\"About Us\"}', NULL, 'asdasda-sadasd', NULL, NULL, NULL, '{\"items\":[{\"number\":\"999\",\"icon\":\"999\",\"label\":{\"ar\":\"999\",\"en\":\"99\"}}]}', '1');
COMMIT;
