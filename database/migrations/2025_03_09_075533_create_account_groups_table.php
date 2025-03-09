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
        Schema::create('account_groups', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name'); // Account Group name
            $table->foreignId('nature_id')->constrained('natures')->onDelete('cascade'); // Foreign key to nature table
            $table->foreignId('group_under_id')->constrained('group_unders')->onDelete('cascade'); // Foreign key to group_under table
            $table->text('description')->nullable(); // Optional description
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to user table
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_groups');
    }
};
