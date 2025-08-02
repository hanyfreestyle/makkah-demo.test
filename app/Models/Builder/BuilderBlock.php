<?php

namespace App\Models\Builder;


use App\Traits\Admin\Model\ClearsCacheOnChange;
use App\Traits\Admin\Model\WithModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BuilderBlock extends Model {
  use WithModelEvents;
  use ClearsCacheOnChange;

  protected $table = "builder_block";
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['name', 'template_id', 'photo', 'photo_thumbnail', 'config', 'schema', 'is_active'];
//  protected $fillable = ['name', 'type', 'slug', 'photo', 'photo_thumbnail', 'config', 'schema', 'is_active'];
  protected $casts = [
    'name' => 'array',
    'config' => 'array',
    'schema' => 'array',
  ];

  public function getDisplayNameAttribute(): string {
    return $this->name[app()->getLocale()] ?? reset($this->name);
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  protected static function booted() {
    self::bootClearsCacheOnChange();
  }

  public static function getGalleryRelation(): string {
    return 'photos';
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

  public function template(): belongsTo {
    return $this->belongsTo(BuilderBlockTemplate::class, 'template_id');
  }

  public function photos(): HasMany {
    return $this->hasMany(BuilderBlockPhoto::class, 'block_id')->orderBy('position');
  }

}
