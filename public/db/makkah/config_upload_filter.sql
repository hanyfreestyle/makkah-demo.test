SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `config_upload_filter` (`id`, `name`, `type`, `convert_state`, `quality_val`, `width`, `height`, `canvas_back`, `crop_aspect_ratio`, `greyscale`, `flip_state`, `flip_v`, `blur`, `blur_size`, `pixelate`, `pixelate_size`, `text_state`, `text_print`, `font_size`, `font_path`, `font_color`, `font_opacity`, `text_position`, `watermark_state`, `watermark_img`, `watermark_position`, `state`, `notes`, `is_notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
('1', 'NoEdit', '1', '1', '85', '100', '100', '#ffffff', '16:9', '0', '0', '0', '0', '0', '0', '5', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '0', '{\"ar\":null,\"en\":null}', '1', '2023-10-18 22:42:57', '2025-07-26 16:57:22', NULL),
('2', 'DefPhoto', '4', '1', '85', '800', '420', '#ffffff', '16:9', '0', '0', '0', '0', '0', '0', '5', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '0', NULL, '1', '2023-10-18 22:42:57', '2025-04-06 01:47:09', NULL),
('3', 'Profile', '4', '1', '99', '400', '400', '#FFFFFF', '1:1', '1', '1', '0', '0', '5', '0', '12', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '0', NULL, '1', '2024-11-27 22:39:25', '2025-04-07 02:03:12', NULL),
('4', 'الاخبار', '4', '1', '85', '820', '400', '#FFFFFF', '16:9', '0', '0', '0', '0', '0', '0', '5', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '0', '{\"ar\":null,\"en\":null}', '1', '2025-01-15 13:45:44', '2025-07-28 09:34:42', NULL),
('5', 'المشروعات', '2', '1', '85', '1600', '450', '#FFFFFF', NULL, '0', '0', '0', '0', '0', '0', '5', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '0', '{\"ar\":null,\"en\":null}', '1', '2025-01-15 14:14:03', '2025-07-31 21:11:39', NULL);
COMMIT;
