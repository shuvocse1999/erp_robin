<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaschinenabnahmesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('maschinenabnahme', function (Blueprint $table) {
//            $table->id();
//            $table->text('standort')->nullable();
//            $table->text('Erstellt_von')->nullable();
//            $table->text('kategories')->nullable();
//            $table->text('abteilung_bereich')->nullable();
//            $table->text('Thema_Problem_Missstand')->nullable();
//            $table->text('informtaion_mangel')->nullable();
//            $table->text('bemerkungen')->nullable();
//            $table->text('Bewertung')->nullable();
//            $table->text('Gesamtrisiko')->nullable();
//            $table->text('ubertrag_in_die')->nullable();
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
        Schema::dropIfExists('maschinenabnahmes');
    }
}
