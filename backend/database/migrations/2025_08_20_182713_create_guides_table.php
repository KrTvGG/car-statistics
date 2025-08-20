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
        Schema::create('guides', function (Blueprint $table) {
            $table->id();
            $table->string('make', 255); // Производитель
            $table->string('model', 255); // Модель
            $table->year('year'); // Год выпуска
            $table->string('body_type', 100)->nullable(); // Тип кузова
            $table->string('engine_type', 100)->nullable(); // Тип двигателя
            $table->float('engine_capacity'); // Объем двигателя
            $table->smallInteger('power'); // Мощность
            $table->string('transmission', 50)->nullable(); // Тип трансмиссии
            $table->string('drive_type', 50)->nullable(); // Тип привода
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guides');
    }
};
