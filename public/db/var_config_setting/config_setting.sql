SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `config_setting` (`id`, `web_url`, `web_status`, `web_status_date`, `switch_lang`, `lang`, `users_login`, `users_register`, `users_forget_password`, `phone_num`, `whatsapp_num`, `phone_call`, `whatsapp_send`, `email`, `def_url`, `social`, `schema`) VALUES
('1', 'https://realestate.eg', '0', '2025-07-01', '1', 'ar', '0', '0', '0', '0100-9808-986', '0100-9808-986', '01009808986', '201009808986', 'info@realestate.eg', NULL, '{\"facebook\":\"https:\\/\\/www.facebook.com\",\"twitter\":\"https:\\/\\/www.twitter.com\",\"youtube\":\"https:\\/\\/www.youtube.com\",\"instagram\":\"https:\\/\\/www.Instagram.com\",\"linkedin\":\"https:\\/\\/www.linkedin.com\"}', '{\"type\":\"website\",\"country\":\"eg\",\"lat\":\"1.2222\",\"long\":\"2.222\",\"postal_code\":\"21111\"}');
COMMIT;
