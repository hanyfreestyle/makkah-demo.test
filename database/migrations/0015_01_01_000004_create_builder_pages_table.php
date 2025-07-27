<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  public function up(): void {

    Schema::create('builder_block_template', function (Blueprint $table) {
      $table->id();
      $table->string('slug')->nullable();
      $table->json('name');
      $table->string('type')->nullable();
      $table->string('template')->nullable();
      $table->string("photo")->nullable();
      $table->json('config')->nullable();
      $table->boolean("is_active")->default(true);

      $table->unique(['slug', 'type', 'template']);
    });

    Schema::create('builder_block', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('template_id')->unsigned();
      $table->json('name');
//      $table->string('type')->nullable();
      $table->string('slug')->unique()->nullable();
      $table->string("photo")->nullable();
      $table->string("photo_thumbnail")->nullable();
      $table->json('config')->nullable();
      $table->json('schema')->nullable();
      $table->boolean("is_active")->default(true);
      $table->foreign('template_id')->references('id')->on('builder_block_template')->onDelete('cascade');
    });


    Schema::create('builder_page', function (Blueprint $table) {
      $table->id();
      $table->integer('parent_id')->nullable();
      $table->json('name');
      $table->boolean('is_home')->default(false);
      $table->boolean('is_active')->default(true);
      $table->unsignedInteger('position')->default(0);
    });


    Schema::create('builder_page_pivot', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('block_id')->unsigned();
      $table->bigInteger('page_id')->unsigned();
      $table->unsignedInteger('position')->default(0);
      $table->boolean('is_active')->default(true);
      $table->foreign('block_id')->references('id')->on('builder_block')->onDelete('cascade');
      $table->foreign('page_id')->references('id')->on('builder_page')->onDelete('cascade');
      $table->timestamps();
    });

  }

  public function down(): void {
    Schema::dropIfExists('builder_page_pivot');
    Schema::dropIfExists('builder_page');
    Schema::dropIfExists('builder_block');
    Schema::dropIfExists('builder_block_template');
  }
};
