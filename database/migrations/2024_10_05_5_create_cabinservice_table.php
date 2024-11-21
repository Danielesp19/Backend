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
        Schema::create('cabinservice', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cabin_id');
            $table->foreignId('service_id');
            $table->timestamps();

            $table->foreign('cabin_id')->references('id')->on('cabins')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('service_id')->references('id')->on('services')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabinservice');
    }
};
