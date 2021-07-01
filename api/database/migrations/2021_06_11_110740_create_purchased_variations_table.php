<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasedVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchased_variations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("purchase_id");
            $table->foreign("purchase_id")->references("id")->on("purchases");
            $table->float("price");
            $table->integer("amount");
            $table->unsignedBigInteger("variation_id");
            $table->foreign("variation_id")->references("id")->on("variations");
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
        Schema::dropIfExists('purchased_variations');
    }
}
