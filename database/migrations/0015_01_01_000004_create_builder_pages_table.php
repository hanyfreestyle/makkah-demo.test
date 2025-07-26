<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  public function up(): void {

    Schema::create('builder_pages', function (Blueprint $table) {
      $table->id();
      $table->json('name');
      $table->boolean("is_active")->default(true);
    });

    Schema::create('builder_blocks', function (Blueprint $table) {
      $table->id();
      $table->json('name');
      $table->string('type');
      $table->string('slug')->unique();
      $table->json('settings');
      $table->boolean("is_active")->default(true);
    });

    Schema::create('builder_pages_blocks', function (Blueprint $table) {
      $table->id();
      $table->foreignId('page_id')->constrained('builder_pages')->onDelete('cascade');
      $table->foreignId('block_id')->constrained('builder_blocks')->onDelete('cascade');
      $table->integer('position')->default(0);
    });


  }

  public function down(): void {
    Schema::dropIfExists('builder_pages_blocks');
    Schema::dropIfExists('builder_blocks');
    Schema::dropIfExists('builder_pages');
  }
};
