<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  public function up(): void {

    Schema::create('builder_blocks', function (Blueprint $table) {
      $table->id();
      $table->json('name');
      $table->string('type')->nullable();
      $table->string('slug')->unique()->nullable();
      $table->json('settings')->nullable();
      $table->boolean("is_active")->default(true);
    });


    Schema::create('builder_pages', function (Blueprint $table) {
      $table->id();
      $table->integer('parent_id')->nullable();
      $table->json('name');
      $table->boolean('is_home')->default(false);
      $table->boolean('is_active')->default(true);
      $table->unsignedInteger('position')->default(0);
    });


    Schema::create('builder_block_page', function (Blueprint $table) {
      $table->id();
      $table->foreignId('builder_block_id')->constrained()->cascadeOnDelete();
      $table->foreignId('builder_page_id')->constrained()->cascadeOnDelete();
      $table->unsignedInteger('position')->default(0);
      $table->timestamps();
    });

  }

  public function down(): void {
    Schema::dropIfExists('builder_block_page');
    Schema::dropIfExists('builder_pages');
    Schema::dropIfExists('builder_blocks');
  }
};
