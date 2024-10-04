<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLsGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ls_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ls_id')->constrained('ls')->onDelete('cascade');
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
        Schema::dropIfExists('ls_goods');
    }
}
