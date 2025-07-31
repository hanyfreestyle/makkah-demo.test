SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `config_upload_filter_sizes` (`id`, `filter_id`, `type`, `width`, `height`, `canvas_back`, `text_state`, `watermark_state`) VALUES
('1', '2', '4', '500', '335', '#ffffff', '0', '0'),
('2', '3', '4', '200', '200', '#FFFFFF', '0', '0'),
('3', '4', '4', '450', '310', '#FFFFFF', '0', '0'),
('4', '5', '2', '900', '450', '#FFFFFF', '0', '0');
COMMIT;
