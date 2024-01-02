<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterneUnfallmeldungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('interne unfallmeldung', function (Blueprint $table) {
//            $table->id();
//            $table->text('standort')->nullable();
//            $table->text('Zustandige')->nullable();
//            $table->text('erstellt_von')->nullable();
//            $table->text('abgeseschlossen_am')->nullable();
//            $table->text('Abteilung')->nullable();
//            $table->text('Name_des_Verunfallten')->nullable();
//            $table->text('Berufshauptgruppe')->nullable();
//            $table->text('Zeitpunkt_des_Unfalls')->nullable();
//            $table->text('Ausgefallene_Arbeitstage')->nullable();
//            $table->text('Art_des_Unfalls')->nullable();
//            $table->text('Sonstige_Schaden')->nullable();
//            $table->text('Betroffene_Korperteile')->nullable();
//            $table->text('Art_der_Verletzung')->nullable();
//            $table->text('Bauliche_Einrichtung')->nullable();
//            $table->text('Schwere_des_Unfalls')->nullable();
//            $table->text('Korrekturmabnahmen_angezeigt')->nullable();
//            $table->text('Korrekturmabnahme')->nullable();
//            $table->text('Mabnahme')->nullable();
//            $table->text('Deadline')->nullable();
//            $table->text('Status')->nullable();
//            $table->text('Prioritat')->nullable();
//            $table->text('Abfrage')->nullable();
//            $table->text('beschreibung')->nullable();
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
        Schema::dropIfExists('interne_unfallmeldungs');
    }
}
