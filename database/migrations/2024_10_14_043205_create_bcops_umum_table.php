<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBcopsUmumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bcops_umum', function (Blueprint $table) {
            $table->id();
            $table->string('red_seal_id')->constrained('bcops_red_seal')->onDelete('cascade')->nullable();
            $table->string('green_seal_id')->constrained('bcops_green_seal')->onDelete('cascade')->nullable();
            $table->string('lock_seal_id')->constrained('bcops_lock_seal')->onDelete('cascade')->nullable();
            $table->string('thread_seal_id')->constrained('bcops_thread_seal')->onDelete('cascade')->nullable();
            $table->string('date_seal')->nullable();
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
        Schema::dropIfExists('bcops_umum');
    }
}
