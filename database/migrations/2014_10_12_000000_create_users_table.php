<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('status')->default(0);
            $table->string('firmenname')->nullable();
            $table->string('standort')->nullable();
            $table->string('abteilung')->nullable();
            $table->string('vorname')->nullable();
            $table->string('nachname')->nullable();
            $table->string('strasse')->nullable();
            $table->string('hasunr')->nullable();
            $table->string('plz')->nullable();
            $table->string('wohnort')->nullable();
            $table->string('email')->unique();
            $table->string('berichte')->nullable();
            $table->string('responsible_BG')->nullable();
            $table->string('company_size')->nullable();
            $table->integer('role_id')->default(2);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->text('access_token')->nullable();
            $table->string('token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
