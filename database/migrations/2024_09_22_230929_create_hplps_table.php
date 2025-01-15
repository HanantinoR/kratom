<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHplpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hplps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppbe_id')->nullable()->constrained('ppbe')->onDelete('cascade');
            // $table->foreignId('ls_id')->constrained('ls')->onDelete('cascade')->nullable();
            // $table->foreignId('lhp_id')->constrained('lhp')->onDelete('cascade')->nullable();
            $table->datetime('date')->nullable();
            $table->string('surveyor_id')->nullable();
            $table->datetime('inspection_date_start')->nullable();
            $table->datetime('inspection_date_end')->nullable();
            $table->string('hpl_notes')->nullable();
            $table->datetime('stuffing_date_start')->nullable();
            $table->datetime('stuffing_date_end')->nullable();
            $table->text('analysis_result')->nullable();
            $table->text('checker_list')->nullable();
            $table->string('status')->nullable();
            $table->string('merk')->nullable();
            $table->string('packaging_total')->nullable();
            $table->string('packaging_unit')->nullable();
            $table->string('inpsection_address')->nullable();
            $table->string('fob_total_hpl')->nullable();
            $table->string('fob_currency_hpl')->nullable();
            $table->string('hpl_feedback_reason')->nullable();
            $table->string('hplps_feedback_file')->nullable();
            $table->timestamps();
            $table->integer('request_id')->nullable();
            $table->integer('verify_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hplps');
    }
}
