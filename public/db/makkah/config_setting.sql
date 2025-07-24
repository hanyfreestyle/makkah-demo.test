SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `config_setting` (`id`, `web_url`, `web_status`, `web_status_date`, `switch_lang`, `lang`, `users_login`, `users_register`, `users_forget_password`, `phone_num`, `whatsapp_num`, `phone_call`, `whatsapp_send`, `email`, `def_url`, `google_map_url`, `social`, `schema`) VALUES
('1', 'https://makkah.com', '1', NULL, '1', 'ar', '0', '0', '0', '0120-7777-483', '0128-4486-263', '01207777483', '201284486263', 'info@makkah.com', NULL, 'https://maps.app.goo.gl/d5ZLvHk8BfLWEtxB9', '{\"facebook\":\"https:\\/\\/www.facebook.com\\/makkah.developmets\",\"twitter\":\"https:\\/\\/www.twitter.com\",\"youtube\":\"https:\\/\\/www.youtube.com\",\"instagram\":\"https:\\/\\/instagram.com\\/makkah.developments\",\"linkedin\":\"https:\\/\\/www.linkedin.com\"}', '{\"type\":\"website\",\"country\":\"eg\",\"lat\":\"1.2222\",\"long\":\"2.222\",\"postal_code\":\"21111\"}');
COMMIT;
