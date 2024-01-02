<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategorienOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategorien_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('kategorien_id')->nullable();
            $table->string('danger')->nullable();
            $table->string('kat1')->nullable();
            $table->string('kat2')->nullable();
            $table->string('kat3')->nullable();
            $table->string('kat4')->nullable();
            $table->string('kat5')->nullable();
            $table->string('kat6')->nullable();
            $table->string('kat7')->nullable();
            $table->string('kat8')->nullable();
            $table->string('kat9')->nullable();
            $table->string('kat10')->nullable();
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
        Schema::dropIfExists('kategorien_options');
    }
}
