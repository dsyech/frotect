<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technicals', function (Blueprint $table) {
            $table->id();
            $table->string('witel');
            $table->string('node');
            $table->string('platform');
            $table->string('ne');
            $table->string('shelf');
            $table->string('slot');
            $table->string('port');
            $table->string('type_from');
            $table->string('ne_from');
            $table->string('port_from');
            $table->string('type_to');
            $table->string('ne_to');
            $table->string('port_to');
            $table->text('keterangan');
            $table->string('created_by');
            $table->string('updated_by');
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
        Schema::dropIfExists('technicals');
    }
}
