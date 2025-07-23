<?php
return [
//    'navigation_group' => '🛠️ '. 'ادارة اعدادات الموقع',
    'navigation_group' =>  'ادارة اعدادات الموقع',
    'web' => [
        'NavigationLabel' => 'أعدادات الموقع',
        'ModelLabel' => 'أعدادات الموقع',
        'PluralModelLabel' => 'أعدادات الموقع',
        'section' => [
            'setting' => 'الإعدادات العامة',
            'phones' => 'أرقام التواصل',
            'social' => 'مواقع التواصل الاجتماعي',
        ],

        'columns' => [
            'name' => 'الاسم',
            'closed_mass' => 'رسالة الإغلاق',
            'footer_text' => 'نص الفوتر',
            'meta_des' => 'إضافة إلى عنوان الصفحة',
            'whatsapp_des' => 'رسالة الواتساب الافتراضية',

            'web_status' => 'حالة الموقع',
            'web_status_date' => 'تاريخ الإطلاق',
            'switch_lang' => 'السماح بتبديل اللغة',
            'lang' => 'اللغة الافتراضية',
            'users_login' => 'تسجيل دخول المستخدمين',
            'users_register' => 'تسجيل عضوية جديدة',
            'users_forget_password' => 'استعادة كلمة المرور',

            'phone_num' => 'رقم الهاتف',
            'phone_call' => 'رقم الاتصال',
            'whatsapp_num' => 'رقم الواتساب',
            'whatsapp_send' => 'رقم إرسال الواتساب',
            'web_url' => 'رابط الموقع',
            'email' => 'البريد الإلكتروني',

            'facebook' => 'فيسبوك',
            'youtube' => 'يوتيوب',
            'twitter' => 'تويتر',
            'instagram' => 'إنستغرام',
            'linkedin' => 'لينكدإن',
            'google_api' => 'مفتاح Google API',

            'telegram_send' => 'إرسال تيليجرام',
            'telegram_phone' => 'هاتف تيليجرام',
            'telegram_group' => 'مجموعة تيليجرام',

            'schema_type' => 'نوع Schema',
            'schema_address' => 'العنوان',
            'schema_city' => 'المدينة',
            'schema_lat' => 'خط العرض',
            'schema_long' => 'خط الطول',
            'schema_postal_code' => 'الرمز البريدي',
            'schema_country' => 'الدولة',
        ],

        'req' => [
            'required_if' => 'من فضلك أدخل تاريخ الاطلاق',
            'after_or_equal' => 'تاريخ الاطلاق يجب أن يكون بعد تاريخ اليوم.',
        ],
    ],
];
