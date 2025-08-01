SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `config_setting_lang` (`id`, `setting_id`, `locale`, `name`, `closed_mass`, `footer_text`, `meta_des`, `whatsapp_des`, `schema_address`, `schema_city`) VALUES
('1', '1', 'ar', 'مكة للتطوير العقاري', 'عذرا جارى اجراء بعض التحديثات 
سنعود قريبا', 'مكة للتطوير العقاري، شركة رائدة في مجال التنمية العمرانية بخبرة دامت 35 حيث قدمت اسلوب حياة عصري و مريح يجمع بين الجودة و الراحة و التصميم المبتكر،', 'مكة للتطوير العقارى', 'اريد الاستفسار عن ..', '281 المحور المركزي - الحي الرابع ', 'مدينة ٦ اكتوبر'),
('2', '1', 'en', 'Makkah Developments', 'Sorry, some updates are being made
We will be back soon', 'Makkah Real Estate Development is a leading company in the field of urban development, with 35 years of experience. It has introduced a modern and comfortable lifestyle that combines quality, comfort, and innovative design.', 'Makkah For Real Estate Development', 'I want to inquire about..', '281 Central Axis – 4th District', '6th of October City');
COMMIT;
