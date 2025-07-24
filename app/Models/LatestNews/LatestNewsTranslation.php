<?php

namespace App\Models\LatestNews;

use Illuminate\Database\Eloquent\Model;

class LatestNewsTranslation extends Model {
    protected $table = "latest_news_lang";
    protected $fillable = ['news_id', 'locale', 'slug', 'name', 'des', 'g_title', 'g_des'];
    public $timestamps = false;

}


