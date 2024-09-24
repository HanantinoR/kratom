<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePpbeHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppbe_history', function (Blueprint $table) {
            $table->id();
            $table->integer('ppbe_id')->constrained('ppbe')->onDelete('cascade');
            $table->integer('request_id')->nullable();
            $table->integer('approver_id')->nullable();
            $table->string('status')->nullable();
            $table->string('status_description')->nullable();
            $table->string('new_status')->nullable();
            $table->string('reason')->nullable();
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
        Schema::dropIfExists('ppbe_history');
    }
}
