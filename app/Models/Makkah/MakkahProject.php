<?php

namespace App\Models\Makkah;

use App\Traits\Admin\Model\ClearsCacheOnChange;
use App\Traits\Admin\Model\WithModelEvents;
use App\Traits\Admin\Query\TranslatableScopes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MakkahProject extends Model implements TranslatableContract {
  use Translatable;
  use TranslatableScopes;
  use WithModelEvents;
  use ClearsCacheOnChange;
  use SoftDeletes;

  protected $table = "makkah_project";
  protected $primaryKey = 'id';
  protected $translationForeignKey = 'project_id';
  public $translationModel = MakkahProjectTranslation::class;
  public array $translatedAttributes = ['project_id', 'locale', 'slug', 'name', 'des', 'short', 'g_title', 'g_des'];
  protected $fillable = ['has_en', 'user_id', 'photo', 'photo_thumbnail', 'video', 'builder_page_id', 'is_active'];

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//  protected static function booted() {
//    static::bootWithModelEvents();
//  }

  public function getSlugAttribute($value) {
    // لو المشروع id = 3 نرجع #
    if ($this->id == 3) {
      return '#';
    }

    return $value;
  }

  protected static function booted() {
    self::bootClearsCacheOnChange();
  }

  public function cacheKeys(): array {
    return [
      'ProjectMenu_CashList_',
    ];
  }


}
