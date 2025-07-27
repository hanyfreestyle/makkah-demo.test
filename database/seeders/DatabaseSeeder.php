<?php

namespace Database\Seeders;

use Database\Seeders\DefaultSeeder\ConfigDataSeeder;
use Database\Seeders\DefaultSeeder\UserSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder {
  public function run(): void {
    $this->call(UserSeeder::class);
    $this->call(ConfigDataSeeder::class);
    loadSeederFromFileWithLang('user_guide', true);
    loadSeederFromFileWithLang('user_guide_photo', true);
    loadSeederFromFileWithLang('latest_news', true);
    loadSeederFromFileWithLang('makkah_project', true);
    loadSeederFromFile('builder_block', true);
    loadSeederFromFile('builder_page', true);
    loadSeederFromFile('builder_page_pivot', true);


//      $titles = [
//        'ar' => [
//          'افتتاح مشروع كمبوند فاخر جديد في التجمع الخامس',
//          'زيادة الإقبال على الوحدات الإدارية بالتجمع الخامس',
//          'فرص استثمارية واعدة في قلب مدينة 6 أكتوبر',
//          'هبوط أسعار الأراضي في مناطق محددة من أكتوبر',
//          'إطلاق مشروع تجاري ضخم على محور 26 يوليو',
//          'نمو مستمر في سوق الشقق الفاخرة بالتجمع الخامس',
//          'توقعات بارتفاع أسعار العقارات في 6 أكتوبر خلال 2025',
//          'أفضل الكمبوندات للاستثمار العقاري في التجمع الخامس',
//          'الفرص الذهبية لشراء وحدات تجارية في أكتوبر الجديدة',
//          'توسعات عمرانية جديدة بالقرب من العاصمة الإدارية',
//          'افتتاح مول تجاري جديد في قلب التجمع الخامس',
//          'شراكات استراتيجية لتطوير مشروعات سكنية في 6 أكتوبر'
//        ],
//        'en' => [
//          'New Luxury Compound Launched in New Cairo – Fifth Settlement',
//          'Rising Demand for Administrative Units in Fifth Settlement',
//          'Promising Investment Opportunities in 6th of October City',
//          'Land Prices Drop in Selected Areas of October City',
//          'Massive Commercial Project Launched on July 26th Axis',
//          'Continuous Growth in Luxury Apartment Market in New Cairo',
//          'Property Prices in October City Expected to Rise by 2025',
//          'Top Compounds for Real Estate Investment in Fifth Settlement',
//          'Golden Opportunities for Buying Commercial Units in New October',
//          'Urban Expansion Near the New Administrative Capital',
//          'New Shopping Mall Opens in the Heart of Fifth Settlement',
//          'Strategic Partnerships to Develop Housing Projects in October City'
//        ],
//      ];
//
//      foreach (range(0, 11) as $i) {
//        $newsId = DB::table('latest_news')->insertGetId([
//          'has_en' => true,
//          'user_id' => null,
//          'photo' => null,
//          'photo_thumbnail' => null,
//          'is_active' => true,
//          'created_at' => now(),
//          'updated_at' => now(),
//        ]);
//
//        DB::table('latest_news_lang')->insert([
//          [
//            'news_id' => $newsId,
//            'locale' => 'ar',
//            'slug' => Url_Slug($titles['ar'][$i]),
//            'name' => $titles['ar'][$i],
//            'des' => 'تفاصيل الخبر: ' . $titles['ar'][$i],
//            'g_title' => $titles['ar'][$i],
//            'g_des' => 'وصف ميتا للخبر: ' . $titles['ar'][$i],
//          ],
//          [
//            'news_id' => $newsId,
//            'locale' => 'en',
//            'slug' => Url_Slug($titles['en'][$i]),
//            'name' => $titles['en'][$i],
//            'des' => 'Details of the news: ' . $titles['en'][$i],
//            'g_title' => $titles['en'][$i],
//            'g_des' => 'Meta description: ' . $titles['en'][$i],
//          ],
//        ]);
//      }

//    $titles = [
//      'ar' => [
//        'رواق الشيخ زايد',
//        'مشروعات أكتوبر',
//        'مشروعات الإسكندرية',
//
//      ],
//      'en' => [
//        'Rowaq Sheikh Zayed',
//        'October Projects',
//        'Alexandria Projects',
//      ],
//    ];
//
//    foreach (range(0, 2) as $i) {
//      $newsId = DB::table('makkah_project')->insertGetId([
//        'has_en' => true,
//        'user_id' => null,
//        'photo' => null,
//        'photo_thumbnail' => null,
//        'is_active' => true,
//        'created_at' => now(),
//        'updated_at' => now(),
//      ]);
//
//      DB::table('makkah_project_lang')->insert([
//        [
//          'project_id' => $newsId,
//          'locale' => 'ar',
//          'slug' => Url_Slug($titles['ar'][$i]),
//          'name' => $titles['ar'][$i],
//          'des' => $titles['ar'][$i],
//          'g_title' => $titles['ar'][$i],
//          'g_des' => $titles['ar'][$i],
//        ],
//        [
//          'project_id' => $newsId,
//          'locale' => 'en',
//          'slug' => Url_Slug($titles['en'][$i]),
//          'name' => $titles['en'][$i],
//          'des' => $titles['en'][$i],
//          'g_title' => $titles['en'][$i],
//          'g_des' => $titles['en'][$i],
//        ],
//      ]);
//    }

  }
}
