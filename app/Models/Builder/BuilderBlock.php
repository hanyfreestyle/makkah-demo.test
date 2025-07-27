<?php

namespace App\Models\Builder;

use App\Traits\Admin\Model\ClearsCacheOnChange;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BuilderBlock extends Model {
  use ClearsCacheOnChange;

  protected $table = "builder_block";
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['name', 'type', 'slug', 'photo', 'photo_thumbnail', 'config', 'schema', 'is_active'];
  protected $casts = [
    'name' => 'array',
    'config' => 'array',
    'schema' => 'array',
  ];

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  protected static function booted() {
    self::bootClearsCacheOnChange();
  }


  public function cacheKeys(): array {
    return [
      'key',
    ];
  }

  public function pages(): BelongsToMany {
    return $this->belongsToMany(BuilderPage::class, 'builder_page_pivot', 'block_id', 'page_id')
      ->withPivot('position');
  }

}
