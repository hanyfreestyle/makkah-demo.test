SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `makkah_project_lang` (`id`, `project_id`, `locale`, `slug`, `name`, `des`, `g_title`, `g_des`) VALUES
('1', '1', 'ar', 'رواق-الشيخ-زايد', 'رواق الشيخ زايد', '<p class=\"project-description\">مشروع معماري متطور يجمع بين التصميم العصري والطابع الأصيل، يوفر مساحات سكنية وتجارية متكاملة في قلب المدينة</p>

<div class=\"project-features\">
<div class=\"features-grid\">
<div class=\"feature-item\"><i class=\"fas fa-building\"></i> <span>تصميم معماري مبتكر</span></div>

<div class=\"feature-item\"><i class=\"fas fa-tree\"></i> <span>مساحات خضراء واسعة</span></div>

<div class=\"feature-item\"><i class=\"fas fa-swimming-pool\"></i> <span>مرافق ترفيهية متكاملة</span></div>

<div class=\"feature-item\"><i class=\"fas fa-shield-alt\"></i> <span>أنظمة أمان متطورة</span></div>
</div>
</div>
', 'رواق الشيخ زايد', 'مشروع معماري متطور يجمع بين التصميم العصري والطابع الأصيل، يوفر مساحات سكنية وتجارية متكاملة في قلب المدينة'),
('2', '1', 'en', 'rowaq-sheikh-zayed', 'Rowaq Sheikh Zayed', '<p class=\"project-description\">A modern architectural project that blends contemporary design with authentic character, offering integrated residential and commercial spaces in the heart of the city.</p>

<div class=\"project-features\">
<div class=\"features-grid\">
<div class=\"feature-item\"><i class=\"fas fa-building\"></i> <span>Innovative Architectural Design</span></div>

<div class=\"feature-item\"><i class=\"fas fa-tree\"></i> <span>Expansive Green Areas</span></div>

<div class=\"feature-item\"><i class=\"fas fa-swimming-pool\"></i> <span>Comprehensive Recreational Facilities</span></div>

<div class=\"feature-item\"><i class=\"fas fa-shield-alt\"></i> <span>Advanced Security Systems</span></div>
</div>
</div>
', 'Rowaq Sheikh Zayed | A modern architectural project that blends contemporary design with authentic character', 'A modern architectural project that blends contemporary design with authentic character, offering integrated residential and commercial spaces in the heart of the city.'),
('3', '2', 'ar', 'مشروعات-أكتوبر', 'مشروعات أكتوبر', '<p class=\"project-description\">مجموعة مشاريع سكنية وإدارية في منطقة 6 أكتوبر الحيوية، تتميز بالموقع الاستراتيجي والخدمات المتطورة</p>

<div class=\"project-features\">
<div class=\"features-grid\">
<div class=\"feature-item\"><i class=\"fas fa-map-marker-alt\"></i> <span>موقع استراتيجي مميز</span></div>

<div class=\"feature-item\"><i class=\"fas fa-bus\"></i> <span>شبكة مواصلات متطورة</span></div>

<div class=\"feature-item\"><i class=\"fas fa-shopping-cart\"></i> <span>مراكز تجارية قريبة</span></div>

<div class=\"feature-item\"><i class=\"fas fa-gamepad\"></i> <span>مناطق ترفيهية متنوعة</span></div>
</div>
</div>
', 'مشروعات أكتوبر', 'مشروعات أكتوبر'),
('4', '2', 'en', 'october-projects', 'October Projects', '<p class=\"project-description\">A collection of residential and administrative projects in the vibrant 6th of October area, featuring a strategic location and advanced services.</p>

<div class=\"project-features\">
<div class=\"features-grid\">
<div class=\"feature-item\"><i class=\"fas fa-map-marker-alt\"></i> <span>Prime Strategic Location</span></div>

<div class=\"feature-item\"><i class=\"fas fa-bus\"></i> <span>Advanced Transportation Network</span></div>

<div class=\"feature-item\"><i class=\"fas fa-shopping-cart\"></i> <span>Nearby Shopping Centers</span></div>

<div class=\"feature-item\"><i class=\"fas fa-gamepad\"></i> <span>Diverse Entertainment Areas</span></div>
</div>
</div>
', 'October Projects  | projects in the vibrant 6th of October area,', 'A collection of residential and administrative projects in the vibrant 6th of October area, featuring a strategic location and advanced services.'),
('5', '3', 'ar', 'مشروعات-الإسكندرية', 'مشروعات الإسكندرية', '<p class=\"project-description\">مشاريع ساحلية مميزة تطل على البحر المتوسط، تجمع بين الرفاهية والطبيعة الخلابة في عروس البحر المتوسط</p>

<div class=\"project-features\">
<div class=\"features-grid\">
<div class=\"feature-item\"><i class=\"fas fa-water\"></i> <span>إطلالة بحرية ساحرة</span></div>

<div class=\"feature-item\"><i class=\"fas fa-sun\"></i> <span>مناخ معتدل طوال العام</span></div>

<div class=\"feature-item\"><i class=\"fas fa-landmark\"></i> <span>قرب من المعالم التاريخية</span></div>

<div class=\"feature-item\"><i class=\"fas fa-umbrella-beach\"></i> <span>شواطئ خاصة مجهزة</span></div>
</div>
</div>
', 'مشروعات الإسكندرية | مشاريع ساحلية مميزة في عروس البحر المتوسط', 'مشاريع ساحلية مميزة تطل على البحر المتوسط، تجمع بين الرفاهية والطبيعة الخلابة في عروس البحر المتوسط'),
('6', '3', 'en', 'alexandria-projects', 'Alexandria Projects', '<p class=\"project-description\">Exceptional coastal projects overlooking the Mediterranean Sea, combining luxury with the breathtaking beauty of the Bride of the Mediterranean.</p>

<div class=\"project-features\">
<div class=\"features-grid\">
<div class=\"feature-item\"><i class=\"fas fa-water\"></i> <span>Stunning Sea View</span></div>

<div class=\"feature-item\"><i class=\"fas fa-sun\"></i> <span>Mild Climate All Year Round</span></div>

<div class=\"feature-item\"><i class=\"fas fa-landmark\"></i> <span>Close to Historical Landmarks</span></div>

<div class=\"feature-item\"><i class=\"fas fa-umbrella-beach\"></i> <span>Equipped Private Beaches</span></div>
</div>
</div>
', 'Alexandria Projects', 'Exceptional coastal projects overlooking the Mediterranean Sea, combining luxury with the breathtaking beauty of the Bride of the Mediterranean.');
COMMIT;
