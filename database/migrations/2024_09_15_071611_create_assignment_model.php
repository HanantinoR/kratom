<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePpbeAssignment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppbe_assignment', function (Blueprint $table) {
            $table->id();
            $table->integer('ppbe_id')->constrained('ppbe')->onDelete('cascade');
            $table->integer('surveyor_id')->constrained('users')->onDelete('cascade');
            $table->string('intervention_type')->nullable();
            $table->string('letter_number')->nullable();
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
        Schema::dropIfExists('assignment_model');
    }
}
