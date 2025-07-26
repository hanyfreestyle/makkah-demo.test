<?php

namespace App\Models\Builder;

use App\Traits\Admin\Model\ClearsCacheOnChange;
use Illuminate\Database\Eloquent\Model;

class BuilderBlocks extends Model {
  use ClearsCacheOnChange;

  protected $table = "builder_blocks";
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['name', 'type', 'slug', 'settings', 'is_active'];

  protected $casts = [
    'name' => 'array',
  ];

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
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
