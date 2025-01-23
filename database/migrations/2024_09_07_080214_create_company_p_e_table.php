<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyPETable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_pe', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pe');
            $table->string('file_pe');
            $table->text('result_pe')->nullable();
            $table->foreignId('company_id')->nullable()->constrained('company')->onDelete('cascade');
            $table->date('permit_date')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->string('status')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();

        });
    }
    // 2024_12_23_073818
    // 2024_09_10_062804
    // 2024_09_07_080214

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_pe');
    }
}
