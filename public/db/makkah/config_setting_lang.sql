SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `config_setting_lang` (`id`, `setting_id`, `locale`, `name`, `closed_mass`, `footer_text`, `meta_des`, `whatsapp_des`, `schema_address`, `schema_city`) VALUES
('1', '1', 'ar', 'مكة للتطوير العقارى', 'عذرا جارى اجراء بعض التحديثات 
سنعود قريبا', 'مكة للتطوير العقارى شركة رائدة في مجال الاستثمار والتطوير العقاري منذ أكثر من 30 عامًا، نقدم حلولًا عقارية مبتكرة تجمع بين الجودة والمصداقية، ونسعى دائمًا لبناء مجتمعات متكاملة تلبي احتياجات عملائنا وتفوق توقعاتهم.', 'اريد الاستفسار عن ..', 'اريد الاستفسار عن ..', '281 المحور المركزي - الحي الرابع ', 'مدينة ٦ اكتوبر'),
('2', '1', 'en', 'Makkah For Real Estate Development', 'Sorry, some updates are being made
We will be back soon', 'Makkah for Real Estate Development has been a leader in property investment and development for over 30 years, delivering quality-driven solutions and building integrated communities that exceed expectations.', 'اريد الاستفسار عن ..', 'I want to inquire about..', '281 Central Axis – 4th District', '6th of October City');
COMMIT;
