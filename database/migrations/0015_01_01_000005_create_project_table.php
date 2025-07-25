<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  public function up(): void {

    Schema::create('makkah_project', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->boolean("has_en")->nullable();
      $table->integer("user_id")->nullable();

      $table->string("photo")->nullable();
      $table->string("photo_thumbnail")->nullable();

      $table->boolean("is_active")->default(true);
      $table->softDeletes();
      $table->timestamps();
    });

    Schema::create('makkah_project_lang', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->bigInteger('project_id')->unsigned();
      $table->string('locale')->index();
      $table->string('slug')->index();
      $table->string('name')->nullable();
      $table->longText('des')->nullable();
      $table->string('g_title')->nullable();
      $table->text('g_des')->nullable();
      $table->unique(['project_id', 'locale']);
      $table->unique(['slug', 'locale']);
      $table->foreign('project_id')->references('id')->on('makkah_project')->onDelete('cascade');
    });

  }

  public function down(): void {
    Schema::dropIfExists('makkah_project_lang');
    Schema::dropIfExists('makkah_project');
  }
};
