<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBereichesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bereiches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aufgabe_id')->nullable();
            $table->foreign('aufgabe_id')->references('id')->on('aufgabes')->onDelete('cascade');
            $table->string('name');
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
        Schema::dropIfExists('bereiches');
    }
}
