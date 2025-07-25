<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  public function up(): void {

    Schema::create('latest_news', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->boolean("has_en")->nullable();
      $table->integer("user_id")->nullable();

      $table->string("photo")->nullable();
      $table->string("photo_thumbnail")->nullable();

      $table->boolean("is_active")->default(true);
      $table->softDeletes();
      $table->timestamps();
    });

    Schema::create('latest_news_lang', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->bigInteger('news_id')->unsigned();
      $table->string('locale')->index();
      $table->string('slug')->index();
      $table->string('name')->nullable();
      $table->longText('des')->nullable();
      $table->string('g_title')->nullable();
      $table->text('g_des')->nullable();
      $table->unique(['news_id', 'locale']);
      $table->unique(['slug', 'locale']);
      $table->foreign('news_id')->references('id')->on('latest_news')->onDelete('cascade');
    });

  }

  public function down(): void {
    Schema::dropIfExists('latest_news_lang');
    Schema::dropIfExists('latest_news');
  }
};
