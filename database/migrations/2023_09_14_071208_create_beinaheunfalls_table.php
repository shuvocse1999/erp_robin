<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeinaheunfallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('beinaheunfall', function (Blueprint $table) {
//            $table->id();
//            $table->text('Standort')->nullable();
//            $table->text('Vorbereitet_von')->nullable();
//            $table->text('Datum')->nullable();
//            $table->text('Genauer_Beinaheunfalls')->nullable();
//            $table->text('aus-1')->nullable();
//            $table->text('aus-2')->nullable();
//            $table->text('aus-3')->nullable();
//            $table->text('aus-4')->nullable();
//            $table->text('aus-5')->nullable();
//            $table->text('Beschreibe')->nullable();
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
        Schema::dropIfExists('beinaheunfalls');
    }
}
