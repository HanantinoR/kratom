<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBcopsLockSealTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bcops_lock_seal', function (Blueprint $table) {
            $table->id();
            $table->string('seal_series')->nullable();
            $table->string('seal_init')->nullable();
            $table->string('seal_total')->nullable();
            $table->string('seal_finish')->nullable();
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
        Schema::dropIfExists('bcops_lock_seal');
    }
}
