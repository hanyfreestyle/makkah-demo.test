SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `config_setting` (`id`, `web_url`, `web_status`, `web_status_date`, `switch_lang`, `lang`, `users_login`, `users_register`, `users_forget_password`, `phone_num`, `whatsapp_num`, `phone_call`, `whatsapp_send`, `email`, `def_url`, `google_map_url`, `google_map_embed`, `social`, `schema`) VALUES
('1', 'https://makkah.com', '1', NULL, '1', 'ar', '0', '0', '0', '0120-7777-483', '0128-4486-263', '01207777483', '201284486263', 'info@makkah.com', NULL, 'https://maps.app.goo.gl/d5ZLvHk8BfLWEtxB9', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3456.7475454951627!2d30.9230558!3d29.95793939999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14585752d27c61cd%3A0x1dc970e0e372287f!2zTWFra2FoIERldmVsb3BtZW50cyAtINmF2YPYqSDZhNmE2KrYt9mI2YrYsSDYp9mE2LnZgtin2LHZig!5e0!3m2!1sen!2seg!4v1753518283401!5m2!1sen!2seg', '{\"facebook\":\"https:\\/\\/www.facebook.com\\/makkah.developmets\",\"twitter\":\"https:\\/\\/www.twitter.com\",\"youtube\":\"https:\\/\\/www.youtube.com\",\"instagram\":\"https:\\/\\/instagram.com\\/makkah.developments\",\"linkedin\":\"https:\\/\\/www.linkedin.com\"}', '{\"type\":\"website\",\"country\":\"eg\",\"lat\":\"1.2222\",\"long\":\"2.222\",\"postal_code\":\"21111\"}');
COMMIT;
