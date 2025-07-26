<?php

namespace App\Models\Builder;

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

class BuilderPage extends Model {
  use ClearsCacheOnChange;


  protected $table = "builder_pages";
  protected $primaryKey = 'id';
  public $timestamps = false;


  protected $fillable = ['name'];

  protected $casts = [
    'name' => 'array',

  ];

  protected static function booted() {
    self::bootClearsCacheOnChange();
  }

  public function cacheKeys(): array {
    return [
      'DataCampaign_CashList_all_',
      'DataCampaign_CashList_only_active_',
    ];
  }




}
