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
        Schema::create('battery_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('battery_id')->references('id')->on('batteries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            //$table->primary(['battery_id','user_id']);
            $table->enum('is_active', ['aktif', 'non-aktif']);
            //$table->foreignId('monitoring_id')->references('id')->on('monitorings')->onUpdate('cascade')->onDelete('cascade');
            //$table->string('token_device')->nullable();
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
        Schema::dropIfExists('battery_users');
    }
};
