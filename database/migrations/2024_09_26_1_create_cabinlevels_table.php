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
        /* This PHP code snippet is creating a migration in Laravel that defines a database table named
        `cabin_leves`. Here's a breakdown of what each line inside the `Schema::create` function is
        doing: */
        Schema::create('cabin_leves', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 50)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabin_leves');
    }
};