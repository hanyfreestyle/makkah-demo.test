<?php

namespace App\Models\Builder;

use App\Traits\Admin\Model\ClearsCacheOnChange;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BuilderBlockTemplate extends Model {
  use ClearsCacheOnChange;

//  use WithModelEvents;


  protected $table = "builder_block_template";
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['name', 'slug', 'type', 'template', 'photo', 'config', 'is_active'];

  protected $casts = [
    'name' => 'array',
    'config' => 'array',
  ];

  public function getDisplayNameAttribute(): string {
    return $this->name[app()->getLocale()] ?? reset($this->name);
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  protected static function booted() {
    self::bootClearsCacheOnChange();
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function cacheKeys(): array {
    return [
      'key',
    ];
  }

  public function blocks(): HasMany {
    return $this->hasMany(BuilderBlock::class, 'template_id');
  }


}
