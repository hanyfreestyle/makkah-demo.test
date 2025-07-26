SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `config_upload_filter` (`id`, `name`, `type`, `convert_state`, `quality_val`, `width`, `height`, `canvas_back`, `crop_aspect_ratio`, `greyscale`, `flip_state`, `flip_v`, `blur`, `blur_size`, `pixelate`, `pixelate_size`, `text_state`, `text_print`, `font_size`, `font_path`, `font_color`, `font_opacity`, `text_position`, `watermark_state`, `watermark_img`, `watermark_position`, `state`, `notes`, `is_notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
('1', 'NoEdit', '1', '1', '85', '100', '100', '#ffffff', '16:9', '0', '0', '0', '0', '0', '0', '5', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '0', '{\"ar\":null,\"en\":null}', '1', '2023-10-16 13:42:57', '2025-07-24 07:57:22', NULL),
('2', 'DefPhoto', '4', '1', '85', '800', '420', '#ffffff', '16:9', '0', '0', '0', '0', '0', '0', '5', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '0', NULL, '1', '2023-10-16 13:42:57', '2025-04-04 11:47:09', NULL),
('3', 'Profile', '4', '1', '99', '400', '400', '#FFFFFF', '1:1', '1', '1', '0', '0', '5', '0', '12', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '0', NULL, '1', '2024-11-26 08:39:25', '2025-04-05 12:03:12', NULL),
('4', 'الاخبار', '4', '1', '85', '820', '400', '#FFFFFF', '16:9', '0', '0', '0', '0', '0', '0', '5', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '0', '{\"ar\":null,\"en\":null}', '1', '2025-01-13 23:45:44', '2025-07-26 00:34:42', NULL),
('5', 'المشروعات', '4', '1', '85', '588', '450', '#FFFFFF', NULL, '0', '0', '0', '0', '0', '0', '5', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '0', '{\"ar\":null,\"en\":null}', '1', '2025-01-14 00:14:03', '2025-07-25 21:36:51', NULL),
('6', 'icon-128-64', '4', '1', '85', '128', '128', '#FFFFFF', NULL, '0', '0', '0', '0', '0', '0', '5', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '0', NULL, '1', '2025-01-14 00:14:34', '2025-01-14 00:14:34', NULL),
('7', 'icon-64-32', '4', '1', '85', '64', '64', '#FFFFFF', NULL, '0', '0', '0', '0', '0', '0', '5', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '0', NULL, '1', '2025-01-14 00:14:53', '2025-01-14 00:14:53', NULL),
('8', 'card-800-600', '4', '1', '85', '800', '600', '#FFFFFF', NULL, '0', '0', '0', '0', '0', '0', '5', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '0', NULL, '1', '2025-01-14 00:24:15', '2025-01-14 00:44:19', NULL),
('9', 'تجربة ملونة', '5', '1', '85', '900', '600', '#850c0c', '16:9', '0', '0', '0', '0', '0', '0', '5', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '0', NULL, '1', '2025-04-04 11:49:51', '2025-04-04 11:50:14', NULL);
COMMIT;
