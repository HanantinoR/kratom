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
            $table->string('code');
            $table->date('date');
            $table->foreignId('company_id')->constrained('company')->onDelete('cascade');
            $table->string('merk')->nullable();
            $table->string('packing_number')->nullable();
            $table->string('packing_total')->nullable();
            $table->string('fob_total')->nullable();
            $table->string('fob_currency')->nullable();
            $table->string('invoice_number')->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('packing_list_number')->nullable();
            $table->date('packing_list_date')->nullable();
            $table->string('buyer_name')->nullable();
            $table->text('buyer_address')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('country_destination_id')->nullable();
            $table->integer('destination_port_id')->nullable();
            $table->integer('loading_port_id')->nullable();
            $table->integer('goods_storage')->comment('1: Gudang Pabrik, 2: Gudang Konsolidator');
            $table->integer('inspection_office_id');
            $table->date('inspection_date');
            $table->string('inspection_timezone');
            $table->text('inspection_address');
            $table->integer('inspection_province_id');
            $table->integer('inspection_city_id');
            $table->string('inspection_pic_name')->nullable();
            $table->string('inspection_pic_phone')->nullable();
            $table->integer('stuffing_office_id')->nullable();
            $table->date('stuffing_date')->nullable();
            $table->string('stuffing_timezone')->nullable();
            $table->text('stuffing_address')->nullable();
            $table->string('status');
            $table->string('memorize_type');
            $table->string('memorize_feet');
            $table->string('memorize_total');
            $table->string('memorize_skenario');
            $table->string('file_nib');
            $table->string('file_invoice');
            $table->string('file_packing_list');
            $table->string('notes')->nullable();
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
