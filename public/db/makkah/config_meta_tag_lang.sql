SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `config_meta_tag_lang` (`id`, `meta_tag_id`, `locale`, `name`, `des`, `g_title`, `g_des`) VALUES
('1', '1', 'ar', 'الصفحة الرئيسية', 'الصفحة الرئيسية', 'الرئيسية | [WebSiteName]', 'الرئيسية | [WebSiteName]'),
('2', '1', 'en', 'Home Page', 'Home Page', 'Home Page | [WebSiteName]', 'Home Page | [WebSiteName]'),
('3', '2', 'ar', 'من نحن', 'نقدم تجربة تعليمية ممتعة ومبتكرة تشمل اختبارات تفاعلية، تقارير أداء دقيقة، وخطط تعليمية مخصصة لتحفيز الطلاب على تحقيق أهدافهم الأكاديمية.', 'من نحن | [WebSiteName]', 'من نحن | [WebSiteName]'),
('4', '2', 'en', 'About Us', 'We provide an engaging and innovative learning experience with interactive quizzes, detailed performance reports, and personalized plans to inspire students', 'About Us | [WebSiteName]', 'About Us | [WebSiteName]'),
('5', '3', 'ar', 'سياسية الاستخدام', 'وضح سياسة الاستخدام الشروط التي تحكم استخدامك لخدماتنا. هدفنا ضمان تجربة آمنة ومنظمة للجميع. باستخدامك الموقع، فإنك توافق على هذه الشروط.', 'سياسية الاستخدام | [WebSiteName]', 'سياسية الاستخدام | [WebSiteName]'),
('6', '3', 'en', 'Terms & Conditions', 'Our Terms of Use define the conditions for using our services. We aim to provide a safe and organized experience. By using the site, you agree to these terms', 'Terms & Conditions | [WebSiteName]', 'Terms & Conditions | [WebSiteName]'),
('7', '4', 'ar', 'خطاء 404', NULL, 'عذرًا !! الصفحة التي تبحث عنها غير موجودة.', 'عذرًا !! الصفحة التي تبحث عنها غير موجودة.'),
('8', '4', 'en', 'Error 404', NULL, 'Oops !! Page Not Found', 'Oops !! Page Not Found'),
('9', '5', 'ar', 'اتصل بنا', NULL, 'اتصل بنا | [WebSiteName]', 'اتصل بنا | [WebSiteName]'),
('10', '5', 'en', 'Contact Us', NULL, 'Contact Us | [WebSiteName]', 'Contact Us | [WebSiteName]'),
('11', '6', 'ar', 'اخر الاخبار', 'اختر الخطة التي تناسب احتياجاتك التعليمية واستفد من مجموعة متنوعة من الخدمات المصممة لتحسين تجربة التعلم وتطوير مهاراتك بسهولة وفعالية.', 'اخر الاخبار  | [WebSiteName]', 'تابع أحدث أخبار الاستثمار العقاري في مصر، مع تغطية حصرية للمشروعات الجديدة، وتحليلات السوق العقاري في التجمع الخامس ومدينة 6 أكتوبر.'),
('12', '6', 'en', 'Latest News', 'Choose the plan that suits your educational needs and enjoy a variety of services designed to enhance your learning experience and develop your skills efficiently', 'Latest News | [WebSiteName]', 'Stay updated with the latest real estate news in Egypt, including exclusive coverage of new projects and market analysis in Fifth Settlement and 6th October.'),
('13', '7', 'ar', 'المشاريع', 'نقدم مواد دراسية أساسية مصممة بعناية لتعزيز المعرفة الأكاديمية وبناء أساس قوي للتعلم. نركز على توفير تجربة', 'المشاريع  | [WebSiteName]', 'تتميز مشاريعنا العقارية بالتنوع والابتكار، وتشمل وحدات سكنية وتجارية في مواقع استراتيجية مثل أكتوبر والتجمع، بجودة عالية وتصميمات عصرية.'),
('14', '7', 'en', 'Our Projects', 'We provide carefully designed core subjects to enhance academic knowledge and build a strong learning', 'Our Projects| [WebSiteName]', 'We deliver exceptional real estate projects with modern designs and strategic locations, meeting client aspirations with top quality and comfort.

'),
('15', '8', 'ar', 'الفصول الدراسية', NULL, 'الفصول الدراسية', 'الفصول الدراسية'),
('16', '8', 'en', 'Classes', NULL, 'Classes', 'Classes');
COMMIT;
