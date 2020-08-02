<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorizingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorizing', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('category_id')->nullable(false)->comment('カテゴリID');
            $table->unsignedInteger('thread_id')->nullable(false)->comment('スレッドID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorizing');
    }
}
