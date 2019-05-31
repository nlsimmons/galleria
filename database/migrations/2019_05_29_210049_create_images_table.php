<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('owner');
            $table->string('url');
            $table->string('display_url');
            $table->string('thumbnail_url');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('location')->nullable(); // Coordinates stored as a string
            $table->boolean('hidden')->default(false);
            $table->timestamps();

            $table->foreign('owner')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
