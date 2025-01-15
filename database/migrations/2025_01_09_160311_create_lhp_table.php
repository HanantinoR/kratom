<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLhpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lhp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppbe_id')->nullable()->constrained('ppbe')->onDelete('cascade');
            $table->foreignId('hplps_id')->nullable()->constrained('hplps')->onDelete('cascade');
            $table->string('code')->unique()->nullable();
            $table->string('code_below_lhp')->unique()->nullable();
            $table->string('code_above_lhp')->unique()->nullable();
            $table->date('code_date')->nullable();
            $table->string('nib');
            $table->string('nomor_et');
            // $table->string('nomor_pe');
            $table->date('date_nib');
            $table->date('date_et');
            // $table->date('date_pe');
            $table->string('destination_port_id')->nullable();//int
            $table->string('loading_port_id')->nullable();//int
            $table->string('origin_port_id')->nullable(); //int
            $table->string('country_id')->nullable(); //int
            $table->string('company_name');
            $table->text('company_address')->nullable();
            $table->string('company_npwp')->nullable();
            $table->string('inspection_office_id');//int
            $table->date('inspection_date');
            $table->text('inspection_address');
            $table->string('fob_total')->nullable();
            $table->string('fob_currency')->nullable();
            $table->string('invoice_number')->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('packing_list_number')->nullable();
            $table->date('packing_list_date')->nullable();
            $table->string('buyer_name')->nullable();
            $table->text('buyer_address')->nullable();
            $table->string('merk')->nullable();
            $table->string('hpl_notes')->nullable();
            $table->string('packing_total')->nullable();
            $table->string('packing_type')->nullable();
            $table->string('signer_ls_id')->nullable();//int
            $table->integer('is_canceled')->nullable();
            $table->string('canceled_reason')->nullable();
            $table->string('file_cancel')->nullable();
            $table->integer('is_perubahan')->nullable();//int
            $table->string('mexamination_conclusions_id')->nullable();//int
            $table->string('status')->nullable();
            $table->string('surveyor_reports_id')->nullable();//int
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
        Schema::dropIfExists('lhp');
    }
}
