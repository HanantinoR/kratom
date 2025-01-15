<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalysisLab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analysis_lab', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppbe_id')->nullable()->constrained('ppbe')->onDelete('cascade');
            $table->text('analysis_result')->nullable();
            $table->string('request_by')->nullable();
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
        Schema::dropIfExists('analysis_lab');
    }
}
