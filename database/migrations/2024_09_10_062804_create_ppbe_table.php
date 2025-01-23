<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePpbeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('ppbe', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->date('date_ppbe')->nullable();
            $table->foreignId('company_id')->constrained('company')->onDelete('cascade');
            $table->foreignId('company_pe_id')->constrained('company_pe')->onDelete('cascade');
            $table->string('merk')->nullable();
            $table->string('packing_total')->nullable();
            $table->integer('packing_type')->nullable();
            $table->string('fob_total')->nullable();
            $table->integer('fob_currency')->nullable();
            $table->string('invoice_number')->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('packing_list_number')->nullable();
            $table->date('packing_list_date')->nullable();
            $table->string('buyer_name')->nullable();
            $table->text('buyer_address')->nullable();
            $table->integer('origin_port_id')->nullable(); //integer
            $table->integer('country_id')->nullable(); //integer
            $table->integer('country_destination_id')->nullable();//integer
            $table->integer('destination_port_id')->nullable();//integer
            $table->integer('loading_port_id')->nullable();//integer
            $table->string('goods_storage')->comment('1: Gudang Pabrik, 2: Gudang Konsolidator');//integer
            $table->integer('inspection_office_id');//integer
            $table->date('inspection_date');
            $table->string('inspection_timezone');
            $table->text('inspection_address');
            $table->integer('inspection_province_id');//integer
            $table->integer('inspection_city_id');//integer
            $table->string('inspection_pic_name')->nullable();
            $table->string('inspection_pic_phone')->nullable();
            $table->integer('stuffing_office_id')->nullable(); //integer
            $table->date('stuffing_date')->nullable();
            $table->string('stuffing_timezone')->nullable();
            $table->text('stuffing_address')->nullable();
            $table->string('status');
            $table->string('checkbox_data')->nullable();
            $table->integer('memorize_type');
            $table->integer('memorize_size');
            $table->integer('memorize_total');
            $table->string('memorize_skenario');
            $table->string('file_nib');
            $table->string('file_invoice');
            $table->string('file_packing_list');
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('ppbe');
    }
}
