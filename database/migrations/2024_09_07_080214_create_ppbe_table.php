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
            $table->date('date')->nullable();
            $table->foreignId('company_id')->constrained('company')->onDelete('cascade');
            $table->string('merk')->nullable();
            $table->string('packing_total')->nullable();
            $table->int('packing_type')->nullable();
            $table->string('fob_total')->nullable();
            $table->int('fob_currency')->nullable();
            $table->string('invoice_number')->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('packing_list_number')->nullable();
            $table->date('packing_list_date')->nullable();
            $table->string('buyer_name')->nullable();
            $table->text('buyer_address')->nullable();
            $table->int('origin_port_id')->nullable(); //int
            $table->int('country_id')->nullable(); //int
            $table->int('country_destination_id')->nullable();//int
            $table->int('destination_port_id')->nullable();//int
            $table->int('loading_port_id')->nullable();//int
            $table->string('goods_storage')->comment('1: Gudang Pabrik, 2: Gudang Konsolidator');//int
            $table->int('inspection_office_id');//int
            $table->date('inspection_date');
            $table->string('inspection_timezone');
            $table->text('inspection_address');
            $table->int('inspection_province_id');//int
            $table->int('inspection_city_id');//int
            $table->string('inspection_pic_name')->nullable();
            $table->string('inspection_pic_phone')->nullable();
            $table->int('stuffing_office_id')->nullable(); //int
            $table->date('stuffing_date')->nullable();
            $table->string('stuffing_timezone')->nullable();
            $table->text('stuffing_address')->nullable();
            $table->string('status');
            $table->string('checkbox_data');
            $table->int('memorize_type');
            $table->int('memorize_size');
            $table->int('memorize_total');
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
