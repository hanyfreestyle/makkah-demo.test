<?php

namespace App\Models\Builder;

use App\Traits\Admin\Model\ClearsCacheOnChange;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BuilderPage extends Model {
  use ClearsCacheOnChange;

  protected $table = "builder_page";
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
      'key',
    ];
  }

  public function blocks(): BelongsToMany {
    return $this->belongsToMany(BuilderBlock::class, 'builder_page_pivot', 'page_id', 'block_id')
      ->withPivot(['position', 'is_active'])
      ->orderBy('builder_page_pivot.position');
  }

//  public function blocks(): BelongsToMany
//  {
//    return $this->belongsToMany(BuilderBlock::class, 'builder_page_pivot', 'page_id', 'block_id');
//  }


}
