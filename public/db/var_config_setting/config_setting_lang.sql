SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `config_setting_lang` (`id`, `setting_id`, `locale`, `name`, `closed_mass`, `footer_text`, `meta_des`, `whatsapp_des`, `schema_address`, `schema_city`) VALUES
('1', '1', 'ar', 'موقع عقارات مصر', 'عذرا جارى اجراء بعض التحديثات 
سنعود قريبا', 'ريال إستيت.إيجي هو السوق العقاري الأول في مصر، حيث يربط بين المشترين والبائعين والمستأجرين ويوفر لهم أفضل العقارات في جميع أنحاء البلاد.', 'اريد الاستفسار عن ..', 'اريد الاستفسار عن ..', '123 مجمع الأعمال الجديد بالقاهرة الجديدة، التجمع الخامس، القاهرة الجديدة، مصر', 'القاهرة الجديدة'),
('2', '1', 'en', 'Real Estate Egypt', 'Sorry, some updates are being made
We will be back soon', 'RealEstate.eg is Egypt\'s premier real estate marketplace, connecting buyers, sellers, and renters with the best properties across the country.', 'اريد الاستفسار عن ..', 'I want to inquire about..', '123 New Cairo Business Park, Fifth Settlement, New Cairo, Egypt', 'New Cairo');
COMMIT;
