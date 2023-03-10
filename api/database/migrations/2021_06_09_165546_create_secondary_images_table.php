<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondaryImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secondary_images', function (Blueprint $table) {
            $table->id();
            $table->string("image");
            $table->unsignedBigInteger("product_id");
            $table->timestamps();

            $table->foreign("product_id")->references("id")->on("products");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('secondary_images');
    }
}
