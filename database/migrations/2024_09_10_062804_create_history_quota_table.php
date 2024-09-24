<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryQuotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_quota', function (Blueprint $table) {
            $table->id();
            $table->string('ppbe_id')->nullable();
            $table->string('ls_id')->nullable();
            $table->foreignId('company_id')->constrained('company')->onDelete('cascade');
            $table->string('nomor_pe')->nullable();
            $table->date('date_pe')->nullable();
            $table->string('company_quota')->nullable();
            $table->string('company_quota_remaining')->nullable();
            $table->string('company_quota_used')->nullable();
            $table->string('status_quota')->nullable();
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
        Schema::dropIfExists('history_quota');
    }
}
