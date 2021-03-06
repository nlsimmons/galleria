<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Image;

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
            $table->unsignedBigInteger('owner_id');
            $table->string('hash')->unique();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('location')->nullable(); // Coordinates stored as a string
            $table->boolean('hidden')->default(false);
            $table->timestamps();

            $table->foreign('owner_id')
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
        array_map(
            'unlink',
            glob(storage_path('app/public/images/*'))
        );

        Schema::dropIfExists('images');
    }
}
