<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slhs', function (Blueprint $table) {
            $table->id();
            $table->string('witel');
            $table->string('link_a');
            $table->string('link_b');
            $table->string('system');
            $table->string('ne');
            $table->string('shelf');
            $table->string('slot');
            $table->string('port');
            $table->string('level');
            $table->string('level_ref');
            $table->string('delta');
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
        Schema::dropIfExists('slhs');
    }
}
