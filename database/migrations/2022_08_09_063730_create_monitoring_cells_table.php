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
        Schema::create('monitoring_cells', function (Blueprint $table) {
            $table->id();
           // $table->id();
           $table->foreignId('monitoring_id')->none()->constrained('monitorings')->onUpdate('cascade')->onDelete('cascade');
            $table->double('tegangan_cell',15,8);
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
        Schema::dropIfExists('monitoring_cells');
    }
};
