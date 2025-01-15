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
            $table->string('npwp');
            $table->date('date_nib')->nullable();
            $table->date('date_et')->nullable();
            $table->string('name')->nullable();
            $table->text('result_et')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->text('company_address')->nullable();
            $table->text('factory_address')->nullable();
            $table->integer('branch_office')->nullable();
            $table->string('pic')->nullable();
            $table->string('position')->nullable();
            $table->string('status')->nullable();
            $table->string('file_et')->nullable();
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
