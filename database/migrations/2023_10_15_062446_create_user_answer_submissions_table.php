<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAnswerSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_answer_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('answer_submissions_id')->nullable();
            $table->unsignedBigInteger('aufgaben_id')->nullable();
            $table->unsignedBigInteger('bereich_id')->nullable();
            $table->unsignedBigInteger('answer_sheet_id')->nullable();
            $table->unsignedBigInteger('answer_id')->nullable();
            $table->string('photo')->nullable();
            $table->text('Textfield')->nullable();
            $table->string('dateTime')->nullable();
            $table->string('Zahlen')->nullable();
            $table->string('Unterschrift')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('user_answer_submissions');
    }
}
