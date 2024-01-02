<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('firma')->nullable();
            $table->string('vorname')->nullable();
            $table->string('nachname')->nullable();
            $table->string('adresse')->nullable();
            $table->string('postleitzahl')->nullable();
            $table->string('ort')->nullable();
            $table->string('email')->nullable();
            $table->string('telefon')->nullable();
            $table->string('status')->nullable();
            $table->string('priorität')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
