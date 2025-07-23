<?php

namespace App\Traits\Admin\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

trait DataSoftMigrationsTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function SetTableName($name,$funType="up") {
        if ($funType == 'up') {
            Schema::create("$name", function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->uuid()->nullable()->unique();
                $table->integer('old_id')->nullable();
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->json('name');
                $table->json('des')->nullable();
                $table->integer('deep')->default(0);
                $table->string("icon")->nullable();
                $table->boolean("is_active")->default(true);
                $table->boolean("is_archive")->default(false);
                $table->integer('position')->default(0);
            });

        } elseif ($funType == 'down') {
            Schema::dropIfExists("$name");
        }
    }

}
