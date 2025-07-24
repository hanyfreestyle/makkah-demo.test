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

//      $titles = [
//        'ar' => [
//          'إطلاق مشروع سكني فاخر جديد في القاهرة الجديدة',
//          'ارتفاع الطلب على الوحدات التجارية في دبي',
//          'فرص استثمارية عقارية في العاصمة الإدارية',
//          'انخفاض أسعار العقارات في بعض مناطق الرياض',
//          'توقعات بانتعاش السوق العقاري في أبوظبي',
//          'إطلاق منصة رقمية لشراء العقارات في السعودية',
//          'مشروع منتجع سياحي فاخر يفتتح قريبًا في الساحل الشمالي',
//          'نمو مستمر في سوق العقارات الفاخرة بدبي',
//          'أهم النصائح قبل شراء عقار للاستثمار',
//          'المناطق الأكثر جذبًا للمستثمرين العقاريين في 2025',
//          'مؤتمر عقاري عالمي ينطلق الشهر القادم في الرياض',
//          'شراكة جديدة لتطوير مشاريع عقارية ذكية'
//        ],
//        'en' => [
//          'New Luxury Residential Project Launched in New Cairo',
//          'Rising Demand for Commercial Units in Dubai',
//          'Real Estate Investment Opportunities in the New Capital',
//          'Property Prices Decline in Some Areas of Riyadh',
//          'Real Estate Market Expected to Recover in Abu Dhabi',
//          'New Digital Platform Launched for Property Buying in KSA',
//          'Luxury Resort Project to Open Soon in North Coast',
//          'Luxury Real Estate Market Continues to Grow in Dubai',
//          'Top Tips Before Buying Property for Investment',
//          'Top Locations Attracting Real Estate Investors in 2025',
//          'Global Real Estate Conference to Launch Next Month in Riyadh',
//          'New Partnership to Develop Smart Property Projects'
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

  }
}
