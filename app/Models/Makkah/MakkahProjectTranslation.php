<?php

namespace App\Models\Makkah;

use Illuminate\Database\Eloquent\Model;

class MakkahProjectTranslation extends Model {
    protected $table = "makkah_project_lang";
    protected $fillable = ['project_id', 'locale', 'slug', 'name', 'des', 'g_title', 'g_des'];
    public $timestamps = false;

}


