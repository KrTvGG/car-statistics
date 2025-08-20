<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->tinyText('name');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('guide_id');
            $table->foreign('guide_id')->references('id')->on('guides');
            $table->tinyInteger('car_year');
            $table->tinyText('car_color');
            $table->tinyText('vin_number');
            $table->tinyText('car_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
