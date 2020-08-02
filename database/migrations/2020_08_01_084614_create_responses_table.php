<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('thread_id')->nullable(false)->comment('レスが付けられたスレッドID');
            $table->string('submitter_name')->nullable(true)->comment('レスの投稿者名(空の場合、デフォルト名が表示される。)');
            $table->string('content', 3000)->nullable(false)->comment('レスの内容');
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
        Schema::dropIfExists('responses');
    }
}
