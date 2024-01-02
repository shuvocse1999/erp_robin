<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAufgabesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aufgabes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formular_id')->nullable(); // Use 'unsignedBigInteger' instead of 'unsignedInteger'
            $table->foreign('formular_id')->references('id')->on('formulars')->onDelete('cascade');
            $table->string('name')->nullable();
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
        Schema::dropIfExists('aufgabes');
    }
}
