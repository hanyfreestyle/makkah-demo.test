<?php

namespace App\Models\Builder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class BuilderBlockPhoto extends Model {


  protected $table = "builder_block_photos";
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['block_id', 'photo', 'photo_thumbnail', 'is_active', 'position'];


  protected static function booted() {
    static::deleting(function ($photo) {
      if ($photo->photo) {
        Storage::disk('root_folder')->delete($photo->photo);
      }
      if ($photo->photo_thumbnail) {
        Storage::disk('root_folder')->delete($photo->photo_thumbnail);
      }
    });
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function block(): BelongsTo {
    return $this->belongsTo(BuilderBlock::class, "block_id");
  }


}
