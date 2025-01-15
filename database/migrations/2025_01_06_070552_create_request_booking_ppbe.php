<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestBookingPpbe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_booking_ppbe', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppbe_id')->nullable()->constrained('ppbe')->onDelete('cascade');
            $table->text('request_result')->nullable();
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
        Schema::dropIfExists('request_booking_ppbe');
    }
}
