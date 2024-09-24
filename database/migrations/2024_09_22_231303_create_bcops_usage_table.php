<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBcopsUsageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bcops_usage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hplps_id')->constrained('hplps')->onDelete('cascade');
            $table->integer('type')->nullable();
            $table->string('series')->nullable();
            $table->string('series_init')->nullable();
            $table->string('series_final')->nullable();
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
        Schema::dropIfExists('bcops_usage');
    }
}
