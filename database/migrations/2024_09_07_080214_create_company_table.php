<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('nib');
            $table->string('nomor_et');
            $table->string('nomor_pe');
            $table->date('date_nib');
            $table->date('date_et');
            $table->date('date_pe');
            $table->string('company_name');
            $table->string('company_quota');
            $table->string('company_provincy')->nullable();;
            $table->string('company_city')->nullable();;
            $table->string('company_address');
            $table->string('company_factory')->nullable();;
            $table->string('company_inspection_office');
            $table->string('company_pic');
            $table->string('company_position')->nullable();;
            $table->string('company_npwp');
            $table->string('company_telp')->nullable();;
            $table->string('company_hp')->nullable();;
            $table->string('company_email');
            $table->string('status');
            $table->string('file_et');
            $table->string('file_pe');
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
        Schema::dropIfExists('company');
    }
}
