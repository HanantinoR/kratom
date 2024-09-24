<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePpbeGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppbe_goods', function (Blueprint $table) {
            $table->id();
            $table->integer('ppbe_id')->constrained('ppbe')->onDelete('cascade');
            $table->integer('processed_level_id')->nullable();
            $table->string('description')->nullable();
            $table->string('quantity_kg')->nullable();
            $table->string('fob_value')->nullable();
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
        Schema::dropIfExists('ppbe_goods');
    }
}
