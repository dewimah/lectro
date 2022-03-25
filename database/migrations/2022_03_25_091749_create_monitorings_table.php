<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('error_id')->none()->constrained('errors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('battery_id')->none()->constrained('batteries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('setting_id')->none()->constrained('settings')->onUpdate('cascade')->onDelete('cascade')->unsigned();
            $table->enum('control_relay', ['1', '0']);
            $table->integer('tegangan_tot');
            $table->integer('tegangan_cell');
            $table->integer('temp_1');
            $table->integer('temp_2');
            $table->integer('temp_3');
            $table->integer('arus');
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
        Schema::dropIfExists('monitorings');
    }
};
