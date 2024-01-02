<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessungerListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messunger_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('messunger_id')->nullable();
            $table->string('A')->nullable();
            $table->string('B')->nullable();
            $table->string('C')->nullable();
            $table->string('D')->nullable();
            $table->string('E')->nullable();
            $table->string('H')->nullable();
            $table->string('I')->nullable();
            $table->string('J')->nullable();
            $table->string('N')->nullable();
            $table->string('AC')->nullable();
            $table->string('AT')->nullable();
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
        Schema::dropIfExists('messunger_lists');
    }
}
