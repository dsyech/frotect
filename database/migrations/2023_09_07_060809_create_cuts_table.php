<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuts', function (Blueprint $table) {
            $table->id();
            $table->string('id_telegram');
            $table->string('name');
            $table->string('phone_number');
            $table->string('witel');
            $table->string('link');
            $table->string('report');
            $table->string('photo');
            $table->string('lat');
            $table->string('long');
            $table->string('date');
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
        Schema::dropIfExists('cuts');
    }
}
