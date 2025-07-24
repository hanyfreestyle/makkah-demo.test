<?php

namespace App\Models\LatestNews;

use App\Traits\Admin\Model\WithModelEvents;
use App\Traits\Admin\Query\TranslatableScopes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LatestNews extends Model implements TranslatableContract {
  use Translatable;
  use TranslatableScopes;
  use WithModelEvents;
  use SoftDeletes;

  protected $table = "latest_news";
  protected $primaryKey = 'id';
  protected $translationForeignKey = 'news_id';
  public $translationModel = LatestNewsTranslation::class;
  public array $translatedAttributes = ['news_id', 'locale', 'slug', 'name', 'des', 'g_title', 'g_des'];
  protected $fillable = ['has_en', 'user_id', 'photo', 'photo_thumbnail', 'is_active'];

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  protected static function booted() {
    static::bootWithModelEvents();
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getCacheKey(): string {
    return "LatestNews_CashList_";
  }


}
