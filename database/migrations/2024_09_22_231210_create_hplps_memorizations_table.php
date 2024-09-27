<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHplpsMemorizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hplps_memorizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hplps_id')->constrained('hplps')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->string('create_number')->nullable();
            $table->string('create_type')->nullable();
            $table->string('size')->nullable();
            $table->string('series')->nullable();
            $table->string('series_init')->nullable();
            $table->string('series_total')->nullable();
            $table->string('series_type')->nullable();
            $table->string('tps_merah')->nullable();
            $table->string('tps_hijau')->nullable();
            $table->string('thread_seal')->nullable();
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
        Schema::dropIfExists('hplps_memorizations');
    }
}
