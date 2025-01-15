<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyPeDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_pe_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pe_id')->nullable()->constrained('company_pe')->onDelete('cascade');
            $table->string('hs')->nullable();
            $table->string('detail')->nullable();
            $table->integer('volume_total')->nullable();
            $table->integer('volume_sisa')->nullable();
            $table->integer('volume_tersedia')->nullable();
            $table->integer('tgl_berlaku')->nullable();
            $table->integer('terpakai_ls')->nullable();
            $table->integer('booking_ls')->nullable();
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
        Schema::dropIfExists('company_pe_detail');
    }
}
