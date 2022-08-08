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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('settingsuhus_id')->none()->constrained('setting_suhus')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('settingtegangans_id')->none()->constrained('setting_tegangans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('settingaruses_id')->none()->constrained('setting_aruses')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('settings');
    }
};
