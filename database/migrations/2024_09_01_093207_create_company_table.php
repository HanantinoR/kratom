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
            $table->string('company_provincy')->nullable();
            $table->string('company_city')->nullable();
            $table->text('company_address')->nullable();
            $table->text('company_factory')->nullable();
            $table->string('company_inspection_office');
            $table->string('company_pic')->nullable();
            $table->string('company_position')->nullable();
            $table->string('company_npwp')->nullable();
            $table->string('company_telp')->nullable();
            $table->string('company_hp')->nullable();
            $table->string('company_email')->nullable();
            $table->string('status')->nullable();
            $table->string('file_et')->nullable();
            $table->string('file_pe')->nullable();
            $table->string('file_nib')->nullable();
            $table->string('file_npwp')->nullable();
            $table->string('file_ktp')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
