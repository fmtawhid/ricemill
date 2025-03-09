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
        Schema::create('account_ledgers', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name'); // Account Ledger name
            $table->foreignId('account_group_id')->constrained('account_groups')->onDelete('cascade'); // Foreign key to account_groups table
            $table->string('phone_number'); // Phone number
            $table->string('email'); // Email address
            $table->decimal('opening_balance', 15, 2); // Opening balance
            $table->enum('debit_credit', ['debit', 'credit']); // Debit or Credit
            $table->enum('status', ['active', 'deactivate']); // Account status
            $table->text('address'); // Address
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_ledgers');
    }
};
