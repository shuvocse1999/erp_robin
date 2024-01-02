<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBegehungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('begehung', function (Blueprint $table) {
//            $table->id();
//            $table->text('Standort')->nullable();
//            $table->text('Erstellt_von')->nullable();
//            $table->text('Anlass')->nullable();
//            $table->text('Abteilung_Bereich')->nullable();
//            $table->text('Thema_Problem_Missstand')->nullable();
//            $table->text('Bild')->nullable();
//            $table->text('Information_Mangel')->nullable();
//            $table->text('Bemerkungen')->nullable();
//            $table->text('Bewertung')->nullable();
//            $table->text('Gesamtrisiko')->nullable();
//            $table->text('Mabnahmenplanung')->nullable();
//            $table->text('Ubertrag_Gefahrdungs')->nullable();
//            $table->text('created_at')->nullable();
//            $table->text('updated_at')->nullable();
//            $table->text('URL')->nullable();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('begehungs');
    }
}
