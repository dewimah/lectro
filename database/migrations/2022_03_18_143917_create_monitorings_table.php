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
            $table->foreignId('erorr_id')->none()->constrained('erorrs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('battery_id')->none()->constrained('battery')->onUpdate('cascade')->onDelete('cascade');
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
