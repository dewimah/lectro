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
            $table->enum('control_relay', ['1', '0']);
            $table->double('tegangan_tot',15,8);
            $table->double('tegangan_cell',15,8);
            $table->double('temp_1',15,8);
            $table->double('temp_2',15,8);
            $table->double('temp_3',15,8);
            $table->double('arus',15,8);
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
