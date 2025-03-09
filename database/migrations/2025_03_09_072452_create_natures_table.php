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
        Schema::create('natures', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name'); // Nature name
            $table->text('note')->nullable(); // Optional note
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to user table
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('natures');
    }
};
