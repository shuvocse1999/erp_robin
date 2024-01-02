<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTatigkeitsberichtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('tatigkeitsbericht', function (Blueprint $table) {
//            $table->id();
//            $table->text('Standort')->nullable();
//            $table->text('Erstellt_von')->nullable();
//            $table->text('Kategorie')->nullable();
//            $table->text('Beginn')->nullable();
//            $table->text('Ende')->nullable();
//            $table->text('Beschreibung')->nullable();
//            $table->text('Dauer_Aufwand')->nullable();
//            $table->text('Dieser_Abs')->nullable();
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tatigkeitsberichts');
    }
}
