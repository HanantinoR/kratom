<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Inatrade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inatrade', function (Blueprint $table) {
            $table->id();
            $table->string('ls_number');
            $table->date('ls_publish_date');
            $table->string('ppbe_number');
            $table->date('ppbe_publish_date');
            $table->string('status');
            $table->string('company_name');
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
        Schema::dropIfExists('inatrade');
    }
}
