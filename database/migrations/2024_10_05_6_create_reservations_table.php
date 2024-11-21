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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cabinservice_id');
            $table->foreignId('user_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();

            $table->foreign('cabinservice_id')->references('id')->on('cabinservice')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
