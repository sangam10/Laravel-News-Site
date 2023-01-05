<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable(true);
            $table->unsignedBigInteger('news_id')->nullable(true);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('news_id')->references('id')->on('news')->onDelete('SET NULL');
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
        Schema::dropIfExists('category_news');
    }
};
