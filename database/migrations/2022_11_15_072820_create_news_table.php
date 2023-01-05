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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->string('slug');
            $table->longText('description');
            $table->boolean('is_published')->default(true);
            $table->boolean('is_trending_news')->default(false);
            $table->string('featured_image_name')->nullable(true);
            $table->unsignedBigInteger('author_id')->nullable(true);
            $table->foreign('author_id')->references('id')->on('users')->onDelete('SET NULL');
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
        Schema::dropIfExists('news');
    }
};
